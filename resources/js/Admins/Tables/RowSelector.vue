<template>
    <div :class="'icheck-' + $page.props.color + ' d-inline'">
        <input type="checkbox" class="table-row-checkbox" :data-id="data" :id="'table-row-checkbox-' + data" @change="tableToggleCheckbox()">
        <label :for="'table-row-checkbox-' + data"></label>
    </div>
</template>

<script>
    export default {
        name: "RowSelector",

        props: {
            data: String,
        },

        created() {
            $.admin.require('icheck-bootstrap');
            $.admin.require('jquery-icheck');
        },
    }
</script>

<style scoped>

</style>
