<template>
    <div class="form-group">
        <label>{{ data.label }}</label>
        <div>
            <span :class="'icheck-' + $page.props.color" v-for="(optionVal, optionKey) in data.options" :key="optionKey">
                <input type="checkbox"
                       :id="data.id + optionKey"
                       :name="data.name + '[]'"
                       :value="optionKey"
                       :class="data.class"
                       :checked="inArray(optionKey, data.value) || (data.value === null && inArray(optionVal, data.checked))"
                        v-bind="data.attributes" />
                <label :for="data.id + optionKey">
                &nbsp;  {{ optionVal }}&nbsp;&nbsp;
                </label>
            </span>
        </div>
        <input type="hidden" :name="data.name + '[]'">

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
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
            assets: Object,
        },

        methods: {
            inArray(val, checked) {
                return $.inArray(val, checked) !== -1;
            },
        }
    }
</script>

<style scoped>

</style>
