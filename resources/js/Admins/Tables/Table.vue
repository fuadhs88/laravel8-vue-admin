<template>
    <div class="row">
        <div class="col-12">
            <div :class="'card card-' + $page.props.color + ' card-outline'">
                <div class="card-header">
                    <div class="card-header" v-if="data.title">
                        <h3 class="card-title"> {{ data.title }}</h3>
                    </div>

                    <div class="card-header p-0 border-bottom-0" v-if="data.showTools || data.showExportBtn || data.showCreateBtn">
                        <div class="card-tools">
                            <tables-column-selector :data="data.columnSelector" :locale="locale"></tables-column-selector>
                            <tables-export-button :data="data.exportButton" :locale="locale"></tables-export-button>
                            <tables-create-button-modal :url="data.createButton.url" :locale="locale" v-if="data.createButton.modal"></tables-create-button-modal>
                            <tables-create-button :url="data.createButton.url" :locale="locale" v-else></tables-create-button>
                        </div>

                        <div class="float-left d-flex" v-if="data.showTools">
                            <tables-batch-actions :data="data.headerTools[0]" :locale="locale"></tables-batch-actions>
                            <tables-filters-button :data="data.headerTools[1]" :locale="locale"></tables-filters-button>
                        </div>
                    </div>
                </div>

                <tables-filters-container :data="data.filters" :locale="locale" v-if="data.options.show_filter"></tables-filters-container>

                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table :class="data.table_class">

                        <thead>
                        <tr>
                            <th v-for="(column, label) in data.columns" :key="label" v-if="column.name === '__row_selector__' && data.options.show_row_selector">
                                <tables-row-selector-all :assets="assets"></tables-row-selector-all>
                            </th>
                            <th v-else-if="column.name === '__actions__' && data.options.show_actions">
                                {{ column.label }}
                            </th>
                            <th v-else>{{ column.label }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-if="data.rows.length <= 0">
                            <td :colspan="data.columns.length" class="empty-table text-center p-5">
                                <svg class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" width="128" height="128" style="fill: #999999;">
                                    <path d="M512.8 198.5c12.2 0 22-9.8 22-22v-90c0-12.2-9.8-22-22-22s-22 9.8-22 22v90c0 12.2 9.9 22 22 22zM307 247.8c8.6 8.6 22.5 8.6 31.1 0 8.6-8.6 8.6-22.5 0-31.1L274.5 153c-8.6-8.6-22.5-8.6-31.1 0-8.6 8.6-8.6 22.5 0 31.1l63.6 63.7zM683.9 247.8c8.6 8.6 22.5 8.6 31.1 0l63.6-63.6c8.6-8.6 8.6-22.5 0-31.1-8.6-8.6-22.5-8.6-31.1 0l-63.6 63.6c-8.6 8.6-8.6 22.5 0 31.1zM927 679.9l-53.9-234.2c-2.8-9.9-4.9-20-6.9-30.1-3.7-18.2-19.9-31.9-39.2-31.9H197c-19.9 0-36.4 14.5-39.5 33.5-1 6.3-2.2 12.5-3.9 18.7L97 679.9v239.6c0 22.1 17.9 40 40 40h750c22.1 0 40-17.9 40-40V679.9z m-315-40c0 55.2-44.8 100-100 100s-100-44.8-100-100H149.6l42.5-193.3c2.4-8.5 3.8-16.7 4.8-22.9h630c2.2 11 4.5 21.8 7.6 32.7l39.8 183.5H612z"></path>
                                </svg>
                            </td>
                        </tr>
                        <tr v-for="(row, i) in data.rows" :key="i" v-else>
                            <td v-for="(columnName, name) in data.columnNames" :key="name" v-if="columnName === '__row_selector__' && data.options.show_row_selector">
                                <tables-row-selector :data="row.column['id']" :assets="assets"></tables-row-selector>
                            </td>
                            <td v-else-if="columnName === '__actions__' && data.options.show_actions">
                                <tables-actions-dropdown :data="row.column[columnName]"></tables-actions-dropdown>
                            </td>
                            <td v-else>{{ row.column[columnName] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <tables-paginator :data="data.paginator" :locale="locale"></tables-paginator>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    import TablesRowSelector from './RowSelector'
    import TablesRowSelectorAll from './RowSelectorAll'
    import TablesCreateButton from './CreateBtn'
    import TablesCreateButtonModal from './CreateBtnModal'
    import TablesExportButton from './ExportBtn'
    import TablesColumnSelector from './ColumnSelector'
    import TablesActionsDropdown from './Actions/Dropdown'
    import TablesPaginator from './Paginator'
    import TablesBatchActions from './BatchActions'
    import TablesFiltersButton from './Filters/Button'
    import TablesFiltersContainer from './Filters/Container'

    export default {
        name: "Table",

        components: {
            TablesRowSelector,
            TablesRowSelectorAll,
            TablesCreateButton,
            TablesCreateButtonModal,
            TablesExportButton,
            TablesColumnSelector,
            TablesActionsDropdown,
            TablesPaginator,
            TablesBatchActions,
            TablesFiltersButton,
            TablesFiltersContainer,
        },

        props: {
            data: Object,
            assets: Object,
            locale: Object,
        },

        created() {
            // console.dir(this.data);
        },
    }
</script>

<style scoped>

</style>
