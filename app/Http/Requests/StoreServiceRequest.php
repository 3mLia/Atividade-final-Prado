<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Define se o usuário tem permissão para fazer essa requisição.
     * Como é um sistema de barbearia, definimos como true.
     */
    public function authorize(): bool
    {
        return true; 
    }

    /**
     * Regras de validação: aqui garantimos que os dados enviados
     * pelo formulário estejam corretos antes de salvar no banco.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:1'],
        ];
    }
}