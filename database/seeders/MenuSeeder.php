<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'name' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'fas fa-list',
            'root' => null,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'User',
            'url' => '/dashboard/management/user',
            'icon' => 'fas fa-list',
            'root' => 1,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'Role',
            'url' => '/dashboard/management/role',
            'icon' => 'fas fa-list',
            'root' => 1,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'Menu',
            'url' => '/dashboard/management/menu',
            'icon' => 'fas fa-list',
            'root' => 1,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'SPV',
            'url' => '/dashboard/spv',
            'icon' => 'fas fa-list',
            'root' => 1,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'Management',
            'url' => '/dashboard/management',
            'icon' => 'fas fa-list',
            'root' => null,
            'order' => 0,
        ]);
    }
}
