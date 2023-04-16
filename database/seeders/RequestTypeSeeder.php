<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RequestType::create(
            ['name' => 'Perbaikan Bug Aplikasi/ Perbaikan Infrastruktur'],
        );

        RequestType::create(
            ['name' => 'Permohonan Baru'],
        );
    }
}
