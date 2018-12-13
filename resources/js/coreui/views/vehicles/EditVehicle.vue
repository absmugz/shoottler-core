<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit vehicle</strong> <small>{{ vehicle.name }}</small>
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
    <b-form @submit.prevent="validateBeforeSubmit(id)">
      <b-form-group>
        <label for="name">Vehicle</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Vehicle's Name"
          v-model="vehicle.name"
          v-validate="'required|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="description">Description</label>
        <b-form-input
          type="text"
          id="description"
          name="description"
          placeholder="Description"
          v-model="vehicle.description"
        />
      </b-form-group>
      <b-form-group>
        <label for="make">Make</label>
        <b-form-input
          type="text"
          id="make"
          name="make"
          placeholder="Make"
          v-model="vehicle.make"
        />
      </b-form-group>
      <b-form-group>
        <label for="model">Model</label>
        <b-form-input
          type="text"
          id="model"
          name="model"
          placeholder="Model"
          v-model="vehicle.model"/>
      </b-form-group>
      <b-form-group>
        <label for="year">Year</label>
        <b-form-input
          type="text"
          id="year"
          name="year"
          placeholder="Year"
          v-model="vehicle.year"/>
      </b-form-group>
      <b-form-group>
        <label for="capacity">Capacity</label>
        <b-form-input
          type="text"
          id="capacity"
          name="capacity"
          placeholder="Capacity"
          v-model="vehicle.capacity"
          v-validate="'required|max:255'"/>
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a vehicle. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteVehicle(id)"
      ok-variant="danger">
      When you delete a vehicle, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
export default {
  name : 'EditVehicle',
  props: { id: '' },
  data () {
    return {
      vehicle: {
        name       : '',
        description: '',
        make       : '',
        model      : '',
        year       : '',
        capacity   : '',
      },
      loaded        : false,
      serverErrors  : '',
      successMessage: '',
      deleteWarning : false,
    }
  },
  computed: {
    token () {
      return this.$store.state.token
    },
  },
  mounted () {
    this.getVehicle(this.id)
  },
  methods: {
    getVehicle (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/vehicles/${id}`)
          .then((response) => {
            this.vehicle =  response.data.data
            this.loaded  = true
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    validateBeforeSubmit (id) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.updateVehicle(id)
      })
    },
    updateVehicle (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/vehicles/${id}/update`, {
          _method    : 'PUT',
          name       : this.vehicle.name,
          description: this.vehicle.description,
          make       : this.vehicle.make,
          model      : this.vehicle.model,
          year       : this.vehicle.year,
          capacity   : this.vehicle.capacity,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'vehicles list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteVehicle (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/vehicles/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
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
