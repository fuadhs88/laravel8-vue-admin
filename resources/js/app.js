require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'
import Helper from './helper';

Vue.use(plugin);

Vue.use(Helper);

const el = document.getElementById('app');

new Vue({
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Admins/${name}`).default,
        },
    }),
}).$mount(el);
