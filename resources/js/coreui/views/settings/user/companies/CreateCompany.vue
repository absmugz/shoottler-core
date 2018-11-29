<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Company</strong> <small>Form</small>
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
          <label for="name">Company </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your company name"
            v-model="name"
            v-validate="'required|min:8|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('brand') }}</span>
        <b-form-group>
          <label for="brand">Brand</label>
          <b-form-input
            type="text"
            id="brand"
            name="brand"
            placeholder="Your awesome trademark or brand"
            v-model="brand"
            v-validate="'required|min:8|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('website') }}</span>
        <b-form-group>
          <label for="website">Website</label>
          <b-form-input
            type="text"
            id="website"
            name="website"
            placeholder="Enter your company's website"
            v-model="website"
            v-validate="'required|url'"/>
        </b-form-group>
        <b-form-group>
          <label for="facebook">Facebook Url</label>
          <b-form-input
            type="text"
            id="facebook"
            name="facebook"
            placeholder="Enter your company's facebook page"
            v-model="facebook"/>
        </b-form-group>
        <b-form-group>
          <label for="google_plus">Google+</label>
          <b-form-input
            type="text"
            id="google_plus"
            name="google_plus"
            placeholder="Enter your company's google+ page"
            v-model="google_plus"/>
        </b-form-group>
        <b-form-group>
          <label for="tripadvisor">TripAdvisor</label>
          <b-form-input
            type="text"
            id="tripadvisor"
            name="tripadvisor"
            placeholder="Enter your company's TripAdvisor property Url"
            v-model="tripadvisor"/>
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
const { mapActions } = createNamespacedHelpers('company')
export default {
  name: 'CreateCompany',
  data () {
    return {
      name          : '',
      brand         : '',
      website       : '',
      facebook      : '',
      google_plus   : '',
      tripadvisor   : '',
      serverErrors  : '',
      successMessage: '',
    }
  },
  computed: {
    token () {
      return this.$store.state.token
    },
  },
  methods: {
    ...mapActions({
      getCompaniesList : 'getCompaniesList',
      getDefaultCompany: 'getDefaultCompany',
    }),
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createCompany()
      })
    },
    createCompany () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post('/companies/create', {
          name       : this.name,
          brand      : this.brand,
          website    : this.website,
          facebook   : this.facebook,
          google_plus: this.google_plus,
          tripadvisor: this.tripadvisor,
        })
          .then((response) => {
            this.getDefaultCompany()
            this.getCompaniesList()
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
