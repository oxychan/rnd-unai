<?php

namespace Database\Seeders;

use App\Models\RequestItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestItem::create([
            'subject' => 'Kursi',
            'description' => 'Kaki patah satu',
            'id_request' => 1
        ]);

        RequestItem::create([
            'subject' => 'Meja',
            'description' => 'Daun meja rusak',
            'id_request' => 1
        ]);
    }
}
