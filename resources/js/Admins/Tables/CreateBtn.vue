<template>
    <inertia-link :href="url" :class="'btn btn-sm btn-' + $page.props.color + ' table-create-btn mr-2'">
        <i class="fa fa-plus"></i><span class="pl-2">{{ trans('new') }}</span>
    </inertia-link>
</template>

<script>
    export default {
        name: "CreateBtn",

        props: {
            url: String,
        }
    }
</script>

<style scoped>

</style>
