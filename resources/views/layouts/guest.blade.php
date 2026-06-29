<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Masbro') }} - Authentication</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-body antialiased bg-surface min-h-screen">
        <div class="min-h-screen flex w-full">
            
            <!-- Left Side: Form Container -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-between p-6 sm:p-12 min-h-screen">
                <!-- Top Spacing -->
                <div class="w-full h-4"></div>

                <!-- Form Card -->
                <div class="w-full max-w-md bg-canvas rounded-lg border border-hairline shadow-card p-8 sm:p-10">
                    <!-- Logo / Brand -->
                    <div class="flex justify-center items-center gap-3 mb-8">
                       
                        <span class="text-2xl font-bold text-ink tracking-tight">Masbro<span class="text-green">•</span></span>
                    </div>

                    <!-- Slot Content (Login/Register Form) -->
                    {{ $slot }}
                </div>

                <!-- Footer Links -->
                <div class="mt-8 flex justify-between w-full max-w-md text-xs font-semibold text-muted">
                    <a href="#" class="hover:text-green-dark transition-colors">Privacy Policy</a>
                    <p>&copy; {{ date('Y') }} Masbro Portal</p>
                </div>
            </div>

            <!-- Right Side: Visual Section -->
            <div class="hidden lg:flex w-1/2 bg-ink relative flex-col items-start justify-end p-16 overflow-hidden">
                <!-- Background Image & Gradient overlay -->
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('images/koala-login.png') }}" class="w-full h-full object-cover" style="object-position: right center;" alt="Koala Login Background">
                    <!-- Dark gradient overlay from left to right -->
                    <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/50 to-transparent"></div>
                </div>

                <!-- Text Overlay -->
                <div class="relative z-10 max-w-md text-left space-y-3 font-body">
                    <h2 class="text-3xl font-extrabold text-white leading-tight tracking-tight">
                        Simulasi TOEFL & Pembelajaran Terstruktur
                    </h2>
                    <p class="text-white/70 text-sm leading-relaxed font-normal">
                        Dapatkan estimasi skor TOEFL ITP yang akurat, materi belajar terarah, dan latihan interaktif untuk meningkatkan kemampuan bahasa Inggrismu secara signifikan.
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>


