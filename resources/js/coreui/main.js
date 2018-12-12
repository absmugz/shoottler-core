// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import Datepicker from 'vuejs-datepicker'
import { id } from 'vuejs-datepicker/dist/locale'
import Notifications from 'vue-notification'
import Sweetalert from 'vue-sweetalert2'
import Loading from './components/Loading.vue'
import Select2 from './components/Select.vue'
import App from './App.vue'
import router from './router'
import store from './store'
import VeeValidate from 'vee-validate'
import CxltToastr from 'cxlt-vue2-toastr'
import * as VueGoogleMaps from 'vue2-google-maps'

const toastrConfigs = {
  position    : 'bottom right',
  showDuration: 2000,
  timeOut     : 5000,
  progressBar : true,
}

Vue.use(BootstrapVue)
Vue.use(Notifications)
Vue.use(Sweetalert)
Vue.use(VeeValidate, { fieldsBagName: 'formFields' })
VeeValidate.Validator.extend('verify_password', {
  getMessage: (field) => `The password must contain at least: 1 uppercase letter, 1 lowercase letter, 1 number, and one special character (E.g. , . _ & ? etc)`,
  validate  : (value) => {
    const strongRegex = new RegExp('^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[!@#$%^&*])(?=.{8,})')
    return strongRegex.test(value)
  },
})
Vue.use(CxltToastr, toastrConfigs)
Vue.use(VueGoogleMaps, {
  load: {
    key      : 'AIzaSyAlvQgM2rAdbwzUbWxuIG2P-o-nGl-JPnI',
    libraries: 'places,drawing',
  },
  autobindAllEvents: true,
})
Vue.component('b-loading', Loading)
Vue.component('b-select-2', Select2)
Vue.component('b-datepicker', {
  extends: Datepicker,
  props  : {
    bootstrapStyling: {
      type   : Boolean,
      default: true,
    },
    language: {
      type   : Object,
      default: () => id,
    },
  },
})

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requiresAuth)) {
    if (!store.getters.loggedIn)
      next({ name: 'Login' })
    else
      next()
  } else if (to.matched.some((record) => record.meta.requiresVisitor)) {
    if (store.getters.loggedIn)
      next({ name: 'Home' })
    else
      next()
  } else
    next()
})

window.Vue = new Vue({
  el        : '#app',
  router    : router,
  store     : store,
  template  : '<App/>',
  components: { App },
})
