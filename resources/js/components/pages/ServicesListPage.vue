<template>
    <div>
        <h2 class="mb-4 align-content-center">Services List goes here</h2>
<!--        <Service v-for="service in services" :key="service.id" :service="service"></Service>-->
<!--        <div v-for="service in services" :key="service.id" class="">-->
<!--            {{ service.name }}-->
<!--        </div>-->

        <template>
            <div>
                <b-table striped hover :fields="fields" :items="services">
                    <template v-slot:cell(name)="data">
                        <router-link
                            :to="`/service/${data.index}`">{{ data.value }}
                        </router-link>
                    </template>
                </b-table>
            </div>
        </template>


    </div>
</template>

<script>
    // import services from "../services";
    import Service from "../Service";
    import { mapState } from 'vuex';

    export default {
        name: "ServicesListPage",
        components: {
            Service
        },
        data() {
            return {
                fields: ['id', 'name', 'created', 'status']
            }
        },
        computed: {
            ...mapState([
                'services'
            ])
        },
        created() {
            this.$store.dispatch('retrieveServices')
        }
    }
</script>

<style scoped>

</style>
