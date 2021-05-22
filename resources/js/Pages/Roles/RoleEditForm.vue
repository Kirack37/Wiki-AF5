<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{role.name}}
        </h2>
    </template>
      <div class="container mx-auto my-10 bg-white">
        <form @submit.prevent="submit">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <label class="mr-12" for="name">Nombre del rol:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
            <div v-if="errors.name">El Nombre es necesario</div>
          </div>
           <div class="flex-1">
            <label class="mr-12" for="name">Slug del rol:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="slug" v-model="form.slug" />
            <div v-if="errors.name">El slug es necesario</div>
          </div>
        </div>
        <div class="mt-14">
          <label for="description">Descripción del rol:</label>
          <div id="app" class="mt-4">
            <ckeditor id="description" v-model="form.description" tag-name="textarea" 
              :editor="editor"
              :config="editorConfig"
              >
            </ckeditor>
          </div>
        </div>
        <div class="flex">          
          <div class="flex-1 mt-8"> 
            <button class="bg-yellow-500 rounded p-4" type="submit"> Editar el rol </button>
          </div>
          <div class="flex-end mt-12"> 
            <inertia-link class="bg-gray-200 rounded p-4" :href="route('roles')">Volver atrás</inertia-link>
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
    role: Object,
    id: Number,
    errors: Object,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
        language: 'es'
      },
      form: this.$inertia.form({ 
        name: this.role.name,
        slug: this.role.slug,
        description: this.role.description,
        all_users: this.tmp_all_users,
        permissions: this.tmp_permissions,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(route("roles.update", this.$props.role.id), this.form);
    },
  }
}

</script>
