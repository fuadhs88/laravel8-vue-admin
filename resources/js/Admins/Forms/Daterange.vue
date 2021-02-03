<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id.start" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="row">
                <div class="field-control ml-2" style="width: 249px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i :class="'far ' + data.icon +' fa-fw'"></i>
                        </span>
                        </div>
                        <input
                            type="text"
                            :name="data.name.start"
                            :value="data.value ? data.value.start : ''"
                            :class="'form-control ' + data.class.start"
                            v-bind="data.attributes"/>
                    </div>
                    <div :class="'col d-none validation-error ' + data.column.start + '-error'">
                        <label class="col-form-label text-danger">
                            <i class="fas fa-bell"></i>
                        </label>
                    </div>
                </div>
                <div class="field-control ml-3" style="width: 249px;">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i :class="'far ' + data.icon +' fa-fw'"></i>
                        </span>
                        </div>
                        <input
                            type="text"
                            :name="data.name.end"
                            :value="data.value ? data.value.end : ''"
                            :class="'form-control ' + data.class.end"
                            v-bind="data.attributes"/>
                    </div>
                    <div :class="'col d-none validation-error ' + data.column.end + '-error'">
                        <label class="col-form-label text-danger">
                            <i class="fas fa-bell"></i>
                        </label>
                    </div>
                </div>
            </div>
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Daterange",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('datepicker');
        },

        mounted() {
            let start = $(this.data.selector.start);
            let end = $(this.data.selector.end);
            start.datetimepicker(this.data.start_options).on('dp.change', function (e) {
                end.data('DateTimePicker').minDate(e.date);
            });

            end.datetimepicker(this.data.end_options).on('dp.change', function (e) {
                start.data('DateTimePicker').maxDate(e.date);
            });

            start.addClass('initialized');
        }
    }
</script>

<style scoped>

</style>
