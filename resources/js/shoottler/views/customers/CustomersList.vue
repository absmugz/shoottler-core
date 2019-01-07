<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col>
        <h4><router-link :to="{ name:'Create a customer' }">Create a new customer</router-link></h4>
        <customers-table
          :company="activeCompanyId"
          caption="<i class='fa fa-align-justify'></i> Vehicles table"/>
      </b-col><!--/.col-->
    </b-row>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
import CustomersTable from './CustomersTable'
const { mapState } = createNamespacedHelpers('company')
export default {
  name      : 'CustomersList',
  components: { CustomersTable },
  computed  : { ...mapState({ activeCompanyId: (state) => state.activeCompany.id }) },
}
</script>
