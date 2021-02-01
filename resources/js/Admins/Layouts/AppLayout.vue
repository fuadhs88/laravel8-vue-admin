<template>
    <div class="wrapper">

        <!-- Navbar -->
        <nav :class="'main-header navbar navbar-expand ' + config('admin.theme.navbar')">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
<!--                <li class="nav-item d-none d-sm-inline-block">-->
<!--                    <a href="index3.html" class="nav-link">Home</a>-->
<!--                </li>-->

                <template v-for="(navbarLeft) in contents.navbar_left">
                    <li class="nav-item" v-html="navbarLeft" v-if="typeof navbarLeft === 'string'"></li>
                    <li class="nav-item" v-else-if="'href' in navbarLeft">
                        <inertia-link class="nav-link" :href="navbarLeft.href" :title="navbarLeft.title">
                            <i :class="'fas ' + navbarLeft.icon"></i>
                        </inertia-link>
                    </li>
                    <li class="nav-item" v-else>
                        <a href="javascript:void(0);"
                                      :class="'nav-link ' + navbarLeft.class"
                                      :title="navbarLeft.title"
                                      v-bind="navbarLeft.attributes"
                                      @click.prevent="('modal_id' in navbarLeft.script) ? buttonFormAction($event, navbarLeft.script) : buttonAction($event, navbarLeft.script)">
                            <i :class="'fas ' + navbarLeft.icon"></i>
                        </a>
                    </li>
                </template>
            </ul>

            <!-- SEARCH FORM -->
<!--            <form class="form-inline ml-3">-->
<!--                <div class="input-group input-group-sm">-->
<!--                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">-->
<!--                    <div class="input-group-append">-->
<!--                        <button class="btn btn-navbar" type="submit">-->
<!--                            <i class="fas fa-search"></i>-->
<!--                        </button>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </form>-->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <template v-for="(navbarRight) in contents.navbar_right">
                    <li class="nav-item" v-html="navbarRight" v-if="typeof navbarRight === 'string'"></li>
                    <component :is="importComponent(navbarRight.view)" :data="navbarRight.data" v-else-if="'view' in navbarRight"></component>
                    <li class="nav-item" v-else-if="'href' in navbarRight">
                        <inertia-link class="nav-link" :href="navbarRight.href" :title="navbarRight.title">
                            <i :class="'fas ' + navbarRight.icon"></i>
                        </inertia-link>
                    </li>

                    <li class="nav-item" v-else>
                        <a href="javascript:void(0);"
                                      :class="'nav-link ' + navbarRight.class"
                                      :title="navbarRight.title"
                                      v-bind="navbarRight.attributes"
                                      @click.prevent="('modal_id' in navbarRight.script) ? buttonFormAction($event, navbarRight.script) : buttonAction($event, navbarRight.script)">
                            <i :class="'fas ' + navbarRight.icon"></i>
                        </a>
                    </li>
                </template>

                <!-- user Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">{{ $page.props.user.name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-3"></i>{{ trans('self_setting') }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form @submit.prevent="logout">
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-share mr-3"></i>{{ trans('logout') }}
                            </button>
                        </form>
                    </div>
                </li>

<!--                <li class="nav-item">-->
<!--                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>-->
<!--                </li>-->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside :class="'main-sidebar elevation-4 ' + config('admin.theme.sidebar')">
            <!-- Brand Logo -->
            <a :href="admin_base_route('home')" :class="'brand-link ' + config('admin.theme.logo')">
                <img :src="config('admin.logo.image')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" v-html="config('admin.logo.text')"></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img :src="$page.props.user.avatar" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">{{ $page.props.user.name }}</div>
                </div>

                <!-- Sidebar Menu -->

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item" v-for="(menu, i) in $page.props.menus" :key="i" v-if="menu.children.length === 0">
                            <inertia-link :href="admin_base_url(menu.uri)" :class="'nav-link ' + has_menu_active(menu.uri)">
                                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                                <p>{{ menu.title }}</p>
                            </inertia-link>
                        </li>
                        <li class="nav-item" v-else>
                            <a href="#" class="nav-link">
                                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                                <p>{{ menu.title }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <menu-children :menus="menu.children"/>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ contents.title }}<small class="ml-2">{{ contents.description }}</small></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a :href="admin_base_route('home')"><i class="fas fa-home pr-1"></i>{{ trans('home') }}</a></li>
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
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row" v-for="(row, i) in contents.rows" :key="i">
                        <div :class="columnClasses(column.width)" v-for="(column, j) in row.columns" :key="j">
                            <template v-for="value in column.contents">
                                <component :is="importComponent(value.view)" :data="value.data" v-if="typeof value === 'object'"></component>
                                <p class="m-0 p-0" v-html="value" v-else></p>
                            </template>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
<!--        <aside class="control-sidebar control-sidebar-dark">-->
<!--            &lt;!&ndash; Control sidebar content goes here &ndash;&gt;-->
<!--            <div class="p-3">-->
<!--                <h5>Title</h5>-->
<!--                <p>Sidebar content</p>-->
<!--            </div>-->
<!--        </aside>-->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>

        <modal-form-action :data="this.$root.modalFormActionData"></modal-form-action>
    </div>
    <!-- ./wrapper -->
</template>

<script>
    // 引入组件
    import {Inertia} from '@inertiajs/inertia'
    import ModalFormAction from './../Modals/ModalFormAction'
    import MenuChildren from './MenuChildren'
    import DashboardTitle from './../Dashboard/Title'
    import DashboardEnvironment from './../Dashboard/Environment'
    import DashboardExtensions from './../Dashboard/Extensions'
    import DashboardDependencies from './../Dashboard/Dependencies'
    import ActionsRefresh from './../Actions/Refresh'
    import TablesTable from './../Tables/Table'
    import FormsForm from './../Forms/Form'

    export default {
        // 当前组件名称
        name: 'AppLayout',

        // 接收传参
        props: {
            configs: Object,
            locale: Object,
            routes: Array,
            assets: Object,
            color: String,
            errors: Object,
            contents: Object
        },

        // 组件集合
        components: {
            ModalFormAction,
            MenuChildren,
            DashboardTitle,
            DashboardEnvironment,
            DashboardExtensions,
            DashboardDependencies,
            ActionsRefresh,
            TablesTable,
            FormsForm,
        },

        // 数据集合
        data() {
            return {

            }
        },

        // 页面加载之前执行
        created() {
            $.admin.configs = this.configs;
            $.admin.locale = this.locale;
            $.admin.routes = this.routes;
            $.admin.assets = this.assets;
            $.admin.color = this.color;
            $.admin.inertia = Inertia;
            // console.dir(this);
        },

        // 页面加载完后执行
        mounted() {
            $(document).Layout('fixLayoutHeight');
            $('.nav-sidebar[data-widget="treeview"] a.nav-link.active').parents('.nav-treeview').prev().addClass('active').parent().addClass('menu-open');
        },

        // 函数集合
        methods: {
            columnClasses(cols) {
                let col = '';
                $.each(cols, function (key, val) {
                    col += key + '-' + val;
                });

                return 'col-' + col;
            },

            logout() {
                this.$inertia.post(this.admin_base_route('logout'));
            },
        }
    }
</script>

<style scoped>

</style>
