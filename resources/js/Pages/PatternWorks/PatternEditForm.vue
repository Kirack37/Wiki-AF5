<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
          Edición de patrón de trabajo
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
           <div class="flex items-center mb-8">
            <div class="flex-1">
              <label class="mr-12" for="subjects">Título del patrón de trabajo:</label >
              <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="title" v-model="form.name" />
              <div class="text-bold text-red-600" v-if="errors.name">El título es necesario</div>
            </div>
            <div class="flex-1">
              <label class="mr-8" for="alias">Tipo del patrón:</label>
              <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="type" v-model="form.project_type">
                <option v-for="(project_type, index) in project_type" :key="index">{{project_type.name}}</option>
                <div class="text-bold text-red-600" v-if="errors.type">El tipo es necesario</div>
              </select>
            </div>
          </div>
          <div class="mt-14">
            <label for="patterns">Texto del patrón:</label>
            <div id="app" class="mt-4">
              <ckeditor id="patterns" v-model="form.patterns" tag-name="textarea" 
              :editor="editor"
              :config="editorConfig"
              ></ckeditor>
            </div>
          </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar el patrón de trabajo </button>
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
    patternwork: Object,
    errors: Object
  },
  data() {
    return {
      project_type: [{name: 'Pequeño'}, {name: 'Mediano'} , {name: 'Grande'}],
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        name: this.patternwork.name,
        project_type: this.patternwork.project_type,
        patterns: this.patternwork.patterns,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("patternworks.update", this.$props.patternwork.id),
        this.form
      );
    },
  }
}

</script>
