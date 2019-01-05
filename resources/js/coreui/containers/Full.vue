<template>
  <div class="app">
    <AppHeader/>
    <div class="app-body">
      <Sidebar
        :nav-items="nav"
        :show-company-switch="true"
        :show-minimizer="true"/>
      <notifications
        class="custom-notifications"
        :style="{ 'margin-top': offset }" />
      <main class="main">
        <breadcrumb :list="list"/>
        <vue-loading
          :active.sync="this.$store.state.loading"
          :can-cancel="false"
          :is-full-page="true"
          loader="dots"/>
        <div class="container-fluid">
          <router-view/>
        </div>
      </main>
    </div>
    <AppFooter/>
  </div>
</template>

<script>
import nav from '../_nav'
import { Header as AppHeader, Sidebar, Aside as AppAside, Footer as AppFooter, Breadcrumb } from '../components'
import VueLoading from 'vue-loading-overlay/src/js/Component'
import LoadingSpinner from '../components/Loading'

export default {
  name      : 'Full',
  components: {
    LoadingSpinner,
    VueLoading,
    AppHeader,
    Sidebar,
    AppAside,
    AppFooter,
    Breadcrumb,
  },
  data () {
    return {
      nav   : nav.items,
      offset: true,
    }
  },
  computed: {
    name () {
      return this.$route.name
    },
    list () {
      return this.$route.matched
    },
  },
  methods: {
    setPosNotify () {
      const top    = $(document).scrollTop()
      const height = $('.app-header').height()
      const offset = top < height ? height - top : 0

      this.offset = `${offset}px`
    },
  },
  mounted () {
    $(window).on('scroll', this.setPosNotify)
  },
  beforeDestroy () {
    $(window).off('scroll', this.setPosNotify)
  },
}
</script>
