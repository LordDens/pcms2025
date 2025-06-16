<?php

use Illuminate\Support\Facades\Route;

Route::get('/pendaftaran-ktp', function () {
    return 'Selamat datang di halaman Pendaftaran KTP Online';
})->middleware('check.age');

use App\Http\Controllers\RentController;

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\PublicOrderController;

Route::get('/pesan', [PublicOrderController::class, 'create']);
Route::post('/pesan', [PublicOrderController::class, 'store'])->name('pesan.store');


Route::resource('rents', RentController::class);

