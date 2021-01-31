<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field" :id="data.id">
            <div class="card-group btn-group-toggle checkbox-card-group">
                <template v-for="(optionVal, optionKey) in data.options">
                    <label :class="'card ' + (in_array(optionKey, data.value) || (data.value === null && in_array(optionKey, data.checked)) ? 'bg-' + $page.props.color : '')" @click.prevent="checkboxCard($event)">
                        <div class="card-body">
                            <input type="checkbox"
                                   :name="data.name + '[]'"
                                   :value="optionKey"
                                   :class="data.class + ' d-none'"
                                   :checked="in_array(optionKey, data.value) || (data.value === null && in_array(optionKey, data.checked))"
                                   v-bind="data.attributes" />&nbsp;{{ optionVal }}&nbsp;&nbsp;
                        </div>
                    </label>
                </template>
            </div>

            <input type="hidden" :name="data.name + '[]'">
            <!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Checkboxcard",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        methods: {
            checkboxCard(e) {
                $(e.currentTarget).toggleClass('bg-' + $.admin.color);
            }
        }
    }
</script>

<style scoped>
    .card-group label {
        cursor: pointer;
        margin-right: 8px;
        font-weight: 400;
    }

    .card-group .card {
        margin-bottom: 0;
    }

    .card-group .card-body {
        padding: 10px 15px;
    }
</style>
