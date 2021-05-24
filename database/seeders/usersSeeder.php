<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $exists = User::where('name', 'Administradora')->first();
        if(!isset($exists)){
            
            $user = new User;
            $user->name = 'Administradora';
            $user->firstname = 'María';
            $user->lastname = 'Correa Valero';
            $user->user_type_id = '1';
            $user->email ='maria.correa@areaf5.es';
            $user->email_verified_at = null;
            $user->password = Hash::make('WikiDestroyer.');
            $user->status = '1';
            $user->save();
        }

        
    }
}
