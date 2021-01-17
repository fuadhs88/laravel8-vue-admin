<template>
    <div class="btn-group table-select-all-btn mr-2 d-none" v-if="data.holdAll">
        <a class="btn btn-sm btn-default hidden-xs"><span class="selected" data-tpl="已选择 {n} 项"></span></a>
        <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" role="menu" v-for="(action, i) in data.actions" :key="i" v-if="data.actions">
            <li v-if="action.isBatchAction">{{ action.render }}}</li>
            <li v-else>
                <a href="#" :class="action.getElementClass">{{ action.render }}} </a>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "BatchActions",

        props: {
            data: Object,
        },
    }
</script>

<style scoped>

</style>
