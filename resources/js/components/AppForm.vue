<template>
  <div>
    <b-form :action="routeForm" @reset="onReset" v-if="show" method="post">
        <b-form-input
            style="display:none;"
            id="token"
            name="_token"
            :value="csrf"
            required
        ></b-form-input>

        <b-form-group
            v-for="(field, key) in fields"
            v-bind:key="key"
            v-show="field.type !== 'hidden'"
            :id="field.name"
            :label="field.label"
            :label-for="field.name"
        >
            <b-form-input
            :id="field.name"
            :type="field.type"
            :name="field.name"
            :value="field.value"
            required
            ></b-form-input>
        </b-form-group>

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
        },
        data() {
        return {
            form: {
            email: '',
            name: '',
            food: null,
            checked: []
            },
            foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
            show: true
        }
        },
        methods: {
        onReset(evt) {
            evt.preventDefault()
            // Reset our form values
            this.form.email = ''
            this.form.name = ''
            this.form.food = null
            this.form.checked = []
            // Trick to reset/clear native browser form validation state
            this.show = false
            this.$nextTick(() => {
                this.show = true
            })
        }
    }
  }
</script>
