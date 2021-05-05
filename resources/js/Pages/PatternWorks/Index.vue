<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
          Patrones de trabajo
        </h2>
    </template>
    <div class="container mx-auto my-10 items-list">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
        <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()"></search>
        <inertia-link class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-3 bg-yellow-600 text-white" :href="route('patternworks.create')">Crear un nuevo patrón de trabajo</inertia-link>
      </div>
      <div class="recent-items">
        <div v-for="pattern in patterns" :key="pattern.id" class="item-card border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="item-info flex">
            <div class="item-data flex-1">
              <p><strong class="text-black ml-4">Título del patrón: </strong>{{ pattern.name }}</p>
            </div>
            <div class="item-data flex-end mr-8">
              <p><strong class="text-black">Tipo de patrón: </strong>{{pattern.project_type.charAt(0).toUpperCase() + pattern.project_type.substr(1)}}</p>
            </div>
          </div> 
          <div class="item-data block ml-4 mt-10">
            <ckeditor
              class="text-black"
              id="patterns" 
              tag-name="textarea" 
              v-model=pattern.patterns 
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
                  :href="route('patternworks.edit', pattern.id)">
                  <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
                </inertia-link>
                <button class="text-red-600" @click="doDelete(pattern.id)">
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
    patterns: Object,
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
      this.$inertia.replace(this.route('patternworks.index', ''))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {

      this.$inertia.replace(this.route('patternworks.index', {term: this.term}))
      
    },
    async doDelete(pattern) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar patrón de trabajo',
          message: 'Confirma que deseas borrar este patrón de trabajo. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('patternworks.destroy', pattern));
      } 
  },
  },
};
</script>