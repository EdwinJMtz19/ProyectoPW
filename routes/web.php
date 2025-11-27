<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta temporal para reset password
Route::get('/password/reset', function () {
    return view('auth.passwords.reset');
})->name('password.request');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Dashboard general
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas de Estudiante
    Route::prefix('estudiante')->name('estudiante.')->group(function () {
        Route::get('/dashboard', function () {
            return view('estudiante.dashboard');
        })->name('dashboard');
        
        Route::get('/eventos', function () {
            return view('estudiante.eventos');
        })->name('eventos');
        
        Route::get('/evento/{id}', function ($id) {
            return view('estudiante.evento-detalle', compact('id'));
        })->name('evento.detalle');
        
        Route::get('/mi-equipo', function () {
            return view('estudiante.mi-equipo');
        })->name('mi-equipo');
        
        Route::get('/mi-progreso', function () {
            return view('estudiante.mi-progreso');
        })->name('mi-progreso');
        
        Route::get('/constancias', function () {
            return view('estudiante.constancias');
        })->name('constancias');
    });
    
    // Rutas de Docente
    Route::prefix('docente')->name('docente.')->group(function () {
        Route::get('/dashboard', function () {
            return view('docente.dashboard');
        })->name('dashboard');
    });
    
    // Rutas de Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });
});
