<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{project.name}}
        </h2>
    </template>
        <div class="container mx-auto my-10 bg-white">
          <form @submit.prevent="submit">
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-12" for="name">Nombre del proyecto:</label >
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="name" v-model="form.name" />
                <div v-if="errors.name">El Nombre es necesario</div>
              </div>
              <div class="flex-1">
                <label class="mr-8" for="alias">Alias en el proyecto:</label>
                <input type="text" class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="alias" v-model="form.alias"/>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-4" for="responsible">Responsable del proyecto:</label>
                <select class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="responsible_id" v-model="form.responsible_id">
                    <option v-for="responsible in responsibles" :key="responsible.id" :value="responsible.id">{{responsible.firstname}} {{responsible.lastname}}</option>
                </select>
              </div>
              <div class="flex-1">
                <label class="mr-6" for="priority">Prioridad del proyecto:</label>
                <select class="relative px-6 py-3 w-32 rounded focus:outline-none focus:ring focus:ring-yellow-600" id="priority_id" v-model="form.priority_id">
                    <option id="priority_id" v-for="priority in priorities" :key="priority.id" :value="priority.id" data-id="priority.id">{{ priority.level }} </option>
                </select>
              </div>
            </div>
            <div class="flex items-center mb-8">
              <div class="flex-1">
                <label class="mr-24" for="start_date">Fecha de inicio:</label>
                <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="start_date" v-model="form.start_date"/>
                <div v-if="errors.start_date">La fecha inicial es necesaria</div>
              </div>
              <div class="flex-1">
                <label class="mr-10" for="end_date">Fecha final prevista:</label>
                <input class="relative px-6 py-3 rounded focus:outline-none focus:ring focus:ring-yellow-600" type="date" id="end_date" v-model="form.end_date"/>
              </div>
            </div>
            <div class="mt-14">
              <label for="description">Descripción del proyecto:</label>
              <div id="app" class="mt-4">
                <ckeditor id="description" v-model="form.description" tag-name="textarea" 
                  :editor="editor"
                  :config="editorConfig"
                  >
                </ckeditor>
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
          <button class="bg-yellow-500 rounded p-4 mt-8" type="submit"> Editar el proyecto </button>
          </form>
      </div>
  </app-layout>
</template>

<script>

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import $ from 'jquery'; 

import AppLayout from '@/Layouts/AppLayout'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import CKEditor from '@ckeditor/ckeditor5-vue';

export default {

  mounted() {

    let id = this.id;
    var table = $('#datatable-users').DataTable({
        ajax: '/projects/data?id='+id,
        columnsDefs: [
          {defaultContent: ''},
          {className: 'select-checkbox'},
          {data: 'checkbox'},
          {data: 'firstname'},
          {data: 'lastname'},
          {data: 'user_type'},
        ],
        select: {
          style:    'os',
          selector: 'td:first-child'
        },
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            searchPlaceholder: "Buscar usuario",
        }
      });

      //Seleccionar todos los checkboxes
      
      $('#selectAll').change(function(){
        var cells = table.cells( ).nodes();
        $( cells ).find(':checkbox').prop('checked', $(this).is(':checked'));
      });
  },
  name: 'app',       
  components: {
      AppLayout,
      ckeditor: CKEditor.component
  },
  props: {
    project: Object,
    all_users: Array,
    priorities: Object,
    responsibles: Object,
    id: Number,
    errors: Object
  },
  data() {
    return {
      editor: ClassicEditor,
      editorConfig: {
          language: 'es'
      },
      form: this.$inertia.form({ 
        name: this.project.name,
        start_date: this.project.start_date,
        end_date: this.project.end_date,
        alias: this.project.alias,
        description: this.project.description,
        responsible_id: this.project.responsible_id,
        priority_id: this.project.priority_id,
        all_users: this.tmp_all_users,
      }),
      
    };
  },
  methods: {
    submit() {
      var tmp_all_users= new Array();
      if(!$.contains(document, this)){
        $('.all_users:checked').each(function() {
          console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
          tmp_all_users.push($(this).val());
        });
        console.log(tmp_all_users);
        this.form.all_users = tmp_all_users;
        this.$inertia.put(
          route("projects.update", this.$props.project.id),
          this.form
        );
      };
    },
  }
}

</script>
