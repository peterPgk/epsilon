<template>

</template>

<script>
    export default {
        name: "Logout",
        created() {
            this.$store.dispatch('destroyAuth')
                .then(response => {
                    this.$router.push({ name: 'home'})
                })
        }
    }
</script>

<style scoped>

</style>
