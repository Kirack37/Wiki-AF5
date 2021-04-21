<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project.name.charAt(0).toUpperCase() + project.name.substr(1)}}
        </h2>
    </template>
    <main class="projects-show bg-white">
      <div class="container mx-auto my-10">
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-12 inline-block">Nombre del proyecto:</h3> <p class="inline-block text-black">{{project.name}}</p>
            </div>
            <div class="flex-1">
              <h3 class="mr-8 inline-block">Alias:</h3> <p class="inline-block text-black">{{project.alias.charAt(0).toUpperCase() + project.alias.substr(1)}}</p>
            </div>
          </div>
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="inline-block mr-4">Responsable del proyecto:</h3> <p class="inline-block text-black" v-for="responsible in responsible" :key="responsible.id" :value="responsible.id">{{ responsible.firstname }} {{ responsible.lastname }}</p>
            </div>
            <div class="flex-1">
              <h3 class="inline-block mr-6">Prioridad del proyecto:</h3><p class="inline-block text-black" v-for="priority in priority" :key="priority.id" :value="priority.id">{{priority.level.charAt(0).toUpperCase() + priority.level.substr(1)}}</p>
            </div>
          </div>
          <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="mr-24 inline-block">Fecha de inicio:</h3> <p class="inline-block text-black">{{project.start_date}}</p>
            </div>
            <div class="flex-1" v-if="project.end_date==!null">
              <h3 class="inline-block mr-10">Fecha final prevista:</h3> <p class="inline-block text-black">{{project.end_date}}</p>
            </div>
          </div>
           <div class="flex items-center mb-8">
            <div class="flex-1">
              <inertia-link :href="route('history.index', project.id)">Historial del proyecto</inertia-link>
            </div>
            <!-- <div class="flex-1">
              <inertia-link :href="route('notes.show', project.id)">Notas del proyecto</inertia-link>
            </div>
            <div class="flex-1">
              <inertia-link :href="route('incidences.show', project.id)">Incidencias del proyecto</inertia-link>
            </div> -->
          </div>
           <div class="flex items-center mb-8">
            <div class="flex-1">
              <h3 class="inline-block mr-4">Fase del proyecto:</h3> <p class="inline-block text-black"></p>
            </div>
            <div class="flex-1">
              <h3 class="inline-block mr-6">GIT del proyecto:</h3><p class="inline-block text-black"></p>
            </div>
            <div class="flex-1">
              <h3 class="inline-block mr-4">Trello del proyecto:</h3> <p class="inline-block text-black"></p>
            </div>
            <div class="flex-1">
              <!-- <inertia-link :href="route('web-services.show', project.id)">Web Services del proyecto</inertia-link> -->
            </div>
          </div>
          
          <div class="project-attribute mt-14">
            <h3 class="inline-block mb-4">Descripción del proyecto:</h3>
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
          <button class="bg-gray-200 rounded p-4 mt-8"><a href="/projects">Volver a la página de proyectos</a></button>
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
    priority: Object,
    responsible: Object,
    history: Object,
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
