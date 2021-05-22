<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-white leading-tight">
          {{meeting[0].subjects}}
      </h2>
    </template>
    <div class="container mx-auto my-10 bg-white">
      <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="subjects">Asunto de la nota:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="subjects" v-model="form.subjects" />
            <div class="text-bold text-red-600" v-if="errors.subjects">El asunto es necesario</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción de la nota:</label>
          <div id="app" class="mt-4">
            <ckeditor id="notes" v-model="form.notes" tag-name="textarea" 
            :editor="editor"
            :config="editorConfig"
            ></ckeditor>
            <div v-if="errors.notes">La descripción es necesaria</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar nota </button>
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
    meeting: Object,
    note: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        subjects: this.note.subjects,
        notes: this.note.notes,
        meeting_id: this.meeting[0].id,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("meetingnotes.update",[this.meeting[0].id, this.$props.note.id]),this.form);
    },
  }
}

</script>
