<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="subjects">Asunto de la reunión:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="subject" v-model="form.subjects" />
            <div class="text-bold text-red-600" v-if="errors.subjects">El asunto es requerido</div>
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Fecha de la reunión:</label>
            <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="date" v-model="form.date"/>
            <div class="text-bold text-red-600" v-if="errors.date">La fecha inicial es requerida</div>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-4" for="owner">Organizador de la reunión:</label>
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="responsible_id" v-model="form.owner_id">
                <option v-for="user in users" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
                <div class="text-bold text-red-600" v-if="errors.owner_id">El asunto es requerido</div>
            </select>
          </div>
          <div class="flex-1">
            <label class="mr-6" for="priority">Prioridad de la reunión:</label>
            <select class="relative px-6 py-3 w-32 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="priority_id" v-model="form.priority_id">
                <option id="priority_id" v-for="priority in priorities" :key="priority.id" :value="priority.id" data-id="priority.id">{{ priority.level }} </option>
                <div class="text-bold text-red-600" v-if="errors.priority_id">El asunto es requerido</div>
            </select>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción de la reunión:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir reunión </button>
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
    meetings: Object,
    users: Object,
    priorities: Object,
    errors: Object,
  },
  emits: ['onFocus', 'submit'],
  data() {
    return {
      editor: ClassicEditor,
      editorData: '',
      editorConfig: {
        ckfinder: {
          uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
          openerMethod: 'popup',
        },
        language: 'es',
      },
      remember: 'form',
      form: this.$inertia.form({
        subjects: null,
        date: null,
        description: null,
        owner_id: null,
        priority_id: null,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('meetings.store'), this.form);
    },
  }
}

</script>
