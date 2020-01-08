<template>
    <div>
        <b-navbar toggleable="lg" type="dark" variant="info">
            <b-navbar-brand :to="{ name: 'services' }">Epsilon Services</b-navbar-brand>

            <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

            <b-collapse id="nav-collapse" is-nav>

                <!-- Right aligned nav items -->
                <b-navbar-nav class="ml-auto">
                    <b-nav-item :to="{ name: 'home' }">Home</b-nav-item>
                    <b-nav-item v-if="!loggedIn" :to="{ name: 'login' }">Login</b-nav-item>
                    <b-nav-item v-if="loggedIn" :to="{ name: 'services' }">Services</b-nav-item>
                    <b-nav-item v-if="loggedIn" :to="{ name: 'logout' }">Logout</b-nav-item>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>

        <b-container>
            <router-view></router-view>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: "App",

        computed: {
            loggedIn() {
                return this.$store.getters.loggedIn;
            }
        }
    }
</script>

<style scoped>
    .container {
        padding-top: 40px;
    }
</style>
