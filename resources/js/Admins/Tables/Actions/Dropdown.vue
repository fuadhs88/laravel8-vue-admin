<template>
    <div class="dropdown dropleft table-dropdown-actions">
        <a type="button" class="dropdown-toggle px-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu text-center">
            <template v-for="defaultVal in data.default">
                <inertia-link :href="defaultVal.href" :class="defaultVal.class" v-if="defaultVal.href">
                    {{ defaultVal.name }}
                </inertia-link>
                <a :data-_key="defaultVal.key" href="javascript:void(0);" :class="defaultVal.class" @click="buttonAction($event, defaultVal.script)" v-else>
                    {{ defaultVal.name }}
                </a>
            </template>
            <div class="dropdown-divider" v-if="data.custom.length > 0 && data.default.length > 0"></div>
            <template v-for="customVal in data.custom">
                <inertia-link :href="customVal.href" :class="customVal.class" v-if="customVal.href">
                    {{ customVal.name }}
                </inertia-link>
                <a :data-_key="customVal.key" href="javascript:void(0);" :class="customVal.class" @click.prevent="('modal_id' in customVal.script) ? buttonFormAction($event, customVal.script) : buttonAction($event, customVal.script)" v-else>
                    {{ customVal.name }}
                </a>
            </template>
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
        }
    }
</script>

<style scoped>

</style>
