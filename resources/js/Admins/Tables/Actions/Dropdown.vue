<template>
    <div class="dropdown dropleft table-dropdown-actions">
        <a type="button" class="dropdown-toggle px-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
            class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu text-center">
            <inertia-link v-for="(defaultVal, i) in data.default" :key="i" :href="defaultVal.href" :class="defaultVal.class" v-if="defaultVal.href">
                {{ defaultVal.name }}
            </inertia-link>
            <inertia-link :data-_key="defaultVal.key" href="javascript:void(0);" :class="defaultVal.class" @click.prevent="buttonAction($event, defaultVal.script)" v-else>
                {{ defaultVal.name }}
            </inertia-link>

            <div v-if="data.custom.length > 0">
                <div class="dropdown-divider" v-if="data.default.length > 0"></div>
                <inertia-link v-for="(customVal, j) in data.custom" :key="j" :href="customVal.href" :class="customVal.class" v-if="customVal.href">
                    {{ customVal.name }}
                </inertia-link>
                <inertia-link :data-_key="customVal.key" href="javascript:void(0);" :class="customVal.class" @click.prevent="('modal_id' in customVal.script) ? formAction($event, customVal.script) : buttonAction($event, customVal.script)" v-else>
                    {{ customVal.name }}
                </inertia-link>
            </div>
        </div>

    </div>
</template>

<script>
    import {Inertia} from '@inertiajs/inertia'

    export default {
        name: "Dropdown",

        props: {
            data: Object,
            assets: Object,
        },

        created() {
            this.require('sweetalert2');
            console.dir(this.data);
        },

        methods: {
            buttonAction(e, script) {
                let $this = $(e.currentTarget);
                let data = $this.data();
                let url = $this.attr('url') || script.url;
                Object.assign(data, script.parameters);// 合并数据
                script.action_script;
                Swal.fire({
                    title: script.options.title,
                    text: script.options.text,
                    icon: script.options.icon,
                    showCancelButton: true,
                    confirmButtonText: '确认',
                    cancelButtonText: '取消'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            method: script.method,
                            url: url,
                            data: data
                        }).done(function (res) {
                            // console.dir(res);
                            if (res.status) {
                                if ('swal' in res) {
                                    Swal.fire(
                                        res.swal.title,
                                        '',
                                        res.swal.icon
                                    )
                                }
                            } else {
                                if ('swal' in res) {
                                    Swal.fire(
                                        res.swal.title,
                                        '',
                                        res.swal.icon
                                    )
                                }
                            }
                            if (res.then.action === "refresh") {
                                Inertia.reload();
                            }
                        }).fail(function (res) {
                            // console.dir(res);
                            Swal.fire(
                                '删除失败',
                                '',
                                'error'
                            )
                        });
                        // For more information about handling dismissals please visit
                        // https://sweetalert2.github.io/#handling-dismissals
                    }
                });
            },

            formAction(e, script) {
                let _this = this;
                _this.$root.modalData = script;
                $('#modal-lg').modal('show').on('hidden.bs.modal', function (event) {
                    _this.$root.modalData = {};
                })
            }
        },
    }
</script>

<style scoped>

</style>
