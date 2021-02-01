<template>
    <div class="modal fade" id="modal-form-action">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">{{ data.title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <forms-fields :rows="data.rows" v-if="data.rows"></forms-fields>
                    </div>
                    <div class="modal-footer justify-end">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('close') }}</button>
                        <button type="submit" :class="'btn btn-' + $page.props.color">{{ trans('submit') }}</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</template>

<script>
    import FormsFields from './../Forms/Fields'

    export default {
        name: "ModalLg",

        components: {
            FormsFields
        },

        props: {
            data: Object,
        },

        created() {
            // console.dir(this.data)
        },
    }
</script>

<style scoped>

</style>
