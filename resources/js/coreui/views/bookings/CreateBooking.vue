<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>Booking</strong> <small>Form</small>
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
          <label for="order">Order</label>
          <b-form-input
            type="text"
            id="order"
            name="order"
            placeholder="Order"
            v-model="order"
          />
        </b-form-group>
        <b-form-group>
          <span class="form-error">{{ errors.first('customer') }}</span>
          <label for="customer">Customer</label>
          <b-select-2
            id="customer"
            placeholder="Please select a customer"
            :options="customers"
            v-model="customer"
            name="customer"
            v-validate="'required'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('service') }}</span>
        <b-form-group>
          <label for="service">Service </label>
          <b-select-2
            id="Service"
            placeholder="Please select a Service"
            :options="services"
            v-model="service"
            name="service"
            v-validate="'required'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('starts at') }}</span>
        <b-form-group>
          <label for="starts_at">Starts At</label>
          <datetime
            type="datetime"
            :value-zone="timezone"
            :zone="timezone"
            id="starts_at"
            name="starts_at"
            placeholder="Starts At"
            v-model="starts_at"
            v-validate="'required'"
          />
        </b-form-group>
        <b-form-group>
          <label for="ends_at">Ends At</label>
          <datetime
            type="datetime"
            :value-zone="timezone"
            :zone="timezone"
            id="ends_at"
            name="ends_at"
            placeholder="Ends At"
            v-model="ends_at"
            v-validate="'required'"
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
  name: 'CreateBooking',
  data () {
    return {
      timezone      : process.env.MIX_APP_TIME_ZONE,
      customers     : [],
      services      : [],
      order         : '',
      customer      : '',
      service       : '',
      starts_at     : '',
      ends_at       : '',
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
      this.customers = []
      this.getCustomers()
      this.services  = []
      this.getServices()
    },
    customer (customer) {
      if (customer.length > 3) {
        this.customers = []
        this.getCustomers()
      }
    },
    service (service) {
      if (service.length > 3) {
        this.services = []
        this.getServices()
      }
    },
  },
  mounted () {
    if (this.activeCompanyId) {
      this.getCustomers()
      this.getServices()
    }
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createBooking()
      })
    },
    createBooking () {
      axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`
      return new Promise((resolve, reject) => {
        axios.post('/bookings/create', {
          customer_id: this.customer,
          bookable_id: this.service,
          order_id   : this.order,
          starts_at  : this.starts_at,
          ends_at    : this.ends_at,
        })
          .then((response) => {
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
