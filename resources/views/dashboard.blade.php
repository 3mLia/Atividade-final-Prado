<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensagem de erro (Flash Message) --}}
            @if(session('error'))
                <div class="bg-red-900/50 border border-red-500 text-red-200 p-4 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6 text-barber-text">
                <h3 class="text-2xl font-bold text-barber-gold mb-4">
                    Olá, {{ Auth::user()->name }}!
                </h3>
                
                @if(Auth::user()->isAdmin())
                    <div class="bg-barber-dark p-4 rounded-lg border border-barber-gold/30">
                        <p>Bem-vindo ao Painel Administrativo. Aqui você pode gerenciar os serviços da barbearia.</p>
                        <div class="mt-4">
                            <a href="{{ route('services.index') }}" class="text-barber-gold hover:underline font-bold">
                                >> Gerenciar Serviços
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-barber-dark p-4 rounded-lg border border-barber-gold/30">
                        <p>Bem-vindo à sua área de cliente. Organize seus cortes e acompanhe seus agendamentos.</p>
                        <div class="mt-4">
                            <a href="{{ route('appointments.create') }}" class="bg-barber-gold text-barber-dark px-4 py-2 rounded-md font-bold hover:bg-amber-600 transition">
                                Agendar novo horário
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>