<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{meetings[0].subjects}}
        </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="subjects">Estado del acta:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="subjects" v-model="form.aprobbed" />
            <div class="text-bold text-red-600" v-if="errors.aprobbed">El asunto es requerido</div>
          </div>
          <div class="flex-1">
            <label class="mr-4" for="responsible">Aprobación del acta:</label>
            <div class="form-group custom-control custom-radio" v-for="(publication, index) in publication" :key="index">
              <input type="radio" class="custom-control-input mr-2" :name="publication.name" :value="publication.name" v-model="form.publication" :id="publication.name">
              <label class="custom-control-label" :for="publication.name">{{ publication.name }}</label>
            </div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción del acta:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.description">La descripción es requerida</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir acta </button>
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
    notes: Object,
    meetings: Object,
    errors: Object,
  },
  emits: ['onFocus', 'submit'],
  data() {
    return {
      publication: [{name: 'Borrador'}, {name: 'Publicado'} , {name: 'Denegado'}],
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
        aprobbed: '0',
        description: null,
        publication: null,
        user_id: this.user_id,
        meeting_id: this.meetings[0].id,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('reports.store', this.meetings[0].id), this.form);
    },
  }
}

</script>
