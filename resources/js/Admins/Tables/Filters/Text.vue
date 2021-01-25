<template>
    <div class="input-group">
        <div class="input-group-prepend show" v-if="data.group">
<!--            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" style="min-width: 32px;">-->
<!--                <span class="{{ $group_name }}-label">{{ $default['label'] }}</span>-->
<!--            </button>-->
<!--            <input type="hidden" name="{{ $id }}_group" class="{{ $group_name }}-operation" value="0"/>-->
<!--            <div class="dropdown-menu {{ $group_name }}">-->
<!--                @foreach($group as $index => $item)-->
<!--                <a class="dropdown-item" href="#" data-index="{{ $index }}"> {{ $item['label'] }} </a>-->
<!--                @endforeach-->
<!--            </div>-->
        </div>

        <div class="input-group-prepend" v-else>
            <span class="input-group-text"><i :class="'fas fa-' + data.icon"></i></span>
        </div>

        <input :type="data.type" :class="'form-control ' + data.id" :placeholder="data.placeholder" :name="data.name" :value="data.value">
    </div>
</template>

<script>
    export default {
        name: "Text",

        props: {
            data: Object,
        }
    }
</script>

<style scoped>

</style>
