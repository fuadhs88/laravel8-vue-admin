<template>
    <div class="form-group">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div>
            <span :class="'icheck-' + $page.props.color" v-for="(optionVal, optionKey) in data.options" :key="optionKey">
                <input type="radio" :id="data.id + optionKey"
                       :name="data.name"
                       :value="optionKey"
                       :class="'minimal ' + data.class"
                       :checked="optionKey.toString() === (data.value).toString() || data.value === null && inArray(optionVal, data.checked)"
                       v-bind="data.attributes"/>
                <label :for="data.id + optionKey" class="radio-inline">&nbsp;{{ optionVal }}&nbsp;&nbsp;</label>
            </span>
        </div>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Radio",

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
