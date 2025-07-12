<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Sistem Pendukung Keputusan - Siswa KSM'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="relative min-h-screen flex flex-col items-center justify-center">

        <!-- Background Image Layer -->
        <div class="absolute inset-0 bg-[url('/public/build/assets/bg-sullamul1.jpeg')] bg-cover bg-center blur-sm z-0"></div>

        <!-- Foreground Content -->
        <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 backdrop-blur-md shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>
