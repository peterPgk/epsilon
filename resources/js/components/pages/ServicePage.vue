<template>
    <div>
        <h2>{{ service.name }}</h2>

        <b-card title="Service Info" sub-title="Card subtitle">
            <b-card-text>
                <b-container class="bv-example-row">
                    <b-row>
                        <b-col>Column</b-col>
                        <b-col>Column</b-col>
                        <div class="w-100"></div>
                        <b-col>Column</b-col>
                        <b-col>Column</b-col>
                    </b-row>
                </b-container>
            </b-card-text>
<!--            <b-card-text>-->
<!--                Some quick example text to build on the <em>card title</em> and make up the bulk of the card's-->
<!--                content.-->
<!--            </b-card-text>-->

<!--            <b-card-text>A second paragraph of text in the card.</b-card-text>-->

<!--            <a href="#" class="card-link">Card link</a>-->
<!--            <b-link href="#" class="card-link">Another link</b-link>-->
        </b-card>

    </div>
</template>

<script>
    import { mapState, mapGetters } from "vuex";
    import Service from "../Service";
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
