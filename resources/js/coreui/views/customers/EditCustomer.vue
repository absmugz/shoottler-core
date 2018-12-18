<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit customer</strong> <small>{{ customer.name }} - {{ customer.type }}</small>
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
        <label for="name">Customer</label>
        <b-form-input
          type="text"
          id="name"
          name="name"
          placeholder="Customer's Name"
          v-model="customer.name"
          v-validate="'required|max:255'"/>
      </b-form-group>
      <b-form-group>
        <label for="email">Email</label>
        <b-form-input
          type="text"
          id="email"
          name="email"
          placeholder="Email"
          v-model="customer.email"
        />
      </b-form-group>
      <b-button
        type="submit"
        variant="primary">Update</b-button>
      <b-button
        @click="deleteWarning = true"
        variant="link"> delete</b-button>
    </b-form>

    <b-modal
      title="You are about to delete a customer. Are you sure?"
      class="modal-danger"
      v-model="deleteWarning"
      @ok="deleteCustomer(id)"
      ok-variant="danger">
      When you delete a customer, all its information and all its related records get permanently erased.
      This process can't be undone.
      Proceed only if you are completely sure.
    </b-modal>
  </b-card>
</template>
<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState } = createNamespacedHelpers('company')
export default {
  name : 'EditCustomer',
  props: { id: '' },
  data () {
    return {
      customerTypes: [],
      customer     : {
        name : '',
        email: '',
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
    this.getCustomers(this.id)
    if (this.activeCompanyId)
      this.getCustomerTypes()
  },
  methods: {
    getCustomers (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/customers/${id}`)
          .then((response) => {
            this.customer =  response.data.data
            this.loaded   = true
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
          this.updateCustomer(id)
      })
    },
    updateCustomer (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/customers/${id}/update`, {
          _method: 'PUT',
          name   : this.customer.name,
          email  : this.customer.email,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'customers list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteCustomer (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/customers/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'customers list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getCustomerTypes () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/customer-types/', { params: { type: 'customer' } })
          .then((response) => {
            this.customerTypes = response.data.data.map((customerType) => {
              const rCustomerType = {}
              rCustomerType.value = customerType.id
              rCustomerType.text  = customerType.name
              return rCustomerType
            })
            this.loaded        = true
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
