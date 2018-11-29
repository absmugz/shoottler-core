// root state object.
// each Vuex instance is just a single state tree.
export default {
  version: __VERSION,
  token  : localStorage.getItem('access_token') || null,
}
