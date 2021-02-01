<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <template v-for="(optionVal, optionKey) in data.options">
                    <label :class="'btn btn-' + $page.props.color">
                        <input type="radio"
                               :name="data.name"
                               :value="optionKey"
                               :class="data.class"
                               :checked="(optionKey == data.value) || (data.value === null && in_array(optionKey, data.checked))"
                               v-bind="data.attributes" />&nbsp;{{ optionVal }}&nbsp;&nbsp;
                    </label>
                </template>
            </div>
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Radiobutton",

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
