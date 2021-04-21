<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project.name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">Nombre del proyecto:</label >
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
                <div v-if="errors.name">El Nombre es requerido</div>
              </div>
              <div class="flex-1">
                <label class="mr-8" for="alias">Alias en el proyecto:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.alias"/>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-4" for="responsible">Responsable del proyecto:</label>
                <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="responsible_id" v-model="form.responsible_id">
                    <option v-for="responsible in responsibles" :key="responsible.id" :value="responsible.id">{{responsible.firstname}} {{responsible.lastname}}</option>
                </select>
              </div>
              <div class="flex-1">
                <label class="mr-6" for="priority">Prioridad del proyecto:</label>
                <select class="relative px-6 py-3 w-32 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="priority_id" v-model="form.priority_id">
                    <option id="priority_id" v-for="priority in priorities" :key="priority.id" :value="priority.id" data-id="priority.id">{{ priority.level }} </option>
                </select>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-24" for="start_date">Fecha de inicio:</label>
                <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="start_date" v-model="form.start_date"/>
                <div v-if="errors.start_date">La fecha inicial es requerida</div>
              </div>
              <div class="flex-1">
                <label class="mr-10" for="end_date">Fecha final prevista:</label>
                <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="end_date" v-model="form.end_date"/>
              </div>
            </div>
            <div class="mt-14">
              <label for="description">Descripción del proyecto:</label>
              <div id="app" class="mt-4">
                <ckeditor id="description" v-model="form.description" tag-name="textarea" 
                  :editor="editor"
                  :config="editorConfig"
                  >
                </ckeditor>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar el proyecto </button>
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
