<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class wiki_af5_projectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_projects')->insert([
            
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 1 para la Wiki de Área F5.',
                'name' => 'Prueba 1',
                'alias' => 'P1',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 2 para la Wiki de Área F5.',
                'name' => 'Otra prueba',
                'alias' => 'P2',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 3 para la Wiki de Área F5.',
                'name' => 'Una más',
                'alias' => 'P3',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 4 para la Wiki de Área F5.',
                'name' => 'Ejemplo',
                'alias' => 'P4',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 5 para la Wiki de Área F5.',
                'name' => 'Registro nuevo',
                'alias' => 'P5',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 6 para la Wiki de Área F5.',
                'name' => 'Para paginar',
                'alias' => 'P6',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 7 para la Wiki de Área F5.',
                'name' => 'Prueba 7',
                'alias' => 'P7',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 8 para la Wiki de Área F5.',
                'name' => 'Prueba 8',
                'alias' => 'P8',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 9 para la Wiki de Área F5.',
                'name' => 'Prueba 9',
                'alias' => 'P9',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 10 para la Wiki de Área F5.',
                'name' => 'Prueba 10',
                'alias' => 'P10',
            ],
            [
                'responsible_id' => '1',
                'priority_id' => '2', 
                'start_date' => Carbon::today(),
                'description' => 'Proyecto de prueba 11 para la Wiki de Área F5.',
                'name' => 'Último',
                'alias' => 'P10',
            ]
        ]);
    }
}
