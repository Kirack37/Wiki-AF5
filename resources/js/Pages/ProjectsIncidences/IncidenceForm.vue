<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyecto
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Título de la incidencia:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.title" />
            <div class="text-bold text-red-600" v-if="errors.title">El título es requerido</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Motivo de la incidencia:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.reason" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div class="text-bold text-red-600" v-if="errors.reason">El motivo es requerido</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción de la incidencia:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div class="text-bold text-red-600" v-if="errors.description">La descripción es requerida</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Solución de la incidencia:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.solution" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir incidencia </button>
        <inertia-link class="inside-project text-yellow-600" :href="route('incidences.index', projects[0].id)">
          Volver atrás
        </inertia-link>
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
    projects: Object,
    incidence: Object,
    user_id: Number,
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
        title: null,
        project_id: this.projects[0].id,
        description: null,
        reason: null,
        solution: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('incidences.store', this.projects[0].id), this.form);
    },
  }
}

</script>
