<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // gunakan model Customer

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create([
            'nama' => 'Budi Santoso',
            'no_hp' => '081234567890',
            'nik' => '3276011234567890',
        ]);

        Customer::create([
            'nama' => 'Siti Aminah',
            'no_hp' => '082233445566',
            'nik' => '3276010987654321',
        ]);
    }
}
