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
                            <li class="breadcrumb-item"><a :href="admin_base_route('home')"><i class="fas fa-home pr-1"></i>首页</a></li>
                            <li class="breadcrumb-item active" v-for="(breadcrumb, i) in contents.breadcrumb" :key="i" v-if="breadcrumb.url">
                                <inertia-link :href="breadcrumb.url">
                                    <i :class="breadcrumb.icon + ' pr-1'" v-if="breadcrumb.icon"></i>{{ breadcrumb.text }}
                                </inertia-link>
                            </li>
                            <li class="breadcrumb-item active" v-else-if="breadcrumb.icon">
                                <i :class="breadcrumb.icon + ' pr-1'"></i>{{ breadcrumb.text }}
                            </li>
                            <li class="breadcrumb-item active" v-else>
                                {{ breadcrumb.text }}
                            </li>
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
    import FormsForm from './../Forms/Form'

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
            FormsForm,
        },

        created() {
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
