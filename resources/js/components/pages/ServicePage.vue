<template>
    <div>
        <div v-if="service">
        <b-card title="Service Basic Info" :sub-title="service.status">
            <b-card-text>
                <b-container class="bv-example-row">
                    <b-row>
                        <b-col>
                            <b-row><b-col class="font-weight-light">name</b-col></b-row>
                            <b-row><b-col><h4>{{ service.name }}</h4></b-col></b-row>
                        </b-col>
                        <b-col>
                            <b-row><b-col class="font-weight-light">bandwidth</b-col></b-row>
                            <b-row><b-col><h4>{{ service.bandwidth }}</h4></b-col></b-row>
                        </b-col>
                        <b-col>
                            <b-row><b-col class="font-weight-light">created</b-col></b-row>
                            <b-row><b-col><h5>{{ service.created }}</h5></b-col></b-row>
                        </b-col>
                        <b-col>
                            <b-row><b-col class="font-weight-light">expires</b-col></b-row>
                            <b-row><b-col><h5>{{ service.expires }}</h5></b-col></b-row>
                        </b-col>
                    </b-row>
                </b-container>
            </b-card-text>
        </b-card>
        </div>
        <div class="mt-4">
            <b-button variant="outline-primary" @click="$router.go(-1)">Back to Services</b-button>
        </div>
    </div>
</template>

<script>
    import { mapState } from "vuex";

    export default {
        name: "ServicesPage",

        data() {
            return {
                service: {}
            }
        },
        computed: {
            ...mapState([
                'services'
            ])
        },
        mounted() {
            this.service = this.services[this.$route.params.id]
        }
    }
</script>

<style scoped>

</style>
