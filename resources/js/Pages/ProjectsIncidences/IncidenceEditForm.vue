<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project[0].name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">Título de la incidencia:</label >
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.title" />
              </div>
            </div>
            <div class="mt-14">
              <label for="description">Motivo de la incidencia:</label>
              <div id="app" class="mt-4">
                <ckeditor id="description" v-model="form.reason" tag-name="textarea" 
                :editor="editor"
                :config="editorConfig"
                ></ckeditor>
              </div>
            </div>
            <div class="mt-14">
              <label for="description">Descripción de la incidencia:</label>
              <div id="app" class="mt-4">
                <ckeditor id="description" v-model="form.description" tag-name="textarea" 
                :editor="editor"
                :config="editorConfig"
                ></ckeditor>
              </div>
            </div>
            <div class="mt-14">
              <label for="description">Solución de la incidencia:</label>
              <div id="app" class="mt-4">
                <ckeditor id="description" v-model="form.solution" tag-name="textarea" 
                :editor="editor"
                :config="editorConfig"
                ></ckeditor>
              </div>
            </div>
            <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar la incidencia </button>
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
    incidence: Object,
    user_id: Number,
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
        title: this.incidence.title,
        reason: this.incidence.reason,
        description: this.incidence.description,
        solution: this.incidence.solution,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("incidences.update", [this.project[0].id, this.$props.incidence.id]), this.form);
    },
  }
}

</script>
