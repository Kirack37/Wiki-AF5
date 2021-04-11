<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        [   
            'user_type_id' => '2',
            'company_id' => '1',  
            'name' => 'EjemploAF5',
            'firstname' => 'Ejemplo',
            'lastname' => 'Prueba',
            'email' => 'ejemplocliente@gmail.com',
            'password' => bcrypt('12346578'),
            'status' => '1'
        ],
        [
            'user_type_id' => '1',
            'company_id' => '1',  
            'name' => 'EjemploAF52',
            'firstname' => 'Ejemplo2',
            'lastname' => 'Prueba2',
            'email' => 'ejemplo2@gmail.com',
            'password' => bcrypt('12346578'),
            'status' => '1'
        ],
        [
            'user_type_id' => '2',
            'company_id' => '1',  
            'name' => 'Ricardo',
            'firstname' => 'Ricardo',
            'lastname' => 'González',
            'email' => 'ricardog@gmail.com',
            'password' => bcrypt('12346578'),
            'status' => '1'
        ],
        [
            'user_type_id' => '3',
            'company_id' => '1',  
            'name' => 'Pepa',
            'firstname' => 'Pepa',
            'lastname' => 'Pepa López',
            'email' => 'pepa@gmail.com',
            'password' => bcrypt('12346578'),
            'status' => '1'
        ]
    ]);
    }
}
