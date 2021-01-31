<template>
    <div class="login-box">
        <div class="login-logo">
            <a :href="admin_base_route('home')" v-html="config('admin.logo.text')"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">{{ trans('login') }}</p>

                <form @submit.prevent="submit()">
                    <div class="input-group mb-3">
                        <input type="text" :class="'form-control ' + (errors.username ? 'is-invalid' : '')" :placeholder="trans('username')" v-model="form.username" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.username">{{ errors.username }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" :class="'form-control ' + (errors.password ? 'is-invalid' : '')" :placeholder="trans('password')" v-model="form.password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.password">{{ errors.password }}</span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div :class="'icheck-' + $page.props.color">
                                <input type="checkbox" id="remember" name="remember" v-model="form.remember">
                                <label for="remember">{{ trans('remember_me') }}</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" :class="'btn btn-' + $page.props.color + ' btn-block'">{{ trans('login') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
</template>

<script>
    export default {
        props: {
            configs: Object,
            locale: Object,
            routes: Array,
            assets: Object,
            errors: Object
        },

        created() {
            this.require('icheck-bootstrap');
        },

        data() {
            return {
                form: this.$inertia.form({
                    username: '',
                    password: '',
                    remember: this.config('admin.auth.remember'),
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.admin_base_route('login'), {
                        onFinish: () => this.form.reset('password'),
                    });
            }
        }
    }
</script>
