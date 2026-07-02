<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Mensagem de Erro (Acesso Negado) --}}
            @if(session('error'))
                <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Cartão de Boas-vindas --}}
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6 text-barber-text mb-6">
                <h3 class="text-2xl font-bold text-barber-gold mb-2">
                    Olá, {{ Auth::user()->name }}!
                </h3>
                <p class="text-barber-text/80">
                    {{ Auth::user()->isAdmin() ? 'Painel Administrativo da Barbearia.' : 'Bem-vindo(a) à sua área de cliente.' }}
                </p>
            </div>

            @if(Auth::user()->isAdmin())
                {{-- ==================== VISÃO DO ADMIN ==================== --}}
                <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-barber-gold">Agenda de Hoje</h4>
                        <a href="{{ route('services.index') }}" class="text-sm text-barber-dark bg-barber-gold px-4 py-2 rounded-md font-bold hover:bg-amber-600 transition">
                            Gerenciar Serviços
                        </a>
                    </div>

                    @if($appointments->isEmpty())
                        <div class="p-6 text-center border border-dashed border-barber-gold/30 rounded-md">
                            <p class="text-barber-text/60 italic">Não há clientes agendados para hoje.</p>
                        </div>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-barber-gold border-b border-barber-gold/20">
                                    <th class="p-3">Horário</th>
                                    <th class="p-3">Cliente</th>
                                    <th class="p-3">Serviço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="border-b border-barber-gold/10 hover:bg-barber-gold/5">
                                        <td class="p-3 font-bold text-lg text-barber-text">{{ $appointment->appointment_date->format('H:i') }}</td>
                                        <td class="p-3">{{ $appointment->user->name }}</td>
                                        <td class="p-3">{{ $appointment->service->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            @else
                {{-- ==================== VISÃO DO CLIENTE ==================== --}}
                <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-xl font-bold text-barber-gold">Seus Próximos Agendamentos</h4>
                        <a href="{{ route('appointments.create') }}" class="text-sm text-barber-dark bg-barber-gold px-4 py-2 rounded-md font-bold hover:bg-amber-600 transition">
                            + Novo Agendamento
                        </a>
                    </div>

                    @if($appointments->isEmpty())
                        <div class="p-6 text-center border border-dashed border-barber-gold/30 rounded-md">
                            <p class="text-barber-text/60 italic mb-4">Você não possui agendamentos futuros.</p>
                            <a href="{{ route('appointments.create') }}" class="text-barber-gold hover:underline font-bold">Agendar agora >></a>
                        </div>
                    @else
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-barber-gold border-b border-barber-gold/20">
                                    <th class="p-3">Data e Hora</th>
                                    <th class="p-3">Serviço</th>
                                    <th class="p-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr class="border-b border-barber-gold/10 hover:bg-barber-gold/5">
                                        <td class="p-3 font-bold">{{ $appointment->appointment_date->format('d/m \à\s H:i') }}</td>
                                        <td class="p-3">{{ $appointment->service->name }}</td>
                                        <td class="p-3 capitalize">{{ $appointment->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4 text-right">
                            <a href="{{ route('appointments.index') }}" class="text-sm text-barber-gold hover:underline">Ver todo o histórico >></a>
                        </div>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>