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
            <label class="mr-12" for="message">Mensaje del log:</label >
            <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="message" v-model="form.message" />
            <div class="text-bold text-red-600" v-if="errors.message">El mensaje es necesario</div>
          </div>
        </div>
        <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Añadir log </button>
      </form>
    </div>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'


export default {
  name: 'app',       
  components: {
      AppLayout,
  },
  props: {
    logs: Object,
    meetings: Object,
    errors: Object,
  },
  emits: ['onFocus', 'submit'],
  data() {
    return {
      remember: 'form',
      form: this.$inertia.form({
        message: null,
        meeting_id: this.meetings[0].id,
      }),
    };
  },
  methods: {
    submit() {
      this.$inertia.post(route('logs.store', this.meetings[0].id), this.form);
    },
  }
}

</script>
