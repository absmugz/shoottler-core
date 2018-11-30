<template>
  <b-card v-if="companiesList.data">
    <div slot="header">
      <strong>Edit company</strong> <small>{{ company.name }}</small>
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
        <label for="name">Company</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Enter your company name"
          v-model="company.name"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="brand">Brand</label>
        <b-form-input
          type="text"
          id="brand"
          name="brand"
          placeholder="Your awesome trademark or brand"
          v-model="company.brand"
          v-validate="'required|min:8|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="website">Website</label>
        <b-form-input
          type="text"
          id="website"
          name="website"
          placeholder="Enter your company's website"
          v-model="company.website"
          v-validate="'required|url'"/>
      </b-form-group>
      <b-form-group>
        <label for="facebook">Facebook Url</label>
        <b-form-input
          type="text"
          id="facebook"
          name="facebook"
          placeholder="Enter your company's facebook page"
          v-model="company.facebook"/>
      </b-form-group>
      <b-form-group>
        <label for="google_plus">Google+</label>
        <b-form-input
          type="text"
          id="google_plus"
          name="google_plus"
          placeholder="Enter your company's google+ page"
          v-model="company.google_plus"/>
      </b-form-group>
      <b-form-group>
        <label for="tripadvisor">TripAdvisor</label>
        <b-form-input
          type="text"
          id="tripadvisor"
          name="tripadvisor"
          placeholder="Enter your company's TripAdvisor property Url"
          v-model="company.tripadvisor"/>
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a company. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteCompany(id)"
      ok-variant="danger">
      When you delete a company, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('company')
export default {
  name : 'EditCompany',
  props: { id: '' },
  data () {
    return {
      company: {
        name       : '',
        brand      : '',
        website    : '',
        facebook   : '',
        google_plus: '',
        tripadvisor: '',
      },
      serverErrors  : '',
      successMessage: '',
      deleteWarning : false,
    }
  },
  computed: {
    ...mapState({ companiesList: state => state.companiesList }),
    token () {
      return this.$store.state.token
    },
  },
  mounted () {
    this.getCompany(this.id)
  },
  methods: {
    ...mapActions({
      getCompaniesList : 'getCompaniesList',
      setActiveCompany : 'setActiveCompany',
      getDefaultCompany: 'getDefaultCompany',
    }),
    getCompany (id) {
      if (!this.companiesList.data) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
        return new Promise((resolve, reject) => {
          axios.get(`/companies/${id}`)
            .then((response) => {
              this.company =  response.data.data[0]
              resolve(response)
            })
            .catch(err => {
              this.serverErrors = Object.values(err.response.data.errors)
              reject(err)
            })
        })
      }
      this.company =  this.companiesList.data.find(function (company) {
        return company.id === id
      })
    },
    validateBeforeSubmit (id) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.updateCompany(id)
      })
    },
    updateCompany (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/companies/${id}/update`, {
          _method    : 'PUT',
          name       : this.company.name,
          brand      : this.company.brand,
          website    : this.company.website,
          facebook   : this.company.facebook,
          google_plus: this.company.google_plus,
          tripadvisor: this.company.tripadvisor,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.getDefaultCompany()
            this.getCompaniesList()
            this.setActiveCompany()
            this.$router.push({ name: 'My Companies' })
            resolve(response)
          })
          .catch(err => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteCompany (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/companies/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.setActiveCompany()
            this.getCompaniesList()
            this.getDefaultCompany()
            this.$router.push({ name: 'My Companies' })
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
