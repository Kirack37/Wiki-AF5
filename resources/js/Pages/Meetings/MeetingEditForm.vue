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
        <div class="mt-14">
          <h4 class="font-bold">Usuarios de la reunión</h4>
          <table id="datatable-users" class="pb-12 table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
            <thead>
              <tr role="row">
                <th class="check-all" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">
                  <input class="mr-4" type="checkbox" id="selectAll" name="selectAll"> Seleccionar todos
                </th>
                <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">Nombre</th>
                <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">Apellidos</th>
                <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">Tipo de usuario</th>   
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th rowspan="1" name="checkbox" colspan="1"></th>
                <th rowspan="1" name="firstname" colspan="1">Nombre</th>
                <th rowspan="1" name="lastname" colspan="1">Apellidos</th>
                <th rowspan="1" name="user_type" colspan="1">Tipo de usuario</th>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="flex">          
          <div class="flex-1 mt-8"> 
            <button class="bg-yellow-500 rounded p-4" type="submit"> Editar la reunión </button>
          </div>
          <div class="flex-end mt-12"> 
            <inertia-link class="bg-gray-200 rounded p-4" :href="route('meetings')">Volver atrás</inertia-link>
          </div>
        </div>
      </form>
    </div>
  </app-layout>
</template>

 


<script>

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import $ from 'jquery'; 

import AppLayout from '@/Layouts/AppLayout';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';




export default {
  
  mounted() {
    // axios.get('/meetings/data').then((result) => {
    //   console.log(result.data);
    //  
    // });
    let id = this.id;
    var table = $('#datatable-users').DataTable({
      ajax: '/meetings/data?id='+id,
      columnsDefs: [
        {defaultContent: ''},
        {className: 'select-checkbox'},
        {data: 'checkbox'},
        {data: 'firstname'},
        {data: 'lastname'},
        {data: 'user_type'},
      ],
      dom: 'Bfrtip',
      select: {
        style:    'os',
        selector: 'td:first-child',
        select: true,
      },
      responsive: true,
      language: {
          url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
          searchPlaceholder: "Buscar usuario",
      }
      });

      // //Checkboxes persistentes//

      $("form").on('submit', function(e){
            var $form = $(this);

            // Iteramos sobre todos los checkboxes de la tabla
            table.$('input[type="checkbox"]').each(function(){
                // En caso de que el checkbox no exista en el DOM por estar en otra página
                if(!$.contains(document, this)){
                    // Si el checkbox está seleccionado
                    if(this.checked){
                        // Se crea un elemento oculto
                        $form.append(
                        $('<input>')
                            .attr('type', 'hidden')
                            .attr('name', this.name)
                            .val(this.value)
                        );
                    }
                } 
            });          
        });

      // $("form").on('submit', function(e){
        

      //   var $form = $(this);

      //   // Iteramos sobre todos los checkboxes de la tabla
      //   table.$('.all_users').each(function(){
          
      //       // En caso de que el checkbox no exista en el DOM por estar en otra página
      //     if(!$.contains(document, this)){
            
      //       // Si el checkbox está seleccionado
      //       if(this.checked){
      //           // Se crea un elemento oculto
      //         $form.append(
      //           $('<input>')
      //               .attr('type', 'hidden')
      //               .attr('name', this.name)
      //               .val(this.value)
      //           );
      //         }
      //       } 
      //     });          
      //   });

        //Seleccionar todos los checkboxes
      
      $('#selectAll').change(function(){
        var cells = table.cells( ).nodes();
        $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
      });
  },
  name: 'app',       
  components: {
      AppLayout,
      ckeditor: CKEditor.component,
  },
  props: {
    meeting: Object,
    meetings_users: Array,
    priorities: Object,
    owners: Object,
    errors: Object,
    id: Number,
  },

  data() {

    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({
        subjects: this.meeting.subjects,
        all_users: this.tmp_all_users,
        date: this.meeting.date,
        description: this.meeting.description,
        owner_id: this.meeting.owner_id,
        priority_id: this.meeting.priority_id,
      }),
      
    };
  },
  methods: {  
    submit() {

    var tmp_all_users = new Array();

      $('.all_users:checked').each(function() {

        // if(!$.contains(document, this.form)){
        //   // Si el checkbox está seleccionado
        //   if ($('.all_users')){
        //       // Se crea un elemento oculto
        //       console.log("Checkbox hidden" + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
        //       tmp_all_users.push($(this).val());
        //     }
        //   } 
        console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
        tmp_all_users.push($(this).val());
      });
      console.log(tmp_all_users);
      this.form.all_users = tmp_all_users;
      this.$inertia.put(route("meetings.update", this.$props.meeting.id), this.form);
    },
  },
    
}

</script>
