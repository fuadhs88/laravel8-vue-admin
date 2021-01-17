<template>
    <div class="dropdown dropleft table-dropdown-actions">
        <a type="button" class="dropdown-toggle px-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu">
            <inertia-link v-for="(defaultVal, i) in data.default" :key="i" :href="defaultVal.href" :class="defaultVal.class" v-if="defaultVal.href">
                {{ defaultVal.name }}
            </inertia-link>
            <inertia-link :data-_key="defaultVal.key" href='javascript:void(0);' :class="defaultVal.class" v-else>
                {{ defaultVal.name }}
            </inertia-link>

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
            // console.dir(this.data);
        },
    }
</script>

<style scoped>

</style>
