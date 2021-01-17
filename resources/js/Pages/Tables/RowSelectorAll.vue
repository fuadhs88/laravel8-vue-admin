<template>
    <div :class="'icheck-' + $page.props.color + ' d-inline'">
        <input type="checkbox" class="table-select-all" id='select-all'/>
        <label for='select-all'></label>
    </div>
</template>

<script>
    export default {
        name: "RowSelectorAll",

        created() {
            this.require('icheck-bootstrap');
        },
    }
</script>

<style scoped>

</style>
