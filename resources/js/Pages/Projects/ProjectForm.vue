<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre del proyecto:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El Nombre es necesario</div>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Alias en el proyecto:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.alias"/>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-4" for="responsible">Responsable del proyecto:</label>
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="responsible_id" v-model="form.responsible_id">
                <option v-for="user in allUsers" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="mr-6" for="priority">Prioridad del proyecto:</label>
            <select class="relative px-6 py-3 w-32 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="priority_id" v-model="form.priority_id">
                <option id="priority_id" v-for="priority in priorities" :key="priority.id" :value="priority.id" data-id="priority.id">{{ priority.level }} </option>
            </select>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-24" for="start_date">Fecha de inicio:</label>
            <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="start_date" v-model="form.start_date"/>
            <div v-if="errors.start_date">La fecha inicial es necesaria</div>
          </div>
          <div class="flex-1">
            <label class="mr-10" for="end_date">Fecha final prevista:</label>
            <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="end_date" v-model="form.end_date"/>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción del proyecto:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir proyecto </button>
      </form>
    </div>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';

export default {
  name: 'app',       
  components: {
      AppLayout,
      ckeditor: CKEditor.component
  },
  props: {
    wikiaf5projects: Object,
    allUsers: Object,
    priorities: Object,
    errors: Object,
  },
  emits: ['onFocus', 'submit'],
  data() {
    return {
      editor: ClassicEditor,
      editorData: '',
      editorConfig: {
        ckfinder: {
          uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
          openerMethod: 'popup',
        },
        language: 'es',
      },
      remember: 'form',
      form: this.$inertia.form({
        name: null,
        start_date: null,
        end_date: null,
        alias: null,
        description: null,
        responsible_id: null,
        priority_id: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('projects.store'), this.form);
    },
  }
}

</script>
