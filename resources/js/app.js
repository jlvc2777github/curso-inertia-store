import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

import oruga from "@oruga-ui/oruga-next"
import "@oruga-ui/oruga-next/dist/oruga.css"
import "@oruga-ui/oruga-next/dist/oruga-full.css"
import "@mdi/font/css/materialdesignicons.min.css"

import  { CKEditor } from "@ckeditor/ckeditor5-vue"
import { vue3Debounce } from "vue-debounce"



createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        const myApp= createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(oruga)
            .use(CKEditor)
            .use(ZiggyVue, Ziggy);
            
          //  myApp.config.globalProperties.$step=1;

            myApp
            .directive('debounce',vue3Debounce({lock:true}))
            .mount(el);

            return myApp;

    },
});

//InertiaProgress.init({ color: '#4B5563' });

InertiaProgress.init({
    delay:250,
    color:'#FF0',
    includeCSS:true,
    showSpinner:true
});