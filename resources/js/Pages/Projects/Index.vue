<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Proyectos
            </h2>
        </template>
        <div class="container mx-auto my-10">
            <div class="select-stuff mb-20">
                <search id="search" class="w-full max-w-md mr-4"  v-model:search="term" @keyup="searchFor" @click="resetQuery()">
                </search>
            </div>
            <div class="recent-projects">
                <table class="bg-blue-250 dark:bg-red-700 text-green-750 dark:text-blue-400  " >
            <thead class="bg-red-500 text-green-750 dark:bg-red-800 dark:text-blue-450">
            <tr>
                <th class="border-2 text-xs border-blue-450 text-center">
                ID
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Fecha de Inicio
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Fecha Fin
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Descripción
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Nombre
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Alias
                </th>
                <th class="border-2 text-xs border-blue-450 text-center">
                Responsable
                </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="projects in wikiaf5projects" :key="projects.id" class="border-2 text-xs border-blue-450">
                
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.id }} 
                </td>

                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.start_date }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.end_date }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.description }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.name }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.alias }} 
                </td>
                <td class="border-r-2 border-red-200 text-center">
                        {{ projects.responsible }} 
                </td>
            </tr>
            </tbody>
        </table>
    
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
        Search
    },
    props: {
      wikiaf5projects: Object,
      term: String,
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
  },
};
</script>