<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <div class="select-stuff mb-20 flex">
          <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()">
          </search>
          <button class="flex-none ml-60 border-2 border-double rounded border-gray-300 p-2"><a class="text-yellow-600" :href="'projects/create'">Crear un nuevo proyecto</a></button>
      </div>
      <div class="recent-projects">
        <div class="recent-projects-titles bg-white p-3 flex mb-2">
          <div class="project-title flex mr-56 mr-1"><h3 class="text-gray-600">Nombre</h3></div>
          <div class="project-title flex mr-44"><h3 class="text-gray-600">Fecha de inicio</h3></div>
          <div class="project-title flex mr-56"><h3 class="text-gray-600">Alias</h3></div>
          <div class="project-title flex"><h3 class="text-gray-600">Responsable del proyecto</h3></div>
        </div>
        <div v-for="project in wikiaf5projects" :key="project.id" class="project-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="project-data flex-1">
            <h4>{{ project.name }}</h4>
          </div>
          <div class="project-data flex-1">
            <p>{{ project.start_date }}</p>
          </div>
          <div class="project-data flex-1">
            <p>{{ project.alias }}</p>
          </div>
          <div class="project-data flex-1">
            <p>{{ project.users.firstname }} {{ project.users.lastname }}</p>
          </div>
          <div class="project-data flex-1">
            <inertia-link class="inside-project text-yellow-600" :href="route('projects.show', project.id)">
              Ver más
            </inertia-link>
          </div>
          <div class="project-data flex-1">
            <inertia-link
              class="inside-project text-blue-600"
              method="get"
              as="button"
              :href="route('projects.edit', project.id)">
              Editar
            </inertia-link>
          </div>
          <div class="project-data flex-1">
            <inertia-link
              class="inside-project text-red-600"
              method="delete"
              as="button"
              :href="route('projects.destroy', project.id)">
              Borrar
            </inertia-link>
          </div>
        </div>
      <div class="paginate">
            <select id="priority">
                <option v-for="project in wikiaf5projects" :key="project.id" :value="project.id">{{ project.name }}</option>
            </select>
      </div>
      </div>
    </div>
  </app-layout>
</template>
<script>

import AppLayout from '@/Layouts/AppLayout'
import { reactive } from "vue";

import Search from '@/Shared/Search'

export default {
        
  metaInfo: { 
      title: 'Projects' 
  },
  
  components: {
      AppLayout,
      Search,
  },
  props: {
    wikiaf5projects: Object,
    term: String,
  },
  data() {
    return {
      page: 1
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
    // showProject: function(project){
    //   this.$inertia.get(this.route('projects.show'), project)
    // },
    // deleteUser: function(project){
    //   this.$inertia.delete(this.route('projects.destroy'), project)
    // },
  },
};
</script>