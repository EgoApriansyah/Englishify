<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'TOEFL Test') }} - Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <script src="https://cdn.tailwindcss.com"></script>
        @endif
        <style>
            body { font-family: 'Inter', sans-serif; }
            .glass-panel {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
        </style>
    </head>
    <body class="antialiased bg-slate-950 text-white min-h-screen relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-blue-600/20 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[50%] h-[50%] rounded-full bg-cyan-600/20 blur-[120px]"></div>
        </div>

        <div class="relative z-10 flex flex-col min-h-screen">
            <!-- Navigation -->
            <nav class="flex justify-between items-center px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-cyan-400 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight">TOEFL<span class="text-blue-400">ITP</span></span>
                </div>
                
                @if (Route::has('login'))
                    <div class="flex gap-4 items-center">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-5 py-2 rounded-lg font-medium text-sm transition hover:bg-white/10">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="px-5 py-2 rounded-lg font-medium text-sm transition hover:bg-white/10">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm transition shadow-lg shadow-blue-500/30">Register Now</a>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow flex flex-col items-center justify-center text-center px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl glass-panel rounded-3xl p-10 lg:p-16 shadow-2xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[80px] -mr-32 -mt-32"></div>
                    
                    <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight mb-6">
                        Master Your <br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">TOEFL Score</span>
                    </h1>
                    
                    <p class="text-lg lg:text-xl text-slate-300 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Experience the most realistic TOEFL ITP simulation. Practice with authentic questions, precise timing, and detailed performance analytics to achieve your target score.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('register') }}" class="px-8 py-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-semibold text-lg transition shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2 group">
                            Start Free Test
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-4 rounded-xl glass-panel hover:bg-white/10 text-white font-semibold text-lg transition flex items-center justify-center">
                            Sign In to Account
                        </a>
                    </div>
                    
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 pt-12 border-t border-white/10 text-left">
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="font-semibold text-white mb-2">Timed Simulation</h3>
                            <p class="text-sm text-slate-400">Experience real test pressure with strict timing per section.</p>
                        </div>
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-cyan-500/20 text-cyan-400 flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <h3 class="font-semibold text-white mb-2">Authentic Questions</h3>
                            <p class="text-sm text-slate-400">Carefully curated questions that match the real TOEFL ITP format.</p>
                        </div>
                        <div>
                            <div class="w-10 h-10 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                            </div>
                            <h3 class="font-semibold text-white mb-2">Instant Scoring</h3>
                            <p class="text-sm text-slate-400">Get your converted score immediately after finishing the test.</p>
                        </div>
                    </div>
                </div>
            </main>
            
            <footer class="py-6 text-center text-sm text-slate-500 border-t border-white/5">
                &copy; {{ date('Y') }} TOEFL ITP Test Portal. Built with Laravel.
            </footer>
        </div>
    </body>
</html>
