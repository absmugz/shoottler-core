<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Service</strong> <small>Form</small>
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
            placeholder="Service's name"
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
        <span class="form-error">{{ errors.first('vehicle') }}</span>
        <b-form-group>
          <label for="vehicle">Vehicle</label>
          <b-select-2
            id="vehicle"
            placeholder="Please select a vehicle"
            :options="vehicles"
            v-model="resource_id"
            name="resource_id"
            v-validate="'required'"/>
        </b-form-group>
        <b-form-group>
          <label for="type">Type</label>
          <b-select-2
            id="type"
            placeholder="Please select a type of service"
            :options="serviceTypes"
            v-model="type"
            name="type_id"
            v-validate="'required'"/>
        </b-form-group>
        <b-form-group>
          <label for="from">From</label>
          <b-select-2
            id="from"
            placeholder="Please select a zone for the starting point"
            :options="zones"
            name="from_zone_id"
            v-model="from_zone_id"/>
        </b-form-group>
        <b-form-group>
          <label for="to">To</label>
          <b-select-2
            id="to"
            placeholder="Please select a zone for the starting point"
            :options="zones"
            name="to_zone_id"
            v-model="to_zone_id"/>
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
  name: 'CreateService',
  data () {
    return {
      serviceTypes  : [],
      vehicles      : [],
      zones         : [],
      name          : '',
      description   : '',
      type          : '',
      from_zone_id  : '',
      to_zone_id    : '',
      resource_id   : '',
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
  watch: {
    activeCompanyId () {
      this.serviceTypes = []
      this.getServiceTypes()
      this.vehicles     = []
      this.getVehicles()
      this.zones        = []
      this.getZones()
    },
  },
  mounted () {
    if (this.activeCompanyId) {
      this.getServiceTypes()
      this.getVehicles()
      this.getZones()
    }
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createService()
      })
    },
    createService () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post('/services/create', {
          company_id  : this.activeCompanyId,
          name        : this.name,
          description : this.description,
          type        : this.type,
          resource_id : this.resource_id,
          from_zone_id: this.from_zone_id,
          to_zone_id  : this.to_zone_id,
        })
          .then((response) => {
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
