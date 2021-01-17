require('./bootstrap');

// Import modules...
import Vue from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import { InertiaProgress } from '@inertiajs/progress'
import PortalVue from 'portal-vue';
import Helper from './helper';
import global from './global'

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);
InertiaProgress.init({
    // 在导航过程中进度条将出现的延迟（以毫秒为单位）。
    delay: 25000,
    // 进度条的颜色。
    color: '#29d',
    // 是否包括默认的NProgress样式。
    includeCSS: true,
    // 是否显示NProgress微调器。
    showSpinner: true,
});

Vue.use(Helper);
Vue.prototype.GLOBAL = global;

const app = document.getElementById('app');

new Vue({
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            },
        }),
}).$mount(app);
