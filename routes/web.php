<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas del administrador
Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});


// Rutas del usuario
Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

require __DIR__ . '/auth.php';
