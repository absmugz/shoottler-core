<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col>
        <h4><router-link :to="{ name:'Create a booking' }">Create a new booking</router-link></h4>
        <bookings-table
          :company="activeCompanyId"
          caption="<i class='fa fa-align-justify'></i> Vehicles table"/>
      </b-col><!--/.col-->
    </b-row>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import BookingsTable from './BookingsTable'
const { mapState } = createNamespacedHelpers('company')
export default {
  name      : 'BookingsList',
  components: { BookingsTable },
  computed  : { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
}
</script>
