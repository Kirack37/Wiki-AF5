<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WikiAf5ProjectsHistory;

class HistoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WikiAf5ProjectsHistory::factory(30)->create();   
    }
}
