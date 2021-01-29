<template>
    <div class="form-group">
        <label>{{ data.label }}</label>
        <input type="file" :class="data.class" :name="data.name + '[]'" v-bind="data.attributes" multiple/>

        <help-block :help="data.help" v-if="data.help.length > 0"></help-block>
    </div>
</template>

<script>
    import HelpBlock from './HelpBlock'

    export default {
        name: "Multiplefile",

        components: {
            HelpBlock
        },

        props: {
            data: Object,
            assets: Object,
            locale: Object,
        },

        created() {
            this.require('bootstrap-fileinput');
        },

        mounted() {
            $(this.data.selector).fileinput(this.data.options);

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

            if (this.data.settings.showDrag) {
                this.require('show-drag');
                $(this.data.selector).on('filesorted', function(event, params) {
                    let order = [];
                    params.stack.forEach(function (item) {
                        order.push(item.key);
                    });
                    $("input " + this.data.selector +"_sort").val(order);
                });
            }
        },
    }
</script>

<style scoped>

</style>
