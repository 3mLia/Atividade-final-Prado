<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-barber-dark text-barber-text">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    {{-- Logo Laravel Customizado (Estilo Metal/Brass conforme imagem) --}}
                    <svg class="w-20 h-20 fill-barber-gold" viewBox="0 0 62 65" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        {{-- O SVG do logo do Laravel original vai aqui --}}
                        {{-- Para este exemplo, simplifiquei. Pegue o SVG completo no welcome.blade.php se preferir. --}}
                        <path d="M61.854619,10.2234383 L61.854619,10.2234383 C61.854619,10.2234383 61.854619,10.2234383 61.854619,10.2234383 L61.854619,10.2234383 Z... (copie o path do logo padrão se quiser o logo idêntico)"></path>
                    </svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-barber-card shadow-2xl shadow-barber-gold/10 overflow-hidden sm:rounded-lg border border-barber-gold/20">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>