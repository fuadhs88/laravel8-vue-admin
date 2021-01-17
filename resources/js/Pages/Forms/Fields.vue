<template>
<!--    <div class="row" v-for="(row, i) in rows" :key="i">-->
<!--        <div :class="column.width" v-for="(column, j) in row.columns" :key="j">-->
<!--            <component :is="importComponent(field.view)" :data="field.data" v-for="(field, k) in column.fields" :key="k"></component>-->
<!--        </div>-->
<!--    </div>-->
</template>

<script>
    export default {
        name: "Fields",

        props: {
            rows: Object,
        },

        methods: {
            importComponent(view) {
                return view.replace(/\//g, '');
            },
        }
    }
</script>

<style scoped>

</style>
