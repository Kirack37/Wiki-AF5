<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class wiki_af5_entitiessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_entities')->insert([
            
            ['name' => 'Home',
            'slug' => 'HOME',  
            'description' => 'Acceso a la home',
            ],
            ['name' => 'Clientes',
            'slug' => 'CLIENTS',  
            'description' => 'Acceso a la página "Clientes"',
            ],
            ['name' => 'Notas',
            'slug' => 'NOTES',  
            'description' => 'Acceso a la página de "Notas"',
            ],
            ['name' => 'Proyectos',
            'slug' => 'PROJECTS',  
            'description' => 'Acceso a los proyectos',
            ],
            ['name' => 'Trabajadores Externos',
            'slug' => 'External_Workers',  
            'description' => 'Acceso a la página "Trajadores Externos"',
            ]
        ]);
    }
}
