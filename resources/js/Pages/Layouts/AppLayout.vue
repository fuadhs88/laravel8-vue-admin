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
                    <a class="nav-link" data-toggle="dropdown" href="#"></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-3"></i>个人设置
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" @submit.prevent="logout">
                            <a :href="this.admin_base_route('logout')" class="dropdown-item">
                                <i class="fas fa-share mr-3"></i>注销
                            </a>
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
                        <img src="" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->

                <nav class="mt-2">
<!--                    <sidebar-menu :menus="menus" />-->
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <slot name="header"></slot>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <slot></slot>
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
    import SidebarMenu from './SidebarMenu'

    export default {
        name: 'AdminLayout',

        components: {
            SidebarMenu,
        },

        data() {
            return {
                menus: [],
            }
        },

        mounted() {
            // this.getMenus();
        },

        methods: {
            getMenus() {
                axios.get(route('admin.admin_menus.sidebar_menus'), {
                    preserveScroll: true,
                }).then((res) => {
                    this.menus = res.data
                });
            },

            logout() {
                this.$inertia.post(this.admin_base_route('logout'));
            },
        }
    }
</script>

<style scoped>

</style>
