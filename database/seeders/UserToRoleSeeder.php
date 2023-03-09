<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserToRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        $user = User::find(2);
        $spv = User::find(3);
        $worker = User::find(4);
        $helpdesk = User::find(5);

        $admin->assignRole('admin');
        $user->assignRole('user');
        $spv->assignRole('spv');
        $worker->assignRole('worker');
        $helpdesk->assignRole('helpdesk');
    }
}
