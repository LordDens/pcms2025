<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        // Data mobil yang akan dimasukkan ke database
        $cars = [
            [
                'nama_mobil' => 'Avanza 1.5 G 2021',
                'harga_sewa' => 350000,
                'jenis_mobil' => 'MVP',
                'transmisi' => Matic,
                'harga_sewa_per_hari' => 350000,
            ],
            [
                'nama_mobil' => 'Avanza 1.5',
                'jenis_mobil' => 'Matic',
                'harga_sewa_per_hari' => 375000,
            ],
            [
                'nama_mobil' => 'Innova',
                'jenis_mobil' => 'Matic',
                'harga_sewa_per_hari' => 500000,
            ]
        ];

        foreach ($cars as $carData) {
            // Menggunakan model untuk membuat data mobil
            Car::create($carData);
        }
    }
}
