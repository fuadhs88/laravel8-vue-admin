<template>
    <div class="form-group">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar"></i></span>
            </div>
            <input type="text"
                   :name="data.name"
                   :value="data.value"
                   :class="'form-control ' + data.class"
                   :placeholder="data.placeholder"
                   v-bind="data.attributes"/>
        </div>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "InputDate",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        created() {
            this.require('daterangepicker');
        },

        mounted() {
            $(this.data.selector).datetimepicker(this.data.options);
        },
    }
</script>

<style scoped>

</style>
