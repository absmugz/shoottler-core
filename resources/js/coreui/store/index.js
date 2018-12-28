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
import area from './modules/area'
import resource from './modules/resource'
import zone from './modules/zone'
import item from './modules/item'
import user from './modules/user'

Vue.use(Vuex)
axios.defaults.baseURL = 'https://openshoottler.test/api'

export default new Vuex.Store({
  modules: {
    company : company,
    booking : booking,
    customer: customer,
    area    : area,
    item    : item,
    resource: resource,
    zone    : zone,
    user    : user,
  },
  state,
  mutations,
  getters,
  actions,
})
