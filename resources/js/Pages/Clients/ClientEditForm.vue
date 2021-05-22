<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Edición de cliente
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="subjects">Nombre del cliente:</label >
                <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="user_id" v-model="form.user_id">
                    <option v-for="user in users" :key="user.id" :value="user.id">{{user.firstname}} {{user.lastname}}</option>
                    <div class="text-bold text-red-600" v-if="errors.client_id">El nombre es necesario</div>
                </select>
              </div>
              <div class="flex-1">
                <label class="mr-8" for="alias">Nombre de la empresa:</label>
                <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="company_id" v-model="form.company_id">
                    <option v-for="company in companies" :key="company.id" :value="company.id">{{company.name}}</option>
                    <div class="text-bold text-red-600" v-if="errors.company_id">La empresa es necesaria</div>
                </select>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-4" for="owner">Anotaciones positivas:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="strengths" v-model="form.strengths" />
              </div>
              <div class="flex-1">
                <label class="mr-6" for="priority">Anotaciones negativas:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="weaknesses" v-model="form.weaknesses" />
              </div>
            </div>
            <div class="mt-14">
              <label for="notes">Notas sobre el cliente:</label>
              <div id="app" class="mt-4">
                <ckeditor id="notes" v-model="form.notes" tag-name="textarea" 
                :editor="editor"
                :config="editorConfig"
                ></ckeditor>
              </div>
          </div>
          <div class="flex">          
            <div class="flex-1 mt-8"> 
              <button class="bg-yellow-500 rounded p-4" type="submit"> Editar la empresa </button>
            </div>
            <div class="flex-end mt-12"> 
              <inertia-link class="bg-gray-200 rounded p-4" :href="route('clients')">Volver atrás</inertia-link>
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
    users: Object,
    companies: Object,
    client: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        user_id: this.client.user_id,
        company_id: this.client.company_id,
        strengths: this.client.strengths,
        weaknesses: this.client.weaknesses,
        notes: this.client.notes,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("clients.update", this.$props.client.id),
        this.form
      );
    },
  }
}

</script>
