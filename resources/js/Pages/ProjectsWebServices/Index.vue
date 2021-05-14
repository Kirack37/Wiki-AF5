<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Servicios web del proyecto
        </h2>
    </template>
    <div class="container mx-auto my-10 items-list">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
        <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()"></search>
        <inertia-link class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-3 bg-yellow-600 text-white" :href="'webservices/create'">Crear un nuevo servicio web</inertia-link>
      </div>
      <div class="recent-items">
        <div class="recent-items-titles bg-white p-3 flex mb-2">
          <div class="item-title flex-1 mr-4"><h3 class="text-gray-600">Nombre</h3></div>
          <div class="item-title flex-1"><h3 class="text-gray-600">Método</h3></div>
          <div class="item-title flex-1 mr-10"><h3 class="text-gray-600">URL del servicio web</h3></div>
          <div class="item-title flex-initial mr-24 ml-28"><h3 class="text-gray-600">Acciones</h3></div>
        </div>
        <div v-for="webservice in webservices" :key="webservice.id"  class="project-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
        <div class="item-data flex-1">
            <h4>{{ webservice.name }}</h4>
          </div>
          <div class="item-data flex-1">
            <p>{{ webservice.methods }}</p>
          </div>
          <div class="item-data flex-1">
            <p>{{ webservice.url }}</p>
          </div>
          <div class="item-data mr-12">
            <inertia-link class="inside-item text-yellow-600" :href="route('webservices.show', [project[0].id, webservice.id])">
              <font-awesome-icon :icon="['fas', 'eye']" size="lg" />
            </inertia-link>
          </div>
          <div class="item-data mr-12">
            <inertia-link
              class="inside-item text-blue-600"
              method="get"
              as="button"
              :href="route('webservices.edit', [project[0].id, webservice.id])">
              <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
            </inertia-link>
          </div>
          <div class="item-data mr-12">
            <button class="text-red-600" @click="doDelete(webservices.id)">
              <font-awesome-icon :icon="['fas', 'trash']" size="lg" />
            </button>
            <confirm-dialogue ref="confirmDialogue"></confirm-dialogue>
          </div>
        </div>
      </div>
      <Paginator :paginator="paginator" />
    </div>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import { reactive } from "vue";

import moment from "moment";
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';

import Search from '@/Shared/Search'
import ConfirmDialogue from '@/Shared/ConfirmDialogue.vue'
import MiddleModal from '../../Shared/MiddleModal.vue';
import Paginator from "@/Shared/Paginator";
import FlashMessages from '@/Shared/FlashMessages'



export default {
  
  components: {
      AppLayout,
      ckeditor: CKEditor.component,
      Search,
      ConfirmDialogue,
      Paginator,
      FlashMessages,
      MiddleModal
  },
  props: {
    webservices: Object,
    project: Object,
    term: String,
    paginator: Object,
  },

  setup () {
    let searching = reactive({
      
      term: ''
    })
    return { searching }
  },

  methods: {
  
    resetQuery() {
      this.$inertia.replace(this.route('webservices.index', [this.project[0].id, '']))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {

      this.$inertia.replace(this.route('webservices.index', {project: this.project[0].id, term: this.term}))
      
    },
    async doDelete(webservice) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar servicio web',
          message: 'Confirma que deseas borrar este servicio web. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('webservices.destroy', [webservice, this.project[0].id]));
      } 
  },
  },
};
</script>