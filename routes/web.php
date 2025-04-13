<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentController; //

Route::resource('rents', RentController::class);

Route::get('/', function () {
    return view('welcome');
});
