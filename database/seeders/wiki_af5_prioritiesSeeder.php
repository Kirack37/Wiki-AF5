<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class wiki_af5_prioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wiki_af5_priorities')->insert([
            [
                'level' => 'baja',
            ], [
                'level' => 'media',
            ], [
                'level' => 'alta',
            ]
        ]);
    }
}
