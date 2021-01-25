<template>
    <div class="card-footer">
        <p class="d-inline-block mb-0 py-1">
            从 <b>{{ data.paginationRanger.first }}</b> 到 <b>{{ data.paginationRanger.last }}</b> ，总共 <b>{{ data.paginationRanger.total }}</b> 条
        </p>
        <div class="d-inline-block float-right">
            <ul class="pagination pagination-sm m-0 float-right">
                <!-- Previous Page Link -->
                <li class="page-item disabled" v-if="data.paginationLinks.onFirstPage"><span class="page-link">&laquo;</span></li>
                <li class="page-item" v-else>
                    <inertia-link class="page-link" :href="data.paginationLinks.previousPageUrl" rel="prev">&laquo;</inertia-link>
                </li>

                <template v-for="(element) in data.paginationLinks.elements">
                    <li class="page-item d-none d-md-block disabled" v-if="typeof (element) === 'string'"><span class="page-link">{{ element }}</span></li>

                    <template v-for="(url, page) in element" v-else>
                        <li class="page-item d-none d-md-block active" v-if="page === data.paginationLinks.currentPage"><span class="page-link">{{ page }}</span></li>
                        <li class="page-item d-none d-md-block" v-else>
                            <inertia-link class="page-link" :href="url">{{ page }}</inertia-link>
                        </li>
                    </template>
                </template>

                <!-- Next Page Link -->
                <li class="page-item" v-if="data.paginationLinks.hasMorePages">
                    <inertia-link class="page-link" :href="data.paginationLinks.nextPageUrl" rel="next">&raquo;</inertia-link>
                </li>
                <li class="page-item disabled" v-else><span class="page-link">&raquo;</span></li>
            </ul>
        </div>
        <label class="float-right perpage-selector d-inline-block">
            显示
            <span class="dropup border px-2 py-1">
                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">{{ data.perPageSelector.perpage }}</a>
                <div class="dropdown-menu">
                    <inertia-link :href="url_with_param(data.perPageSelector.name, option)" :class="data.perPageSelector.perpage === option ? 'active dropdown-item' : 'dropdown-item'" v-for="(option, select) in data.perPageSelector.options" :key="select">{{ option }}</inertia-link>
                </div>
            </span>
        </label>
    </div>
</template>

<script>
    export default {
        name: "Paginator",

        props: {
            data: Object,
        },
    }
</script>

<style scoped>
    .perpage-selector {
        margin: 5px 10px 0 0;
        color: #777;
        font-weight: 400;
    }
    .perpage-selector a {
        color: #777;
    }
    .perpage-selector .dropdown-menu {
        min-width: 70px;
        left: -20px;
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
    }
    .perpage-selector .dropdown-menu a.active {
        background-color: #d2d6de;
    }
</style>
