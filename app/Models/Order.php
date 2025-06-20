<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model

{
    use HasFactory;
    protected $fillable = [
    'rent_id',
    'nama',
    'nik',
    'tanggal_pesan',
    'tanggal_kembali',
    'car_id',
    'with_driver',
    'ktp_path',
];

    public function car()
{
    return $this->belongsTo(Car::class);
}

}
