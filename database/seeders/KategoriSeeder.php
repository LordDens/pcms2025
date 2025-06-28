<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = ['SUV', 'MPV', 'City Car', 'Pickup'];

        foreach ($kategoris as $nama) {
            Kategori::create(['nama' => $nama]);
        }
    }
}
