<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('customers')->insert([
            [
                'nama' => 'Budi Santoso',
                'no_hp' => '081234567890',
                'nik' => '3276011234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'no_hp' => '082233445566',
                'nik' => '3276010987654321',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
