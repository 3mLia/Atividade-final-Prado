<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

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

    // Rotas de Agendamentos (Acessíveis por clientes e administradores)
    Route::resource('appointments', AppointmentController::class)->except(['edit', 'update']);

    // Rotas de Serviços (PROTEGIDAS: Apenas Admins)
    Route::middleware('admin')->group(function () {
        Route::resource('services', ServiceController::class);
    });
});

require __DIR__.'/auth.php';