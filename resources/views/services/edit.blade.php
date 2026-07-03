<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Editar Serviço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20 p-8">
                
                @if ($errors->any())
                    <div class="mb-6 bg-red-900/50 border border-red-500 text-red-200 p-4 rounded-md">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-barber-gold font-bold mb-2">Nome do Serviço</label>
                        <input type="text" name="name" value="{{ old('name', $service->name) }}" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                    </div>

                    <div>
                        <label class="block text-barber-gold font-bold mb-2">Descrição (Opcional)</label>
                        <textarea name="description" rows="3" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold">{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-barber-gold font-bold mb-2">Preço (R$)</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price', $service->price) }}" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                        </div>
                        <div>
                            <label class="block text-barber-gold font-bold mb-2">Duração (minutos)</label>
                            <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-3 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                        </div>
                    </div>

                    <div class="p-4 border border-dashed border-barber-gold/30 rounded-md bg-barber-dark/50">
                        <label class="block text-barber-gold font-bold mb-2">Imagem do Serviço</label>
                        
                        {{-- LÊ A IMAGEM DIRETO DA PASTA PUBLIC --}}
                        @if($service->image_path)
                            <div class="mb-4 flex items-center gap-4">
                                <img src="{{ asset($service->image_path) }}" alt="Imagem de {{ $service->name }}" class="h-20 w-20 object-cover rounded-md border border-barber-gold/50">
                                <span class="text-sm text-barber-text/70">Imagem atual</span>
                            </div>
                        @endif

                        <input type="file" name="image" accept="image/*" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold">
                        <p class="text-sm text-barber-gold/50 mt-1">* Opcional. Envie um ficheiro apenas se desejar trocar a imagem atual.</p>
                    </div>

                    <div class="flex justify-end pt-4 items-center">
                        <a href="{{ route('services.index') }}" class="mr-6 text-barber-gold hover:underline">Cancelar</a>
                        <button type="submit" class="bg-barber-gold text-barber-dark px-6 py-3 rounded-md font-bold hover:bg-amber-600 transition uppercase tracking-wider">
                            Atualizar Serviço
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>