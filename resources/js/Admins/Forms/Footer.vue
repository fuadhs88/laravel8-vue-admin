<template>
    <div class="card-footer">
        <div class="container">
            <button type="reset" class="btn btn-warning" v-if="in_array('reset', data.buttons)">{{ trans('reset') }}</button>

            <div class="btn-group float-right" v-if="in_array('submit', data.buttons)">
                <template v-for="(redirect, value) in data.submit_redirects">
                    <span :class="'d-none d-md-block icheck-' + $page.props.color" v-if="in_array(redirect, data.checkboxes)">
                        <input type="checkbox" :id="'after-submit-' + value" class="after-submit" name="_saved" :value="value" :checked="(data.default_check === redirect) ? true : false">
                    <label :for="'after-submit-' + value" class="mr-2">{{ trans(redirect) }}</label>
                </span>
                </template>
                <button type="submit" :class="'rounded btn btn-' + $page.props.color">{{ trans('submit') }}</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Footer",

        props: {
            data: Object,
        },

        created() {
            $.admin.require('icheck-bootstrap');
        },
    }
</script>

<style scoped>

</style>
