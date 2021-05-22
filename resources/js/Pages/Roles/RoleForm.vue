<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
          Nuevo rol
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre del rol:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El Nombre es necesario</div>
          </div>
        </div>
        <div class="flex-1">
          <label class="mr-8" for="alias">Slug del rol:</label>
          <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.slug"/>
          <div v-if="errors.name">El Nombre es necesario</div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción del rol:</label>
          <div id="app" class="mt-4">
            <ckeditor id="notes" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir rol </button>
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
      ckeditor: CKEditor.component,
  },
  props: {
    roles: Object,
    errors: Object,
  },
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
        slug: null,
        description: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('roles.store'), this.form);
    },
  }
}

</script>
