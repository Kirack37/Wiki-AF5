<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class wiki_af5_permissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_permissions')->insert([
            
            ['name' => 'Crear',
            'slug' => 'CREATE',  
            'description' => 'Poder crear posts',
            ],
            ['name' => 'Leer',
            'slug' => 'READ',  
            'description' => 'Poder crear posts',
            ],
            ['name' => 'Editar',
            'slug' => 'UPDATE',  
            'description' => 'Poder crear posts',
            ],
            ['name' => 'Delete',
            'slug' => 'DELETE',  
            'description' => 'Poder crear posts',
            ]
        ]);
    }
}
