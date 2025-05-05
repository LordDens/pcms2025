<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_hp', 'nik', 'kode_registrasi'];

    protected static function booted()
    {
        static::creating(function ($customer) {
            // Otomatis buat kode_registrasi unik
            $customer->kode_registrasi = self::generateKodeRegistrasi();
        });
    }

    private static function generateKodeRegistrasi()
    {
        do {
            // Format: JR + 6 digit random number, contoh: JR001
            $kode = 'JR' . mt_rand(001, 999999);
        } while (self::where('kode_registrasi', $kode)->exists());

        return $kode;
    }
}
