<template>
  <app-layout>
    <!-- <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script> -->
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <form @submit.prevent="submit">
        <div>
          <label for="name">Nombre:</label >
          <input id="name" v-model="form.name" />
          <div v-if="errors.name">El Nombre es requerido</div>
        </div>
        <div>
          <label for="description">Descripción</label>
          <input id="description" v-model="form.description"/>
        </div>
        <div>
          <label for="status">status:</label>
          <input id="status" v-model="form.status"/>
        </div>
        <button type="submit"> Añadir </button>
      </form>
    </div>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'

export default {
          
  components: {
      AppLayout,
  },
  props: {
    // wikiaf5projects: Object,
    // users: Object,
    // priorities: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: null,
        start_date: null,
        description: null,
        status: null,
        description: null,
        delete_at: null,
        created_at: null,
        updated_at: null
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('company.store'), this.form);
    },
  },
}

</script>