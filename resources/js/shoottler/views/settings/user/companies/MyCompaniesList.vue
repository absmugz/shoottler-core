<template>
  <div class="animated fadeIn">
    <b-row>
      <b-col>
        <h4><router-link :to="{ name:'Create a company' }">Create a new company</router-link></h4>
        <companies-table caption="<i class='fa fa-align-justify'></i> Companies Table"/>
      </b-col><!--/.col-->
    </b-row>
  </div>
</template>

<script>
import CompaniesTable from './CompaniesTable.vue'
export default {
  name      : 'MyCompaniesList',
  components: { CompaniesTable },
}
</script>
