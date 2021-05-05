<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{projects[0].name}}
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre del entorno:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El nombre es requerido</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir nota </button>
        <inertia-link class="inside-project text-yellow-600" :href="route('enviroments.index', projects[0].id)">
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
    enviroments: Object,
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
        project_id: this.projects[0].id,
        name: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('enviroments.store', this.projects[0].id), this.form);
    },
  }
}

</script>
