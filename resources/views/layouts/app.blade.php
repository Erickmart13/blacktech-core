<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <!-- Styles -->
    @livewireStyles
</head>

<body x-cloak class="font-sans antialiased" x-data="{ sidebarOpen: window.innerWidth >= 1024 }" x-init="window.addEventListener('resize', () => {
    sidebarOpen = window.innerWidth >= 1024
})">
    <x-banner />

    <div class="min-h-screen bg-gray-300">
        <!-- Page Heading -->

        <!-- Navegacion -->
        @include('layouts.partials.navigation-menu')

        <!-- Sidebar -->

        @include('layouts.partials.sidebar')

        <!-- Contenido principal -->
        <main>
            <div class="pt-24">
                <div class="bg-white lg:ml-72 mt-5 lg:py-5 lg:mr-6 lg:rounded-t-2xl">
                    {{ $slot }}
                </div>
            </div>
        </main>
        @include('layouts.partials.footer')
    </div>
    @stack('modals')
    @livewireScripts
    @stack('scripts')
</body>

</html>
