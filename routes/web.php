<?php

use App\Http\Controllers\Admin\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\TrackController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\CommentLikeController;
use App\Http\Controllers\User\CommentVoteController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LeaderboardController;
use App\Http\Controllers\User\LearningController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\User\UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman utama apabila user belum login atau register
Route::get('/', [HomeController::class, 'index'])->name('welcome');

// Rute untuk manajemen profil pengguna (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/me', function () {
        return view('profile.show', ['user' => Auth::user()]);
    })->name('profile.show');
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/comments', [UserCommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'toggle'])->name('comments.like');
});


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'destroy']);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('tracks', TrackController::class);
    Route::resource('tracks.materials', MaterialController::class);
    Route::get('/materials', [MaterialController::class, 'all'])->name('materials.all');
    Route::get('/materials/create', [MaterialController::class, 'createGlobal'])->name('materials.create_global');
    Route::get('quizzes/{material}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::put('quizzes/{quiz}', [QuizController::class, 'update'])->name(name: 'quizzes.update');
    Route::resource('quizzes.questions', QuestionController::class)->except(['index', 'show'])->shallow();
    Route::resource('comments', CommentController::class)->only(['index', 'destroy']);
    Route::post('/materials', [MaterialController::class, 'storeGlobal'])->name('materials.store_global');
});

/*
|--------------------------------------------------------------------------
| User Learning Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('learn')->name('learn.')->group(function () {
    // Halaman utama: Daftar semua Learning Path
    Route::get('/', [LearningController::class, 'index'])->name('index');
    Route::get('/track/{track}', [LearningController::class, 'showTrack'])->name('track.show');
    Route::post('/track/{track}/enroll', [LearningController::class, 'enroll'])->name('track.enroll');
    Route::get('/track/{track}/material/{material}', [LearningController::class, 'showMaterial'])->name('material.show');
});

// Memuat rute autentikasi (login, register, dll.) dari file terpisah
require __DIR__ . '/auth.php';
