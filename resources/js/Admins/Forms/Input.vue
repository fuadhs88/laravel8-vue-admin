<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="input-group">
                <div class="input-group-prepend" v-html="data.prepend" v-if="data.prepend"></div>

                <input :name="data.name" v-bind="data.attributes" />

                <span class="input-group-append" v-html="data.append" v-if="data.append"></span>

                <span class="input-group-append" v-if="data.picker">
                    <button type="button" class="btn btn-@color text-white" data-toggle="modal" :data-target="'#' + data.picker.modal">
                        <i class="fas fa-folder-open"></i>  {{ trans('browse') }}
                    </button>
                </span>
            </div>
            <!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Input",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            if (this.data.inputmask) {
                $.admin.require('inputmask');
            }
        },

        mounted() {
            if (this.data.inputmask) {
                $(this.data.selector).inputmask(JSON.parse(this.data.inputMaskOptions));
            }
        },
    }
</script>

<style scoped>

</style>
