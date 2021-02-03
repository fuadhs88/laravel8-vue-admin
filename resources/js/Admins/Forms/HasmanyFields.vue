<template>
    <component :is="importComponent(field.view)" :data="replaceIndex(field.data, index)"></component>
</template>

<script>
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
    import FormsHidden from './Hidden'

    export default {
        name: "HasmanyFields",

        props: {
            field: Object,
            index: Number,
        },

        components: {
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
            FormsHidden,
        },

        methods: {
            replaceIndex(data, i) {
                console.dir(data);
                let field = data;
                field.name = (field.name).replace('new___LA_KEY__', 'new_' + i);
                //
                return data;
            },
        }
    }
</script>

<style scoped>

</style>
