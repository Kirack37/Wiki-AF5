<?php

namespace Database\Seeders;

use App\Models\WikiAf5Permission;
use Illuminate\Database\Seeder;
use App\Models\WikiAf5Role;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = WikiAf5Role::where('slug', 'superadmin')->first();
        if(!isset($exists)){
            $role = new WikiAf5Role;
            $role->name = 'Super Administrador';
            $role->slug = 'superadmin';
            $role->description = 'Superadministrador del sistema, tiene todos los permisos.';
            $role->save();
        }else{
            $role = WikiAf5Role::where('slug', 'superadmin')->first();
        }

        $actions = WikiAf5Permission::get();

        foreach($actions as $action){
            $exists = DB::table('wiki_af5_roles_permissions')->where('role_id', $role->id)->where('permission_id', $action->id)->first();
            if(!isset($exists)){
                DB::table('wiki_af5_roles_permissions')->insert([
                    'role_id' => $role->id,
                    'permission_id' => $action->id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
