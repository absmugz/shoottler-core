import Vue from 'vue'
import Vuex from 'vuex'
import state from './state'
import mutations from './mutations'
import getters from './getters'
import actions from './actions'
import axios from 'axios'
import company from './modules/company'

Vue.use(Vuex)
axios.defaults.baseURL = 'https://openshoottler.test/api'

export default new Vuex.Store({
  modules: { company: company },
  state,
  mutations,
  getters,
  actions,
})
