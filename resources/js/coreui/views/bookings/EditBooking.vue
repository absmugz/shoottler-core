<template>
  <b-card v-if="loaded">
    <div slot="header">
      <strong>Edit booking</strong>
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
        <label for="order">Order</label>
        <b-form-input
          type="text"
          id="order"
          name="order"
          placeholder="Order"
          v-model="booking.order_id"
        />
      </b-form-group>
      <span class="form-error">{{ errors.first('customer') }}</span>
      <b-form-group>
        <label for="customer">Customer</label>
        <b-select-2
          id="customer"
          placeholder="Please select a customer"
          :options="customers"
          :value="booking.customer_id"
          v-model="booking.customer_id"
          name="customer"
          v-validate="'required'"/>
      </b-form-group>
      <span class="form-error">{{ errors.first('service') }}</span>
      <b-form-group>
        <label for="service">Service</label>
        <b-select-2
          id="Service"
          placeholder="Please select a Service"
          :options="services"
          :value="booking.bookable_id"
          v-model="booking.bookable_id"
          name="service"
          v-validate="'required'"/>
      </b-form-group>
      <span class="form-error">{{ errors.first('starts_at') }}</span>
      <b-form-group>
        <label for="starts_at">Starts At</label>
        <datetime
          type="datetime"
          :value-zone="timezone"
          :zone="timezone"
          id="starts_at"
          name="starts_at"
          placeholder="Starts At"
          v-model="booking.starts_at"
          v-validate="'required'"
        />
      </b-form-group>
      <span class="form-error">{{ errors.first('ends_at') }}</span>
      <b-form-group>
        <label for="ends_at">Ends At</label>
        <datetime
          type="datetime"
          :value-zone="timezone"
          :zone="timezone"
          id="ends_at"
          name="ends_at"
          placeholder="Ends At"
          v-model="booking.ends_at"
          v-validate="'required'"
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
      @ok="deleteBooking(id)"
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
  name : 'EditBooking',
  props: { id: '' },
  data () {
    return {
      timezone : process.env.MIX_APP_TIME_ZONE,
      customers: [],
      services : [],
      booking  : {
        order_id   : '',
        customer_id: '',
        bookable_id: '',
        starts_at  : '',
        ends_at    : '',
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
  watch: {
    activeCompanyId () {
      this.customers = []
      this.services  = []
      this.getCustomers()
      this.getServices()
    },
  },
  mounted () {
    this.getBooking(this.id)
    if (this.activeCompanyId) {
      this.getCustomers()
      this.getServices()
    }
  },
  methods: {
    getBooking (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get(`/bookings/${id}`)
          .then((response) => {
            this.booking =  response.data.data
            this.loaded  = true
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
          this.updateBooking(id)
      })
    },
    updateBooking (id) {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post(`/bookings/${id}/update`, {
          _method    : 'PUT',
          order_id   : this.booking.order_id,
          customer_id: this.booking.customer_id,
          bookable_id: this.booking.bookable_id,
          starts_at  : this.booking.starts_at,
          ends_at    : this.booking.ends_at,
        })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'bookings list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    deleteBooking (id) {
      this.deleteWarning                             = false
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.delete(`/bookings/${id}`, { _method: 'DELETE' })
          .then((response) => {
            this.successMessage = response.data.message
            this.$router.push({ name: 'bookings list' })
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getCustomers () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/customers/', { params: { search: this.customer, company_id: this.activeCompanyId } })
          .then((response) => {
            this.customers = response.data.data.map((customer) => {
              const rCustomer = {}
              rCustomer.value = customer.id
              rCustomer.text  = customer.name
              return rCustomer
            })
            this.loaded    = true
            resolve(response)
          })
          .catch((err) => {
            this.serverErrors = Object.values(err.response.data.errors)
            reject(err)
          })
      })
    },
    getServices () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.get('/services/', { params: { search: this.service, company_id: this.activeCompanyId } })
          .then((response) => {
            this.services = response.data.data.map((service) => {
              const rService = {}
              rService.value = service.id
              rService.text  = service.name
              return rService
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
  },
}
</script>
