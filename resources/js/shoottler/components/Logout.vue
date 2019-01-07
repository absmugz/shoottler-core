<template/>
    <div></div>
<script>
export default {
  created () {
    this.$store.dispatch('asyncCall', {
      method: 'post',
      url   : '/logout',
      type  : 'destroyToken',
    })
      .then(() => {
        localStorage.clear()
        this.$store.dispatch('clearAll')
        this.$router.push({ name: 'Login' })
      })
  },
}
</script>
