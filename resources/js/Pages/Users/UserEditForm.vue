<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{currentUser.firstname}} {{currentUser.lastname}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
        <form @submit.prevent="submit">
            <div>
                <jet-label for="firstname" value="Nombre" />
                <jet-input id="firstname" type="text" class="mt-1 block w-full" v-model="form.firstname" required autofocus autocomplete="firstname" />
            </div>
            <div class="mt-4">
                <jet-label for="lastname" value="Apellidos" />
                <jet-input id="lastname" type="text" class="mt-1 block w-full" v-model="form.lastname" required autofocus autocomplete="lastname" />
            </div>
            <div class="mt-4">
                <jet-label for="username" value="Nombre de usuario" />
                <jet-input id="username" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
            </div>
            <div class="mt-4">  
                <jet-label for="user_type_id" value="Tipo de usuario" />
                <select class="mt-1 relative px-6 py-3 w-50 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="user_type_id" v-model="form.user_type_id">
                    <option id="usersType" v-for="user_type in user_type" :key="user_type.id" :value="user_type.id" data-id="user_type_id">{{ user_type.name }} </option>
                </select>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar usuario </button>
            </div>
        </form>
      </div>
  </app-layout>
</template>

<script>

import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetCheckbox from "@/Jetstream/Checkbox";
import JetLabel from '@/Jetstream/Label'
import JetValidationErrors from '@/Jetstream/ValidationErrors'

import AppLayout from '@/Layouts/AppLayout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';

export default {

  name: 'app',       
  components: {
      AppLayout,
      ckeditor: CKEditor.component,
      JetAuthenticationCard,
      JetAuthenticationCardLogo,
      JetButton,
      JetInput,
      JetCheckbox,
      JetLabel,
      JetValidationErrors
  },
  props: {
    currentUser: Object,
    user_type: Object,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({ 
        name: this.currentUser.name,
        firstname: this.currentUser.firstname,
        lastname: this.currentUser.lastname,
        user_type_id: this.currentUser.user_type_id,
        email: this.currentUser.email,
      }),
      
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("wikiusers.update", this.$props.currentUser.id),
        this.form
      );
    },
  }
}

</script>
