<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rents')->insert([
            [
                'customer_id' => 1,
                'car_id' => 1,
                'tanggal_sewa' => '2025-04-10',
                'tanggal_kembali' => '2025-04-13',
                'harga_sewa' => 1050000,
                'with_driver' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id' => 2,
                'car_id' => 2,
                'tanggal_sewa' => '2025-04-12',
                'tanggal_kembali' => '2025-04-14',
                'harga_sewa' => 600000,
                'with_driver' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
