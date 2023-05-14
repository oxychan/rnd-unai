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
            'icon' => 'fa-solid fa-house',
            'root' => null,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'Management',
            'url' => '/management',
            'icon' => 'fa-solid fa-bars-progress',
            'root' => null,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'Permohonan',
            'url' => '/permohonan',
            'icon' => 'fa-solid fa-circle-info',
            'root' => null,
            'order' => 3
        ]);

        Menu::create([
            'name' => 'User',
            'url' => '/management/user',
            'icon' => 'fa-solid fa-user',
            'root' => 2,
            'order' => 0,
        ]);

        Menu::create([
            'name' => 'Role',
            'url' => '/management/role',
            'icon' => 'fa-solid fa-user-tie',
            'root' => 2,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'Menu',
            'url' => '/management/menu',
            'icon' => 'fa-solid fa-bars',
            'root' => 2,
            'order' => 2,
        ]);

        Menu::create([
            'name' => 'Jenis Permohonan',
            'url' => '/management/request-type',
            'icon' => 'fa-solid fa-keyboard',
            'root' => 2,
            'order' => 3,
        ]);

        Menu::create([
            'name' => 'Permohonan Saya',
            'url' => '/permohonan/user',
            'icon' => 'fa-solid fa-circle-info',
            'root' => null,
            'order' => 3,
        ]);

        Menu::create([
            'name' => 'Masuk',
            'url' => '/permohonan/user/masuk',
            'icon' => 'fa-solid fa-inboxes',
            'root' => 3,
            'order' => 1,
        ]);

        Menu::create([
            'name' => 'Proses',
            'url' => '/permohonan/user/proses',
            'icon' => 'fa-solid fa-bars-progresse',
            'root' => 3,
            'order' => 2,
        ]);

        Menu::create([
            'name' => 'Selesai',
            'url' => '/permohonan/user/selesai',
            'icon' => 'fa-solid fa-box-check',
            'root' => 3,
            'order' => 3,
        ]);
    }
}
