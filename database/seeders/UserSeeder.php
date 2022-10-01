<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $guest= User::create([
            'name' => "guest",
            'email' => "guest@gmail.com",
            'password' => bcrypt("guest123"),
        ]);
        $superadmin= User::create([
            'name' => "superadmin",
            'email' => "superadmin@gmail.com",
            'password' => bcrypt("superadmin123"),
        ]);
        UserRole::create([
            'user_id' => $guest->id,
            'role_id' => 1,
        ]);
        UserRole::create([
            'user_id' => $superadmin->id,
            'role_id' => 2,
        ]);
    }
}
