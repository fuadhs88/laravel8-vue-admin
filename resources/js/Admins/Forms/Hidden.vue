<template>
    <input type="hidden" :name="data.name" :value="data.value" :class="data.class" v-bind="data.attributes" />
</template>

<script>
    export default {
        name: "Hidden",

        props: {
            data: Object,
        }
    }
</script>

<style scoped>

</style>
