<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project[0].name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">URL del Trello:</label >
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="url" v-model="form.url" />
                <div v-if="errors.name">La URL es requerida</div>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">Nombre de usuario del Trello:</label >
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="username" v-model="form.username" />
              </div>
              <div class="flex-1">
                <label class="mr-12" for="name">Contraseña del usuario de Trello:</label >
                <input type="password" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="username" v-model="form.password" />
              </div>
            </div>
            <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir Trello </button>
            <inertia-link class="inside-project text-yellow-600" :href="route('trello.index', [project[0].id, enviroment[0].id])">
              Volver atrás
            </inertia-link>
          </form>
        </div>
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
    trello: Object,
    enviroment: Object,
    errors: Object,
  },
  data() {
    return {
      form: this.$inertia.form({ 
       project_enviroment_id: this.enviroment[0].id,
        url: this.trello.url,
        username: this.trello.username,
        password: this.trello.password,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(route("trello.update", [this.project[0].id, this.enviroment[0].id, this.$props.trello.id]), this.form);
    },
  }
}

</script>
