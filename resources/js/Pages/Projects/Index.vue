<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-white leading-tight">
                Proyectos
            </h2>
        </template>
        <div class="container mx-auto my-10">
            <div class="select-stuff mb-20">
                <input id="search" class="w-full max-w-md mr-4" :value="value" @input="$emit('input', $event.target.value)"  @reset="reset">
                <!-- </search> -->
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
import pickBy from 'lodash/pickBy'
import throttle from 'lodash/throttle'
import mapValues from 'lodash/mapValues'
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
      filters: Object,
      value: String,
      emits: ['input'],
      maxWidth: {
        type: Number,
        default: 300,
      },
  },
    data() {
    return {
      form: {
        search: this.filters.search,
      },
    }
  },
  watch: {
    form: {
      handler: throttle(function() {
        let query = pickBy(this.form)
        this.$inertia.replace(this.route('projects', Object.keys(query).length ? query : { remember: 'forget' }))
      }, 150),
      deep: true,
    },
  },
  methods: {
    reset() {
      this.form = mapValues(this.form, () => null)
    },
    onInput() {
      console.log(this.searchQuery);
      this.$emit('queryChange', this.searchQuery);
    },
  },
    
//     data() {
//         return{
//         term: {
//         term: this.filters.search,
        
//         }
//     }
//         // return {
//         //     term:''
//         // }
//     }, 
//     term: {
//         form: {
//         handler: throttle(function() {
//             let query = pickBy(this.term)
//             this.$inertia.replace(this.route('projects', Object.keys(query).length ? query : { remember: 'forget' }))
//         }, 150),
//         deep: true,
//         },
//   },
//     methods: {
//         // search(){
//         //     this.$inertia.get(this.route('projects',  { term: this.term }))
//         // },
//         reset() {
//             this.term = mapValues(this.term, () => null)
//         },
//     },
};
</script>