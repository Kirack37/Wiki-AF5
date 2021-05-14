<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{meeting.subjects.charAt(0).toUpperCase() + meeting.subjects.substr(1)}}
        </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-12 inline-block">Asunto de la reunión:</h3> <p class="inline-block text-black">{{meeting.subjects}}</p>
            </div>
          </div>
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="inline-block mr-4">Organizador de la reunión:</h3> <p class="inline-block text-black" v-for="owner in owner" :key="owner.id" :value="owner.id">{{ owner.firstname }} {{ owner.lastname }}</p>
            </div>
            <div class="flex-1">
              <h3 class="inline-block mr-6">Prioridad de la reunión:</h3><p class="inline-block text-black" v-for="priority in priority" :key="priority.id" :value="priority.id">{{priority.level.charAt(0).toUpperCase() + priority.level.substr(1)}}</p>
            </div>
          </div>
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-24 inline-block">Fecha de la reunión:</h3> <p class="inline-block text-black">{{meeting.date}}</p>
            </div>
          </div>
           <div class="flex items-center mb-14">
            <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('logs.index', meeting.id)">Log de la reunión</inertia-link>
            </div>
            <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('meetingnotes.index', meeting.id)">Notas de la reunión</inertia-link>
            </div>
            <div class="flex-1">
              <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('reports.index', meeting.id)">Acta de la reunión</inertia-link>
            </div>
          </div>
           <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="inline-block mr-4">Estado del acta de la reunión:</h3> <p class="inline-block text-black"></p>
            </div>
            <div class="flex-1">
              <h3 class="inline-block mr-6">Usuarios de la reunión:</h3><p class="inline-block text-black"></p>
            </div>
          </div>
          
          <div class="item-attribute mt-14">
            <h3 class="inline-block mb-4">Descripción de la reunión:</h3>
            <ckeditor
              class="text-black"
              id="description" 
              tag-name="textarea" 
              v-model="editorData" 
              :disabled="true"
              @ready="onReady"
              :editor="editor"
              :config="editorConfig" >  
            </ckeditor>
          </div>
          <button class="bg-gray-200 rounded p-4 mt-8"><a href="/meetings">Volver a la página de reuniones</a></button>
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
    owner: Object,
    meeting: Object,
    priority: Object,
    responsible: Object,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: this.meeting.description,
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
