// actions are functions that cause side effects and can involve
// asynchronous operations.
export default {
  asyncCall (context, { method = '', url = '', params = {}, data = {}, config = {}, type = '', sendToken = true, canCommit = true }) {
    context.commit('setLoadingStatus', true)
    if (sendToken)
      axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`
    return new Promise((resolve, reject) => {
      axios({
        method: method,
        url   : url,
        params: params,
        data  : data,
        config,
      })
        .then((response) => {
          context.commit('setLoadingStatus', false)
          if (canCommit)
            context.commit(type, response.data)
          resolve(response)
        })
        .catch((err) => {
          context.commit('setLoadingStatus', false)
          reject(err)
        })
    })
  },
  clearAll ({ commit }) {
    commit('company/reset')
  },
}
