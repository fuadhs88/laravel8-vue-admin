<template>
    <div class="form-group">
        <label>{{ data.label }}</label>
        <div :class="'select2-' + $page.props.color">
            <select :name="data.name + '[]'"
                    :class="'select2 ' + data.class"
                    :data-dropdown-css-class="'select2-' + $page.props.color" style="width: 100%;"
                    v-bind="data.attributes"
                    :data-placeholder="data.label"
                    multiple>

                <option value=""></option>
                <option :value="optionKey" :selected="inArray(optionKey, data.value ? data.value : [])"  v-for="(optionVal, optionKey) in data.options" :key="optionKey">{{ optionVal }}</option>
            </select>
        </div>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
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
            assets: Object,
        },

        created() {
            this.require('select2');
        },

        mounted() {
            $(this.data.selector).select2(this.data.configs);
        },

        methods: {
            inArray(key,val) {
                return $.inArray(key, val) !== -1;
            }
        }
    }
</script>

<style scoped>

</style>
