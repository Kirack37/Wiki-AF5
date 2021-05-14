<?php

namespace Database\Seeders;

use App\Models\WikiAf5Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = WikiAf5Company::where('name', 'Área F5')->first();
        if(!isset($exists)){

            $company = new WikiAf5Company;
            $company->name = 'Área F5';
            $company->description = 'Área F5';
            $company->status = '1';
            $company->save();
        }

        $exists = WikiAf5Company::where('name', 'RK')->first();
        if(!isset($exists)){

            $company = new WikiAf5Company;
            $company->name = 'RK';
            $company->description = 'RK';
            $company->status = '1';
            $company->save();
        }

        $exists = WikiAf5Company::where('name', 'SIDN')->first();
        if(!isset($exists)){

            $company = new WikiAf5Company;
            $company->name = 'SIDN';
            $company->description = 'SIDN';
            $company->status = '1';
            $company->save();
        }
    }
}
