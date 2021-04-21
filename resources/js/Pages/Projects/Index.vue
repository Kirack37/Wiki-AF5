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
          <button class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-2 bg-yellow-600"><a class="text-white" :href="'projects/create'">Crear un nuevo proyecto</a></button>
      </div>
      <div class="recent-projects">
        <div class="recent-projects-titles bg-white p-3 flex mb-2">
          <div class="project-title flex-1 mr-4"><h3 class="text-gray-600">Nombre</h3></div>
          <div class="project-title flex-1"><h3 class="text-gray-600">Fecha de inicio</h3></div>
          <div class="project-title flex-1 mr-10"><h3 class="text-gray-600">Alias en el proyecto</h3></div>
          <div class="project-title flex-1"><h3 class="text-gray-600">Responsable del proyecto</h3></div>
          <div class="project-title flex-initial mr-24 ml-28"><h3 class="text-gray-600">Acciones</h3></div>
        </div>
        <div v-for="project in projects" :key="project.id" class="project-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="project-data flex-1">
            <h4>{{ project.name }}</h4>
          </div>
          <div class="project-data flex-1">
            <p>{{ moment(project.start_date).format("DD-MM-YYYY") }}</p>
          </div>
          <div class="project-data flex-1">
            <p>{{ project.alias }}</p>
          </div>
          <div class="project-data flex-1">
            <p>{{ project.users.firstname }} {{ project.users.lastname }}</p>
          </div>
          <div class="project-data mr-12">
            
            <inertia-link class="inside-project text-yellow-600" :href="route('projects.show', project.id)">
              <font-awesome-icon :icon="['fas', 'eye']" size="lg" />
            </inertia-link>

          </div>
          <div class="project-data mr-12">
            <inertia-link
              class="inside-project text-blue-600"
              method="get"
              as="button"
              :href="route('projects.edit', project.id)">
              <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
            </inertia-link>
          </div>
          <div class="project-data mr-12">
            <button class="text-red-600" @click="doDelete(project.id)">
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
        
  metaInfo: { 
      title: 'Projects' 
  },
  
  components: {
      AppLayout,
      Search,
      ConfirmDialogue,
      Paginator,
      FlashMessages,
      MiddleModal
  },
  props: {
    projects: Object,
    term: String,
    paginator: Object
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
      this.$inertia.replace(this.route('projects', ''))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {
      this.$inertia.replace(this.route('projects', {term:this.term}))
      
    },
    async doDelete(project) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar proyecto',
          message: 'Confirma que deseas borrar este proyecto. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('projects.destroy', project));
      } 
  },
  },
};
</script>