<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('rents', RentController::class);
