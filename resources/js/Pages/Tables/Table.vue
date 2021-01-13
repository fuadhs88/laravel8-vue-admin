<template>
    <div class="row">
        <div class="col-12">
            <div :class="'card card-' + this.GLOBAL.color + ' card-outline'">
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
                    <table :class="data.variables.tableClass">
                        <thead>
                        <tr>
                            <th>
                                <span :class="'icheck-' + this.GLOBAL.color">
                                    <input type="checkbox" id="all-select">
                                    <label for="all-select"></label>
                                </span>
                            </th>
                            <th v-for="(column, label) in data.columns" :key="label">{{ column.label }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(row, i) in data.rows" :key="i">
                            <td v-for="(column, name) in data.columns" :key="name">{{ row.data[column.name] }}</td>
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
    export default {
        name: "Table",

        props: ['data'],

        created() {
            console.dir(this.data);
            this.el_insert('icheck bootstrap', '<!--icheck bootstrap-->\n<link rel="stylesheet" href="/vendor/laravel-admin/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">');
        },
    }
</script>

<style scoped>

</style>
