<template>
    <div class="service_item">
        {{ service.name }}
    </div>
</template>

<script>
    export default {
        name: "Service",
        props: {
            service: {
                type: Object,
                required: true
            }
        }
    }
</script>

<style scoped>

</style>
