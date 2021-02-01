<template>
    <div class="form-group">
        <label>{{ data.label }}</label>
        <input type="file" :class="data.class" :name="data.name" v-bind="data.attributes" />

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "InputFile",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
        },

        created() {
            $.admin.require('bootstrap-fileinput');
        },

        mounted() {
            $(this.data.selector).fileinput(JSON.parse(this.data.options));

            if (this.data.settings.showRemove) {
                $(this.data.selector).on('filebeforedelete', function() {
                    return new Promise(function(resolve, reject) {
                        let remove = resolve;
                        $.admin.confirm({
                            title: this.trans('delete_confirm'),
                            preConfirm: function() {
                                return new Promise(function(resolve) {
                                    resolve(remove());
                                });
                            }
                        });
                    });
                });
            }
        },
    }
</script>

<style scoped>

</style>
