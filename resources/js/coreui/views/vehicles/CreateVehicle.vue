<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Vehicle</strong> <small>Form</small>
      </div>
      <div
        v-if="serverErrors"
        class="server-error">
        <div
          v-for="(value, key) in serverErrors"
          :key="key">
          {{ value[0] }}
        </div>
      </div>
      <b-form @submit.prevent="validateBeforeSubmit()">
        <span class="form-error">{{ errors.first('name') }}</span>
        <b-form-group>
          <label for="name">Name </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Vehicle's name"
            v-model="name"
            v-validate="'required|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('description') }}</span>
        <b-form-group>
          <label for="description">Description</label>
          <b-form-input
            type="text"
            id="description"
            name="description"
            placeholder="Description"
            v-model="description"
          />
        </b-form-group>
        <span class="form-error">{{ errors.first('make') }}</span>
        <b-form-group>
          <label for="make">Make</label>
          <b-form-input
            type="text"
            id="make"
            name="make"
            placeholder="Make"
            v-model="make"
          />
        </b-form-group>
        <b-form-group>
          <label for="model">Model</label>
          <b-form-input
            type="text"
            id="model"
            name="model"
            placeholder="Model"
            v-model="model"/>
        </b-form-group>
        <b-form-group>
          <label for="year">Year</label>
          <b-form-input
            type="text"
            id="year"
            name="year"
            placeholder="Year"
            v-model="year"/>
        </b-form-group>
        <b-form-group>
          <label for="capacity">Capacity</label>
          <b-form-input
            type="text"
            id="capacity"
            name="capacity"
            placeholder="Capacity"
            v-model="capacity"
            v-validate="'required|max:255'"/>
        </b-form-group>
        <b-button
          type="submit"
          variant="primary">Save</b-button>
      </b-form>
    </b-card>
  </div>

</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState } = createNamespacedHelpers('company')
export default {
  name: 'CreateVehicle',
  data () {
    return {
      name          : '',
      description   : '',
      make          : '',
      model         : '',
      year          : '',
      capacity      : '',
      serverErrors  : '',
      successMessage: '',
    }
  },
  computed: {
    token () {
      return this.$store.state.token
    },
    ...mapState({ activeCompanyId: (state) => state.activeCompany.id }),
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createVehicle()
      })
    },
    createVehicle () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post('/vehicles/create', {
          company_id : this.activeCompanyId,
          name       : this.name,
          description: this.description,
          make       : this.make,
          model      : this.model,
          year       : this.year,
          capacity   : this.capacity,
        })
          .then((response) => {
            this.$router.push({ name: 'vehicles list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
  },
}
</script>
