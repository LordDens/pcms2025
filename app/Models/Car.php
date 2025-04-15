<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['nama_mobil', 'harga_sewa_per_hari'];

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
