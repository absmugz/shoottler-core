<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit zone</strong> <small>{{ zone.name }}</small>
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
        <b-select-2
          id="serviceArea"
          placeholder="Please select a service area"
          :options="items"
          v-model="area"/>
      </b-form-group>
      <b-form-group>
        <label for="name">Name</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Name"
          v-model="zone.name"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a zone. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteZone(id)"
      ok-variant="danger">
      When you delete a service area, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState } = createNamespacedHelpers('company')
export default {
  name : 'EditZone',
  props: { id: '' },
  data () {
    return {
      items         : [],
      area          : '',
      zone          : { name: '' },
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
    ...mapState({ activeCompanyId: state => state.activeCompany.id }),
  },
  mounted () {
    this.getZone(this.id)
    if (this.activeCompanyId)
      this.getAreas()
  },
  watch: {
    activeCompanyId () {
      this.items = []
      this.getAreas()
    },
  },
  methods: {
    getZone (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/zones/${id}`)
          .then((response) => {
            this.zone   =  response.data.data
            this.loaded = true
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getAreas () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/areas/', { params: { company_id: this.activeCompanyId } })
          .then((response) => {
            this.items  = response.data.data.map(area => {
              const rArea = {}
              rArea.value = area.id
              rArea.text  = area.name
              return rArea
            })
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
          this.updateZone(id)
      })
    },
    updateZone (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/zones/${id}/update`, {
          _method: 'PUT',
          area   : this.area,
          name   : this.zone.name,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'zones list' })
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteZone (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/zones/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'zones list' })
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
