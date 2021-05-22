<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{company.name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre de la empresa:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El Nombre es necesario</div>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Descripción de la empresa:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.description"/>
          </div>
        </div>
        <div class="flex">          
          <div class="flex-1 mt-8"> 
            <button class="bg-yellow-500 rounded p-4" type="submit"> Editar la empresa </button>
          </div>
          <div class="flex-end mt-12"> 
            <inertia-link class="bg-gray-200 rounded p-4" :href="route('companies')">Volver atrás</inertia-link>
          </div>
        </div>
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
    company: Object,
    errors: Object,
  },
  data() {
    return {
      form: this.$inertia.form({ 
        name: this.company.name,
        description: this.company.description,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(route("companies.update", this.$props.company.id), this.form);
    },
  }
}

</script>
