<template>
    <div class="login-box">
        <div class="login-logo">
            <a :href="admin_route('home', config)" v-html="config.logo.text"></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">登录以开始您的会话</p>
                <p class="text-danger" v-if="errors">{{ errors }}</p>

                <form @submit.prevent="submit">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="用户名" v-model="form.username" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="密码" v-model="form.password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
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
            config: Object,
            errors: String
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
                    .post(this.route('admin.login'), {
                        onFinish: () => this.form.reset('password'),
                    });
            }
        }
    }
</script>
