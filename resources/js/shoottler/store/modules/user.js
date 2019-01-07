const state = { config: {} }

function initialState () {
  return { config: {} }
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
const actions   = {
  show ({ dispatch }) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'get',
        url      : `/user/`,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
  update ({ dispatch }, user) {
    return new Promise((resolve, reject) => {
      dispatch('asyncCall', {
        method   : 'put',
        url      : `/user/update`,
        data     : user,
        canCommit: false,
      }, { root: true }).then((response) => {
        resolve(response)
      }).catch((err) => {
        reject(err)
      })
    })
  },
}
export default {
  namespaced: true,
  state,
  mutations,
  actions,
}
