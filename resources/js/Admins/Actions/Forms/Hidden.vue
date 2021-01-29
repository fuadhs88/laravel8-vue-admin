<template>
    <input type="hidden" :name="data.name" :value="data.value" :class="'form-control ' + data.class" v-bind="data.attributes" />
</template>

<script>
    export default {
        name: "Hidden",

        props: {
            data: Object,
            assets: Object,
        },
    }
</script>

<style scoped>

</style>
