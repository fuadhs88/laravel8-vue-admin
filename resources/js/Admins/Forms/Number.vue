<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="input-group" style="width: 300px;">
                <input v-bind="data.attributes" />
                <span class="input-group-append" v-html="data.append" v-if="data.append"></span>
            </div>
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Number",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('input-spinner');
        },

        mounted() {
            $(this.data.selector).inputSpinner();
        },
    }
</script>

<style scoped>

</style>
