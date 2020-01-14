<template>
    <div>
        <b-container fluid>
            <!-- User Interface controls -->
            <b-row>

                <b-col lg="4" class="my-1">
                    <b-form-group
                        class="mb-0"
                        >
                        <b-input-group size="sm">
                            <b-form-input
                                v-model="filter"
                                type="search"
                                id="filterInput"
                                placeholder="Pesquise"
                            ></b-form-input>
                            <b-input-group-append>
                                <b-button
                                    :disabled="!filter"
                                    @click="filter = ''"
                                    >x</b-button>
                            </b-input-group-append>
                        </b-input-group>
                    </b-form-group>
                </b-col>
                <b-col sm="5" md="4" class="my-1">
                    <b-form-group
                        label="Items por pagina"
                        label-cols-sm="7"
                        label-cols-md="7"
                        label-cols-lg="6"
                        label-align-sm="right"
                        label-size="sm"
                        label-for="perPageSelect"
                        class="mb-0"
                        >
                        <b-form-select
                            v-model="perPage"
                            id="perPageSelect"
                            size="sm"
                            :options="pageOptions"
                        ></b-form-select>
                    </b-form-group>
                </b-col>
            </b-row>

            <b-table
                show-empty
                small
                stacked="md"
                :items="products"
                :fields="fields"
                :current-page="currentPage"
                :per-page="perPage"
                :filter="filter"
                :filterIncludedFields="filterOn"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                :sort-direction="sortDirection"
                @filtered="onFiltered"
                >

                <template v-slot:cell(actions)="row">
                    <b-button size="sm" @click="row.toggleDetails">
                        <b-icon icon="plus"></b-icon>
                    </b-button>
                    <b-button variant="info" size="sm" :href="'products/' + row.item.id + '/edit'">
                        <b-icon icon="pencil"></b-icon>
                    </b-button>
                    <b-button variant="danger" size="sm" @click="deleteProduct(row.item.id)">
                        <b-icon icon="trash-fill"></b-icon>
                    </b-button>
                </template>

                <template v-slot:row-details="row">
                    <b-card>
                        <ul>
                            <p>Detalhes</p>
                            <li>Nome: {{ row.item.name }}</li>
                        </ul>
                    </b-card>
                </template>
            </b-table>

            <b-row>
                <b-col sm="5" md="4" class="my-1">
                    <b-pagination
                    v-model="currentPage"
                    :total-rows="totalRows"
                    :per-page="perPage"
                    align="fill"
                    size="sm"
                    class="my-0"
                    ></b-pagination>
                </b-col>
            </b-row>
        </b-container>
    </div>
</template>


<script>
import gql from 'graphql-tag'

const QUERY_PRODUCTS = gql`
    query Products
    {
        products{
            id
            name
        }
    }`;

const QUERY_DELETE_PRODUCT = gql`
    mutation deleteProduct($id: ID!)
    {
        deleteProduct(id: $id){
            id
            name
        }
    }`;

    export default {
        props: {
             hasPermission: {
                type: Boolean,
                required: true
            },
            csrf: {
                type:String
            }
        },
        apollo: {
            products: {
                query : QUERY_PRODUCTS
            },
        },
        data() {
            return {
                products: [],
                fields: [
                    { key: 'id', label: 'ID', sortable: true, class: 'text-center' },
                    { key: 'name', label: 'Nome', sortable: true, sortDirection: 'desc' },
                    { key: 'actions', label: 'Actions' }
                ],
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15],
                sortBy: '',
                sortDesc: false,
                sortDirection: 'asc',
                filter: null,
                filterOn: [],
            }
        },
        computed: {
            sortOptions() {
                // Create an options list from our fields
                return this.fields
                    .filter(f => f.sortable)
                    .map(f => {
                        return { text: f.label, value: f.key }
                    })
            }
        },
        mounted() {
            this.$apollo.queries.products.refetch().then(() => {
                this.totalRows = this.products.length
            });
        },
        methods: {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            deleteProduct(id) {
                this.$apollo.mutate({
                    mutation: QUERY_DELETE_PRODUCT,
                    variables: {
                        id
                    }
                })
            }
        }
    }
</script>
