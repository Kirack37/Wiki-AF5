<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{incidence.title}}
        </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="mr-8 inline-block">Titulo de la incidencia:</h3> <p class="inline-block text-black">{{incidence.title}}</p>

          </div>
        </div>
        <div class="mt-14">
          <h3 class="mr-8 inline-block">Motivo de la incidencia:</h3>
          <div id="app" class="mt-4">
            <ckeditor id="reason" v-model="incidence.reason" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <div class="mt-14">
          <h3 class="mr-8 inline-block">Descripción de la incidencia:</h3>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="incidence.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <div class="mt-14">
          <h3 class="mr-8 inline-block">Solución de la incidencia:</h3>
          <div id="app" class="mt-4">
            <ckeditor id="solution" v-model="incidence.solution" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <inertia-link class="inside-project text-yellow-600" :href="route('incidences.index', project[0].id)">
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
    incidence: Object,
    user_id: Number,
  },
  data() {
    return {
      editor: ClassicEditor,
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
}

</script>
