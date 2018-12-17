<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col>
        <h4><router-link :to="{ name:'Create a service' }">Create a new service</router-link></h4>
        <services-table
          :company="activeCompanyId"
          caption="<i class='fa fa-align-justify'></i> Vehicles table"/>
      </b-col><!--/.col-->
    </b-row>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import ServicesTable from './ServicesTable'
const { mapState } = createNamespacedHelpers('company')
export default {
  name      : 'ServicesList',
  components: { ServicesTable },
  computed  : { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
}
</script>
