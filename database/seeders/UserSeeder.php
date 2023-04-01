<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'telp' => '08212423493',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567891',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'spv',
            'username' => 'spv',
            'email' => 'spv@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567892',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'worker',
            'username' => 'worker',
            'email' => 'worker@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567893',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'helpdesk',
            'username' => 'helpdesk',
            'email' => 'helpdesk@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567894',
            'avatar' => 'default.jpg'
        ]);
    }
}
