<template>
    <inertia-link :href="url" :class="'btn btn-sm btn-' + $page.props.color + ' table-create-btn mr-2'">
        <i class="fas fa-plus"></i><span class="pl-2">新增</span>
    </inertia-link>
</template>

<script>
    export default {
        name: "CreateBtn",

        props: {
            url: String
        }
    }
</script>

<style scoped>

</style>
