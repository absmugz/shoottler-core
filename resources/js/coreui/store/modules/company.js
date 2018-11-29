const state = {
  config       : { defaultCompanyId: {} },
  companiesList: [],
  activeCompany: {},
}

function initialState () {
  return {
    config       : { defaultCompanyId: {} },
    companiesList: [],
    activeCompany: {},
  }
}

const mutations = {
  set (state, { key, value }) {
    _.set(state, key, value)
  },
  reset (state) {
    const s = initialState()
    Object.keys(s).forEach(key => {
      state[key] = s[key]
    })
  },
}

const actions = {
  getConfig ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('config')
        .then((response) => {
          commit('set', {
            key  : 'config',
            value: response.data,
          })
          resolve()
        })
        .catch(reject)
    })
  },
  getDefaultCompany ({ commit, rootState }) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${rootState.token}`
    return new Promise((resolve, reject) => {
      axios.get('/companies/default')
        .then((response) => {
          commit('set', {
            key  : 'config.defaultCompanyId',
            value: response.data.data.id,
          })
          resolve()
        })
        .catch(reject)
    })
  },
  setActiveCompany ({ commit, rootState }) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${rootState.token}`
    return new Promise((resolve, reject) => {
      axios.get('/companies/default')
        .then((response) => {
          commit('set', {
            key  : 'activeCompany',
            value: response.data.data,
          })
          resolve()
        })
        .catch(reject)
    })
  },
  setDefaultCompany ({ commit, rootState }, id) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${rootState.token}`
    return new Promise((resolve, reject) => {
      axios.post('/companies/set-default', { company_id: id })
        .then((response) => {
          commit('set', {
            key  : 'config.defaultCompanyId',
            value: response.data.data.company_id,
          })
          resolve()
        })
        .catch(reject)
    })
  },
  getCompaniesList ({ commit, rootState }) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${rootState.token}`
    return new Promise((resolve, reject) => {
      axios.get('/companies')
        .then((response) => {
          commit('set', {
            key  : 'companiesList',
            value: response.data,
          })
          resolve()
        })
        .catch(reject)
    })
  },
  switchActiveCompany ({ commit }, company) {
    commit('set', {
      key  : 'activeCompany',
      value: company,
    })
  },
}

export default {
  namespaced: true,
  state,
  mutations,
  actions,
}
