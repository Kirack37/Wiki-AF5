<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Entornos de {{project[0].name.charAt(0).toUpperCase() + project[0].name.substr(1)}}
        </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-12 inline-block">Nombre del entorno:</h3> <p class="inline-block text-black">{{enviroment.name}}</p>
            </div>
          </div>
          <div class="flex items-center mb-14">
            <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('git.index', [project[0].id, enviroment.id])">GIT del entorno</inertia-link>
            </div>
            <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('trello.index', [project[0].id, enviroment.id])">Trello del entorno</inertia-link>
            </div> 
            <!-- <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('phase.index', [project[0].id, enviroment.id])">Fase del entorno</inertia-link>
            </div> -->
          </div>

          <!-- <inertia-link class="bg-gray-200 rounded p-4" :href="route('enviroments')">Volver atrás</inertia-link> -->
      </div>
    </main>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'


export default {
  name: 'app',       
  components: {
      AppLayout,
  },
  props: {
    project: Object,
    enviroment: Object,
  },
}

</script>
