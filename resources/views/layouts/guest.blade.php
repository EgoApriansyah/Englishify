<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Englishify') }} - Authentication</title>

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
                        <img src="{{ asset('images/Logo.png') }}" class="h-10 w-auto object-contain shrink-0" alt="Logo">
                        <span class="text-2xl font-bold text-ink tracking-tight">Englishify<span class="text-green">•</span></span>
                    </div>

                    <!-- Slot Content (Login/Register Form) -->
                    {{ $slot }}
                </div>

                <!-- Footer Links -->
                <div class="mt-8 flex justify-between w-full max-w-md text-xs font-semibold text-muted">
                    <a href="#" class="hover:text-green-dark transition-colors">Privacy Policy</a>
                    <p>&copy; {{ date('Y') }} Englishify Portal</p>
                </div>
            </div>

            <!-- Right Side: Visual Section -->
            <div class="hidden lg:flex w-1/2 bg-green flex-col items-center justify-center p-16 relative overflow-hidden">
                <!-- Subtle decorative pattern background -->
                <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(circle, #FFFFFF 1px, transparent 1px); background-size: 20px 20px;"></div>

                <div class="z-10 w-full max-w-lg flex flex-col items-center text-center">
                    <h2 class="text-display-sm font-bold text-white mb-3">Simulasi TOEFL & Pembelajaran Terstruktur</h2>
                    <p class="text-white/80 text-body-sm mb-12 max-w-sm leading-relaxed">
                        Dapatkan estimasi skor TOEFL ITP yang akurat dan materi belajar terarah untuk meningkatkan keahlian berbahasa Inggrismu.
                    </p>

                    <!-- Interactive Dashboard Mockup Card -->
                    <div class="bg-canvas rounded-lg border border-hairline p-6 w-full max-w-[390px] shadow-lg relative mb-10 hover:-translate-y-1 transition-all duration-300 group text-left">
                        
                        <!-- Header and TOEFL Score -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-hairline">
                            <div>
                                <span class="text-label-sm text-green font-bold uppercase tracking-widest block mb-0.5">Estimasi Skor</span>
                                <span class="text-3xl font-bold text-ink tracking-tight">580 <span class="text-xs font-semibold text-muted">/ 677</span></span>
                            </div>
                            <div class="relative w-14 h-14 flex items-center justify-center">
                                <!-- Circular progress SVG -->
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-hairline" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-green transition-all duration-1000 ease-out" stroke-dasharray="85, 100" stroke-linecap="round" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <span class="absolute text-xs font-bold text-ink">85%</span>
                            </div>
                        </div>

                        <!-- Section progress items -->
                        <div class="space-y-4">
                            <!-- Listening section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-md bg-blue-light border border-hairline flex items-center justify-center text-blue font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2Zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2ZM9 10l12-3" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-semibold text-ink truncate">Listening Comprehension</span>
                                        <span class="text-[10px] font-bold text-muted">90%</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-blue h-full rounded-pill transition-all duration-1000" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Structure section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-md bg-yellow-light border border-hairline flex items-center justify-center text-yellow font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-semibold text-ink truncate">Structure & Written Expression</span>
                                        <span class="text-[10px] font-bold text-muted">75%</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-yellow h-full rounded-pill transition-all duration-1000" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reading section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-md bg-green-light border border-hairline flex items-center justify-center text-green font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-semibold text-ink truncate">Reading Comprehension</span>
                                        <span class="text-[10px] font-bold text-muted">60%</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-green h-full rounded-pill transition-all duration-1000" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Testimonial -->
                    <div class="bg-white/10 backdrop-blur-md rounded-md p-5 border border-white/20 text-left max-w-[390px] shadow-lg">
                        <p class="text-body-sm text-white leading-relaxed mb-3">
                            "Simulasinya sangat mirip dengan tes asli. Timer dan format penulisan soalnya betul-betul melatih mental. Skor saya naik dari 480 ke 580!"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-pill bg-white/20 flex items-center justify-center font-bold text-xs text-white">
                                AP
                            </div>
                            <div>
                                <div class="text-xs font-semibold text-white">Ari Prasetyo</div>
                                <div class="text-[10px] text-green-light">Mahasiswa Universitas Indonesia</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


