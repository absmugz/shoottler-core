<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Customer</strong> <small>Form</small>
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
          <label for="type">Type</label>
          <b-select-2
            id="type"
            placeholder="Please select a type of customer"
            :options="customerTypes"
            v-model="type"
            name="type_id"
            v-validate="'required'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('name') }}</span>
        <b-form-group>
          <label for="name">Name </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Customer's name"
            v-model="name"
            v-validate="'required|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('email') }}</span>
        <b-form-group>
          <label for="email">Email</label>
          <b-form-input
            type="text"
            id="email"
            name="email"
            placeholder="Email"
            v-model="email"
            v-validate="'required|email'"
          />
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
  name: 'CreateCustomer',
  data () {
    return {
      customerTypes : [],
      name          : '',
      email         : '',
      type          : '',
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
      this.customerTypes = []
      this.getCustomerTypes()
    },
  },
  mounted () {
    if (this.activeCompanyId)
      this.getCustomerTypes()
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createCustomer()
      })
    },
    createCustomer () {
      this.$store.dispatch('asyncCall', {
        method: 'post',
        url   : '/customers/create',
        data  : {
          company_id: this.activeCompanyId,
          name      : this.name,
          email     : this.email,
          type      : this.type,
        },
        canCommit: false,
      }).then(() => {
        this.$router.push({ name: 'customers list' })
      })
        .catch((err) => {
          this.serverErrors = Object.values(err.response.data.errors)
        })
    },
    getCustomerTypes () {
      this.$store.dispatch('asyncCall', {
        method   : 'get',
        url      : '/customer-types/',
        params   : { type: 'customer' },
        canCommit: false,
      })
        .then((response) => {
          this.customerTypes = response.data.data.map((customerType) => {
            const rCustomerType = {}
            rCustomerType.value = customerType.id
            rCustomerType.text  = customerType.name
            return rCustomerType
          })
        })
        .catch((err) => {
          this.serverErrors = Object.values(err.response.data.errors)
        })
    },
  },
}
</script>
