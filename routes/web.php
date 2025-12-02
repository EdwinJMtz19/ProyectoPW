<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Redirigir raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// RUTAS DE AUTENTICACIÓN (públicas)
// ==========================================

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Registro
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==========================================
// RUTAS PROTEGIDAS (requieren autenticación)
// ==========================================

Route::middleware('auth')->group(function () {
    
    // ==========================================
    // RUTAS DE ESTUDIANTE
    // ==========================================
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', function () {
            return view('estudiante.dashboard');
        })->name('dashboard');
    });
    
    // ==========================================
    // RUTAS DE MAESTRO (ASESOR)
    // ==========================================
    Route::prefix('maestro')->name('maestro.')->group(function () {
        Route::get('/dashboard', function () {
            return view('maestro.dashboard');
        })->name('dashboard');
    });
    
    // ==========================================
    // RUTAS DE JUEZ
    // ==========================================
    Route::prefix('juez')->name('juez.')->group(function () {
        Route::get('/dashboard', function () {
            return view('juez.dashboard');
        })->name('dashboard');
    });
    
    // ==========================================
    // RUTAS DE ADMIN
    // ==========================================
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
    
});
