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
      <b-form @submit.prevent="validateBeforeSubmit(company)">
        <span class="form-error">{{ errors.first('name') }}</span>
        <b-form-group>
          <label for="name">Company </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Enter your company name"
            v-model="company.name"
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
            v-model="company.brand"
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
    }
  },
  methods: {
    ...mapActions({
      index            : 'index',
      store            : 'store',
      getDefaultCompany: 'getDefaultCompany',
    }),
    validateBeforeSubmit (company) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createCompany(company)
      })
    },
    createCompany (company) {
      this.store(company).then(() => {
        this.getDefaultCompany()
        this.index()
        this.$router.push({ name: 'My Companies' })
      })
    },
  },
}
</script>
