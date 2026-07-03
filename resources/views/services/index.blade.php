<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Serviços da Barbearia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-6">
                
                <div class="flex justify-end mb-4">
                    <a href="{{ route('services.create') }}" class="bg-barber-gold text-barber-dark px-4 py-2 rounded-md hover:bg-amber-600 transition font-bold uppercase tracking-wider text-sm">
                        + Novo Serviço
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-900/50 border border-green-500 text-green-200 p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-barber-text">
                        <thead>
                            <tr class="text-barber-gold border-b border-barber-gold/20">
                                <th class="p-3">Imagem</th>
                                <th class="p-3">Nome</th>
                                <th class="p-3">Preço</th>
                                <th class="p-3">Duração</th>
                                <th class="p-3 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($services as $service)
                                <tr class="border-b border-barber-gold/10 hover:bg-barber-gold/5">
                                    <td class="p-3">
                                        {{-- LÊ A IMAGEM DIRETO DA PASTA PUBLIC --}}
                                        @if($service->image_path)
                                            <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" class="h-12 w-12 object-cover rounded-md border border-barber-gold/30">
                                        @else
                                            <div class="h-12 w-12 bg-barber-dark border border-dashed border-barber-gold/30 rounded-md flex items-center justify-center text-xs text-barber-gold/50 text-center leading-tight">Sem foto</div>
                                        @endif
                                    </td>
                                    <td class="p-3 font-bold">{{ $service->name }}</td>
                                    <td class="p-3">R$ {{ number_format($service->price, 2, ',', '.') }}</td>
                                    <td class="p-3">{{ $service->duration_minutes }} min</td>
                                    <td class="p-3 text-right">
                                        <div class="flex justify-end gap-4">
                                            <a href="{{ route('services.edit', $service) }}" class="text-amber-500 hover:text-amber-400 font-bold">Editar</a>
                                            <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400 font-bold" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-barber-text/50 italic border border-dashed border-barber-gold/30 rounded-md">
                                        Nenhum serviço cadastrado ainda.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>