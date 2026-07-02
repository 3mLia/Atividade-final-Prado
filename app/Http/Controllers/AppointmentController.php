<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Http\Requests\StoreAppointmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Exibe a lista de agendamentos do usuário logado.
     */
    public function index(): View
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with('service')
            ->orderBy('appointment_date', 'asc')
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Exibe o formulário para um novo agendamento.
     */
    public function create(): View
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    /**
     * Salva um novo agendamento.
     */
    public function store(StoreAppointmentRequest $request): RedirectResponse
    {
        // Cria o agendamento associado ao usuário autenticado
        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $request->appointment_date,
            'status' => 'pendente',
        ]);

        return redirect()->route('appointments.index')
            ->with('success', 'Agendamento realizado com sucesso!');
    }

    /**
     * Cancela um agendamento.
     */
    public function destroy(Appointment $appointment): RedirectResponse
    {
        // Verifica se o agendamento pertence ao usuário
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Agendamento cancelado com sucesso!');
    }
}