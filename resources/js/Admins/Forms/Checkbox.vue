<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field + ' py-2'" :id="data.id">
            <span :class="'icheck-' + $page.props.color" v-if="data.canCheckAll">
                <input type="checkbox" :id="'checkboxAll-' + data.name" :class="data.checkAllClass" @change="checkboxAll($event)"/>
                <label :for="'checkboxAll-' + data.name">&nbsp;{{ trans('all') }}</label>
            </span>
            <hr class="my-2" v-if="data.canCheckAll">

            <template v-for="(optionVal, optionKey) in data.options">
                <span :class="'icheck-' + $page.props.color" v-if="data.inline">
                    <input type="checkbox" :id="data.id + optionKey"
                           :name="data.name + '[]'"
                           :value="optionKey"
                           :class="data.class"
                           :checked="in_array(optionKey, data.value) || (data.value === null && in_array(optionKey, data.checked))"
                           v-bind="data.attributes"/>

                    <label :for="data.id + optionKey">&nbsp;{{ optionVal }}&nbsp;&nbsp;</label>
                </span>
                <div :class="'mt-0 icheck-' + $page.props.color" v-else>
                    <input type="checkbox" :id="data.id + optionKey"
                           :name="data.name + '[]'"
                           :value="optionKey"
                           :class="data.class"
                           :checked="in_array(optionKey, data.value) || (data.value === null && in_array(optionKey, data.checked))"
                           v-bind="data.attributes"/>
                    <label :for="data.id + optionKey">&nbsp;{{ optionVal }}&nbsp;&nbsp;</label>
                </div>
            </template>

            <input type="hidden" :name="data.name + '[]'">
<!--        @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Checkbox",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            locale: Object,
            assets: Object,
        },

        created() {
            this.require('icheck-bootstrap');
            this.require('jquery-icheck');
        },

        methods: {
            checkboxAll(e) {
                let $checkbox = $(e.currentTarget).parents('.form-group:first').find(this.data.selector);
                if (e.currentTarget.checked) {
                    $checkbox.iCheck('check');
                } else {
                    $checkbox.iCheck('uncheck');
                }
            }
        }
    }
</script>

<style scoped>

</style>
