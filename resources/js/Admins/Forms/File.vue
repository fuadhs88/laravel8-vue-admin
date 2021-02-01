<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <input type="file" :class="'form-control ' + data.class" :name="data.name" v-bind="data.attributes" />
<!--            @include('admin::form.error')-->
            <help-block :help="data.help" v-if="Object.values(data.help).length > 0"></help-block>
        </div>
        <input type="hidden" :class="'form-control ' + data.class" :name="data.name" :value="data.value"/>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "File",

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
            let this_hidden = $(this.data.selector).parents('.field-control:first').next();

            $(this.data.selector).fileinput(JSON.parse(this.data.options)).on('change', function () {
                this_hidden.prop('disabled', true);
            });

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
