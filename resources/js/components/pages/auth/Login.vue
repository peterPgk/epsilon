<template>
    <div>
        <b-row>
            <b-col></b-col>
            <b-col cols="6">
                <b-card>
                    <template v-slot:header>
                        <h4 class="mb-0">Login</h4>
                    </template>
                    <b-card-body>
                    <b-card-text>
                        <b-form @submit.prevent="login">
                            <b-form-group
                                id="input-group-1"
                                label="Username/Email"
                                label-for="username"
                            >
                                <b-form-input
                                    id="username"
                                    v-model="user.username"
                                    type="email"
                                    required
                                    placeholder="Enter username/email"
                                ></b-form-input>
                            </b-form-group>

                            <b-form-group id="input-group-2" label="Password" label-for="password">
                                <b-form-input
                                    id="password"
                                    type="password"
                                    v-model="user.password"
                                    required
                                    placeholder="Enter password"
                                ></b-form-input>
                            </b-form-group>

                            <b-button type="submit" variant="primary">Login</b-button>
                        </b-form>
                    </b-card-text>
                    </b-card-body>
                </b-card>
            </b-col>
            <b-col></b-col>
        </b-row>
    </div>
</template>

<script>
    export default {
        name: "login",
        data() {
            return {
                user: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            login() {
                this.$store.dispatch('authenticate', this.user)
                .then(response => {
                    this.$router.push({ name: 'services'})
                })
            }
        }
    }
</script>

<style scoped>

</style>
