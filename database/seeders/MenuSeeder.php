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
            'nama' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'fas fa-list',
            'root' => null,
            'urutan' => 0,
        ]);

        Menu::create([
            'nama' => 'User',
            'url' => '/dashboard/management/user',
            'icon' => 'fas fa-list',
            'root' => 1,
            'urutan' => 0,
        ]);

        Menu::create([
            'nama' => 'Role',
            'url' => '/dashboard/management/role',
            'icon' => 'fas fa-list',
            'root' => 1,
            'urutan' => 0,
        ]);

        Menu::create([
            'nama' => 'Menu',
            'url' => '/dashboard/management/menu',
            'icon' => 'fas fa-list',
            'root' => 1,
            'urutan' => 0,
        ]);

        Menu::create([
            'nama' => 'SPV',
            'url' => '/dashboard/spv',
            'icon' => 'fas fa-list',
            'root' => 1,
            'urutan' => 0,
        ]);

        Menu::create([
            'nama' => 'Management',
            'url' => '/dashboard/management',
            'icon' => 'fas fa-list',
            'root' => null,
            'urutan' => 0,
        ]);
    }
}
