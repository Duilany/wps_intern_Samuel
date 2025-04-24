<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Untuk staf
Route::middleware(['auth', RoleMiddleware::class.':staf'])->group(function () {
    Route::resource('logs', LogController::class);
});

// Manager dan direktur
Route::middleware(['auth', RoleMiddleware::class.':manager,direktur'])->group(function () {
    Route::get('verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');
    Route::post('verifikasi/{log}', [VerifikasiController::class, 'verify'])->name('verifikasi.verify');
});

// Direktur saja
Route::middleware(['auth', RoleMiddleware::class.':direktur'])->group(function () {
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/data', [CalendarController::class, 'data'])->name('calendar.data');
});

// Dashboard diarahkan ke CalendarController untuk direktur, dan ke logs untuk staf
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'direktur') {
            return redirect()->route('calendar.index');
        } elseif (auth()->user()->role === 'manager') {
            return redirect()->route('verifikasi.index');
        } else {
            return redirect()->route('logs.index');
        }
    })->name('dashboard');
});

require __DIR__.'/auth.php';