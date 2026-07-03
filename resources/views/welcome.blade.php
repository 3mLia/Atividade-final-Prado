<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Barbearia IFSP</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 text-gray-200 antialiased font-sans flex flex-col min-h-screen">
    
    <!-- Navbar -->
    <header class="bg-slate-800 border-b border-amber-500/20 py-4 shadow-lg shadow-black/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-extrabold text-amber-500 uppercase tracking-widest">
                    Barbearia<span class="text-white">IFSP</span>
                </span>
            </div>
            <nav>
                @if (Route::has('login'))
                    <div class="space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-amber-500 hover:text-amber-400 font-bold transition">Acessar Meu Painel</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition font-medium">Entrar</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-amber-600 hover:bg-amber-500 text-slate-900 px-5 py-2 rounded-md font-bold transition">Cadastrar</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
    </header>

    <!-- Banner Principal (Hero) -->
    <main class="flex-grow">
        <section class="py-20 text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 text-white drop-shadow-md">
                Estilo, Tradição e <span class="text-amber-500">Excelência</span>
            </h1>
            <p class="text-xl text-gray-400 max-w-2xl mx-auto mb-10">
                Agende o seu horário com os melhores profissionais da região. Cuidamos do seu visual para você dominar o seu dia.
            </p>
            <a href="{{ route('login') }}" class="inline-block bg-amber-600 hover:bg-amber-500 text-slate-900 px-8 py-4 rounded-md font-extrabold text-lg transition shadow-lg shadow-amber-500/20 uppercase tracking-wider">
                Agende Agora
            </a>
        </section>

        <!-- Seção de Serviços (A Vitrine) -->
        <section class="py-16 bg-slate-800/50 border-t border-amber-500/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-amber-500 uppercase tracking-wider">Nossos Serviços</h2>
                    <p class="text-gray-400 mt-2">Escolha o que melhor combina com você.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($services as $service)
                        <div class="bg-slate-800 rounded-xl overflow-hidden border border-amber-500/20 shadow-xl transition hover:border-amber-500/50 flex flex-col">
                            
                            {{-- EXIBIÇÃO DA IMAGEM DO SERVIÇO --}}
                            @if($service->image_path)
                                <img src="{{ asset($service->image_path) }}" alt="{{ $service->name }}" class="w-full h-56 object-cover border-b border-amber-500/20">
                            @else
                                <div class="w-full h-56 bg-slate-900 flex items-center justify-center border-b border-amber-500/20">
                                    <span class="text-gray-600 text-sm italic">Sem imagem ilustrativa</span>
                                </div>
                            @endif
                            
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold text-white">{{ $service->name }}</h3>
                                    <span class="text-amber-500 font-extrabold text-xl whitespace-nowrap ml-2">
                                        R$ {{ number_format($service->price, 2, ',', '.') }}
                                    </span>
                                </div>
                                
                                <p class="text-gray-400 text-sm mb-6 flex-grow">
                                    {{ $service->description ?? 'Serviço de barbearia profissional.' }}
                                </p>
                                
                                <div class="flex justify-between items-center text-sm pt-4 border-t border-slate-700">
                                    <span class="text-gray-400 flex items-center gap-1 bg-slate-900 px-3 py-1 rounded-full">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $service->duration_minutes }} min
                                    </span>
                                    <a href="{{ route('login') }}" class="text-amber-500 hover:text-amber-400 font-bold uppercase tracking-wider text-xs transition">
                                        Agendar &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-slate-800 rounded-lg border border-dashed border-amber-500/30">
                            <p class="text-gray-400 text-lg">Os serviços estarão disponíveis em breve.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 py-8 text-center text-gray-600 border-t border-amber-500/10">
        <p>&copy; {{ date('Y') }} Barbearia IFSP. Desenvolvido com Laravel Boost.</p>
    </footer>

</body>
</html>