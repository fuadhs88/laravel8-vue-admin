<template>
    <div class="form-group">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div class="input-group">
            <div class="input-group-prepend" v-html="data.prepend" v-if="data.prepend"></div>
            <input type="text"
                   :name="data.name"
                   :value="data.value"
                   :class="'form-control ' + data.class"
                   :placeholder="data.placeholder"
                   v-bind="data.attributes">
        </div>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "InputText",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        mounted() {
            if (this.data.inputmask) {
                this.require('inputmask');
                $(this.data.selector).inputmask(JSON.parse(this.data.inputMaskOptions));
            }
        },
    }
</script>

<style scoped>

</style>
