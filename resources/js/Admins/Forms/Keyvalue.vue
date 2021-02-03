<template>
    <div v-bind="data.group_attrs">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>{{ trans('Key') }}</th>
                    <th>{{ trans('Value') }}</th>
                    <th style="width: 90px;"></th>
                </tr>
                </thead>

                <tbody>
                <tr v-for="(value, i) in data.value" :key="i">
                    <td class="form-group">
                        <input :name="data.name + '[keys][]'" :value="i" class="form-control" required/>
                    </td>
                    <td class="form-group">
                        <input :name="data.name + '[values][]'" :value="value" :class="'form-control ' + data.class + ' values'" />
                        <div :class="data.class + ' values-error d-none validation-error'">
                            <label class="col-form-label text-danger"><i class="fas fa-bell"></i></label>
                        </div>
                    </td>

                    <td class="form-group">
                        <span class="btn btn-warning btn-sm float-right" @click.prevent="removeKeyValue($event)">
                            <i class="fas fa-trash">&nbsp;</i>{{ trans('remove') }}
                        </span>
                    </td>
                </tr>
                </tbody>
            </table>

            <span class="btn btn-success btn-sm" @click.prevent="newKeyValue()">
                <i class="fas fa-save"></i>&nbsp;{{ trans('new') }}
            </span>

            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Keyvalue",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        data() {
            return {
                key: 0,
            }
        },

        methods: {
            newKeyValue() {
                this.key ++;
                this.$set(this.data.value, 'New' + this.key, '');
            },

            removeKeyValue(e) {
                $(e.currentTarget).closest('tr').remove();
            }
        }
    }
</script>

<style scoped>

</style>
