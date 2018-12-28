// mutations are operations that actually mutates the state.
// each mutation handler gets the entire state tree as the
// first argument, followed by additional payload arguments.
// mutations must be synchronous and can be recorded by plugins
// for debugging purposes.
export default {
  retrieveToken (state, data) {
    state.token = data.access_token
  },
  retrieveEmailVerificationStatus (state, emailVerified) {
    state.emailVerified = emailVerified
  },
  destroyToken (state) {
    state.token         = null
  },
  setLoadingStatus (state, status) {
    state.loading = status
  },
}
