<template>
  <div>
    <b-form :action="routeForm" method="post">
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
                    :options="field.options"
                    value-field="id"
                    text-field="name"
                    size="sm"
                    class="mt-3"
                >
            </b-form-select>
            </b-form-group>
        </div>

        <b-button type="submit" variant="primary">Salvar</b-button>
        <b-button type="reset" variant="danger" :href="routeList">Cancelar</b-button>
    </b-form>
  </div>
</template>

<script>
  export default {
        props: {
            fields: {
                type: Array
            },
            routeForm: {
                type: String
            },
            routeList: {
                type: String
            },
            csrf: {
                type: String
            }
        }
  }
</script>
