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
        // \App\Models\User::factory(10)->create();
        $this->call([
            wiki_af5_users_typeSeeder::class,
            wiki_af5_companySeeder::class,
            usersSeeder::class,
            wiki_af5_permissionsSeeder::class,
            wiki_af5_entitiessSeeder::class,
            wiki_af5_projectsSeeder::class
        ]);
    }
}
