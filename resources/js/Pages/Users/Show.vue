<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
          {{currentUser.firstname }} {{currentUser.lastname }}
        </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-12 inline-block">Nombre de usuario:</h3> <p class="inline-block text-black">{{currentUser.name}}</p>
            </div>
            <div class="flex-1">
              <h3 class="mr-8 inline-block">Nombre completo</h3> <p class="inline-block text-black">{{currentUser.firstname }} {{currentUser.lastname }}</p>
            </div>
          </div>
          <div class="flex items-center mb-8">
             <div class="flex-1">
              <h3 class="inline-block mr-6">Tipo de usuario:</h3><p class="inline-block text-black" v-for="type in user_type" :key="type.id" :value="type.id">{{type.name}}</p>
            </div>
            <!-- <div v-if="contact!=null" class="flex-1">
                <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('contacts.show', contact.id)">Contacto del usuario</inertia-link>

            </div> -->
          </div>
          <inertia-link class="bg-gray-200 rounded p-4 mt-8" :href="route('wikiusers')">Volver a la página de usuarios</inertia-link>
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
    currentUser: Object,
    user_type: Object,
    // contact: Number,

  },
  data() {
    return {
      
    };
  },
  methods: {

  }
}

</script>
