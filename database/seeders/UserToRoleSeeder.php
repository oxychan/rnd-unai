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
        $spvs = User::where('username', 'LIKE', '%' . 'spv' . '%')->get();
        $worker = User::find(4);
        $helpdesks = User::where('username',  'LIKE', '%' . 'helpdesk' . '%')->get();

        $admin->assignRole('admin');
        $user->assignRole('user');
        $worker->assignRole('worker');
        foreach ($spvs as $spv) {
            $spv->assignRole('spv');
        }
        foreach ($helpdesks as $helpdesk) {
            $helpdesk->assignRole('helpdesk');
        }
    }
}
