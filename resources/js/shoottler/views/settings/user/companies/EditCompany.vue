<template>
  <b-card>
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
    <b-form @submit.prevent="validateBeforeSubmit(id, company)">
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
  mounted () {
    this.getCompany(this.id)
  },
  computed: { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
  methods : {
    ...mapActions({
      index              : 'index',
      show               : 'show',
      update             : 'update',
      destroy            : 'destroy',
      setActiveCompany   : 'setActiveCompany',
      getDefaultCompany  : 'getDefaultCompany',
      switchActiveCompany: 'switchActiveCompany',
    }),
    getCompany (id) {
      this.show(id).then((response) => {
        this.company = response.data.data[0]
      })
    },
    validateBeforeSubmit (id, company) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.updateCompany(id, company)
      })
    },
    updateCompany (id, company) {
      this.update({ id, company }).then(() => {
        this.index()
        if (this.activeCompanyId === id)
          this.switchActiveCompany(company)
        this.$router.push({ name: 'My Companies' })
      })
    },
    deleteCompany (id) {
      this.deleteWarning  = false
      this.destroy(id).then(() => {
        this.index()
        if (this.activeCompanyId === id) {
          this.getDefaultCompany()
          this.setActiveCompany()
        }
        this.$router.push({ name: 'My Companies' })
      })
    },
  },
}
</script>
