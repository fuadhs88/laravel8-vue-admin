<template>
    <div class="btn-group mr-2">
        <button type="button" :class="'btn btn-sm btn-default ' + data.btn_class" @click="filter()">
            <i class="fas fa-filter"></i><span class="pl-1">筛选</span>
        </button>

        <template v-if="data.scopes.length > 0">
            <button type="button" class="btn btn-sm btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span v-html="data.label"></span>
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                <template v-for="(scope) in data.scopes">
                    <div class="dropdown-divider" v-if="scope.divider"></div>
                    <inertia-link :href="scope.url" class='dropdown-item' v-html="" v-else>{{ scope.label }}</inertia-link>
                </template>
                <div class="dropdown-divider"></div>
                <inertia-link :href="data.cancel" class="dropdown-item">取消</inertia-link>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "Button",

        props: {
            data: Object
        },

        created() {
            console.dir(this.data);
        },

        methods: {
            filter() {
                let filter = $('#filter-box');
                if (filter.is(':visible')) {
                    filter.addClass('d-none');
                } else {
                    filter.removeClass('d-none');
                }
                console.dir(filter);
            }
        }
    }
</script>

<style scoped>

</style>
