<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            Proyectos
        </h2>
    </template>
    <div class="container mx-auto my-10">
      <flash-messages />
      <div class="select-stuff mb-20 flex">
        <search id="search" class="w-full max-w-md mr-10"  v-model:search="term" @keyup="searchFor" @click="resetQuery()"></search>
        <inertia-link class="flex-none ml-auto border-2 border-double rounded border-gray-100 p-3 bg-yellow-600 text-white" :href="'meetings/create'">Crear una nueva reunión</inertia-link>
      </div>
      <div class="recent-items">
        <div class="recent-items-titles bg-white p-3 flex mb-2">
          <div class="item-title flex-1"><h3 class="text-gray-600">Asunto de la reunión</h3></div>
          <div class="item-title flex-1"><h3 class="text-gray-600">Fecha de la reunión</h3></div>
          <div class="item-title flex-1 mr-10"><h3 class="text-gray-600">Organizador/a de la reunión</h3></div>
          <div class="item-title flex-1 mr-10"><h3 class="text-gray-600 ml-16 pl-2">Acta de la reunión</h3></div>
          <div class="item-title flex-initial mr-24 ml-28"><h3 class="text-gray-600">Acciones</h3></div>
        </div>
        <div v-for="meeting in meetings" :key="meeting.id" class="item-card flex border-2 rounded border-double border-gray-300 mb-3 p-3 bg-white">
          <div class="item-data flex-1">
            <h4>{{ meeting.subjects }}</h4>
          </div>
          <div class="item-data flex-1">
            <p>{{ moment(meeting.date).format("DD-MM-YYYY") }}</p>
          </div>
          <div class="item-data flex-1">
            <p>{{ meeting.owner.firstname }} {{ meeting.owner.lastname }}</p>
          </div>
           <div class="item-data flex-1">
            <p v-if="meeting.status == 0">Pendiente de aprobar</p>
            <p v-if="meeting.status == 1">Acta aprobada</p>
          </div>
          <div class="item-data mr-12">
            
            <inertia-link class="inside-item text-yellow-600" :href="route('meetings.show', meeting.id)">
              <font-awesome-icon :icon="['fas', 'eye']" size="lg" />
            </inertia-link>

          </div>
          <div class="item-data mr-12">
            <inertia-link
              class="inside-item text-blue-600"
              method="get"
              as="button"
              :href="route('meetings.edit', meeting.id)">
              <font-awesome-icon :icon="['fas', 'edit']" size="lg" />
            </inertia-link>
          </div>
          <div class="item-data mr-12">
            <button class="text-red-600" @click="doDelete(meeting.id)">
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
      title: 'Meetings' 
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
      this.$inertia.replace(this.route('meetings', ''))
      var inputs = document.getElementsByTagName('input');
      for (var i=0 ; i < inputs.length ; i++){
        if (inputs[i].type == "text"){
            inputs[i].value = "";
        }
      }
    },
    searchFor() {
      this.$inertia.replace(this.route('meetings', {term:this.term}))
      
    },
    async doDelete(meeting) {
      const ok = await this.$refs.confirmDialogue.show({
          title: 'Eliminar proyecto',
          message: 'Confirma que deseas borrar esta reunión. Esta acción no puede deshacerse.',
          okButton: 'Eliminar',
      })
      if (ok) {
          this.$inertia.delete(this.route('meetings.destroy', meeting));
      } 
    },
  },
};
</script>