<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth

                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-500 font-bold">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-500 font-bold">Registrar</a>
                        @endif
                    @endif
                </div>
            @endif
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="p-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-gray-200 md:flex md:justify-between md:items-center">
                                    <div class="space-y-3">
                                        <p class="text-6xl">Bienvenido <br> Alquila<span class="font-bold">Pucallpa</span></p>
                                    </div>
                                </div>
                                <div class="p-6 space-y-3 mt-10">
                                    <p class="text-sm">AlquilaPucallpa Derechos Reservados 2022</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>