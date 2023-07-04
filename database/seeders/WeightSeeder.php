<?php

namespace Database\Seeders;

use App\Models\Weight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Weight::create([
            'title' => 'tinggi'
        ]);

        Weight::create([
            'title' => 'sedang'
        ]);

        Weight::create([
            'title' => 'rendah'
        ]);
    }
}
