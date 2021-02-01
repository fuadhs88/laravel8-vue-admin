<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="'select2-' + $page.props.color + ' ' + data.viewClass.field">

            <select :class="'form-control ' + data.class" style="width: 100%;" multiple="multiple"
                    :name="data.name + '[]'"
                    :data-dropdown-css-class="'select2-' + $page.props.color"
                    :data-placeholder="data.placeholder"
                    v-bind="data.attributes">
                <template v-for="(optionVal, optionKey) in data.options">
                    <option :value="optionKey"
                            v-bind="data.optionDataAttributes[optionKey]"
                            :selected="data.value && in_array(optionKey, data.value)">
                        {{ optionVal }}
                    </option>
                </template>
            </select>
            <input type="hidden" :name="data.name + '[]'" />

<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Multipleselect",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('select2');
        },

        mounted() {
            $(this.data.selector).select2(this.data.configs);
        }
    }
</script>

<style scoped>

</style>
