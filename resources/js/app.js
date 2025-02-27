require('./bootstrap');


// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

// import VueFinalModal from 'vue-final-modal'
// import PortalVue from "portal-vue";

// import { Modalable, ToModal } from "@protonemedia/inertia-vue-modal-poc"
import { library } from "@fortawesome/fontawesome-svg-core";
import { faPhone, faEye, faEdit, faTrash, faHome, faEnvelope, faEnvelopeOpenText, faUsersCog, faUserPlus } from "@fortawesome/free-solid-svg-icons";
import { faFacebookSquare, faTwitterSquare, faLinkedin } from '@fortawesome/free-brands-svg-icons'
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import ReadMore from 'vue-read-more';
import Vue from 'vue';
import axios from 'axios';
import VueAxios from 'vue-axios';
// import { useModal } from "./useModal";


library.add(faPhone, faEye, faEdit, faTrash, faFacebookSquare, faTwitterSquare, faLinkedin, faHome, faEnvelopeOpenText, faEnvelope, faUsersCog, faUserPlus);


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
    .use(library)
    // .use(PortalVue)
    .use(ReadMore)
    .use(VueAxios, axios)
    // .use(VueFinalModal())
    .component('font-awesome-icon', FontAwesomeIcon)
    .mount(el);

InertiaProgress.init({ color: '#4B5563' });