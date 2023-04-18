<?php

namespace Database\Seeders;

use App\Models\Request;
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
        foreach (Request::all() as $value) {
            RequestItem::create([
                'subject' => 'Item 1',
                'description' => 'Item ke satu list permohonan',
                'id_request' => $value->id
            ]);

            RequestItem::create([
                'subject' => 'Item 2',
                'description' => 'Item ke dua list permohonan',
                'id_request' => $value->id
            ]);
        }
    }
}
