<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user management
        Permission::create(['name' => 'read /management/user']);
        Permission::create(['name' => 'create /management/user']);
        Permission::create(['name' => 'update /management/user']);
        Permission::create(['name' => 'delete /management/user']);

        // role management
        Permission::create(['name' => 'read /management/role']);
        Permission::create(['name' => 'create /management/role']);
        Permission::create(['name' => 'update /management/role']);
        Permission::create(['name' => 'delete /management/role']);

        // menu management
        Permission::create(['name' => 'read /management/menu']);
        Permission::create(['name' => 'create /management/menu']);
        Permission::create(['name' => 'update /management/menu']);
        Permission::create(['name' => 'delete /management/menu']);

        // request type management
        Permission::create(['name' => 'read /management/request-type']);
        Permission::create(['name' => 'create /management/request-type']);
        Permission::create(['name' => 'update /management/request-type']);
        Permission::create(['name' => 'delete /management/request-type']);

        // permohonan user
        Permission::create(['name' => 'read /permohonan/user']);
        Permission::create(['name' => 'create /permohonan/user']);
        Permission::create(['name' => 'update /permohonan/user']);
        Permission::create(['name' => 'delete /permohonan/user']);

        Permission::create(['name' => 'read /permohonan/user/history']);
        Permission::create(['name' => 'create /permohonan/user/history']);
        Permission::create(['name' => 'update /permohonan/user/history']);
        Permission::create(['name' => 'delete /permohonan/user/history']);

        Permission::create(['name' => 'read /dashboard']);
        Permission::create(['name' => 'create /dashboard']);
        Permission::create(['name' => 'update /dashboard']);
        Permission::create(['name' => 'delete /dashboard']);

        Permission::create(['name' => 'read /management']);
        Permission::create(['name' => 'create /management']);
        Permission::create(['name' => 'update /management']);
        Permission::create(['name' => 'delete /management']);

        Permission::create(['name' => 'read /permohonan']);
        Permission::create(['name' => 'create /permohonan']);
        Permission::create(['name' => 'update /permohonan']);
        Permission::create(['name' => 'delete /permohonan']);

        Permission::create(['name' => 'read /permohonan/user/masuk']);
        Permission::create(['name' => 'read /permohonan/user/proses']);
        Permission::create(['name' => 'read /permohonan/user/selesai']);

        Permission::create(['name' => 'update /permohonan/user/masuk']);
        Permission::create(['name' => 'update /permohonan/user/proses']);
        Permission::create(['name' => 'update /permohonan/user/selesai']);

        Permission::create(['name' => 'create /permohonan/user/masuk']);
        Permission::create(['name' => 'create /permohonan/user/proses']);
        Permission::create(['name' => 'create /permohonan/user/selesai']);

        Permission::create(['name' => 'delete /permohonan/user/masuk']);
        Permission::create(['name' => 'delete /permohonan/user/proses']);
        Permission::create(['name' => 'delete /permohonan/user/selesai']);

        Permission::create(['name' => 'read /permohonan/spv']);
        Permission::create(['name' => 'create /permohonan/spv']);
        Permission::create(['name' => 'update /permohonan/spv']);
        Permission::create(['name' => 'delete /permohonan/spv']);

        Permission::create(['name' => 'read /permohonan/spv/masuk']);
        Permission::create(['name' => 'read /permohonan/spv/proses']);
        Permission::create(['name' => 'read /permohonan/spv/selesai']);

        Permission::create(['name' => 'update /permohonan/spv/masuk']);
        Permission::create(['name' => 'update /permohonan/spv/proses']);
        Permission::create(['name' => 'update /permohonan/spv/selesai']);

        Permission::create(['name' => 'create /permohonan/spv/masuk']);
        Permission::create(['name' => 'create /permohonan/spv/proses']);
        Permission::create(['name' => 'create /permohonan/spv/selesai']);

        Permission::create(['name' => 'delete /permohonan/spv/masuk']);
        Permission::create(['name' => 'delete /permohonan/spv/proses']);
        Permission::create(['name' => 'delete /permohonan/spv/selesai']);

        Permission::create(['name' => 'read /permohonan/worker']);
        Permission::create(['name' => 'create /permohonan/worker']);
        Permission::create(['name' => 'update /permohonan/worker']);
        Permission::create(['name' => 'delete /permohonan/worker']);

        Permission::create(['name' => 'read /permohonan/worker/masuk']);
        Permission::create(['name' => 'read /permohonan/worker/proses']);
        Permission::create(['name' => 'read /permohonan/worker/selesai']);

        Permission::create(['name' => 'update /permohonan/worker/masuk']);
        Permission::create(['name' => 'update /permohonan/worker/proses']);
        Permission::create(['name' => 'update /permohonan/worker/selesai']);

        Permission::create(['name' => 'create /permohonan/worker/masuk']);
        Permission::create(['name' => 'create /permohonan/worker/proses']);
        Permission::create(['name' => 'create /permohonan/worker/selesai']);

        Permission::create(['name' => 'delete /permohonan/worker/masuk']);
        Permission::create(['name' => 'delete /permohonan/worker/proses']);
        Permission::create(['name' => 'delete /permohonan/worker/selesai']);
    }
}
