<template>
    <div class="row">
        <div class="col-12">
            <div :class="'card card-' + $page.props.color + ' card-outline'">
                <div class="card-header">
                    <div class="card-header" v-if="data.title">
                        <h3 class="card-title"> {{ data.title }}</h3>
                    </div>

                    <div class="card-header py-0 border-bottom-0" v-if="data.showTools || data.showExportBtn || data.showCreateBtn">
                        <div class="card-tools">
                            <tables-column-selector :data="data.columnSelector"></tables-column-selector>
                            <tables-export-button :data="data.exportButton"></tables-export-button>
                            <tables-create-button-modal :url="data.createButton.url" v-if="data.createButton.modal"></tables-create-button-modal>
                            <tables-create-button :url="data.createButton.url" v-else></tables-create-button>
                        </div>

                        <div class="float-left d-flex" v-if="data.showTools">
                            {!! $table->renderHeaderTools() !!}
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table :class="data.table_class">

                        <thead>
                        <tr>
                            <th v-for="(column, label) in data.columns" :key="label" v-if="column.name === '__row_selector__' && data.options.show_row_selector">
                                <tables-row-selector-all></tables-row-selector-all>
                            </th>
                            <th v-else>{{ column.label }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(row, i) in data.rows" :key="i">
                            <td v-for="(columnName, name) in data.columnNames" :key="name" v-if="columnName === '__row_selector__' && data.options.show_row_selector">
                                <tables-row-selector :data="row.data['id']"></tables-row-selector>
                            </td>
                            <td v-else-if="columnName === '__actions__'">
                                <component :is="importComponent(row.data[columnName].view)" :data="row.data[columnName].data"></component>
                            </td>
                            <td v-else>{{ row.data[columnName] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

                <tables-paginator :data="data.paginator"></tables-paginator>
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
    import TablesColumnSelector from './ColumnSelector'
    import TablesExportButton from './ExportBtn'
    import TablesActionsDropdown from './Actions/Dropdown'
    import TablesPaginator from './Paginator'

    export default {
        name: "Table",

        components: {
            TablesRowSelector,
            TablesRowSelectorAll,
            TablesCreateButton,
            TablesCreateButtonModal,
            TablesColumnSelector,
            TablesExportButton,
            TablesActionsDropdown,
            TablesPaginator,
        },

        props: {
            data: Object,
        },

        created() {
            // console.dir(this.data);
        },

        methods: {
            importComponent(view) {
                return view.replace(/\//g, '');
            },
        }
    }
</script>

<style scoped>

</style>
