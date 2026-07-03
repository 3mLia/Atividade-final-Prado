<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Busca todos os serviços cadastrados para a vitrine
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
});

Route::get('/dashboard', function () {
    $user = Illuminate\Support\Facades\Auth::user();
    
    if ($user->isAdmin()) {
        // Admin: Vê os agendamentos de hoje
        $appointments = App\Models\Appointment::with(['user', 'service'])
            ->whereDate('appointment_date', \Carbon\Carbon::today())
            ->orderBy('appointment_date')
            ->get();
    } else {
        // Cliente: Vê seus próximos agendamentos limitados a 5
        $appointments = App\Models\Appointment::with('service')
            ->where('user_id', $user->id)
            ->where('appointment_date', '>=', \Carbon\Carbon::now())
            ->orderBy('appointment_date')
            ->take(5)
            ->get();
    }

    return view('dashboard', compact('appointments'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rota da API para checar horários ocupados
    Route::get('/appointments/check-availability', [AppointmentController::class, 'checkAvailability'])->name('appointments.checkAvailability');

    // Rotas de Agendamentos (Acessíveis por clientes e administradores)
    Route::resource('appointments', AppointmentController::class)->except(['edit', 'update']);

    // Rotas de Serviços (PROTEGIDAS: Apenas Admins)
    Route::middleware('admin')->group(function () {
        Route::resource('services', ServiceController::class);
    });
});

require __DIR__.'/auth.php';