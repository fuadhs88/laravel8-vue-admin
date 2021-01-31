<template>
    <div class="card-footer row mx-0">

        <div :class="'col-md-' + data.width.label"></div>

        <div :class="'col-md-' + data.width.field">
            <div class="row">
                <div class="col-3" v-if="in_array('reset', data.buttons)">
                    <button type="reset" class="btn btn-warning">{{ trans('reset') }}</button>
                </div>

                <div class="col-9" v-if="in_array('submit', data.buttons)">
                    <div class="btn-group float-right">
                        <button type="submit" :class="'btn btn-' + $page.props.color">{{ trans('submit') }}</button>
                    </div>
                    <div class="d-none d-md-block float-right my-2">
                        <template v-for="(redirect, value) in data.submit_redirects">
                            <div :class="'icheck-' + $page.props.color + ' d-inline'" v-if="in_array(redirect, data.checkboxes)">
                                <input type="checkbox" :id="'after-submit- ' + value" class="after-submit" name="_saved" :value="value" :checked="(data.default_check === redirect) ? true : false">
                                <label :for="'after-submit- ' + value" class="mr-2">{{ trans(redirect) }}</label>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer",

        props: {
            data: Object,
            assets: Object,
            locale: Object,
        },

        created() {
            this.require('icheck-bootstrap');
        },
    }
</script>

<style scoped>

</style>
