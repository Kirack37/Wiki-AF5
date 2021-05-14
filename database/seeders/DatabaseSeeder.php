<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTypeSeeder::class,
            CompaniesSeeder::class,
            PrioritiesSeeder::class,
            UsersSeeder::class,
            ProjectsSeeder::class,
            HistoriesSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
        ]);
    }
}
