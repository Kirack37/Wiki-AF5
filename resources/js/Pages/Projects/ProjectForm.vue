<template>
  <app-layout>
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
          <label for="start_date">Fecha de inicio:</label>
          <input type="date" id="start_date" v-model="form.start_date"/>
          <div v-if="errors.start_date">La fecha inicial es requerida</div>
        </div>
          <div>
          <label for="end_date">Fecha de inicio:</label>
          <input type="date" id="end_date" v-model="form.end_date"/>
        </div>
        <div>
          <label for="alias">Alias:</label>
          <input id="alias" v-model="form.alias"/>
        </div>
        <div>
          <label for="responsible">Resopnsable:</label>
          <input id="responsible" v-model="form.responsible"/>
        </div>
        <div>
          <label for="description">Descripción del proyecto:</label>
          <textarea id="description" v-model="form.description"/>
        </div>
        <div>
          <label for="responsible">Responsable del proyecto:</label>
          <select ref="prueba" id="responsible_id" v-model="form.responsible_id">
              <option v-for="user in users" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
          </select>
        </div>
        <div>
          <label for="priority">Prioridad del proyecto:</label>
          <select id="priority_id" v-model="form.priority_id">
              <option v-for="priority in priorities" :key="priority.id" :value="priority.id">{{ priority.level }}</option>
          </select>
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
    wikiaf5projects: Object,
    users: Object,
    priorities: Object,
    errors: Object,
  },
  data() {
    return {
      form: {
        name: null,
        start_date: null,
        end_date: null,
        alias: null,
        description: null,
        responsible_id: null,
        priority_id: null,
        responsible: null,

      },
    };
  },
  methods: {
    submit() {
      this.form.responsible = 'hola';
      this.$inertia.post(route('projects.store'), this.form);
    },
  },
}

</script>