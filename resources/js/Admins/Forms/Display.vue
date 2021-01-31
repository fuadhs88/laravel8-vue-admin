<template>
    <div v-bind="data.group_attrs">
        <label :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">

            <div class="card card-solid card-default m-0">
                <!-- /.card-header -->
                <div class="card-body py-2 px-4" v-html="data.value"></div><!-- /.card-body -->
            </div>

            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Display",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        }
    }
</script>

<style scoped>

</style>
