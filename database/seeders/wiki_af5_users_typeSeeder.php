<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class wiki_af5_users_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_users_type')->insert([
            [
                'name' => 'Empleado',
                'description' => 'Empleado de Área F5',
                'status' => '1',
            ], [
                'name' => 'Cliente',
                'description' => 'Cliente de Área F5',
                'status' => '1',
            ], [
                'name' => 'Trabajador Externo',
                'description' => 'Trabajador de empresa externa',
                'status' => '1',
            ]
        ]);
    }
}
