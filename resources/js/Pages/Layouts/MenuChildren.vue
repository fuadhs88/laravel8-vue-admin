<template>
    <ul class="nav nav-treeview">
        <li class="nav-item" v-for="(menu, i) in menus" :key="i" v-if="menu.children.length === 0">
            <inertia-link :href="menuUri(menu.uri)" class="nav-link">
                <i :class="menuIconClasses(menu.icon)" v-if="menu.icon"></i>
                <p>{{ menu.title }}</p>
            </inertia-link>
        </li>
        <li class="nav-item" v-else>
            <a href="#" class="nav-link">
                <i :class="menuIconClasses(menu.icon)" v-if="menu.icon"></i>
                <p>{{ menu.title }}<i class="right fas fa-angle-left"></i></p>
            </a>
            <menu-children :config="config" :menus="menu.children" />
        </li>
    </ul>
</template>

<script>

    export default {
        name: "MenuChildren",

        props: ['config', 'menus'],

        methods: {
            menuIconClasses(icon) {
                return 'nav-icon ' + icon ?? '';
            },

            menuUri(uri) {
                return this.admin_base_url(uri, this.config.route.prefix);
            },
        }
    }
</script>

<style scoped>

</style>
