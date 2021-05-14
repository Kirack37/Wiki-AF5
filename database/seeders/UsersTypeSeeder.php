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
            
            $userType = new WikiAf5UsersType;
            $userType->name = 'Empleado';
            $userType->description = 'Empleado de Área F5';
            $userType->status = '1';
            $userType->save();
        }

        $exists = WikiAf5UsersType::where('name', 'Cliente')->first();
        if(!isset($exists)){
            
            $userType = new WikiAf5UsersType;
            $userType->name = 'Cliente';
            $userType->description = 'Cliente de Área F5';
            $userType->status = '1';
            $userType->save();
        }

        $exists = WikiAf5UsersType::where('name', 'Trabajador Externo')->first();
        if(!isset($exists)){
            
            $userType = new WikiAf5UsersType;
            $userType->name = 'Trabajador Externo';
            $userType->description = 'Trabajador de empresa externa';
            $userType->status = '1';
            $userType->save();
        }
    }
}
