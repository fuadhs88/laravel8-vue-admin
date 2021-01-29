require('./bootstrap');
// require('./laravel-admin');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import Helper from './helper';
import Admin from './admin';

Vue.use(plugin);
Vue.use(Helper);
Vue.use(Admin);

const el = document.getElementById('app');

new Vue({
    data() {
        return {
            modalFormActionData: {},
        }
    },
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Admins/${name}`).default,
        },
    }),
}).$mount(el);
