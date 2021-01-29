<template>
    <p class="help-block">
        <i :class="'fas ' + help.icon"></i><span class="pl-2" v-html="help.text"></span>
    </p>
</template>

<script>
    export default {
        name: "HelpBlock",

        props: {
            help: Object
        }
    }
</script>

<style scoped>

</style>
