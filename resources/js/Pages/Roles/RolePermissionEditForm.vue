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
                  <h4 class="font-bold">Permisos del rol</h4>
                  <table id="datatable-permissions" class="pb-12 table table-striped table-no-bordered table-hover dataTable dtr-inline" cellspacing="0" width="100%" style="width: 100%;" role="grid" aria-describedby="datatables_info">
                    <thead>
                      <tr role="row">
                        <th class="check-all" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">
                          <input class="mr-4" type="checkbox" id="selectAll" name="selectAll"> Seleccionar todos
                        </th>
                        <th class="sorting_asc" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">Nombre</th>
                        <th class="sorting" tabindex="0" aria-controls="datatables" rowspan="1" colspan="1">Descripción</th>  
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th rowspan="1" name="checkbox" colspan="1"></th>
                        <th rowspan="1" name="id" colspan="1">ID</th>
                        <th rowspan="1" name="firstname" colspan="1">Nombre</th>
                        <th rowspan="1" name="description" colspan="1">Descripción</th>

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
     var table = $('#datatable-permissions').DataTable({
        ajax: '/roles/datapermissions?id='+id,
        columnsDefs: [
          {defaultContent: ''},
          {className: 'select-checkbox'},
          {data: 'checkbox'},
          {data: 'id'},
          {data: 'name'},
          {data: 'description'},
        ],
        select: {
          style:    'os',
          selector: 'td:first-child'
        },
        responsive: true,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
            searchPlaceholder: "Buscar permiso",
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
    permissions: Array,
    id: Number,
    errors: Object,
  },
  data() {
    return {
      form: this.$inertia.form({ 
        permissions: this.tmp_permissions,
      }),
      
    };
  },
  methods: {
    submit() {
      var tmp_permissions= new Array();

      if(!$.contains(document, this)){
        $('.permissions:checked').each(function() {
          console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") Seleccionado");
          tmp_permissions.push($(this).val());
        });
        console.log(tmp_permissions);
        this.form.permissions = tmp_permissions;
        this.$inertia.put(route("roles.updatepermissions", this.$props.role.id), this.form);
      };
    },
  }
}
</script>
