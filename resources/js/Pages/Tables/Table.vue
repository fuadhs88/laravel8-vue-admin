<template>
    <div class="row">
        <div class="col-12">
            <div :class="'card card-' + $page.props.color + ' card-outline'">
                <div class="card-header">
                    <h3 class="card-title">card-title</h3>

<!--                    <div class="card-tools">-->
<!--                        <inertia-link :href="data.create_url" class="btn btn-sm btn-success" v-if="data.options.show_create_btn">-->
<!--                            新增-->
<!--                        </inertia-link>-->
<!--                    </div>-->
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table :class="data.table_class">

                        <thead>
                        <tr>
                            <th v-for="(column, label) in data.columns" :key="label" v-if="column.name === '__row_selector__'" v-html="column.label"></th>
                            <th v-else>{{ column.label }}</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr v-for="(row, i) in data.rows" :key="i">
                            <td v-for="(columnName, name) in data.columnNames" :key="name" v-if="columnName === '__row_selector__'" v-html="row.data[columnName]"></td>
                            <td v-else-if="columnName === '__actions__'">
                                <component :is="importComponent(row.data[columnName].view)" :data="row.data[columnName].data"></component>
                            </td>
                            <td v-else>{{ row.data[columnName] }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</template>

<script>
    import TablesActionsDropdown from './../Tables/Actions/Dropdown'

    export default {
        name: "Table",

        components: {
            TablesActionsDropdown,
        },

        props: {
            data: Object,
        },

        created() {
            // console.dir(this.data);
            this.el_insert('icheck bootstrap', '<!--icheck bootstrap-->\n<link rel="stylesheet" href="/vendor/laravel-admin/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">');
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
