<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project[0].name.charAt(0).toUpperCase() + project[0].name.substr(1)}}
        </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="inline-block mr-4">Nombre del servicio web:</h3> <p class="inline-block text-black">{{ webservice.name }}</p>
          </div>
          <div class="flex-1">
            <h3 class="inline-block mr-6">Método del servicio web:</h3><p class="inline-block text-black">{{ webservice.method }}</p>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="inline-block mr-4">URL del servicio web:</h3> <p class="inline-block text-black">{{ webservice.url }}</p>
          </div>
          <div class="flex-1">
            <h3 class="inline-block mr-6">Tipo de respuesta del servicio web:</h3><p class="inline-block text-black">{{ webservice.data_request_type }}</p>
          </div>
        </div>
        <div class="project-attribute mt-14">
            <h3 class="inline-block mb-4">Data headers del servicio web:</h3>
            <ckeditor
              class="text-black"
              id="data_headers" 
              tag-name="textarea"
              v-model=webservice.data_headers  
              :disabled="true"
              @ready="onReady"
              :editor="editor"
              :config="editorConfig" >  
            </ckeditor>
          </div>
        <div class="mt-14">
          <label for="data_headers"></label>
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
      </div>
    </main>
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
    project: Object,
    webservice: Object,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: this.project.description,
      editorConfig: {      
        editorDisabled: true,
        ckfinder: {
          uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
          openerMethod: 'popup',
        },
        language: 'es',
      },
    };
  },
  methods: {
    onReady( editor )  {
      // Insert the toolbar before the editable area.
      editor.ui.getEditableElement().parentElement.insertBefore(
          editor.ui.view.toolbar.element,
          editor.ui.getEditableElement()
      );
    },
  }
}

</script>
