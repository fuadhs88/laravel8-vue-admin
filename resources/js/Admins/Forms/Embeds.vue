<template>
    <div v-bind="data.group_attrs">
        <label :for="data.id" :class="data.viewClass.label">{{ data.label }}</label>
        <div :class="data.viewClass.field">
            <hr class="m-0">

            <div :id="'embed-' + data.column" :class="'embed-' + data.column">
                <div :class="'embed-' + data.column + '-forms'">
                    <div :class="'embed-' + data.column + '-form fields-group'">
                        <forms-embed-fields :rows="data.rows" v-if="data.rows"></forms-embed-fields>
                    </div>
                </div>
            </div>

            <hr class="m-0">
        </div>
    </div>
</template>

<script>
    import FormsEmbedFields from './../Forms/EmbedFields';

    export default {
        name: "Embeds",

        components: {
            FormsEmbedFields
        },

        props: {
            data: Object,
        },
    }
</script>

<style scoped>

</style>
