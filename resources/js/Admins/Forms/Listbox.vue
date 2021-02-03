<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <select :class="'duallistbox form-control ' + data.class" style="width: 100%;" multiple="multiple"
                    :name="data.name + '[]'"
                    :data-placeholder="data.placeholder"
                    v-bind="data.attributes">
                <template v-for="(optionVal, optionKey) in data.options">
                    <option :value="optionKey" :selected="data.value && in_array(optionKey, data.value)">{{ optionVal }}</option>
                </template>
            </select>
            <input type="hidden" :name="data.name + '[]'" />

            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Listbox",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('duallistbox');
        },

        mounted() {
            $(this.data.selector).bootstrapDualListbox(this.data.settings);

            if (this.data.remote) {
                $.ajax(this.data.remote).done(function(data) {
                    let value = $(this).data('value') + '';
                    if (value) {
                        value = value.split(',');
                    }
                    for (let key in data) {
                        let selected =  ($.inArray(key, value) >= 0) ? 'selected' : '';
                        $(this).append('<option value="'+key+'" '+selected+'>'+data[key]+'</option>');
                    }
                    $(this).bootstrapDualListbox('refresh', true);
                });
            }
        },
    }
</script>

<style scoped>

</style>
