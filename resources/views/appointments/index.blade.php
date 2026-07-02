<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Meus Agendamentos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6">
                
                <div class="flex justify-end mb-4">
                    <a href="{{ route('appointments.create') }}" class="bg-barber-gold text-barber-dark px-4 py-2 rounded-md hover:bg-amber-600 transition font-bold">
                        + Novo Agendamento
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-600 text-white p-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                <table class="w-full text-left text-barber-text">
                    <thead>
                        <tr class="text-barber-gold border-b border-barber-gold/20">
                            <th class="p-3">Serviço</th>
                            <th class="p-3">Data/Hora</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr class="border-b border-barber-gold/10">
                                <td class="p-3">{{ $appointment->service->name }}</td>
                                <td class="p-3">{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
                                <td class="p-3 capitalize">{{ $appointment->status }}</td>
                                <td class="p-3 text-right">
                                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="text-red-400 hover:text-red-300">Cancelar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    Você ainda não possui agendamentos.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>