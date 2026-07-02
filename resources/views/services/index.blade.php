<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Gerenciamento de Serviços') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20">
                <div class="p-6 text-barber-text">
                    
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('services.create') }}" class="bg-barber-gold text-barber-dark px-4 py-2 rounded-md hover:bg-amber-600 transition">
                            + Novo Serviço
                        </a>
                    </div>

                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-barber-gold border-b border-barber-gold/20">
                                <th class="p-3">Nome</th>
                                <th class="p-3">Preço</th>
                                <th class="p-3">Duração</th>
                                <th class="p-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr class="border-b border-barber-gold/10 hover:bg-barber-gold/5">
                                    <td class="p-3">{{ $service->name }}</td>
                                    <td class="p-3">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                                    <td class="p-3">{{ $service->duration_minutes }} min</td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('services.edit', $service) }}" class="text-barber-gold hover:underline mr-3">Editar</a>
                                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-400 hover:text-red-300">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $services->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>