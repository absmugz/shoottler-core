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
import { itemStore } from '../../../../Modules/Item/Resources/assets/src/js/store'
import resource from './modules/resource'
import user from './modules/user'

Vue.use(Vuex)
axios.defaults.baseURL = 'https://openshoottler.test/api'

export default new Vuex.Store({
  modules: {
    company : company,
    booking : booking,
    customer: customer,
    item    : itemStore,
    resource: resource,
    user    : user,
  },
  state,
  mutations,
  getters,
  actions,
})
