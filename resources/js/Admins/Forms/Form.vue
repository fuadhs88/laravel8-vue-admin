<template>
    <div :class="'card card-' + $page.props.color + ' card-outline'">
        <div class="card-header">
            <h3 class="card-title">{{ data.title }}</h3>

            <div class="card-tools">
                <template v-for="(defaultVal, defaultKey) in data.tools.default">
                    <div class="btn-group float-right mr-2" v-if="defaultKey === 'list'">
                        <inertia-link :href="defaultVal" class="btn btn-sm btn-default" :title="trans('list')">
                            <i class="fas fa-list"></i><span class="pl-2 d-none d-md-inline">{{ trans('list') }}</span>
                        </inertia-link>
                    </div>
                    <div class="btn-group float-right mr-2" v-if="defaultKey === 'delete'">
                        <inertia-link href="javascript:void(0);" class="btn btn-sm btn-danger" :title="trans('delete')" @click.prevent="buttonAction($event, defaultVal.script)" v-if="'script' in defaultVal">
                            <i class="fas fa-trash"></i><span class="pl-2 d-none d-md-inline">{{ trans('delete') }}</span>
                        </inertia-link>
                    </div>
                    <div class="btn-group float-right mr-2" v-if="defaultKey === 'view'">
                        <inertia-link :href="defaultVal" :class="'btn btn-sm btn-' + $page.props.color" :title="trans('view')">
                            <i class="fas fa-eye"></i><span class="pl-2 d-none d-md-inline">{{ trans('view') }}</span>
                        </inertia-link>
                    </div>
                </template>

            </div>
        </div>
        <!-- /.card-header -->

        <form v-bind="data.open">
            <!-- form start -->
            <div class="card-body">

                <!--            <component :is="FormsTab" :data="data.tabObj" v-if="data.tabObj"></component>-->

                <div :class="'fields-group ' + data.container">
                    <forms-fields :rows="data.rows" v-if="data.rows"></forms-fields>
                </div>

            </div>
            <!-- /.card-body -->

            <forms-footer :data="data.footer" v-if="data.footer"></forms-footer>
            <!-- /.card-footer -->

            <template v-for="(hiddenField) in data.hiddenFields">
                <forms-hidden :data="hiddenField.data"></forms-hidden>
            </template>
        </form>
    </div>
</template>

<script>
    import FormsFields from './Fields';
    import FormsFooter from './Footer';
    import FormsHidden from './Hidden';

    export default {
        name: "Form",

        components: {
            FormsFields,
            FormsFooter,
            FormsHidden,
        },

        props: {
            data: Object,
        },

        mounted() {
            $.admin.initForm($('form.' + this.data.class));
        },
    }
</script>

<style scoped>

</style>
