<template>
  <b-nav-item-dropdown
    right
    no-caret>
    <template slot="button-content">
      <img
        src="~static/img/avatars/6.jpg"
        class="img-avatar"
        alt="admin@bootstrapmaster.com">
    </template>
    <b-dropdown-item>
    <i class="fa fa-user"/> Profile</b-dropdown-item>
    <b-dropdown-item>
    <i class="fa fa-wrench"/> Settings</b-dropdown-item>
    <b-dropdown-item :to="{ name: 'Logout' }"><i class="fa fa-lock"/> Logout</b-dropdown-item>
  </b-nav-item-dropdown>
</template>
<script>
export default {
  name: 'HeaderDropdown',
  data: () => {
    return { itemsCount: 42 }
  }
}

</script>
