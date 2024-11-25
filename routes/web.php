<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkSessionController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/user-sessions', [UserController::class, 'listSessions'])->name('user.sessions');
    Route::post('/worksession/start', [WorkSessionController::class, 'start'])->name('worksession.start');
    Route::patch('/worksession/{session}/end', [WorkSessionController::class, 'end'])->name('worksession.end');
});

Route::middleware([\App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    Route::patch('/admin/worksession/update', [AdminController::class, 'updateWorkSession'])->name('admin.worksession.update');
});

require __DIR__ . '/auth.php';
