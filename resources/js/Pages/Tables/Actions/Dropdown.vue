<template>
    <div class="table-dropdown-actions dropdown">
        <a href="javascript:void(0);" style="padding: 0 10px;" data-toggle="dropdown">
            <i class="fa fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="min-width: 70px !important;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);top: 5px;">

            <inertia-link v-for="(defaultVal, i) in data.default" :key="i" :href="defaultVal.href" :class="defaultVal.class" v-if="defaultVal.href">
                {{ defaultVal.name }}
            </inertia-link>
            <inertia-link :data-_key="defaultVal.key" href='javascript:void(0);' :class="defaultVal.class" v-else>
                {{ defaultVal.name }}
            </inertia-link>
<!--            @foreach($default as $action)-->
<!--            {!! $action->render() !!}-->
<!--            @endforeach-->

<!--            @if(!empty($custom))-->

<!--            @if(!empty($default))-->
<!--            <div class="divider"></div>-->
<!--            @endif-->

<!--            @foreach($custom as $action)-->
<!--            {!! $action->render() !!}-->
<!--            @endforeach-->
<!--            @endif-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "Dropdown",

        props: {
            data: Object,
        },

        created() {
            console.dir(this.data);
        },
    }
</script>

<style scoped>

</style>
