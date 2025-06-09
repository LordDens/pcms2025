<?php

use Illuminate\Support\Facades\Route;

Route::get('/pendaftaran-ktp', function () {
    return 'Selamat datang di halaman Pendaftaran KTP Online';
})->middleware('check.age');

use App\Http\Controllers\RentController;

Route::get('/', function () {
    return view('home');
});



Route::resource('rents', RentController::class);

