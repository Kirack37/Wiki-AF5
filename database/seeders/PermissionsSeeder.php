<?php

namespace Database\Seeders;

use App\Models\WikiAf5Permission;
use Illuminate\Database\Seeder;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slug_action = 'listado_';
        $slug_action = 'carga_form_creacion_';
        $slug_action = 'guardar_form_creacion_';
        $slug_action = 'carga_vista_';
        $slug_action = 'carga_form_edicion_';
        $slug_action = 'guardar_form_edicion_';
        $slug_action = 'eliminar_';


        $exists = WikiAf5Permission::where('slug', 'listado_notas_personales')->first();
        if(!isset($exists)){
            $action = new WikiAf5Permission;
            $action->name = 'Listado de notas personales';
            $action->slug = 'listado_notas_personales';
            $action->description = 'Carga la vista del listado de notas personales (personalnotes.index)';
            $action->save();
        }
    }
}
