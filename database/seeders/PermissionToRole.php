<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionToRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::find(1);
        $user = Role::find(2);
        $spv = Role::find(3);
        $worker = Role::find(4);
        $helpdesk = Role::find(5);

        // user management
        $admin->givePermissionTo('read /dashboard/management/user');
        $admin->givePermissionTo('create /dashboard/management/user/create');
        $admin->givePermissionTo('store /dashboard/management/user/store');
        $admin->givePermissionTo('delete /dashboard/management/user/delete');
        // role management
        $admin->givePermissionTo('read /dashboard/management/role');
        $admin->givePermissionTo('create /dashboard/management/role/create');
        $admin->givePermissionTo('store /dashboard/management/role/store');
        $admin->givePermissionTo('delete /dashboard/management/role/delete');
        // menu management
        $admin->givePermissionTo('read /dashboard/management/menu');
        $admin->givePermissionTo('create /dashboard/management/menu/create');
        $admin->givePermissionTo('store /dashboard/management/menu/store');
        $admin->givePermissionTo('delete /dashboard/management/menu/delete');
        // other
        $admin->givePermissionTo('read /dashboard');
        $admin->givePermissionTo('read /dashboard/management');
        $admin->givePermissionTo('read /dashboard/spv');

        $user->givePermissionTo('read /dashboard');
        $user->givePermissionTo('read /dashboard/management');
        $user->givePermissionTo('read /dashboard/spv');

        $spv->givePermissionTo('read /dashboard');
        $spv->givePermissionTo('read /dashboard/management');
        $spv->givePermissionTo('read /dashboard/spv');

        $worker->givePermissionTo('read /dashboard');
        $worker->givePermissionTo('read /dashboard/management');
        $worker->givePermissionTo('read /dashboard/spv');

        $helpdesk->givePermissionTo('read /dashboard');
        $helpdesk->givePermissionTo('read /dashboard/management');
        $helpdesk->givePermissionTo('read /dashboard/spv');
    }
}
