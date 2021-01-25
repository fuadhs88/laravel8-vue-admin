<template>
    <div class="form-group row">
        <label class="col-2 col-form-label text-right">{{ data.label }}</label>
        <div class="col-8">
            <component :is="importComponent(data.presenter)" :data="data"></component>
<!--            @include($presenter->view())-->
        </div>
    </div>
</template>

<script>
    import TablesFiltersText from "./Text"

    export default {
        name: "Where",

        components: {
            TablesFiltersText
        },

        props: {
            data: Object
        },

        created() {
            console.dir(this.data);
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
