<template>
    <div v-bind="data.group_attrs">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
                <table :class="'table table-has-many has-many-' + data.column">
                    <thead>
                    <tr>
                        <template v-for="header in data.headers">
                            <th>{{ header }}</th>
                        </template>

                        <th class="d-none"></th>

                        <th v-if="data.options.allowDelete"></th>
                    </tr>
                    </thead>
                    <tbody :class="'has-many-' + data.column + '-forms'">
                    <tr :class="'has-many-' + data.column + '-form fields-group'" v-for="(form, i) in data.forms" :key="i">
                        <td :class="(field.view === 'Forms/Hidden') ? 'd-none' : ''" v-for="(field, j) in form.fields" :key="j">
                            <froms-hasmany-fields :field="field" :index="i"></froms-hasmany-fields>
                        </td>

                        <td v-if="data.options.allowDelete">
                            <span class="btn btn-danger float-right text-white" @click.prevent="removeTable($event)"><i class="fas fa-trash-alt"></i></span>
                        </td>
                    </tr>
                    </tbody>
                </table>

                <div v-if="data.options.allowCreate">
                    <div :class="data.viewClass.field">
                        <div class="btn btn-success btn-sm" @click.prevent="newTable()"><i class="fas fa-save"></i>&nbsp;{{ trans('new') }}</div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    import FromsHasmanyFields from './HasmanyFields'

    export default {
        name: "Hasmanytable",

        components: {
            FromsHasmanyFields
        },

        props: {
            data: Object,
        },

        methods: {
            newTable() {
                let fields = this.data.fields;

                (this.data.forms).push({'fields': fields});
            },

            removeTable(e) {
                $(e.currentTarget).closest('tr').remove();
            },
        }
    }
</script>

<style scoped>

</style>
