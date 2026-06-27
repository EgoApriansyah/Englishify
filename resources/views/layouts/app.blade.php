<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Englishify') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-body antialiased bg-surface" x-data="{ sidebarOpen: true }">
        <div class="min-h-screen flex flex-col sm:flex-row">
            
            <!-- Navigation (Sidebar on Desktop, Bottom Nav on Mobile) -->
            @include('layouts.navigation')

            <!-- Desktop Sidebar Toggle Button -->
            <button @click="sidebarOpen = !sidebarOpen" 
                    class="hidden sm:flex fixed top-6 z-30 items-center justify-center w-8 h-8 rounded-full bg-canvas text-ink border border-hairline hover:bg-surface hover:scale-105 shadow-md transition-all duration-300 focus:outline-none cursor-pointer"
                    :class="sidebarOpen ? 'left-[224px]' : 'left-4'">
                <svg class="w-4 h-4 transition-transform duration-300" :class="{ 'rotate-180': !sidebarOpen }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Main Content Area -->
            <div class="flex-grow min-h-screen flex flex-col pb-16 sm:pb-0 transition-all duration-300"
                 :class="sidebarOpen ? 'sm:pl-60' : 'sm:pl-16'">
                
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-canvas border-b border-hairline sticky top-0 z-10 py-4 px-6 md:px-8">
                        <div class="max-w-container mx-auto">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-grow p-6 md:p-8">
                    <div class="max-w-container mx-auto">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
        @stack('scripts')
    </body>
</html>

