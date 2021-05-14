<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10 items-list">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
        <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()"></search>
        <inertia-link class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-3 bg-yellow-600 text-white" :href="'history/create'">Crear un nuevo historial</inertia-link>
      </div>
      <div class="recent-items">
        <div v-for="history in histories" :key="history.id" class="item-card border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
        <div class="item-info flex">
          <div class="item-data flex-1">
              <p><strong class="text-black ml-4">Título del historial: </strong>{{ history.title }}</p>
            </div>
          <div class="item-data flex-1 mr-32">
              <p><strong class="text-black">Creador del historial: </strong>{{ history.users.firstname }} {{ history.users.lastname }}</p>
            </div>
            <div class="item-data flex-end mr-8">
              <p><strong class="text-black">Fecha de creación: </strong>{{ moment(history.created_at).format("DD-MM-YYYY") }}</p>
            </div>
          </div> 
          <div class="item-data block ml-4 mt-10">
            <ckeditor
              class="text-black"
              id="description" 
              tag-name="textarea" 
              v-model=history.description 
              :disabled="true"
              :editor="editor"
              :config="editorConfig" >  
            </ckeditor>
          </div>
            <div class="item-actions flex">
              <div class="item-data mr-0 ml-auto">
                <inertia-link
                  class="inside-item text-blue-600 mr-4"
                  method="get"
                  as="button"
                  :href="route('history.edit', [project[0].id, history.id])">
                  <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
                </inertia-link>
                <button class="text-red-600" @click="doDelete(history.id)">
                  <font-awesome-icon :icon="['fas', 'trash']" size="lg" />
                </button>
                <confirm-dialogue ref="confirmDialogue"></confirm-dialogue>
            </div>
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
    histories: Object,
    project: Object,
    term: String,
    paginator: Object,
  },
  data() {

    return {
      moment: moment,
      editor: ClassicEditor,
      editorConfig: {      
        editorDisabled: true,
        ckfinder: {
          uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
          openerMethod: 'popup',
        },
        language: 'es',
      },
    }    
  },
  setup () {
    let searching = reactive({
      
      term: ''
    })
    return { searching }
  },

  methods: {
  
    resetQuery() {
      this.$inertia.replace(this.route('history.index', [this.project[0].id, '']))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {

      this.$inertia.replace(this.route('history.index', {project: this.project[0].id, term: this.term}))
      
    },
    async doDelete(history) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar historial',
          message: 'Confirma que deseas borrar este historial. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('history.destroy', [history, this.project[0].id]));
      } 
  },
  },
};
</script>