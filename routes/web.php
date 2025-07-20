<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
// Impor controller-controller untuk admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\UserController;

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

    // RUTE BARU UNTUK MANAJEMEN PENGGUNA
    Route::resource('users', UserController::class)->only(['index','destroy']);

    // Rute untuk halaman utama panel admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute untuk manajemen track
    Route::resource('tracks', TrackController::class);

    // Route untuk Materials yang berada di dalam sebuah Track
    Route::resource('tracks.materials', MaterialController::class);

    // Route untuk menampilkan semua materi dari semua track
    Route::get('/materials', [MaterialController::class, 'all'])->name('materials.all');

    // Route untuk menampilkan form tambah materi global
    Route::get('/materials/create', [MaterialController::class, 'createGlobal'])->name('materials.create_global');

    // Rute untuk menampilkan & update detail kuis (Judul & Deskripsi)
    // Parameter {material} digunakan agar kita tahu kuis ini milik materi yang mana
    Route::get('quizzes/{material}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::put('quizzes/{quiz}', [QuizController::class, 'update'])->name(name: 'quizzes.update');
    
    // Rute resource untuk mengelola Pertanyaan (Question) di dalam sebuah Kuis (Quiz)
    Route::resource('quizzes.questions', QuestionController::class)->except(['index', 'show'])->shallow();
});


// Memuat rute autentikasi (login, register, dll.) dari file terpisah
require __DIR__ . '/auth.php';
