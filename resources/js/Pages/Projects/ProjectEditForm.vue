<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <form @submit.prevent="submit">
        <div>
          <label for="name">Nombre:</label >
          <input id="name" v-model="form.name" />
          <div v-if="errors.name">El Nombre es requerido</div>
        </div>
        <div>
          <label for="start_date">Fecha de inicio:</label>
          <input type="date" id="start_date" v-model="form.start_date"/>
          <div v-if="errors.start_date">La fecha inicial es requerida</div>
        </div>
          <div>
          <label for="end_date">Fecha fin:</label>
          <input type="date" id="end_date" v-model="form.end_date"/>
        </div>
        <div>
          <label for="alias">Alias:</label>
          <input id="alias" v-model="form.alias"/>
        </div>
        <div>
          <label for="description">Descripción del proyecto:</label>
          <div id="app">
            <ckeditor id="description" v-model="form.description" tag-name="textarea"
            :editor="editor"
            :config="editorConfig"
            @ready="onEditorReady"
            @focus="onEditorFocus"
            @blur="onEditorBlur"
            @input="onEditorInput"
            @destroy="onEditorDestroy"></ckeditor>
          </div>
        </div>
        <div>
          <label for="responsible">Responsable del proyecto:</label>
          <select id="responsible_id" v-model="form.responsible_id">
              <option v-for="user in allUsers" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
          </select>
        </div>
        <div>
          <label for="priority">Prioridad del proyecto:</label>
          <select id="priority_id" v-model="form.priority_id">
              <option v-for="priority in priorities" :key="priority.id" :value="priority.id">{{ priority.level }}</option>
          </select>
        </div>
        <button type="submit"> Añadir </button>
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
    WikiAf5Projects: Object,
    allUsers: Object,
    priorities: Object,
    errors: Object,
  },
  remember: 'form',
  data() {
    return {
      editor: ClassicEditor,
      editorData: '',
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({ 
        name: this.WikiAf5Projects.name,
        start_date: this.WikiAf5Projects.start_date,
        end_date: this.WikiAf5Projects.end_date,
        alias: this.WikiAf5Projects.alias,
        description: this.WikiAf5Projects.description,
        responsible_id: this.WikiAf5Projects.responsible_id,
        priority_id: this.WikiAf5Projects.priority_id,
      }),
      
    };
  },
  mounted() {
    console.log(this.WikiAf5Projects)
  },
  methods: {
    submit() {
      // this.$inertia.put(
      //   route("prjects.update", this.$props.project.id),
      //   this.form
      // );
      console.log(this.$props.WikiAf5Projects.name)
    },
    onReady( editor )  {
    // Insert the toolbar before the editable area.
    editor.ui.getEditableElement().parentElement.insertBefore(
            editor.ui.view.toolbar.element,
            editor.ui.getEditableElement()
      );
    },
      destroyApp() {
          app.$destroy();
      },
      onEditorReady( editor ) {
          console.log( 'Editor is ready.', { editor } );
      },
      onEditorFocus( event, editor ) {
          console.log( 'Editor focused.', { event, editor } );
      },
      onEditorBlur( event, editor ) {
          console.log( 'Editor blurred.', { event, editor } );
      },
      onEditorInput( data, event, editor ) {
          console.log( 'Editor data input.', { event, editor, data } );
      },
      onEditorDestroy( editor ) {
          console.log( 'Editor destroyed.', { editor } );
      }
  }
}

</script>
