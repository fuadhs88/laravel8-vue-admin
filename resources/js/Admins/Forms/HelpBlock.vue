<template>
    <div class="mt-2 text-secondary">
        <i :class="'fas ' + help.icon"></i><span class="pl-2" v-html="help.text"></span>
    </div>
</template>

<script>
    export default {
        name: "HelpBlock",

        props: {
            help: Object
        },
    }
</script>

<style scoped>

</style>
