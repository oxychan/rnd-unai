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
            'title' => 'Permohonan ditolak tanpa revisi',
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

        Request::create([
            'title' => 'Permohonan ditolak dengan revisi',
            'description' => 'Permohonan ini ditolak akan tetapi bisa direvisi',
            'telp' => '082139929591',
            'file_name' => null,
            'id_type' => 2,
            'id_user' => 2,
            'id_helpdesk' => null,
            'id_spv' => null,
            'id_worker' => null,
            'status' => 2,
            'is_revised' => true,
            'revise_note' => 'Gapapa sih pengen nolak aja',
        ]);

        Request::create([
            'title' => 'Permohonan diajukan',
            'description' => 'Permohonan ini diajukan ke helpdesk',
            'telp' => '082139929591',
            'file_name' => null,
            'id_type' => 2,
            'id_user' => 2,
            'id_helpdesk' => null,
            'id_spv' => null,
            'id_worker' => null,
            'status' => 0,
        ]);

        Request::create([
            'title' => 'Permohonan diproses',
            'description' => 'Permohonan ini udah diterima sama helpdesk dan udah di proses',
            'telp' => '082139929591',
            'file_name' => null,
            'id_type' => 2,
            'id_user' => 2,
            'id_helpdesk' => null,
            'id_spv' => null,
            'id_worker' => null,
            'status' => 1,
        ]);

        Request::create([
            'title' => 'Permohonan selesai',
            'description' => 'Permohonan ini udah selesai yahhhhhhh',
            'telp' => '082139929591',
            'file_name' => null,
            'id_type' => 2,
            'id_user' => 2,
            'id_helpdesk' => null,
            'id_spv' => null,
            'id_worker' => null,
            'status' => 3,
        ]);
    }
}
