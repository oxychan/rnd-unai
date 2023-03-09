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
        Permission::create(['name' => 'create /dashboard/management/user/create']);
        Permission::create(['name' => 'store /dashboard/management/user/store']);
        Permission::create(['name' => 'delete /dashboard/management/user/delete']);

        // role management
        Permission::create(['name' => 'read /dashboard/management/role']);
        Permission::create(['name' => 'create /dashboard/management/role/create']);
        Permission::create(['name' => 'store /dashboard/management/role/store']);
        Permission::create(['name' => 'delete /dashboard/management/role/delete']);

        // menu management
        Permission::create(['name' => 'read /dashboard/management/menu']);
        Permission::create(['name' => 'create /dashboard/management/menu/create']);
        Permission::create(['name' => 'store /dashboard/management/menu/store']);
        Permission::create(['name' => 'delete /dashboard/management/menu/delete']);

        Permission::create(['name' => 'read /dashboard']);
        Permission::create(['name' => 'read /dashboard/management']);
        Permission::create(['name' => 'read /dashboard/spv']);
    }
}
