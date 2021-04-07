<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class wiki_af5_companySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_company')->insert([
            [
                'name' => 'Área F5',
                'description' => 'Área F5',
                'status' => '1',
            ], [
                'name' => 'RK',
                'description' => 'Empresa RK',
                'status' => '1',
            ], [
                'name' => 'SIDN',
                'description' => 'Empresa SIDN',
                'status' => '1',
            ]
        ]);
    }
}
