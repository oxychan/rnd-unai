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
            'name' => 'SPV 1',
            'username' => 'spv1',
            'email' => 'spv1@mail.com',
            'password' => Hash::make('password'),
            'telp' => '12345678001',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'SPV 2',
            'username' => 'spv2',
            'email' => 'spv2@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567232',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'SPV 3',
            'username' => 'spv3',
            'email' => 'spv3@mail.com',
            'password' => Hash::make('password'),
            'telp' => '12343243892',
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
            'name' => 'Helpdesk 1',
            'username' => 'helpdesk1',
            'email' => 'helpdesk1@mail.com',
            'password' => Hash::make('password'),
            'telp' => '1234567894',
            'avatar' => 'default.jpg'
        ]);

        User::create([
            'name' => 'Helpdesk 2',
            'username' => 'helpdesk2',
            'email' => 'helpdesk2@mail.com',
            'password' => Hash::make('password'),
            'telp' => '12341231223',
            'avatar' => 'default.jpg'
        ]);
    }
}
