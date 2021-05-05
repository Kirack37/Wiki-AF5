<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project[0].name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex-1">
              <label class="mr-12" for="name">Título del entorno:</label >
              <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
              <div v-if="errors.name">El nombre es requerido</div>
            </div>
            <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar el entorno </button>
            <inertia-link class="inside-project text-yellow-600" :href="route('enviroments.index', project[0].id)">
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
    user_id: Number,
    project: Object,
    enviroment: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({ 
        project_id: this.project[0].id,
        name: this.enviroment.name,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("enviroments.update", [this.project[0].id, this.$props.enviroment.id]), this.form);
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
