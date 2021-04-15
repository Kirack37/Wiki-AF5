<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project.name.charAt(0).toUpperCase() + project.name.substr(1)}}
        </h2>
    </template>
    <main class="projects-show">
      <div class="container mx-auto my-10">
          <div class="project-attribute">
            <h4>Fecha de inicio:</h4> <p>{{project.start_date}}</p>
          </div>
          <div v-if="project.end_date==!null" class="project-attribute">
            <h4>Fecha fin:</h4> <p>{{project.end_date}}</p>
          </div>
          <div class="project-attribute">
            <h4>Responsable:</h4> <p v-for="responsible in responsible" :key="responsible.id" :value="responsible.id">{{ responsible.firstname }} {{ responsible.lastname }}</p>
          </div>
          <div class="project-attribute">
            <h4>Alias:</h4> <p>{{project.alias.charAt(0).toUpperCase() + project.alias.substr(1)}}</p>
          </div>
          <div class="project-attribute">
            <h4>Prioridad:</h4><p v-for="priority in priority" :key="priority.id" :value="priority.id">{{priority.level.charAt(0).toUpperCase() + priority.level.substr(1)}}</p>
          </div>
          <div class="project-attribute">
            <h4>Descripción:</h4>
            <ckeditor 
              id="description" 
              tag-name="textarea" 
              v-model="editorData" 
              :disabled="true"
              @ready="onReady"
              :editor="editor"
              :config="editorConfig" >  
            </ckeditor>
          </div>
          <button><a href="/projects">Volver a la página de proyectos</a></button>
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
    responsible: Object
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
