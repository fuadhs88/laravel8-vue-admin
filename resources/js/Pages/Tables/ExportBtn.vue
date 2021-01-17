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
            <a target="_blank" :class="data.name + ' dropdown-item selected_rows'" @click="selectedRow">选定的行</a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ExportBtn",

        props: {
            data: Object,
        },

        methods: {
            selectedRow() {
                console.dir($('.table-row-checkbox:selected'));
                // let rows = $.admin.table.selected().join();

                if (!rows) {
                    return false;
                }

                console.div($(this));
                // location.href = $(this).attr('href').replace('__rows__', rows);
            },
        }
    }
</script>

<style scoped>

</style>
