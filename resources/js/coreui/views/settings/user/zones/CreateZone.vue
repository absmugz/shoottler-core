<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Zone</strong> <small>Form</small>
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
        <b-form-group>
          <label for="area">Service Area</label>
          <b-select-2
            v-if="loaded"
            id="serviceArea"
            placeholder="Please select a service area"
            :options="items"
            v-model="area"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('name') }}</span>
        <b-form-group>
          <label for="name">Name </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Zone name"
            v-model="name"
            v-validate="'required|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('country') }}</span>
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
  name: 'CreateZone',
  data () {
    return {
      items         : [],
      area          : '',
      name          : '',
      loaded        : '',
      serverErrors  : '',
      successMessage: '',
    }
  },
  computed: {
    token () {
      return this.$store.state.token
    },
    ...mapState({ activeCompanyId: state => state.activeCompany.id }),
  },
  mounted () {
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
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createZone()
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
    createZone () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post('/zones/create', {
          area: this.area,
          name: this.name,
        })
          .then((response) => {
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
