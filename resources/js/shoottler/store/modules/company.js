const state = {
  config       : { defaultCompanyId: '' },
  companiesList: [],
  activeCompany: {},
}

function initialState () {
  return {
    config       : { defaultCompanyId: '' },
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
    Object.keys(s).forEach((key) => {
      state[key] = s[key]
    })
  },
}

const actions = {
  index ({ dispatch, commit }) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'get',
        url      : '/companies',
        canCommit: false,
      }, { root: true }).then((response) => {
        commit('set', {
          key  : 'companiesList',
          value: response.data,
        })
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  show ({ dispatch }, id) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'get',
        url      : `/companies/${id}`,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  store ({ dispatch }, data) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'post',
        url      : '/companies/create',
        data     : data,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  update ({ dispatch }, { id, company }) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'put',
        url      : `/companies/${id}/update`,
        data     : company,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  destroy ({ dispatch }, id) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'delete',
        url      : `/companies/${id}`,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },

  getDefaultCompany ({ dispatch, commit }) {
    dispatch('asyncCall', {
      method   : 'get',
      url      : '/companies/default',
      canCommit: false,
    }, { root: true }).then((response) => {
      commit('set', {
        key  : 'config.defaultCompanyId',
        value: response.data.data.id,
      })
    })
  },
  setActiveCompany ({ dispatch, commit }) {
    dispatch('asyncCall', {
      method   : 'get',
      url      : '/companies/default',
      canCommit: false,
    }, { root: true }).then((response) => {
      commit('set', {
        key  : 'activeCompany',
        value: response.data.data,
      })
    })
  },
  setDefaultCompany ({ dispatch, commit }, id) {
    dispatch('asyncCall', {
      method            : 'post',
      url               : '/companies/set-default',
      params            : { company_id: id },
      canCommit         : false,
      showLoadingOverlay: false,
    }, { root: true }).then(() => {
      commit('set', {
        key  : 'config.defaultCompanyId',
        value: id,
      })
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
