<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edición de nota personal
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="subjects">Título de la nota:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="title" v-model="form.title" />
            <div class="text-bold text-red-600" v-if="errors.title">El título es necesario</div>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Tipo de nota:</label>
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="type" v-model="form.type">
              <option v-for="(type, index) in type" :key="index">{{type.name}}</option>
              <div class="text-bold text-red-600" v-if="errors.type">El tipo es necesario</div>
            </select>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Texto de la nota:</label>
          <div id="app" class="mt-4">
            <ckeditor id="notes" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <div class="flex">          
          <div class="flex-1 mt-8"> 
            <button class="bg-yellow-500 rounded p-4" type="submit"> Editar la nota personal </button>
          </div>
          <div class="flex-end mt-12"> 
            <inertia-link class="bg-gray-200 rounded p-4" :href="route('personalnotes')">Volver atrás</inertia-link>
          </div>
        </div>
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
    note: Object,
    errors: Object
  },
  data() {
    return {
      type: [{name: 'Reuniones'}, {name: 'Proyectos'} , {name: 'Empleados'}, {name: 'Trabajadores externos'}],
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        user_id: this.note.user_id,
        title: this.note.title,
        type: this.note.type,
        description: this.note.description,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("personalnotes.update", this.$props.note.id),
        this.form
      );
    },
  }
}

</script>
