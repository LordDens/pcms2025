<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\PublicOrderController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [CarController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route umum (login saja)
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rental-saya', [PublicOrderController::class, 'userRentals'])->name('rents.my');
});

// Route admin-only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/car/create', [CarController::class, 'create'])->name('car.create');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::resource('rents', RentController::class);
    Route::get('/car/{car}/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::put('/car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::patch('/admin/sewa/{rent}/status', [RentController::class, 'updateStatus'])->name('admin.rents.updateStatus');
    Route::get('/admin/rents', [RentController::class, 'index'])->name('admin.rents.index');
    Route::patch('/rents/{rent}/confirm', [RentController::class, 'updateStatus'])->name('admin.rents.confirm');
    Route::get('/admin/laporan', [App\Http\Controllers\ReportController::class, 'index'])->name('admin.laporan.index');
});

// Untuk umum
Route::get('/car', [CarController::class, 'index'])->name('car.index');
Route::get('/order', [PublicOrderController::class, 'create'])->name('orders.create');
Route::post('/order', [PublicOrderController::class, 'store'])->name('orders.store');
Route::get('/order/{rent_id}', [PublicOrderController::class, 'show'])->name('pesanan.show');
Route::get('/pesanan/{rent_id}/pembayaran', [PublicOrderController::class, 'payment'])->name('pesanan.payment');
Route::post('/pesanan/{rent_id}/bayar', [PublicOrderController::class, 'processPayment'])->name('pesanan.processPayment');
Route::get('/kontak', function () {
    return view('contact');
})->name('kontak');


// Pembayaran
Route::get('/pembayaran/{rent_id}', [PublicOrderController::class, 'payment'])->name('pesanan.payment');


require __DIR__.'/auth.php';

