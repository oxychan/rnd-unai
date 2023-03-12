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
        Permission::create(['name' => 'read /dashboard/management/user']);
        Permission::create(['name' => 'create /dashboard/management/user']);
        Permission::create(['name' => 'update /dashboard/management/user']);
        Permission::create(['name' => 'delete /dashboard/management/user']);

        // role management
        Permission::create(['name' => 'read /dashboard/management/role']);
        Permission::create(['name' => 'create /dashboard/management/role']);
        Permission::create(['name' => 'update /dashboard/management/role']);
        Permission::create(['name' => 'delete /dashboard/management/role']);

        // menu management
        Permission::create(['name' => 'read /dashboard/management/menu']);
        Permission::create(['name' => 'create /dashboard/management/menu']);
        Permission::create(['name' => 'update /dashboard/management/menu']);
        Permission::create(['name' => 'delete /dashboard/management/menu']);

        Permission::create(['name' => 'read /dashboard']);
        Permission::create(['name' => 'create /dashboard']);
        Permission::create(['name' => 'update /dashboard']);
        Permission::create(['name' => 'delete /dashboard']);

        Permission::create(['name' => 'read /dashboard/management']);
        Permission::create(['name' => 'create /dashboard/management']);
        Permission::create(['name' => 'update /dashboard/management']);
        Permission::create(['name' => 'delete /dashboard/management']);

        Permission::create(['name' => 'read /dashboard/spv']);
        Permission::create(['name' => 'create /dashboard/spv']);
        Permission::create(['name' => 'update /dashboard/spv']);
        Permission::create(['name' => 'delete /dashboard/spv']);
    }
}
