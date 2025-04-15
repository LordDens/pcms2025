<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['nama', 'no_hp', 'nik'];

    public function rents()
    {
        return $this->hasMany(Rent::class);
    }
}
