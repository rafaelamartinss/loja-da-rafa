<template>
    <div>
        <b-container fluid>
            <b-form method="post">
                <b-form-input
                    style="display:none;"
                    id="token"
                    name="_token"
                    :value="csrf"
                    required
                ></b-form-input>


                <div
                    v-for="(field, key) in fields"
                    v-bind:key="key"
                >
                    <b-form-group
                        v-if="field.options === undefined"
                        v-show="field.type_input !== 'hidden'"
                        :id="field.name"
                        :label="field.label"
                        :label-for="field.name"
                    >
                        <b-form-input
                        :id="field.name"
                        :type="field.type_input"
                        :name="field.name"
                        v-model="form[field.name]"
                        :value="field.value !== undefined ? field.value : ''"
                        required
                        ></b-form-input>
                    </b-form-group>

                    <b-form-group
                        v-if="field.options"
                        :id="field.name"
                        :label="field.label"
                        :label-for="field.name"
                    >
                        <b-form-select
                            :name="field.name"
                            v-model="form[field.name]"
                            :options="field.options"
                            value-field="id"
                            text-field="name"
                            size="sm"
                            class="mt-3"
                        >
                    </b-form-select>
                    </b-form-group>
                </div>

                <b-button @click="createProduct()" variant="primary">Salvar</b-button>
                <b-button type="reset" variant="danger" :href="routeList">Cancelar</b-button>
            </b-form>
        </b-container>
    </div>
</template>


<script>
import gql from 'graphql-tag'

const QUERY_CREATE_PRODUCT = gql`
    mutation createProduct(
        $name: String!,
        $value: Float!,
        $quantity: Int!,
        $category_id: ID!)
    {
        createProduct(
            name: $name,
            value: $value,
            quantity: $quantity,
            category_id: $category_id
        ){
            id
            name
        }
    }`;

    export default {
        props: {
            fields: {
                type: Array
            },
            routeList: {
                type: String
            },
            csrf: {
                type: String
            }
        },
        apollo: {
            // products: {
            //     query : QUERY_PRODUCTS
            // },
        },
        data() {
            return {
                products: [],
                form: {}
            }
        },
        methods: {
            createProduct() {
                let name = this.form.name;
                let value = this.form.value;
                let quantity = this.form.quantity;
                let category_id = this.form.category_id;

                this.$apollo.mutate({
                    mutation: QUERY_CREATE_PRODUCT,
                    variables: {
                        name,
                        value,
                        quantity,
                        category_id
                    }
                }).then(() => {
                    window.location.href = this.routeList
                })
            }
        }
    }
</script>
