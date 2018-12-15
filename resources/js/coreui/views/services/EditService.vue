<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit service</strong> <small>{{ service.name }}</small>
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
        <label for="name">Service</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Service's Name"
          v-model="service.name"
          v-validate="'required|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="description">Description</label>
        <b-form-input
          type="text"
          id="description"
          name="description"
          placeholder="Description"
          v-model="service.description"
        />
      </b-form-group>
      <b-form-group>
        <label for="make">Vehicle</label>
        <b-form-input
          type="text"
          id="vehicle"
          name="resource_id"
          placeholder="Vehicle"
          v-model="service.resource_id"
        />
      </b-form-group>
      <b-form-group>
        <label for="type">Type</label>
        <b-form-input
          type="text"
          id="type"
          name="type"
          placeholder="Type"
          v-model="service.type"/>
      </b-form-group>
      <b-form-group>
        <label for="from">From</label>
        <b-form-input
          type="text"
          id="from"
          name="from_zone_id"
          placeholder="From"
          v-model="service.from_zone_id"/>
      </b-form-group>
      <b-form-group>
        <label for="to">To</label>
        <b-form-input
          type="text"
          id="to"
          name="to_zone_id"
          placeholder="To"
          v-model="service.to_zone_id"/>
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a service. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteService(id)"
      ok-variant="danger">
      When you delete a service, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
export default {
  name : 'EditService',
  props: { id: '' },
  data () {
    return {
      service: {
        name        : '',
        description : '',
        type        : '',
        resource_id : '',
        from_zone_id: '',
        to_zone_id  : '',
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
    this.getServices(this.id)
  },
  methods: {
    getServices (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/services/${id}`)
          .then((response) => {
            this.service =  response.data.data
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
          this.updateService(id)
      })
    },
    updateService (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/services/${id}/update`, {
          _method     : 'PUT',
          name        : this.service.name,
          description : this.service.description,
          type        : this.service.type,
          resource_id : this.service.resource_id,
          from_zone_id: this.service.from_zone_id,
          to_zone_id  : this.service.to_zone_id,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'services list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteService (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/services/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'services list' })
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
