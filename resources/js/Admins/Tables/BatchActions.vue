<template>
    <div class="btn-group table-select-all-btn mr-2 d-none" v-if="!data.holdAll">
        <a class="btn btn-sm btn-default hidden-xs"><span class="selected" :data-tpl="this.trans('table_items_selected')"></span></a>

        <template v-if="data.actions.length > 0">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li v-for="(action, i) in data.actions" :key="i" v-if="action.isBatchAction" v-html="action.render"></li>
                <li v-else>
                    <a href="#" :class="action.getElementClass" v-html="action.render"></a>
                </li>
            </ul>
        </template>
    </div>
</template>

<script>
    export default {
        name: "BatchActions",

        props: {
            data: Object,
            locale: Object,
        },

        created() {
            // console.dir(this.data);
        },
    }
</script>

<style scoped>

</style>
