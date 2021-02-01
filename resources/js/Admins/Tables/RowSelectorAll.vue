<template>
    <div :class="'icheck-' + $page.props.color + ' d-inline'">
        <input type="checkbox" class="table-select-all" id='select-all' v-model="checked" @change="tableToggleAll(checked)"/>
        <label for='select-all'></label>
    </div>
</template>

<script>
    export default {
        name: "RowSelectorAll",

        data() {
            return {
                checked: false
            }
        },

        created() {
            $.admin.require('icheck-bootstrap');
            $.admin.require('jquery-icheck');
        },
    }
</script>

<style scoped>

</style>
