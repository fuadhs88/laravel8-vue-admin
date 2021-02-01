<template>
    <app-layout :configs="this.configs" :routes="this.routes">
        <template #header>
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ content.title }}<small class="ml-2">{{ content.description }}</small></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a :href="admin_base_route('home')"><i class="fas fa-home pr-1"></i>首页</a></li>
                            <li class="breadcrumb-item active" v-for="(breadcrumb, i) in content.breadcrumb" :key="i" v-if="breadcrumb.url">
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
            <div class="row" v-for="(row, i) in content.rows" :key="i">
                <div :class="columnClasses(column.width)" v-for="(column, j) in row.columns" :key="j">
                    <component v-for="(value, k) in column.contents" :key="k" :is="importComponent(value.view)" :data="value.data"></component>
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
            routes: Array,
            assets: Object,
            errors: Object,
            content: Object
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

        },

        data() {
            return {

            }
        },

        methods: {
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
