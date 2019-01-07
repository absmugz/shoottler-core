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
      <b-form @submit.prevent="validateBeforeSubmit(booking)">
        <b-form-group>
          <label for="order">Order</label>
          <b-form-input
            type="text"
            id="order"
            name="order"
            placeholder="Order"
            v-model="booking.order"
          />
        </b-form-group>
        <b-form-group>
          <span class="form-error">{{ errors.first('customer') }}</span>
          <label for="customer">Customer</label>
          <b-select-2
            id="customer"
            placeholder="Please select a customer"
            :options="customers"
            v-model="booking.customer_id"
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
          variant="primary">Save</b-button>
      </b-form>
    </b-card>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState }   = createNamespacedHelpers('company')
const { mapActions } = createNamespacedHelpers('booking')
export default {
  name: 'CreateBooking',
  data () {
    return {
      timezone : process.env.MIX_APP_TIME_ZONE,
      customers: [],
      services : [],
      booking  : {
        order      : '',
        customer_id: '',
        service_id : '',
        starts_at  : '',
        ends_at    : '',
      },
      serverErrors  : '',
      successMessage: '',
    }
  },
  computed: { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
  watch   : {
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
    ...mapActions({ store: 'store' }),
    validateBeforeSubmit (booking) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.createBooking(booking)
      })
    },
    createBooking (booking) {
      this.store(booking).then(() => {
        this.$router.push({ name: 'bookings list' })
      })
    },
    getCustomers () {
      this.$store.dispatch('asyncCall', {
        method: 'get',
        url   : '/customers/',
        params: {
          search    : this.customer,
          company_id: this.activeCompanyId,
        },
        canCommit: false,
      }).then((response) => {
        this.customers = response.data.data.map((customer) => {
          const rCustomer = {}
          rCustomer.value = customer.id
          rCustomer.text  = customer.name
          return rCustomer
        })
      }).catch((err) => {
        this.serverErrors = Object.values(err.response.data.errors)
      })
    },
    getServices () {
      this.$store.dispatch('asyncCall', {
        method: 'get',
        url   : '/services/',
        params: {
          search    : this.service,
          company_id: this.activeCompanyId,
        },
        canCommit: false,
      }).then((response) => {
        this.services = response.data.data.map((service) => {
          const rService = {}
          rService.value = service.id
          rService.text  = service.name
          return rService
        })
      }).catch((err) => {
        this.serverErrors = Object.values(err.response.data.errors)
      })
    },
  },
}
</script>
