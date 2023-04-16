<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Request::create([
            'title' => 'Permohonan 1',
            'description' => 'Permohonan untuk perbaikan kursi',
            'telp' => '08239929591',
            'file_name' => null,
            'id_type' => 2,
            'id_user' => 2,
            'id_helpdesk' => null,
            'id_spv' => null,
            'id_worker' => null,
            'status' => 2
        ]);
    }
}
