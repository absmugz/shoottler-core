<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit service</strong> <small>{{ service.name }} - {{ service.type }}</small>
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
        <b-select-2
          id="vehicle"
          name="resource_id"
          placeholder="Vehicle"
          :options="vehicles"
          :value="service.resource_id"
          v-model="service.resource_id"
        />
      </b-form-group>
      <b-form-group>
        <label for="from">From</label>
        <b-select-2
          id="from"
          name="from_zone_id"
          placeholder="From"
          :options="zones"
          :value="service.from_zone_id"
          v-model="service.from_zone_id"/>
      </b-form-group>
      <b-form-group>
        <label for="to">To</label>
        <b-select-2
          id="to"
          name="to_zone_id"
          placeholder="To"
          :options="zones"
          :value="service.to_zone_id"
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
import { createNamespacedHelpers } from 'vuex'
const { mapState } = createNamespacedHelpers('company')
export default {
  name : 'EditService',
  props: { id: '' },
  data () {
    return {
      vehicles    : [],
      serviceTypes: [],
      zones       : [],
      service     : {
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
    ...mapState({ activeCompanyId: (state) => state.activeCompany.id }),
  },
  mounted () {
    this.getServices(this.id)
    if (this.activeCompanyId) {
      this.getServiceTypes()
      this.getVehicles()
      this.getZones()
    }
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
    getServiceTypes () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/item-types/', { params: { type: 'service' } })
          .then((response) => {
            this.serviceTypes = response.data.data.map((itemType) => {
              const rItemType = {}
              rItemType.value = itemType.id
              rItemType.text  = itemType.name
              return rItemType
            })
            this.loaded       = true
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getVehicles () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/vehicles/', { params: { company_id: this.activeCompanyId } })
          .then((response) => {
            this.vehicles = response.data.data.map((vehicle) => {
              const rVehicle = {}
              rVehicle.value = vehicle.id
              rVehicle.text  = vehicle.name
              return rVehicle
            })
            this.loaded   = true
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getZones () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/zones/', { params: { company_id: this.activeCompanyId } })
          .then((response) => {
            this.zones  = response.data.data.map((zone) => {
              const rZone = {}
              rZone.value = zone.id
              rZone.text  = zone.name
              return rZone
            })
            this.loaded = true
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
