<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <textarea :name="data.name" :class="'form-control ' + data.class" :rows="data.rows" :placeholder="data.placeholder" v-bind="data.attributes" >{{ data.value }}</textarea>

            <div class="text-right textarea-picker" v-if="data.picker">
                <button type="button" :class="'btn btn-' + $page.props.color + ' text-white'" data-toggle="modal" :data-target="'#' + data.picker.modal">
                    <i class="fa fa-folder-open"></i>  {{ trans('browse') }}
                </button>
            </div>
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Textarea",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },
    }
</script>

<style scoped>

</style>
