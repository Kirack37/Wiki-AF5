<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Creación de historial del proyecto
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
         <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="title">Nombre del servicio web:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El título es requerido</div>
          </div>
          <div class="flex-1">
            <label class="mr-12" for="title">Método del servicio web:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.methods" />
            <div v-if="errors.methods">el método es requerido</div>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="title">URL del servicio web:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.url" />
            <div v-if="errors.url">La URL es requerida</div>
          </div>
          <div class="flex-1">
            <label class="mr-12" for="title">Tipo de respuesta del servicio web:</label>
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.data_request_type" />
            <div v-if="errors.data_request_type">El título es requerido</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="data_headers">Data headers del servicio web:</label>
          <div id="app" class="mt-4">
            <ckeditor id="data_headers" v-model="form.data_headers" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.description">La descripción es requerida</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="data_request">Data request del servicio web:</label>
          <div id="app" class="mt-4">
            <ckeditor id="data_request" v-model="form.data_request" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.description">La descripción es requerida</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="data_response">Data response del servicio web:</label>
          <div id="app" class="mt-4">
            <ckeditor id="data_response" v-model="form.data_response" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.description">La descripción es requerida</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir servicio web </button>
        <inertia-link class="inside-project text-yellow-600" :href="route('webservices.index', projects[0].id)">
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
    webservice: Object,
    user_id: Number,
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
        project_id: this.projects[0].id,
        name: null,
        methods: null,
        url: null,
        data_headers: null,
        data_request_type: null,
        data_request: null,
        data_response: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('webservices.store', this.projects[0].id), this.form);
    },
  }
}

</script>
