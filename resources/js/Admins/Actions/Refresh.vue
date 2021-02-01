<template>
    <li class="nav-item">
        <inertia-link class="nav-link" href="javascript:void(0);" :title="trans('refresh')" @click.prevent="refresh()"><i class="fas fa-sync"></i></inertia-link>
    </li>
</template>

<script>
    export default {
        name: "Refresh",

        methods: {
            refresh() {
                $.admin.reload(this.trans('refresh_succeeded'));
            }
        }
    }
</script>

<style scoped>

</style>
