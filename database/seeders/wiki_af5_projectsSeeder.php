<?php

namespace Database\Seeders;

use App\Models\WikiAf5Projects;
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
        // DB::table('wiki_af5_projects')->insert([
            WikiAf5Projects::factory(30)->create();   
        
        // ]);
    }
}
