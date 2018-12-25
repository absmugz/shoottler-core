import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'
import mutations from './mutations'
import getters from './getters'
import actions from './actions'
import axios from 'axios'
import company from './modules/company'
import booking from './modules/booking'
import customer from './modules/customer'
import service from './modules/service'

Vue.use(Vuex)
axios.defaults.baseURL = 'https://openshoottler.test/api'

export default new Vuex.Store({
  modules: {
    company : company,
    booking : booking,
    customer: customer,
    service : service,
  },
  state,
  mutations,
  getters,
  actions,
})
