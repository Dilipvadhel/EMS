<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;


class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'role_id' => 1,
            'firstname' => 'Vadhel',
            'lastname' => 'Dilip',
            'username' => 'Dilip',
            'email' => 'Dilip@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'role_id' => 2,
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'username' => 'Admin',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'role_id' => 2,
            'firstname' => 'Test',
            'lastname' => 'Test',
            'username' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('123456')


        ]);
    }
}
