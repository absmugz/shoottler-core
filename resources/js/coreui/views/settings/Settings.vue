<template>
  <b-card header="Settings">
    <b-container>
      <b-row>
        <b-col
          sm="12"
          md="3">
          <b-nav vertical>
            <b-nav-item :to="{ name:'User Profile' }">User profile </b-nav-item>
            <b-nav-item :to="{ name:'My Companies' }">My companies</b-nav-item>
            <b-nav-item :to="{ name:'Service areas' }">Service areas</b-nav-item>
          </b-nav>
        </b-col>
        <b-col>
          <router-view/>
        </b-col>
      </b-row>
    </b-container>
  </b-card>
</template>

<script>
export default { name: 'Settings' }
</script>
