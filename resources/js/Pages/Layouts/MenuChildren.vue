<template>
    <ul class="nav nav-treeview">
        <li class="nav-item" v-for="(menu, i) in menus" :key="i" v-if="!menu.children || menu.children.length === 0">
            <inertia-link :href="admin_base_url(menu.uri)" :class="'nav-link ' + has_menu_active(menu.uri)" :only="['contents']">
                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                <p>{{ menu.title }}</p>
            </inertia-link>
        </li>
        <li class="nav-item" v-else>
            <a href="#" class="nav-link">
                <i :class="'nav-icon ' + menu.icon" v-if="menu.icon"></i>
                <p>{{ menu.title }}<i class="right fas fa-angle-left"></i></p>
            </a>
            <menu-children :menus="menu.children" />
        </li>
    </ul>
</template>

<script>
    export default {
        name: "MenuChildren",

        props: {
            menus: Array
        }
    }
</script>

<style scoped>

</style>
