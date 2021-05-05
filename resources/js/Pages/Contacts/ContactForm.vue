<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
          Contacto
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre del contacto:</label >
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="user_id" v-model="form.user_id">
                <option v-for="user in users" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
                <div class="text-bold text-red-600" v-if="errors.client_id">El nombre es requerido</div>
            </select>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="type">Tipo de contacto:</label>
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="type" v-model="form.type">
              <option v-for="(type, index) in type" :key="index">{{type.name}}</option>
             <div class="text-bold text-red-600" v-if="errors.type">El tipo es requerido</div>
            </select>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-4" for="contact">Contacto</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="value" v-model="form.value" />
            <div class="text-bold text-red-600" v-if="errors.type">El contacto es requerido</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir contacto </button>
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
    contacts: Object,
    users: Object,
    errors: Object,
  },

  data() {
    
    return {
      type: [{name: 'Email'}, {name: 'Teléfono fijo'} , {name: 'Teléfono móvil'}, {name: 'Skype'}, {name: 'Teams'}, {name: 'Asana'}, {name: 'Facebook'}, {name: 'Twitter'}],
      remember: 'form',
      form: this.$inertia.form({
        user_id: null,
        type: null,
        value: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('contacts.store'), this.form);
    },
  }
}

</script>
