<?php

namespace Database\Seeders;

use App\Models\WikiAf5RoleUser;
use Illuminate\Database\Seeder;

class RolesUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = WikiAf5RoleUser::where('user_id', '1')->first();
        if(!isset($exists)){
            
            $roleuser = new WikiAf5RoleUser;
            $roleuser->role_id = '1';
            $roleuser->user_id = '1';
            $roleuser->save();
        }
    }
}
