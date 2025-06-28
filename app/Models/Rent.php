<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rent extends Model
{
    protected $fillable = [
    'customer_id', 'car_id', 'tanggal_sewa', 'tanggal_kembali',
    'harga_sewa', 'with_driver', 'driver', 'diskon',
    'dp', 'total_pendapatan', 'belum_terbayar', 'is_confirmed',
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
