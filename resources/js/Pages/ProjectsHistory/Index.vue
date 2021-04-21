<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
          <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()">
          </search>
          <button class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-2 bg-yellow-600"><a class="text-white" :href="'history/create'">Crear un nuevo historial</a></button>
      </div>
      <div class="recent-projects">
        <div class="recent-projects-titles bg-white p-3 flex mb-2">
          <div class="project-title flex-1 mr-4"><h3 class="text-gray-600">Descripción</h3></div>
          <div class="project-title flex-1"><h3 class="text-gray-600">Fecha</h3></div>
          <div class="project-title flex-1"><h3 class="text-gray-600">Creador/a</h3></div>
          <div class="project-title flex-initial mr-24 ml-28"><h3 class="text-gray-600">Acciones</h3></div>
        </div>
        <div v-for="history in histories" :key="history.id" class="project-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="project-data flex-1">
            <h4 class="text-black">{{ history.description }}</h4>
          </div>
          <div class="project-data flex-1">
            <p>{{ moment(history.created_at).format("DD-MM-YYYY") }}</p>
          </div>
          <div class="project-data flex-1">
            <p>{{ history.users.firstname }} {{ history.users.lastname }}</p>
          </div>
          <div class="project-data mr-12">
            <inertia-link
              class="inside-project text-blue-600"
              method="get"
              as="button"
              :href="route('history.edit', [project[0].id, history.id])">
              <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
            </inertia-link>
          </div>
          <div class="project-data mr-12">
            <button class="text-red-600" @click="doDelete(history.id)">
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

import Search from '@/Shared/Search'
import ConfirmDialogue from '@/Shared/ConfirmDialogue.vue'
import MiddleModal from '../../Shared/MiddleModal.vue';
import Paginator from "@/Shared/Paginator";
import FlashMessages from '@/Shared/FlashMessages'



export default {
        
  // metaInfo: { 
  //     title: 'history' 
  // },
  
  components: {
      AppLayout,
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
      moment: moment
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
      this.$inertia.replace(this.route('history.index', this.project[0].id, ''))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {

      this.$inertia.replace(this.route('history.index', this.project[0].id, {term:this.term}))
      
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