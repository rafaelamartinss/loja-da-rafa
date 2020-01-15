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
                <b-button @click="submitCategory()" variant="primary">Salvar</b-button>
                <b-button type="reset" variant="danger" :href="routeList">Cancelar</b-button>
            </b-form>
        </b-container>
    </div>
</template>


<script>
import gql from 'graphql-tag'

const QUERY_CREATE_CATEGORY = gql`
    mutation createCategory(
        $name: String!,)
    {
        createCategory(
            name: $name,
        ){
            id
            name
        }
    }`;

const QUERY_UPDATE_CATEGORY = gql`
    mutation updateCategory(
        $id: ID!,
        $name: String,)
    {
        updateCategory(
            id: $id,
            name: $name,
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
            category_id: {
                type: String
            }
        },
        apollo: {},
        data() {
            return {
                categories: [],
                form: {
                    _method: this.filterFields('_method'),
                    name: this.filterFields('name'),
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
            submitCategory() {
                this.form._method === 'PUT' ? this.updateCategory() : this.createCategory()
            },
            createCategory() {
                let name = this.form.name;

                this.$apollo.mutate({
                    mutation: QUERY_CREATE_CATEGORY,
                    variables: {
                        name
                    }
                }).then(() => {
                    window.location.href = this.routeList
                })
            },
            updateCategory() {
                let name = this.form.name;

                this.$apollo.mutate({
                    mutation: QUERY_UPDATE_CATEGORY,
                    variables: {
                        id: this.category_id,
                    }
                }).then(() => {
                    window.location.href = this.routeList
                })
            }
        }
    }
</script>
