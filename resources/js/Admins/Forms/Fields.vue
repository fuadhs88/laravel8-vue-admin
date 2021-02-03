<template>
    <div>
        <p class="p-0 m-0" v-for="(row, i) in rows" :key="i" v-html="row.html" v-if="row.html"></p>
        <div class="row" v-else>
            <template v-for="column in row.columns">
                    <div :class="column.width">
                        <div class="row">
                            <template v-for="field in column.fields">
                            <div class="col-md-12">
                                <component :is="importComponent(field.view)" :data="field.data"></component>
                            </div>
                            </template>
                        </div>
                    </div>
            </template>
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
    import FormsDate from './Date'
    import FormsDaterange from './Daterange'
    import FormsDisplay from './Display'
    import FormsFile from './File'
    import FormsInput from './Input'
    import FormsTextarea from './Textarea'
    import FormsRadio from './Radio'
    import FormsRadiobutton from './Radiobutton'
    import FormsRadiocard from './Radiocard'
    import FormsCheckbox from './Checkbox'
    import FormsCheckboxbutton from './Checkboxbutton'
    import FormsCheckboxcard from './Checkboxcard'
    import FormsSelect from './Select'
    import FormsMultipleselect from './Multipleselect'
    import FormsListbox from './Listbox'
    import FormsColor from './Color'
    import FormsNumber from './Number'
    import FormsSlider from './Slider'
    import FormsKeyvalue from './Keyvalue'
    import FormsEmbeds from './Embeds'
    import FormsListfield from './Listfield'
    import FormsHasmanytable from './Hasmanytable'

    export default {
        name: "Fields",

        props: {
            rows: Array,
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
            FormsDaterange,
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
            FormsSelect,
            FormsMultipleselect,
            FormsListbox,
            FormsColor,
            FormsNumber,
            FormsSlider,
            FormsKeyvalue,
            FormsEmbeds,
            FormsListfield,
            FormsHasmanytable,
        },
    }
</script>

<style scoped>

</style>
