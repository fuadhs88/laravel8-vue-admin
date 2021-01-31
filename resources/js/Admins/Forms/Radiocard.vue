<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <div class="card-group btn-group-toggle radio-card-group">
                <template v-for="(optionVal, optionKey) in data.options">
                    <label :class="'card ' + ((optionKey == data.value) || (data.value === null && in_array(optionKey, data.checked)) ? 'bg-' + $page.props.color : '')" @click="radioCard($event)">
                        <div class="card-body">
                            <input type="radio"
                                   :name="data.name"
                                   :value="optionKey"
                                   :class="data.class + ' d-none'"
                                   :checked="(optionKey == data.value) || (data.value === null && in_array(optionKey, data.checked))"
                                   v-bind="data.attributes" />&nbsp;{{ optionVal }}&nbsp;&nbsp;
                        </div>
                    </label>
                </template>
            </div>
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>

        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Radiocard",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
        },

        methods: {
            radioCard(e) {
                $(e.currentTarget).addClass('bg-' + $.admin.color).siblings().removeClass('bg-' + $.admin.color);
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
