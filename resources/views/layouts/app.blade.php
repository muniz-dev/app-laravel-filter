<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @stack('styles')
</head>
<body class="antialiased bg-gray-50">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center">
                        <a href="{{ route('products.index') }}" class="flex items-center space-x-3 group">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-500 rounded-xl flex items-center justify-center group-hover:from-orange-700 group-hover:to-orange-600 transition-all duration-200 shadow-md group-hover:shadow-lg">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <span class="text-xl font-bold text-gray-900">
                                {{ config('app.name') }}
                            </span>
                        </a>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('products.index') }}" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Início
                        </a>
                        <a href="{{ route('admin.activity-logs.index') }}" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Logs de Atividade
                        </a>
                        <a href="{{ route('admin.search-logs.index') }}" class="text-sm text-gray-700 hover:text-orange-600 font-semibold transition-colors duration-200 px-4 py-2 rounded-lg hover:bg-orange-50">
                            Logs de Pesquisa
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
</body>
</html>
