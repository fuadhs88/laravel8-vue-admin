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
    // forms form
    import FormsDate from './../Forms/Date'
    import FormsDaterange from './../Forms/Daterange'
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
    import FormsSelect from './../Forms/Select'
    import FormsMultipleselect from './../Forms/Multipleselect'
    import FormsListbox from './../Forms/Listbox'
    import FormsColor from './../Forms/Color'
    import FormsNumber from './../Forms/Number'
    import FormsSlider from './../Forms/Slider'

    export default {
        name: "EmbedFields",

        props: {
            rows: Array,
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
        },
    }
</script>

<style scoped>

</style>
