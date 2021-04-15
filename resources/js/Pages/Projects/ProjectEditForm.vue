<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project.name}}
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
              :config="editorConfig">
            </ckeditor>
          </div>
        </div>
        <div>
          <label for="responsible">Responsable del proyecto:</label>
          <select id="responsible_id" v-model="form.responsible_id">
              <option v-for="responsible in responsibles" :key="responsible.id" :value="responsible.id">{{responsible.firstname}} {{responsible.lastname}}</option>
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
    project: Object,
    priorities: Object,
    responsibles: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({ 
        name: this.project.name,
        start_date: this.project.start_date,
        end_date: this.project.end_date,
        alias: this.project.alias,
        description: this.project.description,
        responsible_id: this.project.responsible_id,
        priority_id: this.project.priority_id,
      }),
      
    };
  },
  mounted() {
    console.log(this.project)
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("projects.update", this.$props.project.id),
        this.form
      );
    },
    // onReady( editor )  {
    // // Insert the toolbar before the editable area.
    // editor.ui.getEditableElement().parentElement.insertBefore(
    //         editor.ui.view.toolbar.element,
    //         editor.ui.getEditableElement()
    //   );
    // },
    //   destroyApp() {
    //       app.$destroy();
    //   },
    //   onEditorReady( editor ) {
    //       console.log( 'Editor is ready.', { editor } );
    //   },
    //   onEditorFocus( event, editor ) {
    //       console.log( 'Editor focused.', { event, editor } );
    //   },
    //   onEditorBlur( event, editor ) {
    //       console.log( 'Editor blurred.', { event, editor } );
    //   },
    //   onEditorInput( data, event, editor ) {
    //       console.log( 'Editor data input.', { event, editor, data } );
    //   },
    //   onEditorDestroy( editor ) {
    //       console.log( 'Editor destroyed.', { editor } );
    //   }
  }
}

</script>
