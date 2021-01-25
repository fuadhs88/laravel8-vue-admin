<template>
    <div :class="'card card-' + $page.props.color + ' card-outline'">
        <div class="card-header">
            <h3 class="card-title">{{ data.title }}</h3>

            <div class="card-tools" v-html="data.tools"></div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">

<!--            <component :is="FormsTab" :data="data.tabObj" v-if="data.tabObj"></component>-->

            <div class="fields-group">
                <component :is="FormsFields" :rows="data.rows"></component>
            </div>

        </div>
        <!-- /.card-body -->

        <!-- /.card-footer -->
    </div>
</template>

<script>
    import FormsFields from './Fields';

    export default {
        name: "Form",

        components: {
            FormsFields,
        },

        props: {
            data: Object,
        },
    }
</script>

<style scoped>

</style>
