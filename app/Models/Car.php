<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['nama_mobil', 'harga_sewa_per_hari', 'jenis_mobil', 'kode_mobil'];

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

    protected static function booted()
    {
        static::creating(function ($car) {
            // Ambil 3 huruf pertama dari nama mobil
            $prefix = strtoupper(substr(preg_replace('/\s+/', '', $car->nama_mobil), 0, 3));

            // Ambil huruf pertama dari jenis mobil
            $jenisKode = strtoupper(substr($car->jenis_mobil, 0, 1)); // M untuk Manual, A untuk Automatic

            // Tentukan kode mobil pertama
            $kodeMobil = "{$prefix}-{$jenisKode}1";

            // Periksa jika kode mobil sudah ada, ulangi sampai unik
            $existingCode = self::where('kode_mobil', $kodeMobil)->first();
            $counter = 1;

            while ($existingCode) {
                $counter++;
                $kodeMobil = "{$prefix}-{$jenisKode}{$counter}";
                $existingCode = self::where('kode_mobil', $kodeMobil)->first();
            }

            // Assign kode mobil yang unik
            $car->kode_mobil = $kodeMobil;
        });
    }
}
