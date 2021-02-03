<template>
    <div v-bind="data.group_attrs">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <table class="table table-hover">
                <tbody>
                <tr v-for="(value, i) in data.value" :key="i">
                    <td class="form-group">
                        <input :name="data.column + '[]'" :value="value" :class="'form-control ' + data.class" />
                        <!--@include('admin::form.error')-->
                    </td>

                    <td style="width: 90px;">
                        <div class="btn btn-warning btn-sm float-right" @click.prevent="removeList($event)">
                            <i class="fas fa-trash">&nbsp;</i>{{ trans('remove') }}
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="btn btn-success btn-sm" @click.prevent="newList()">
                <i class="fas fa-save"></i>&nbsp;{{ trans('new') }}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Listfield",

        props: {
            data: Object,
        },

        methods: {
            newList() {
                (this.data.value).push('');
            },

            removeList(e) {
                $(e.currentTarget).closest('tr').remove();
            }
        }
    }
</script>

<style scoped>

</style>
