<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="form-group mb-0 mt-2">
                <template v-for="(optionVal, optionKey) in data.options">
                    <span :class="'icheck-' + $page.props.color" v-if="data.inline">
                        <input type="radio" :id="data.id + optionKey"
                               :name="data.name"
                               :value="optionKey"
                               :class="'minimal ' + data.class"
                               :checked="(optionKey == data.value) || (data.value === null && in_array(optionKey, data.checked))"
                               v-bind="data.attributes"/>

                        <label :for="data.id + optionKey">&nbsp;{{ optionVal }}&nbsp;&nbsp;</label>
                    </span>
                    <div :class="'icheck-' + $page.props.color" v-else>
                        <input type="radio" :id="data.id + optionKey"
                               :name="data.name"
                               :value="optionKey"
                               :class="'minimal ' + data.class"
                               :checked="(optionKey == data.value) || (data.value === null && in_array(optionKey, data.checked))"
                               v-bind="data.attributes"/>
                        <label :for="data.id + optionKey">&nbsp;{{ optionVal }}&nbsp;&nbsp;</label>
                    </div>
                </template>
        </div>
<!--        @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
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

        created() {
            this.require('icheck-bootstrap');
        },
    }
</script>

<style scoped>

</style>
