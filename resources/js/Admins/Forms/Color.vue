<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="input-group" style="width: 249px">
                <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fas fa-palette fa-fw"></i>
                </span>
                </div>
                <input v-bind="data.attributes" />
            </div>
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Color",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('colorpicker');
        },

        mounted() {
            $(this.data.selector).colorpicker();
        },
    }
</script>

<style scoped>

</style>
