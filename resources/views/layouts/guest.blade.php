<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TOEFL Test') }} - Authentication</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Plus Jakarta Sans', sans-serif; }
            .form-input {
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 lg:bg-white text-gray-900 min-h-screen">
        <div class="min-h-screen flex w-full">
            
            <!-- Left Side: Form Container -->
            <div class="w-full lg:w-1/2 flex flex-col items-center justify-between p-6 sm:p-12 min-h-screen">
                <!-- Top Spacing -->
                <div class="w-full h-4"></div>

                <!-- Form Card -->
                <div class="w-full max-w-md bg-white rounded-3xl border border-slate-100/80 shadow-xl shadow-slate-200/30 p-8 sm:p-10 lg:shadow-none lg:border-0 lg:p-0">
                    <!-- Logo / Brand -->
                    <div class="flex justify-center items-center gap-2.5 mb-8">
                        <div class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-lg shadow-indigo-600/30">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5.5 h-5.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight text-gray-900">TOEFL<span class="text-indigo-600 font-light">ITP</span></span>
                    </div>

                    <!-- Slot Content (Login/Register Form) -->
                    {{ $slot }}
                </div>

                <!-- Footer Links -->
                <div class="mt-8 flex justify-between w-full max-w-md text-xs font-semibold text-gray-400">
                    <a href="#" class="hover:text-indigo-600 transition-colors">Privacy Policy</a>
                    <p>&copy; {{ date('Y') }} TOEFL ITP Portal</p>
                </div>
            </div>

            <!-- Right Side: Visual Section -->
            <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800 flex-col items-center justify-center p-16 relative overflow-hidden">
                <!-- Decorative blurred glow elements -->
                <div class="absolute top-[-15%] right-[-15%] w-[450px] h-[450px] rounded-full bg-indigo-400/30 blur-[100px]"></div>
                <div class="absolute bottom-[-15%] left-[-15%] w-[450px] h-[450px] rounded-full bg-purple-500/25 blur-[100px]"></div>

                <div class="z-10 w-full max-w-lg flex flex-col items-center text-center">
                    <h2 class="text-3xl font-extrabold text-white mb-3 tracking-tight">Simulasi Tes TOEFL ITP Terbaik</h2>
                    <p class="text-indigo-100 text-sm mb-12 max-w-sm leading-relaxed">
                        Rasakan pengalaman simulasi dengan standar waktu dan format soal yang presisi untuk hasil maksimal.
                    </p>

                    <!-- Interactive Dashboard Mockup Card -->
                    <div class="bg-white/95 rounded-[32px] p-6 w-full max-w-[390px] shadow-2xl relative border border-white/40 mb-10 hover:scale-[1.02] transition-all duration-500 group">
                        
                        <!-- Mini circular chart and header -->
                        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                            <div>
                                <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-widest block mb-0.5">Estimasi Skor</span>
                                <span class="text-3xl font-extrabold text-slate-800 tracking-tight">580 <span class="text-xs font-medium text-slate-400">/ 677</span></span>
                            </div>
                            <div class="relative w-14 h-14 flex items-center justify-center">
                                <!-- Circular progress SVG -->
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-slate-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-indigo-600 transition-all duration-1000 ease-out" stroke-dasharray="85, 100" stroke-linecap="round" stroke-width="3.5" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <span class="absolute text-xs font-extrabold text-slate-800">85%</span>
                            </div>
                        </div>

                        <!-- Section progress items -->
                        <div class="space-y-4">
                            <!-- Listening section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2Zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2ZM9 10l12-3" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-bold text-slate-700 truncate">Listening Comprehension</span>
                                        <span class="text-[10px] font-bold text-slate-500">90%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Structure section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600 font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-bold text-slate-700 truncate">Structure & Written Expression</span>
                                        <span class="text-[10px] font-bold text-slate-500">75%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-purple-600 h-full rounded-full transition-all duration-1000" style="width: 75%"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reading section card -->
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-sky-50 flex items-center justify-center text-sky-600 font-bold shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-xs font-bold text-slate-700 truncate">Reading Comprehension</span>
                                        <span class="text-[10px] font-bold text-slate-500">60%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                        <div class="bg-sky-600 h-full rounded-full transition-all duration-1000" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Testimonial -->
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20 text-left max-w-[390px] shadow-lg">
                        <p class="text-xs text-indigo-50 leading-relaxed italic mb-3">
                            "Simulasinya sangat mirip dengan tes asli. Timer dan format penulisan soalnya betul-betul melatih mental. Skor saya naik dari 480 ke 570!"
                        </p>
                        <div class="flex items-center gap-3">
                            <div class="w-7 h-7 rounded-full bg-indigo-500/30 flex items-center justify-center font-bold text-xs text-white">
                                AP
                            </div>
                            <div>
                                <div class="text-xs font-bold text-white">Ari Prasetyo</div>
                                <div class="text-[10px] text-indigo-200">Mahasiswa Universitas Indonesia</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

