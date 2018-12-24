<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col md="8">
          <b-card-group>
            <b-card
              no-body
              class="p-4">
              <b-card-body>
                <h1>Login</h1>
                <p class="text-muted">Sign In to your account</p>
                <div
                  v-if="successMessage"
                  class="success-message">{{ successMessage }}</div>
                <div
                  v-if="serverError"
                  class="server-error">{{ serverError }}</div>

                <form
                  action="#"
                  @submit.prevent="login">

                  <b-input-group class="mb-3">
                    <b-input-group-prepend><b-input-group-text><i class="icon-user"/></b-input-group-text></b-input-group-prepend>
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Username"
                      v-model="username"
                      autocomplete="username">
                  </b-input-group>
                  <b-input-group class="mb-4">
                    <b-input-group-prepend><b-input-group-text><i class="icon-lock"/></b-input-group-text></b-input-group-prepend>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="Password"
                      v-model="password"
                      autocomplete="current-password">
                  </b-input-group>
                  <b-row>
                    <b-col cols="6">
                      <b-loading
                        v-if="this.$store.state.loading"
                        :size=20
                        variant="Jumper"/>
                      <b-button
                        type="submit"
                        variant="primary"
                        class="px-4"
                        v-else>Login</b-button>
                    </b-col>
                    <b-col
                      cols="6"
                      class="text-right">
                      <a href="/password/reset">Forgot password?</a>
                    </b-col>
                  </b-row>

                </form>

              </b-card-body>
            </b-card>
            <b-card
              no-body
              class="text-white bg-primary py-5 d-md-down-none"
              style="width:44%;">
              <b-card-body class="text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <router-link :to="{ name: 'Register' }"><b-button
                    variant="primary"
                    class="active mt-3">Register Now!</b-button></router-link>
                </div>
              </b-card-body>
            </b-card>
          </b-card-group>
        </b-col>
      </b-row>
    </div>
  </div>
</template>
<style>
  .spinner-container {
    min-height: 0;
    min-width: 0;

  }
</style>
<script>
export default {
  name : 'Login',
  props: { dataSuccessMessage: { type: String } },
  data () {
    return {
      username      : '',
      password      : '',
      serverError   : '',
      successMessage: this.dataSuccessMessage,
    }
  },
  methods: {
    login () {
      this.$store.dispatch('asyncCall', {
        method: 'post',
        url   : '/login',
        data  : {
          username: this.username,
          password: this.password,
        },
        type: 'retrieveToken',
      }).then((response) => {
        localStorage.setItem('access_token', response.data.access_token)
        this.$router.push({ name: 'Home' })
      })
        .catch((err) => {
          this.serverError    = err.response.data
          this.password       = ''
          this.successMessage = ''
        })
    },
  },
}
</script>
