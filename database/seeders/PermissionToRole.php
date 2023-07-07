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
        $admin->givePermissionTo('read /management/user');
        $admin->givePermissionTo('create /management/user');
        $admin->givePermissionTo('update /management/user');
        $admin->givePermissionTo('delete /management/user');
        // role management
        $admin->givePermissionTo('read /management/role');
        $admin->givePermissionTo('create /management/role');
        $admin->givePermissionTo('update /management/role');
        $admin->givePermissionTo('delete /management/role');
        // menu management
        $admin->givePermissionTo('read /management/menu');
        $admin->givePermissionTo('create /management/menu');
        $admin->givePermissionTo('update /management/menu');
        $admin->givePermissionTo('delete /management/menu');
        // request type management
        $admin->givePermissionTo('read /management/request-type');
        $admin->givePermissionTo('create /management/request-type');
        $admin->givePermissionTo('update /management/request-type');
        $admin->givePermissionTo('delete /management/request-type');

        // permohonan user
        $helpdesk->givePermissionTo('read /permohonan/user/masuk');
        $helpdesk->givePermissionTo('read /permohonan/user/proses');
        $helpdesk->givePermissionTo('read /permohonan/user/selesai');

        // permohonan user spv
        $spv->givePermissionTo('read /permohonan/spv/masuk');
        $spv->givePermissionTo('read /permohonan/spv/proses');
        $spv->givePermissionTo('read /permohonan/spv/selesai');

        // permohonan user worker
        $worker->givePermissionTo('read /permohonan/worker/masuk');
        $worker->givePermissionTo('read /permohonan/worker/proses');
        $worker->givePermissionTo('read /permohonan/worker/selesai');

        // other
        $admin->givePermissionTo('read /dashboard');
        $admin->givePermissionTo('read /management');

        $helpdesk->givePermissionTo('read /permohonan');

        $spv->givePermissionTo('read /permohonan/spv');
        $worker->givePermissionTo('read /permohonan/worker');

        $user->givePermissionTo('read /dashboard');
        $user->givePermissionTo('read /permohonan/user');

        $spv->givePermissionTo('read /dashboard');

        $worker->givePermissionTo('read /dashboard');

        $helpdesk->givePermissionTo('read /dashboard');
    }
}
