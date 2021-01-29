<template>
    <div :class="'card-header ' + (data.expand ? '' : 'd-none' + ' filter-box')" :id="data.filter_id" v-if="!data.empty">
        <form :action="data.action" class="form-horizontal" method="get">

            <div class="row">
                <div :class="'col-md-' + column.width" v-for="(column, i) in data.columns" :key="i">
                    <div class="card-body">
                        <div class="fields-group">
                            <component v-for="(filter, j) in column.filters" :key="j" :is="importComponent(filter.view)" :data="filter.data"></component>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <div class="row">
                    <div :class="'col-md-' + data.first_width + ' row'">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="btn-group float-left">
                                <button :class="'btn btn-' + $page.props.color + ' submit btn-sm'"><i class="fa fa-search"></i><span class="pl-2">{{ this.trans('search') }}</span></button>
                            </div>
                            <div class="btn-group float-left ml-2">
                                <inertia-link :href="data.action" class="btn btn-default btn-sm"><i class="fa fa-undo"></i><span class="pl-2">{{ this.trans('reset') }}</span></inertia-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</template>

<script>
    import TablesFiltersWhere from './Where'

    export default {
        name: "Container",

        components: {
            TablesFiltersWhere,
        },

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
