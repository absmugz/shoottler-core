<template>
  <div class="animated fadeIn">
    <b-card>
      <div slot="header">
        <strong>User Profile</strong>
      </div>
      <div
        v-if="serverErrors"
        class="server-error">
        <div
          v-for="(value, key) in serverErrors"
          :key="key">
          {{ value[0] }}
        </div>
      </div>
      <b-form @submit.prevent="validateBeforeSubmit(user)">
        <span class="form-error">{{ errors.first('name') }}</span>
        <b-form-group>
          <label for="name">Name </label>
          <b-form-input
            type="text"
            id="name"
            name="name"
            placeholder="Your name"
            v-model="user.name"
            autocomplete="name"
            v-validate="'required|min:8|max:255'"/>
        </b-form-group>
        <span class="form-error">{{ errors.first('email') }}</span>
        <b-form-group>
          <label for="email">Email</label>
          <b-form-input
            type="text"
            id="email"
            name="email"
            placeholder="Email"
            v-model="user.email"
            autocomplete="current-email"
            v-validate="'email|required'"
          />
        </b-form-group>
        <span class="form-error">{{ errors.first('password') }}</span>
        <b-form-group>
          <label for="password">Password <small>(Leave empty if you don't want to change your password)</small></label>
          <b-form-input
            autocomplete="new-password"
            type="password"
            id="password"
            name="password"
            placeholder="Password"
            v-model="user.password"
            v-validate="'min:8|verify_password'"
            ref="password"
          />
        </b-form-group>
        <span class="form-error">{{ errors.first('confirmation') }}</span>
        <b-form-group>
          <label for="confirmation">Confirm your password</label>
          <b-form-input
            type="password"
            id="confirmation"
            name="confirmation"
            placeholder="Confirm your password"
            data-vv-as="password"
            v-model="user.confirmation"
            v-validate="'min:8|confirmed:password'"/>
        </b-form-group>
        <b-button
          type="submit"
          variant="primary">Save</b-button>
      </b-form>
    </b-card>
  </div>
</template>

<script>
import { createNamespacedHelpers } from 'vuex'
const { mapActions } = createNamespacedHelpers('user')
export default {
  name: 'UserProfile',
  data () {
    return {
      user: {
        name        : '',
        email       : '',
        password    : '',
        confirmation: '',
      },
      serverErrors: '',
    }
  },
  mounted () {
    this.getUser()
  },
  methods: {
    ...mapActions({ show: 'show', update: 'update' }),
    validateBeforeSubmit (user) {
      this.$validator.validateAll().then((result) => {
        if (result)
          this.updateUser(user)
      })
    },
    getUser () {
      this.show().then((response) => {
        this.user = response.data.data
      })
    },
    updateUser (user) {
      this.update(user).then((response) => {
        this.user = response.data.data
      })
    },
  },
}
</script>
