<template>
  <app-layout>
    <template #header>
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{role.name}}
        </h2>
    </template>
      <div class="container mx-auto my-10 bg-white">
          <p>hola</p>
        <form @submit.prevent="submit">
            <div class="mb-8">
                <div class="mt-14">
                    <h4 class="font-bold">Usuarios del rol</h4>
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

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables"
import "datatables.net-dt/css/jquery.dataTables.min.css"
import $ from 'jquery'; 

import AppLayout from '@/Layouts/AppLayout'


export default {

  mounted() {

    let id = this.id;
    var table = $('#datatable-users').DataTable({
        ajax: '/roles/datausers?id='+id,
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
  },
  props: {
    role: Object,
    all_users: Array,
    id: Number,
    errors: Object,
  },
  data() {
    return {
      form: this.$inertia.form({ 
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
        this.form.all_users = tmp_all_users;
        this.$inertia.put(route("roles.updateusers", this.$props.role.id), this.form);
      };
    },
  }
}
</script>
