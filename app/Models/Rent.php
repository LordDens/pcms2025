<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'car_id',
        'kode_transaksi',
        'tanggal_pinjam',
        'tanggal_kembali',
        'lama_sewa',
        'sopir',
        'biaya',
        'dp',
        'belum_terbayar',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
