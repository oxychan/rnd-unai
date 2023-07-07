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
        for ($i = 1; $i < 11; $i++) {
            Request::create([
                'title' => 'Permohonan ke-' . $i,
                'description' => 'Ini merupakan deskripsi dari permohonan ke-' . $i,
                'telp' => '082139929591',
                'file_name' => null,
                'id_type' => 2,
                'id_user' => 2,
                'id_helpdesk' => null,
                'id_spv' => null,
                'id_worker' => null,
                'status' => 0,
            ]);
        }
    }
}
