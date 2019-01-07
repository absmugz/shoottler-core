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
                <p class="text-muted">Reset your password</p>
                <div v-if="successMessage" class="success-message">{{ successMessage }}</div>
                <div v-if="serverError" class="server-error">{{ serverError }}</div>
                <form action="#" @submit.prevent="resetPassword">

                  <b-input-group class="mb-3">
                    <b-input-group-prepend><b-input-group-text><i class="icon-user"/></b-input-group-text></b-input-group-prepend>
                    <input
                            type="text"
                            class="form-control"
                            placeholder="Email"
                            v-model="email"
                            autocomplete="email">
                  </b-input-group>
                  <b-row>
                    <b-col cols="6">
                      <b-loading v-if="loading" :size=20 variant="Jumper">
                      </b-loading>
                      <b-button
                              type="submit"
                              variant="primary"
                              class="px-4"
                              v-else>Login</b-button>
                    </b-col>
                  </b-row>
                  <b-row>
                    <router-link :to="{ name: 'Login' }">Login with your email and password</router-link>
                  </b-row>

                </form>

              </b-card-body>
            </b-card>
            <b-card
              no-body
              class="text-white bg-primary py-5 d-md-down-none"
              style="width:44%">
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
    name: 'Login',
    props: {
        dataSuccessMessage: {
            type: String,
        }
    },
    data() {
        return {
            email: '',
            serverError: '',
            successMessage: this.dataSuccessMessage,
            loading: false,
        }
    },
    methods: {
        resetPassword() {
            this.loading = true
            return new Promise((resolve, reject) => {
                axios.post('/password/email', {
                    email   : this.email,
                })
                    .then(response => {
                        console.log(response)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        }
    }
}
</script>
