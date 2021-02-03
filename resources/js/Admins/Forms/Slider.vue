<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <input type="text" :class="'form-control ' + data.class" :name="data.name" :data-from="data.value" v-bind="data.attributes" />
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Slider",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('range-slider');
        },

        mounted() {
            $(this.data.selector).ionRangeSlider(this.data.options);
        },
    }
</script>

<style scoped>

</style>
