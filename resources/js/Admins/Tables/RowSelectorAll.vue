<template>
    <div :class="'icheck-' + $page.props.color + ' d-inline'">
        <input type="checkbox" class="table-select-all" id='select-all' v-model="checked" @change="tableToggleAll(checked)"/>
        <label for='select-all'></label>
    </div>
</template>

<script>
    export default {
        name: "RowSelectorAll",

        props: {
            assets: Object,
        },

        data() {
            return {
                checked: false
            }
        },

        created() {
            this.require('icheck-bootstrap');
            this.require('jquery-icheck');
        },
    }
</script>

<style scoped>

</style>
