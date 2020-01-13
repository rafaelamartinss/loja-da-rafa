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
                :items="items"
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
                    <b-button variant="info" size="sm" :href="actions + '/' + row.item.id + '/edit'">
                        <b-icon icon="pencil"></b-icon>
                    </b-button>

                    <b-button variant="danger" size="sm" type="submit">
                        <form :action="actions + '/' + row.item.id" method="post">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="csrf">
                            <b-button variant="danger" size="sm" type="submit">
                                <b-icon icon="trash-fill"></b-icon>
                            </b-button>
                        </form>
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
    export default {
        props: {
            items: {
                type: Array,
                required: true
            },
            hasPermission: {
                type: Boolean,
                required: true
            },
            actions: {
                type: String
            },
            csrf: {
                type:String
            }
        },
        data() {
            return {
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
            // Set the initial number of items
            this.totalRows = this.items.length
        },
        methods: {
            onFiltered(filteredItems) {
                // Trigger pagination to update the number of buttons/pages due to filtering
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        }
    }
</script>
