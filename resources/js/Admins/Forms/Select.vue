<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <input type="hidden" :name="data.name" />

            <select :class="'form-control select2 select2-' + $page.props.color + ' ' + data.class" style="width: 100%;"
                    :name="data.name"
                    :data-dropdown-css-class="'select2-' + $page.props.color"
                    v-bind="data.attributes" v-if="data.groups.length > 0">
                <template v-for="(group, i) in data.groups">
                    <optgroup :label="group.label">
                        <template v-for="(optionVal, optionKey) in group.options">
                            <option
                                :value="optionKey"
                                v-bind="data.optionDataAttributes[optionKey]"
                                :selected="data.value && optionKey == data.value">
                                {{ optionVal }}
                            </option>
                        </template>
                    </optgroup>
                </template>
            </select>

            <select :class="'form-control select2 select2-' + $page.props.color + ' ' + data.class" style="width: 100%;"
                    :name="data.name"
                    :data-dropdown-css-class="'select2-' + $page.props.color"
                    v-bind="data.attributes" v-else>
                <option value=""></option>
                <option v-for="(optionVal, optionKey) in data.options" :key="optionKey"
                        :value="optionKey"
                        v-bind="data.optionDataAttributes[optionKey]"
                        :selected="data.value && optionKey == data.value">
                    {{ optionVal }}
                </option>

            </select>

<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
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
        },

        created() {
            $.admin.require('select2');
        },

        mounted() {
            $(this.data.selector).select2(this.data.configs);

            let _this = this;
            if (_this.data.load) {
                $(_this.data.selector).off('change').on('change', function () {
                    let target = $(this).closest('.fields-group').find("." + _this.data.load.class);
                    $.get(_this.data.load.sourceUrl, {q: this.value}, function (data) {
                        target.find("option").remove();
                        $(target).select2({
                            placeholder: {id: '', text: $.admin.trans('choose')},
                            allowClear: _this.data.strAllowClear,
                            data: $.map(data, function (d) {
                                d.id = d[_this.data.idField];
                                d.text = d[_this.data.textField];
                                return d;
                            })
                        });
                        if (target.data('value')) {
                            $(target).val(target.data('value'));
                        }
                        $(target).trigger('change');
                    });
                });
            }
        },
    }
</script>

<style scoped>

</style>
