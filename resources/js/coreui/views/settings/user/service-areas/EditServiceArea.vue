<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit area</strong> <small>{{ area.name }}</small>
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
        <label for="name">Area</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Service Area Name"
          v-model="area.name"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="brand">Country</label>
        <b-form-input
          type="text"
          id="country"
          name="country"
          placeholder="Country"
          v-model="area.country"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="website">City</label>
        <b-form-input
          type="text"
          id="city"
          name="city"
          placeholder="City"
          v-model="area.city"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="IATA">IATA Code</label>
        <b-form-input
          type="text"
          id="IATA"
          name="IATA"
          placeholder="IATA Code"
          v-model="area.IATA"/>
      </b-form-group>
      <b-form-group>
        <label for="ICAO">ICAO</label>
        <b-form-input
          type="text"
          id="ICAO"
          name="ICAO"
          placeholder="ICAO"
          v-model="area.ICAO"/>
      </b-form-group>
      <b-form-group>
        <label for="FAA">FAA</label>
        <b-form-input
          type="text"
          id="FAA"
          name="FAA"
          placeholder="FAA"
          v-model="area.FAA"/>
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a service area. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteArea(id)"
      ok-variant="danger">
      When you delete a service area, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
export default {
  name : 'EditServiceArea',
  props: { id: '' },
  data () {
    return {
      area: {
        type   : '',
        name   : '',
        country: '',
        city   : '',
        IATA   : '',
        ICAO   : '',
        FAA    : '',
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
    this.getArea(this.id)
  },
  methods: {
    getArea (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/areas/${id}`)
          .then((response) => {
            this.area   =  response.data.data
            this.loaded = true
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    validateBeforeSubmit (id) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.updateArea(id)
      })
    },
    updateArea (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/areas/${id}/update`, {
          _method: 'PUT',
          type   : this.area.type,
          name   : this.area.name,
          country: this.area.country,
          city   : this.area.city,
          IATA   : this.area.IATA,
          ICAO   : this.area.ICAO,
          FAA    : this.area.FAA,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'service areas list' })
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteArea (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/areas/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'service areas list' })
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
  },
}
</script>
