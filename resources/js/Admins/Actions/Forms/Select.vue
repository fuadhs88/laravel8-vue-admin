<template>
    <div class="form-group">
        <label>{{ data.label }}</label>

        <select :name="data.name" :class="'form-control select2 select2-' + $page.props.color + ' ' + data.class" :data-dropdown-css-class="'select2-' + $page.props.color" style="width: 100%;" v-bind="data.attributes" >
            <option value=""></option>
            <option :value="optionKey" :selected="optionKey.toString() === (data.value).toString()" v-for="(optionVal, optionKey) in data.options" :key="optionKey">{{ optionVal }}</option>
        </select>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Select",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        created() {
            this.require('select2');
        },

        mounted() {
            $(this.data.selector).select2(this.data.configs);
        },
    }
</script>

<style scoped>

</style>
