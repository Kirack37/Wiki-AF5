<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-white leading-tight">
          {{users[0].firstname}} {{users[0].lastname}}
      </h2>
    </template>
    <main class="items-show bg-white">
      <div v-for="contact in contacts" :key="contact.id" :value="contact.id" class="container mx-auto my-10">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="mr-12 inline-block">Tipo del contacto:</h3> <p class="inline-block text-black">{{ contact.type }}</p>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="inline-block mr-4">Contacto:</h3> <p class="inline-block text-black">{{ contact.value }}</p>
          </div>
        </div>
        <button class="bg-gray-200 rounded p-4 mt-8"><a href="/clients">Volver a la página de clientes</a></button>
      </div>
    </main>
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
    client: Object,
    contacts: Object,
  },
  data() {
    return {
      editor: ClassicEditor,
      editorData: this.client.notes,
      editorConfig: {      
        editorDisabled: true,
        ckfinder: {
          uploadUrl: '/ckfinder/connector?command=QuickUpload&type=Images&responseType=json',
          openerMethod: 'popup',
        },
        language: 'es',
      },
    };
  },
}

</script>
