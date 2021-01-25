<template>
    <a :href="url" :class="'btn btn-sm btn-' + $page.props.color + ' table-create-btn mr-2'" data-toggle="modal" data-target="#table-create-modal">
        <i class="fas fa-plus"></i><span class="pl-2">新增</span>
    </a>
</template>

<script>
    export default {
        name: "CreateBtnModal",

        props: {
            url: String
        }
    }
</script>

<style scoped>

</style>
