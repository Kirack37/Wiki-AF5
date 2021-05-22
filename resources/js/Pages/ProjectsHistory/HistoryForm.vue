<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Creación de historial del proyecto
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="mt-14">
          <label class="mr-12" for="title">Título del historial:</label>
          <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.title" />
        </div>
        <div class="mt-14">
          <label for="description">Descripción del historial:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.description">La descripción es necesaria</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir historial </button>
        <inertia-link class="inside-project text-yellow-600" :href="route('history.index', projects[0].id)">
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
import moment from "moment";

export default {
  name: 'app',       
  components: {
      AppLayout,
      ckeditor: CKEditor.component
  },
  props: {
    projects: Object,
    histories: Object,
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
        user_id: this.user_id,
        project_id: this.projects[0].id,
        title: null,
        description: null,
        publicado: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('history.store', this.projects[0].id), this.form);
    },
  }
}

</script>
