<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Define se o usuário tem permissão para realizar esta requisição.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação para o agendamento.
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required', 'exists:services,id'],
            'appointment_date' => ['required', 'date', 'after:now'],
        ];
    }
}