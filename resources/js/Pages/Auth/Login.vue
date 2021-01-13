<template>
    <div class="login-box">
        <div class="login-logo">
            <a :href="this.admin_base_route('home')" v-html="this.config('admin.logo.text')"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">登录以开始您的会话</p>

                <form @submit.prevent="submit">
                    <div class="input-group mb-3">
                        <input type="text" :class="'form-control ' + (errors.username ? 'is-invalid' : '')" placeholder="用户名" v-model="form.username" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.username">{{ errors.username }}</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" :class="'form-control ' + (errors.password ? 'is-invalid' : '')" placeholder="密码" v-model="form.password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="error invalid-feedback" v-if="errors.password">{{ errors.password }}</span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" v-model="form.remember">
                                <label for="remember">记住我</label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">登录</button>
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
        components: {

        },

        props: {
            configs: Object,
            errors: Object
        },

        created() {
            this.GLOBAL.configs = this.configs;
            this.el_insert('icheck bootstrap', '<!--icheck bootstrap-->\n<link rel="stylesheet" href="/vendor/laravel-admin/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">');
        },

        data() {
            return {
                form: this.$inertia.form({
                    username: '',
                    password: '',
                    remember: false
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
