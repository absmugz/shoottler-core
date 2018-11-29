<template>
  <b-button variant="link">
    <i
      v-if="defaultCompanyId === id"
      class="fa fa-star fa-lg"
      @click="setDefaultCompany(id)"/>
    <i
      v-else
      class="fa fa-star-o fa-lg"
      @click="setDefaultCompany(id)"/>
  </b-button>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapState, mapActions } = createNamespacedHelpers('company')
export default {
  name: 'SetDefault',
  data () {
    return { serverErrors: '' }
  },
  props   : { id: '' },
  computed: {
    token () {
      return this.$store.state.token
    },
    ...mapState({ defaultCompanyId: state => state.config.defaultCompanyId }),
  },
  methods: { ...mapActions({ setDefaultCompany: 'setDefaultCompany' }) },
}
</script>
