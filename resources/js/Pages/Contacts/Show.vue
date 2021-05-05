<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-white leading-tight">
          {{users[0].firstname}} {{users[0].lastname}}
      </h2>
    </template>
    <main class="items-show bg-white">
      <div class="container mx-auto my-10">
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="mr-12 inline-block">Nombre del cliente:</h3> <p class="inline-block text-black">{{users[0].firstname}} {{users[0].lastname}}</p>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="inline-block mr-4">Nombre de la empresa:</h3> <p class="inline-block text-black">{{ companies[0].name }}</p>
          </div>
          <div class="flex-1">
            <h3 class="inline-block mr-6">Anotaciones positivas:</h3><p class="inline-block text-black">{{client.strengths}}</p>
          </div>
        </div>
        <div class="flex items-center mb-8">
          <div class="flex-1">
            <h3 class="mr-24 inline-block">Anotaciones negativas:</h3> <p class="inline-block text-black">{{client.weaknesses}}</p>
          </div>
        </div>
        <!-- <div class="flex items-center mb-14">
          <div class="flex-1">
            <inertia-link class="bg-blue-400 rounded p-4 mt-8" :href="route('contact.index', users.id)">Contacto del cliente</inertia-link>
          </div>
        </div> -->
        <div class="item-attribute mt-14">
          <h3 class="inline-block mb-4">Notas de los clientes:</h3>
          <ckeditor
            class="text-black"
            id="notes" 
            tag-name="textarea" 
            v-model="editorData" 
            :disabled="true"
            @ready="onReady"
            :editor="editor"
            :config="editorConfig" >  
          </ckeditor>
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
    companies: Object,
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
