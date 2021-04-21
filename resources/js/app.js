require('./bootstrap');


// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import VueFinalModal from 'vue-final-modal'
import PortalVue from "portal-vue";

import { Modalable, ToModal } from "@protonemedia/inertia-vue-modal-poc"
import { library } from "@fortawesome/fontawesome-svg-core";
import { faPhone, faEye, faEdit, faTrash, faHome, faEnvelope } from "@fortawesome/free-solid-svg-icons";
import { faFacebookSquare, faTwitterSquare, faLinkedin } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";


library.add(faPhone, faEye, faEdit, faTrash, faFacebookSquare, faTwitterSquare, faLinkedin, faHome, faEnvelope);


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
    // .add(faUserSecret)
    .use(library)
    .use(PortalVue)
    .use(VueFinalModal())
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });