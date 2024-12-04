<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkSessionController;

// Ruta principal (página de bienvenida)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard principal (para usuarios autenticados)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas de perfil para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para usuarios (protegidas por autenticación)
Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/sessions', [UserController::class, 'listSessions'])->name('user.sessions');
    Route::post('/worksession/start', [WorkSessionController::class, 'start'])->name('worksession.start');
    Route::patch('/worksession/{session}/end', [WorkSessionController::class, 'end'])->name('worksession.end');
});

// Rutas para administradores (protegidas por middleware admin)
Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    // Dashboard del administrador
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Gestión de usuarios (CRUD completo)
    Route::resource('/users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    Route::patch('/admin/worksession/update', [AdminController::class, 'updateWorkSession'])->name('admin.worksession.update');
});

// Rutas de autenticación
require __DIR__ . '/auth.php';
