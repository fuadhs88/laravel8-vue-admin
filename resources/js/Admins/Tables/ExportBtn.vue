<template>
    <div class="btn-group float-right mr-2">
        <a :href="data.all" target="_blank" class="btn btn-sm btn-default" :title="trans('export')">
            <i class="fa fa-download"></i><span class="pl-2">{{ trans('export') }}</span>
        </a>
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
        </button>
        <div class="dropdown-menu" role="menu">
            <a :href="data.all" target="_blank" class="dropdown-item">{{ trans('all') }}</a>
            <a :href="data.page" target="_blank" class="dropdown-item">{{ trans('current_page') }}</a>
            <a :href="selectedHref" :data-href="data.selected" target="_blank" :class="data.name + ' dropdown-item selected_rows d-none'">{{ trans('selected_rows') }}</a>
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
