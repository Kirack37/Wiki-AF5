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
                <label class="mr-12" for="name">URL del repositorio de GIT:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="url" v-model="form.repository_url" />
                <div v-if="errors.repository_url">La URL es necesaria</div>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">Nombre del repositorio de GIT:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.repository_name" />
                <div v-if="errors.repository_name">El nombre es necesario</div>
              </div>
            </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir GIT </button>
        <inertia-link class="inside-project text-yellow-600" :href="route('git.index', [project[0].id, enviroment[0].id])">
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
    git: Object,
    enviroment: Object,
    errors: Object,
  },
  data() {
    return {
      remember: 'form',
      form: this.$inertia.form({
        project_enviroment_id: this.enviroment[0].id,
        repository_url: null,
        repository_name: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('git.store', [this.project[0].id, this.enviroment[0].id]), this.form);
    },
  }
}

</script>
