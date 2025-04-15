<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DummyRentController;

Route::get('/', function () {
    return view('welcome');
});

// Route resource dummy
Route::resource('rents', DummyRentController::class);
