<?php

namespace Database\Seeders;

use App\Models\WikiAf5UsersType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = WikiAf5UsersType::where('name', 'Empleado')->first();
        if(!isset($exists)){
            
            $user_type = new WikiAf5UsersType;
            $user_type->name = 'Empleado';
            $user_type->description = 'Empleado de Área F5';
            $user_type->status = '1';
            $user_type->save();
        }

        $exists = WikiAf5UsersType::where('name', 'Cliente')->first();
        if(!isset($exists)){
            
            $user_type = new WikiAf5UsersType;
            $user_type->name = 'Cliente';
            $user_type->description = 'Cliente de Área F5';
            $user_type->status = '1';
            $user_type->save();
        }

        $exists = WikiAf5UsersType::where('name', 'Trabajador Externo')->first();
        if(!isset($exists)){
            
            $user_type = new WikiAf5UsersType;
            $user_type->name = 'Trabajador Externo';
            $user_type->description = 'Trabajador de empresa externa';
            $user_type->status = '1';
            $user_type->save();
        }
    }
}
