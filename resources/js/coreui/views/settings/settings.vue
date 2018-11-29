<template>
  <b-card header="Settings">
    <b-row>
      <b-col
        sm="12"
        md="3">
        <b-nav vertical>
          <router-link :to="{ name:'User Profile' }">User Profile</router-link>
          <router-link :to="{ name:'My Companies' }">My Companies</router-link>
        </b-nav>
      </b-col>
      <b-col>
        <router-view/>
      </b-col>
    </b-row>
  </b-card>
</template>

<script>
export default { name: 'Settings' }
</script>
