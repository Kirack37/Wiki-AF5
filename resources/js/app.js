require('./bootstrap');


// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import VueFinalModal from 'vue-final-modal'
import PortalVue from "portal-vue";
import { Modalable, ToModal } from "@protonemedia/inertia-vue-modal-poc"




const el = document.getElementById('app');

createApp({
        render: () =>
            h(InertiaApp, {
                initialPage: JSON.parse(el.dataset.page),
                resolveComponent: (name) => require(`./Pages/${name}`).default,
            }),
    })
    .mixin({ methods: { route } })

.use(InertiaPlugin)
    // .component("Modalable", Modalable)
    // .component("ToModal", ToModal)
    .use(PortalVue)
    .use(VueFinalModal())
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });