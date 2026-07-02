<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-barber-gold leading-tight">
            {{ __('Novo Serviço') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-barber-card overflow-hidden shadow-sm sm:rounded-lg border border-barber-gold/20">
                <div class="p-6 text-barber-text">
                    
                    <form action="{{ route('services.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-barber-gold mb-2">Nome do Serviço</label>
                            <input type="text" name="name" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-barber-gold mb-2">Descrição</label>
                            <textarea name="description" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold"></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label class="block text-barber-gold mb-2">Preço (R$)</label>
                                <input type="number" step="0.01" name="price" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-barber-gold mb-2">Duração (minutos)</label>
                                <input type="number" name="duration_minutes" class="w-full bg-barber-dark border border-barber-gold/30 rounded-md p-2 text-barber-text focus:border-barber-gold focus:ring-barber-gold" required>
                            </div>
                        </div>

                        <div class="flex justify-end mt-6">
                            <a href="{{ route('services.index') }}" class="mr-4 text-barber-text hover:underline py-2">Cancelar</a>
                            <button type="submit" class="bg-barber-gold text-barber-dark px-6 py-2 rounded-md hover:bg-amber-600 transition font-bold">
                                Salvar Serviço
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>