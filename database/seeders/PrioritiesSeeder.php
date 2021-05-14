<?php

namespace Database\Seeders;

use App\Models\WikiAf5Priorities;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $exists = WikiAf5Priorities::where('level', 'baja')->first();
        if(!isset($exists)){

            $priority = new WikiAf5Priorities;
            $priority->level = 'baja';
            $priority->save();
        }

        $exists = WikiAf5Priorities::where('level', 'media')->first();
        if(!isset($exists)){
            
            $priority = new WikiAf5Priorities;
            $priority->level = 'media';
            $priority->save();
        }

        $exists = WikiAf5Priorities::where('level', 'alta')->first();
        if(!isset($exists)){
            
            $priority = new WikiAf5Priorities;
            $priority->level = 'alta';
            $priority->save();
        }
    }
}
