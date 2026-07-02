<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = Appointment::where('user_id', Auth::id())
            ->with('service')
            ->orderBy('appointment_date', 'asc')
            ->paginate(10);

        return view('appointments.index', compact('appointments'));
    }

    public function create(): View
    {
        $services = Service::all();
        return view('appointments.create', compact('services'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'day' => 'required|numeric|min:1|max:31',
            'month' => 'required|numeric|min:1|max:12',
            'hour' => 'required|string',
        ]);

        $dateString = date('Y') . '-' . $request->month . '-' . $request->day . ' ' . $request->hour . ':00';
        
        try {
            $appointmentDate = Carbon::createFromFormat('Y-m-d H:i:s', $dateString);
        } catch (\Exception $e) {
            return back()->withErrors(['appointment_date' => 'Data ou hora inválida. Verifique o dia e mês.']);
        }

        if ($appointmentDate->isPast()) {
            return back()->withErrors(['appointment_date' => 'Não é possível agendar uma data que já passou.']);
        }

        if (Appointment::where('appointment_date', $appointmentDate)->exists()) {
            return back()->withErrors(['appointment_date' => 'Este horário já está ocupado. Escolha outro.']);
        }

        Appointment::create([
            'user_id' => Auth::id(),
            'service_id' => $request->service_id,
            'appointment_date' => $appointmentDate,
            'status' => 'pendente',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Agendamento realizado com sucesso!');
    }

    /**
     * ESSA É A FUNÇÃO "MÁGICA" QUE O JAVASCRIPT CHAMA!
     * Ela retorna os horários ocupados para uma data específica (JSON).
     */
    public function checkAvailability(Request $request): JsonResponse
    {
        // 1. Valida se a data chegou no formato certo
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        // 2. Busca no banco todos os agendamentos daquele dia
        $occupiedTimes = Appointment::whereDate('appointment_date', $request->date)
            ->get()
            ->map(function ($appointment) {
                // 3. Pega só a hora e minuto (ex: "14:30")
                return $appointment->appointment_date->format('H:i');
            })
            ->toArray();

        // 4. Devolve para o Javascript no formato JSON
        return response()->json(['occupiedTimes' => $occupiedTimes]);
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        if ($appointment->user_id !== Auth::id()) abort(403);
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Agendamento cancelado!');
    }
}