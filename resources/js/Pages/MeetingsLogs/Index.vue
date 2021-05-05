<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Logs de {{meetings[0].id}}
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
        <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()"></search>
        <inertia-link class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-3 bg-yellow-600 text-white" :href="'logs/create'">Crear un nuevo log</inertia-link>
      </div>
      <div class="recent-items">
        <div class="recent-items-titles bg-white p-3 flex mb-2">
          <div class="item-title flex-1"><h3 class="text-gray-600">Mensaje del log</h3></div>
          <div class="item-title flex-1"><h3 class="text-gray-600">Fecha del log</h3></div>
          <!-- <div class="item-title flex-1"><h3 class="text-gray-600">Creador del log</h3></div> -->
          <div class="item-title flex-initial mr-24 ml-28"><h3 class="text-gray-600">Acciones</h3></div>
        </div>
        <div v-for="log in logs" :key="log.id" class="item-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="item-data flex-1">
            <h4>{{ log.message }}</h4>
          </div>
          <div class="item-data flex-1">
            <p>{{ moment(log.created_at).format("DD-MM-YYYY") }}</p>
          </div>
          <!-- <div class="item-data flex-1">
            <p>{{ log.users.firstname }} {{ log.users.lastname }}</p>
          </div> -->
          <div class="item-data mr-12">
            
            <!-- <inertia-link class="inside-item text-yellow-600" :href="route('meetings.show', meeting.id)">
              <font-awesome-icon :icon="['fas', 'eye']" size="lg" />
            </inertia-link> -->

          </div>
          <div class="item-data mr-12">
            <inertia-link
              class="inside-item text-blue-600"
              method="get"
              as="button"
              :href="route('logs.edit', [meetings[0].id, log.id])">
              <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
            </inertia-link>
          </div>
          <div class="item-data mr-12">
            <button class="text-red-600" @click="doDelete(log.id)">
              <font-awesome-icon :icon="['fas', 'trash']" size="lg" />
            </button>
            <confirm-dialogue ref="confirmDialogue"></confirm-dialogue>
          </div>
        </div>
      </div>
      <Paginator :paginator="paginator" />
    </div>
  </app-layout>
</template>

<script>

import AppLayout from '@/Layouts/AppLayout'
import { reactive } from "vue";

import moment from "moment";

import Search from '@/Shared/Search'
import ConfirmDialogue from '@/Shared/ConfirmDialogue.vue'
import MiddleModal from '../../Shared/MiddleModal.vue';
import Paginator from "@/Shared/Paginator";
import FlashMessages from '@/Shared/FlashMessages'

export default {
        
  metaInfo: { 
      title: 'Logs' 
  },
  
  components: {
      AppLayout,
      Search,
      ConfirmDialogue,
      Paginator,
      FlashMessages,
      MiddleModal
  },
  props: {
    logs: Object,
    meetings: Object,
    term: String,
    paginator: Object
  },
  data() {
    return {
  
      moment: moment
      }    
  },
  setup () {
    let searching = reactive({
      
      term: ''
    })
    return { searching }
  },

  methods: {
    
    resetQuery() {
      this.$inertia.replace(this.route('logs.index', [this.meetings[0].id, '']))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {
      this.$inertia.replace(this.route('logs.index', {meetings: this.meetings[0].id}, {term:this.term}))
      
    },
    async doDelete(log) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar proyecto',
          message: 'Confirma que deseas borrar este log. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('logs.destroy', [log, this.meetings[0].id]));
      } 
    },
  },
};
</script>