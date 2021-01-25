<template>
    <div class="btn-group float-right mr-2">
        <a :href="data.all" target="_blank" class="btn btn-sm btn-default" title="导出">
            <i class="fa fa-download"></i><span class="pl-2">导出</span>
        </a>
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <div class="dropdown-menu" role="menu">
            <a :href="data.all" target="_blank" class="dropdown-item">全部</a>
            <a :href="data.page" target="_blank" class="dropdown-item">本页</a>
            <a :href="selectedHref" :data-href="data.selected" target="_blank" :class="data.name + ' dropdown-item selected_rows d-none'">选定的行</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExportBtn",

        props: {
            data: Object,
            selectedHref: 'javascript:void(0);',
        },

        created() {
            // console.dir(this.data);
        },
    }
</script>

<style scoped>

</style>
