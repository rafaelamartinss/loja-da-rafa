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
                        :name="field.name"
                        v-model="form[field.name]"
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
                <b-button @click="submitProduct()" variant="primary">Salvar</b-button>
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

const QUERY_UPDATE_PRODUCT = gql`
    mutation updateProduct(
        $id: ID!,
        $name: String,
        $value: Float,
        $quantity: Int,
        $category_id: ID)
    {
        updateProduct(
            id: $id,
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
            },
            product_id: {
                type: String
            }
        },
        apollo: {},
        data() {
            return {
                products: [],
                form: {
                    _method: this.filterFields('_method'),
                    name: this.filterFields('name'),
                    value: this.filterFields('value'),
                    quantity: this.filterFields('quantity'),
                    category_id: this.filterFields('category_id')
                }
            }
        },
        methods: {
            filterFields(inputName) {
                let inputValue = this.fields.filter(field => {
                    return field.name === inputName
                })[0]
                return inputValue !== undefined ? inputValue.value : 'POST';
            },
            submitProduct() {
                this.form._method === 'PUT' ? this.updateProduct() : this.createProduct()
            },
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
            },
            updateProduct() {
                let name = this.form.name;
                let value = this.form.value;
                let quantity = this.form.quantity;
                let category_id = this.form.category_id;

                this.$apollo.mutate({
                    mutation: QUERY_UPDATE_PRODUCT,
                    variables: {
                        id: this.product_id,
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
