<template>
    <div>
        <p class="p-0 m-0" v-for="(row, i) in rows" :key="i" v-html="row.html" v-if="row.html"></p>
        <div class="row" v-else>
            <div :class="column.width" v-for="(column, j) in row.columns" :key="j">
                <component :is="importComponent(field.view)" :data="field.data" :assets="assets" :locale="locale" v-for="(field, k) in column.fields" :key="k"></component>
            </div>
        </div>
    </div>
</template>

<script>
    // table action form
    import ActionsFormsCheckbox from './../Actions/Forms/Checkbox'
    import ActionsFormsDate from './../Actions/Forms/InputDate'
    import ActionsFormsFile from './../Actions/Forms/InputFile'
    import ActionsFormsHidden from './../Actions/Forms/Hidden'
    import ActionsFormsMultiplefile from './../Actions/Forms/Multiplefile'
    import ActionsFormsMultipleselect from './../Actions/Forms/Multipleselect'
    import ActionsFormsRadio from './../Actions/Forms/Radio'
    import ActionsFormsSelect from './../Actions/Forms/Select'
    import ActionsFormsText from './../Actions/Forms/InputText'

    // forms form
    import FormsDate from './../Forms/Date'
    import FormsDisplay from './../Forms/Display'
    import FormsFile from './../Forms/File'
    import FormsInput from './../Forms/Input'
    import FormsTextarea from './../Forms/Textarea'
    import FormsRadio from './../Forms/Radio'
    import FormsRadiobutton from './../Forms/Radiobutton'
    import FormsRadiocard from './../Forms/Radiocard'
    import FormsCheckbox from './../Forms/Checkbox'
    import FormsCheckboxbutton from './../Forms/Checkboxbutton'
    import FormsCheckboxcard from './../Forms/Checkboxcard'

    export default {
        name: "Fields",

        props: {
            rows: Array,
            assets: Object,
            locale: Object,
        },

        components: {
            // table action form
            ActionsFormsCheckbox,
            ActionsFormsDate,
            ActionsFormsFile,
            ActionsFormsHidden,
            ActionsFormsMultiplefile,
            ActionsFormsMultipleselect,
            ActionsFormsRadio,
            ActionsFormsSelect,
            ActionsFormsText,
            // forms form
            FormsDate,
            FormsDisplay,
            FormsFile,
            FormsInput,
            FormsTextarea,
            FormsRadio,
            FormsRadiobutton,
            FormsRadiocard,
            FormsCheckbox,
            FormsCheckboxbutton,
            FormsCheckboxcard,
        },
    }
</script>

<style scoped>

</style>
