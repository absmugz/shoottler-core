<template>

</template>

<script>
    export default {
        created() {
            this.$store.dispatch('destroyToken')
                .then(response => {
                    this.$store.dispatch('clearAll')
                    this.$router.push({ name: 'Login' })
                })
        }
    }
</script>