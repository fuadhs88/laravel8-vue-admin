<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="input-group" style="width: 250px;">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i :class="'far ' + data.icon + ' fa-fw'"></i>
                    </span>
                </div>
                <input v-bind="data.attributes"/>
                <!--            @include('admin::form.error')-->

                <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
            </div>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Date",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        created() {
            $.admin.require('daterangepicker');
        },

        mounted() {
            $(this.data.selector).datetimepicker(this.data.options);
        },
    }
</script>

<style scoped>

</style>
