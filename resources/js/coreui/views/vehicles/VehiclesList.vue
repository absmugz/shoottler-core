<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col>
        <h4><router-link :to="{ name:'Create a vehicle' }">Create a new vehicle</router-link></h4>
        <vehicles-table
          :company="activeCompanyId"
          caption="<i class='fa fa-align-justify'></i> Vehicles table"/>
      </b-col><!--/.col-->
    </b-row>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import VehiclesTable from './VehiclesTable'
const { mapState } = createNamespacedHelpers('company')
export default {
  name      : 'VehiclesList',
  components: { VehiclesTable },
  computed  : { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
}
</script>
