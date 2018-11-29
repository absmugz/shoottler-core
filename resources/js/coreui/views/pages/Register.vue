<template>
  <div class="app flex-row align-items-center">
    <div class="container">
      <b-row class="justify-content-center">
        <b-col
          md="6"
          sm="8">
          <b-card
            no-body
            class="mx-4">
            <b-card-body class="p-4">
              <h1>Register</h1>
              <p class="text-muted">Create your account</p>
              <div
                v-if="serverErrors"
                class="server-error">
                <div
                  v-for="(value, key) in serverErrors"
                  :key="key">
                  {{ value[0] }}
                </div>
              </div>
              <b-form
                action="#"
                @submit.prevent="validateBeforeSubmit">
                <span class="form-error">{{ errors.first('name') }}</span>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-user"/></b-input-group-text>
                  </b-input-group-prepend>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Name"
                    :class="{ 'input-error': errors.has('name') }"
                    v-model="name"
                    name="name"
                    v-validate="'required|min:8'"
                    autocomplete="name">
                </b-input-group>
                <span class="form-error">{{ errors.first('email') }}</span>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text>@</b-input-group-text>
                  </b-input-group-prepend>
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Email"
                    :class="{ 'input-error': errors.has('email') }"
                    v-model="email"
                    name="email"
                    v-validate="'email|required'"
                    autocomplete="current-email">
                </b-input-group>
                <span class="form-error">{{ errors.first('password') }}</span>
                <b-input-group class="mb-3">
                  <b-input-group-prepend>
                    <b-input-group-text><i class="icon-lock"/></b-input-group-text>
                  </b-input-group-prepend>
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    :class="{ 'input-error': errors.has('password') }"
                    v-model="password"
                    name="password"
                    v-validate="'required|min:8|verify_password'"
                    autocomplete="current-password">
                </b-input-group>
                <b-button
                  @click="validateBeforeSubmit()"
                  variant="success"
                  block>Create Account</b-button>
                <b-input-group>
                  Already have an account?<span><router-link :to="{ name: 'Login' }"> Login here.</router-link></span>
                </b-input-group>
              </b-form>
            </b-card-body>
          </b-card>
        </b-col>
      </b-row>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Register',
  data () {
    return {
      name          : '',
      email         : '',
      password      : '',
      serverErrors  : '',
      successMessage: '',
    }
  },
  methods: {
    validateBeforeSubmit () {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.register()
      })
    },
    register () {
      this.$store.dispatch('register', {
        name    : this.name,
        email   : this.email,
        password: this.password,
      })
        .then(response => {
          this.$store.dispatch('retrieveToken', {
            username: this.email,
            password: this.password,
          })
            .then(response => {
              this.loading = false
              this.$router.push({ name: 'Home' })
            })
            .catch(error => {
              this.loading        = false
              this.serverError    = error.response.data
              this.password       = ''
              this.successMessage = ''
            })
        })
        .catch(error => {
          this.serverErrors = Object.values(error.response.data.errors)
        })
    },
  },
}
</script>
