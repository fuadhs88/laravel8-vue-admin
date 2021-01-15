<template>
    <app-layout>
        <template #header>
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ contents.title }}<small class="ml-2">{{ contents.description }}</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </template>

        <div class="container-fluid">
            <div class="row" v-for="(row, i) in contents.rows" :key="i">
                <div :class="columnClasses(column.width)" v-for="(column, j) in row.columns" :key="j">
                    <component v-for="(content, k) in column.contents" :key="k" :is="importComponent(content.view)" :data="content.data"></component>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->

    </app-layout>
</template>

<script>
    import AppLayout from './AppLayout'
    import DashboardTitle from './../Dashboard/Title'
    import DashboardEnvironment from './../Dashboard/Environment'
    import DashboardExtensions from './../Dashboard/Extensions'
    import DashboardDependencies from './../Dashboard/Dependencies'
    import TablesTable from './../Tables/Table'

    export default {
        props: {
            configs: Object,
            contents: Object
        },

        components: {
            AppLayout,
            DashboardTitle,
            DashboardEnvironment,
            DashboardExtensions,
            DashboardDependencies,
            TablesTable,
        },

        created() {
            console.dir(this.contents);
            this.GLOBAL.configs = this.configs;
        },

        methods: {
            importComponent(view) {
                return view.replace('/', '');
            },

            columnClasses(cols) {
                var col = '';
                $.each(cols, function (key, val) {
                    col += key + '-' + val;
                });

                return 'col-' + col;
            },
        }
    }
</script>

<style scoped>

</style>
