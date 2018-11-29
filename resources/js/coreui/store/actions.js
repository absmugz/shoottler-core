// actions are functions that cause side effects and can involve
// asynchronous operations.
export default {
  retrieveEmailVerificationStatus (context) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`
    return new Promise((resolve, reject) => {
      axios.post('/email/verification/status')
        .then(response => {
          const emailVerified = response.data.email_verified
          localStorage.setItem('email_verified', emailVerified)
          context.commit('EmailVerificationStatus', emailVerified)
          resolve(response)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  register (context, data) {
    return new Promise((resolve, reject) => {
      axios.post('/register', {
        name    : data.name,
        email   : data.email,
        password: data.password,
      })
        .then(response => {
          resolve(response)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  destroyToken (context) {
    axios.defaults.headers.common['Authorization'] = `Bearer ${context.state.token}`
    if (context.getters.loggedIn) {
      return new Promise((resolve, reject) => {
        axios.post('/logout')
          .then(response => {
            localStorage.removeItem('access_token')
            localStorage.removeItem('activeCompany')
            context.commit('destroyToken')
            resolve(response)
          })
          .catch(err => {
            localStorage.removeItem('activeCompany')
            localStorage.removeItem('access_token')
            context.commit('destroyToken')
            reject(err)
          })
      })
    }
  },
  retrieveToken (context, credentials) {
    return new Promise((resolve, reject) => {
      axios.post('/login', {
        username: credentials.username,
        password: credentials.password,
      })
        .then(response => {
          const token = response.data.access_token
          localStorage.setItem('access_token', token)
          context.commit('retrieveToken', token)
          resolve(response)
        })
        .catch(err => {
          reject(err)
        })
    })
  },
  clearAll ({ commit }) {
    commit('company/reset')
  },
}
