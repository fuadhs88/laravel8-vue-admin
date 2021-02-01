<template>
    <div class="btn-group dropdown column-selector float-right mr-2">
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
            <i class="fas fa-table"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right pt-0 w-auto">
            <form class="p-2">
                <div class="form-group mb-0">
                    <div :class="'form-check pl-0 icheck-' + $page.props.color" v-for="(column, key) in data.columns" :key="key">
                        <input type="checkbox" class="form-check-input column-select-item" :id="'column-select-item-' + key" :value="key" :checked="(!data.visible || inArray(key)) ? 'checked' : ''" @click="columnSelect()">
                        <label class="form-check-label" :for="'column-select-item-' + key">{{ column }}</label>
                    </div>
                </div>
            </form>

            <div class="dropdown-divider"></div>

            <form class="p-2">
                <a class="btn btn-sm btn-default float-left" @click="columnSelectAll()">{{ trans('all') }}</a>&nbsp;&nbsp;
                <inertia-link :href="url" :class="'btn btn-sm btn-' + $page.props.color + ' column-select-submit float-right'">{{ trans('submit') }}</inertia-link>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ColumnSelector",

        props: {
            data: Object,
        },

        data() {
            return {
                url: '',
            }
        },

        mounted() {
            this.columnSelect();
        },

        methods: {
            inArray(key) {
                let visible = $.map(this.data.visible, function (value, index) {
                    return [value];
                });
                return $.inArray(key, visible) !== -1;
            },

            columnSelectAll() {
                $('.column-select-item').prop('checked', true);
                this.columnSelect();
            },

            columnSelect() {
                let defaults = this.data.defaults;
                let selected = [];

                $('.column-select-item:checked').each(function () {
                    selected.push($(this).val());
                });

                let url = new URL(location);

                if (selected.length === 0 || selected.sort().toString() === defaults.sort().toString()) {
                    url.searchParams.delete('_columns_');
                } else {
                    url.searchParams.set('_columns_', selected.join());
                }

                this.url = url.toString();
            },
        }
    }
</script>

<style scoped>

</style>
