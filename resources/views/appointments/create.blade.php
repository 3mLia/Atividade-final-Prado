<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Novo Agendamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6">
                
                {{-- Exibição de erros de validação --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-900/50 border border-red-500 text-red-200 p-4 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-barber-gold mb-2">Serviço</label>
                        <select name="service_id" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} - R$ {{ number_format($service->price, 2, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-barber-gold mb-2">Data e Hora</label>
                        <input type="datetime-local" 
                               name="appointment_date" 
                               min="{{ date('Y-m-d\TH:i') }}" 
                               class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold" 
                               required>
                        <p class="text-xs text-barber-gold/60 mt-1">* Por favor, agende dentro do horário comercial (09:00 - 18:00).</p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-barber-gold text-barber-dark px-6 py-2 rounded-md font-bold hover:bg-amber-600 transition">Confirmar Agendamento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>