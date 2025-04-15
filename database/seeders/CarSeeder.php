<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cars')->insert([
            [
                'nama_mobil' => 'Toyota Avanza',
                'harga_sewa_per_hari' => 350000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_mobil' => 'Honda Brio',
                'harga_sewa_per_hari' => 300000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
