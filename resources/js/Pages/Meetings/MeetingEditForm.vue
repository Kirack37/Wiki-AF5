<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{meeting.name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="subjects">Asunto de la reunión:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="subject" v-model="form.subjects" />
          </div>
          <div class="flex-1">
            <label class="mr-8" for="alias">Fecha de la reunión:</label>
            <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="date" v-model="form.date"/>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-4" for="owner">Organizador de la reunión:</label>
            <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="responsible_id" v-model="form.owner_id">
                <option v-for="owner in owners" :key="owner.id" :value="owner.id">{{owner.firstname}} {{owner.lastname}}</option>
            </select>
          </div>
          <div class="flex-1">
            <label class="mr-6" for="priority">Prioridad de la reunión:</label>
            <select class="relative px-6 py-3 w-32 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="priority_id" v-model="form.priority_id">
                <option id="priority_id" v-for="priority in priorities" :key="priority.id" :value="priority.id" data-id="priority.id">{{ priority.level }} </option>
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
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar la reunión </button>
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
    priorities: Object,
    owners: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        subjects: this.meeting.subjects,
        date: this.meeting.date,
        description: this.meeting.description,
        owner_id: this.meeting.owner_id,
        priority_id: this.meeting.priority_id,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("meetings.update", this.$props.meeting.id),
        this.form
      );
    },
  }
}

</script>
