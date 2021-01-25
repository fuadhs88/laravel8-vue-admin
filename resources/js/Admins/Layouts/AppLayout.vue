<template>
    <div class="wrapper">

        <!-- Navbar -->
        <nav :class="'main-header navbar navbar-expand ' + this.config('admin.theme.navbar')">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- user Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">{{ $page.props.user.name }}</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-3"></i>个人设置
                        </a>
                        <div class="dropdown-divider"></div>
                        <form @submit.prevent="logout">
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-share mr-3"></i>注销
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
        <aside :class="'main-sidebar elevation-4 ' + this.config('admin.theme.sidebar')">
            <!-- Brand Logo -->
            <a :href="this.admin_base_route('home')" :class="'brand-link ' + this.config('admin.theme.logo')">
                <img :src="this.config('admin.logo.image')" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light" v-html="this.config('admin.logo.text')"></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img :src="$page.props.user.avatar" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ $page.props.user.name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                        <li class="nav-item" v-for="(menu, i) in $page.props.menus" :key="i" v-if="menu.children.length === 0">
                            <inertia-link :href="admin_base_url(menu.uri)" :class="'nav-link ' + has_menu_active(menu.uri, this)">
                                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                                <p>{{ menu.title }}</p>
                            </inertia-link>
                        </li>
                        <li class="nav-item" v-else>
                            <a href="#" class="nav-link">
                                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                                <p>{{ menu.title }}<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <menu-children :menus="menu.children" :configs="configs"/>
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
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row" v-for="(row, i) in contents.rows" :key="i">
                        <div :class="columnClasses(column.width)" v-for="(column, j) in row.columns" :key="j">
                            <template v-for="value in column.contents">
                                <component :is="importComponent(value.view)" :data="value.data" :assets="assets" v-if="typeof value === 'object'"></component>
                                <p class="p-0" v-html="value" v-else></p>
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
    </div>
    <!-- ./wrapper -->
</template>

<script>
    import MenuChildren from './MenuChildren'
    import DashboardTitle from './../Dashboard/Title'
    import DashboardEnvironment from './../Dashboard/Environment'
    import DashboardExtensions from './../Dashboard/Extensions'
    import DashboardDependencies from './../Dashboard/Dependencies'
    import TablesTable from './../Tables/Table'
    import FormsForm from './../Forms/Form'

    export default {
        name: 'AppLayout',

        props: {
            configs: Object,
            routes: Array,
            assets: Object,
            errors: Object,
            contents: Object
        },

        components: {
            MenuChildren,
            DashboardTitle,
            DashboardEnvironment,
            DashboardExtensions,
            DashboardDependencies,
            TablesTable,
            FormsForm,
        },

        data() {
            return {

            }
        },

        // 页面加载之前执行
        created() {
            if (document.location.pathname !== this.admin_base_url('login')) {
                let body_class = this.config('admin.theme.layout') + ' ' + this.config('admin.theme.accent');
                $('body').addClass(body_class).removeClass('login-page');
            }
            // console.dir(this.contents);
        },

        // 页面加载完后执行
        mounted() {
            $('.main-sidebar .nav-sidebar[data-widget="treeview"] a.nav-link.active').parents('.nav-treeview').prev().addClass('active').parent().addClass('menu-open');
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

            logout() {
                this.$inertia.post(this.admin_base_route('logout'));
            },
        }
    }
</script>

<style scoped>

</style>
