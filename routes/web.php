<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// Impor controller-controller untuk admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TrackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini adalah tempat Anda mendaftarkan rute web untuk aplikasi Anda.
| Rute-rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditugaskan ke grup middleware "web".
|
*/

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Rute untuk dashboard pengguna biasa, memerlukan login
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk manajemen profil pengguna (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Grup rute ini hanya bisa diakses oleh pengguna yang sudah login
| dan memiliki peran 'admin'.
|
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute untuk halaman utama panel admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk manajemen track
    Route::resource('tracks', TrackController::class);

    // Nanti rute untuk manajemen materi, kuis, dll. akan ditambahkan di sini.
});


// Memuat rute autentikasi (login, register, dll.) dari file terpisah
require __DIR__.'/auth.php';
