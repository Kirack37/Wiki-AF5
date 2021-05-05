<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Empresas
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre de la empresa:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El Nombre es requerido</div>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Descripción de la empresa:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.description"/>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir empresa </button>
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
    companies: Object,
    errors: Object,
  },
  data() {
    return {
      remember: 'form',
      form: this.$inertia.form({
        name: null,
        description: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('companies.store'), this.form);
    },
  }
}

</script>
