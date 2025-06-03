<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    protected $fillable = [
        'customer_id',
        'car_id',
        'kode_transaksi',
        'tanggal_sewa',
        'tanggal_kembali',
        'lama_sewa',
        'sopir',
        'biaya',
        'dp',
        'belum_terbayar',
        'with_driver',
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
