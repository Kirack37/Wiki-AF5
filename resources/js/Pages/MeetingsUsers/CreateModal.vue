<template>
  Crear modal
</template>

<script>

// import AppLayout from '@/Layouts/AppLayout'
// import { reactive } from "vue";

// import moment from "moment";

// import Search from '@/Shared/Search'
// import ConfirmDialogue from '@/Shared/ConfirmDialogue.vue'
// import MiddleModal from '../../Shared/MiddleModal.vue';
// import Paginator from "@/Shared/Paginator";
// import FlashMessages from '@/Shared/FlashMessages'

// export default {
        
//   metaInfo: { 
//       title: 'Logs' 
//   },
  
//   components: {
//       AppLayout,
//       Search,
//       ConfirmDialogue,
//       Paginator,
//       FlashMessages,
//       MiddleModal
//   },
//   props: {
//     logs: Object,
//     meetings: Object,
//     term: String,
//     paginator: Object
//   },
//   data() {
//     return {
  
//       moment: moment
//       }    
//   },
//   setup () {
//     let searching = reactive({
      
//       term: ''
//     })
//     return { searching }
//   },

//   methods: {
    
//     resetQuery() {
//       this.$inertia.replace(this.route('logs.index', [this.meetings[0].id, '']))
//       var inputs = document.getElementsByTagName('input');
//       for (var i=0 ; i < inputs.length ; i++){
//         if (inputs[i].type == "text"){
//             inputs[i].value = "";
//         }
//       }
//     },
//     searchFor() {
//       this.$inertia.replace(this.route('logs.index', {meetings: this.meetings[0].id}, {term:this.term}))
      
//     },
//     async doDelete(log) {
//       const ok = await this.$refs.confirmDialogue.show({
//           title: 'Eliminar proyecto',
//           message: 'Confirma que deseas borrar este log. Esta acción no puede deshacerse.',
//           okButton: 'Eliminar',
//       })
//       if (ok) {
//           this.$inertia.delete(this.route('log.destroy', [log, this.meetings[0].id]));
//       } 
//     },
//   },
// };
</script>