<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Masbro - Platform TOEFL & Pembelajaran Bahasa Inggris</title>

        <!-- Meta tags for SEO -->
        <meta name="description" content="Tingkatkan skor TOEFL ITP Anda dengan simulasi standar resmi dan pembelajaran terstruktur di Masbro.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts / Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-body text-body antialiased bg-surface">

        <!-- Navbar -->
        <nav class="bg-canvas h-16 border-b border-hairline shadow-sm sticky top-0 z-50">
            <div class="max-w-container mx-auto px-6 lg:px-8 h-full flex justify-between items-center">
                <a href="/" class="flex items-center gap-3 text-ink">
                    
                    <span class="text-xl font-bold tracking-tight">Masbro<span class="text-green">•</span></span>
                </a>
                <div class="flex items-center gap-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-body-sm font-semibold text-muted hover:text-ink transition duration-120">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-body-sm font-semibold text-muted hover:text-ink transition duration-120">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm rounded-md shadow-sm">Mulai Belajar</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="bg-surface min-h-[90vh] flex items-center py-16">
            <div class="max-w-container mx-auto px-6 lg:px-8 w-full">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left: Hero Text (6/12) -->
                    <div class="lg:col-span-6 space-y-6">
                        <span class="text-label-lg text-green uppercase tracking-wider block font-bold">Platform TOEFL Terpercaya</span>
                        <h1 class="text-display-xl font-bold text-ink leading-tight">
                            Belajar Bahasa Inggris.<br/>Raih Skor TOEFL Terbaik.
                        </h1>
                        <p class="text-body-lg text-muted max-w-xl leading-relaxed">
                            Simulasi TOEFL ITP dengan waktu real-time yang akurat. Akses materi belajar terstruktur yang menyenangkan seperti bermain game.
                        </p>
                        <div class="flex flex-wrap gap-4 pt-2">
                            <a href="{{ route('register') }}" class="btn btn-primary px-8 py-3.5 shadow-md">
                                Mulai Gratis
                            </a>
                            <a href="#cara-kerja" class="btn btn-ghost px-8 py-3.5 border border-hairline hover:bg-canvas">
                                Lihat cara kerja
                            </a>
                        </div>
                        <div class="pt-4 flex items-center gap-3 text-body-sm text-muted">
                            <div class="flex -space-x-2">
                                <span class="w-8 h-8 rounded-full bg-green text-white text-xs font-bold border-2 border-surface flex items-center justify-center">12k</span>
                                <span class="w-8 h-8 rounded-full bg-blue text-white text-xs font-bold border-2 border-surface flex items-center justify-center">AP</span>
                                <span class="w-8 h-8 rounded-full bg-purple text-white text-xs font-bold border-2 border-surface flex items-center justify-center">SF</span>
                            </div>
                            <span>12.400+ pelajar aktif minggu ini</span>
                        </div>
                    </div>

                    <!-- Right: Floating Score Card Mockup (6/12) -->
                    <div class="lg:col-span-6 flex flex-col items-center justify-center relative">
                        <!-- Score Card Component -->
                        <div class="bg-canvas border border-hairline rounded-lg shadow-lg p-6 w-full max-w-[320px] relative z-10 hover:-translate-y-1 transition duration-300">
                            <span class="text-label-sm text-green uppercase tracking-widest font-bold">Skor TOEFL Anda</span>
                            <div class="flex items-baseline mt-2">
                                <span class="text-score-display font-extrabold text-ink leading-none tracking-tighter">677</span>
                                <span class="text-body-sm font-semibold text-muted ml-2">/ 677</span>
                            </div>
                            <div class="border-t border-hairline mt-4 pt-4 space-y-3">
                                <div>
                                    <div class="flex justify-between items-center text-xs mb-1">
                                        <span class="font-semibold text-ink">Listening</span>
                                        <span class="font-bold text-blue">68 / 68</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-blue h-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between items-center text-xs mb-1">
                                        <span class="font-semibold text-ink">Structure</span>
                                        <span class="font-bold text-purple">68 / 68</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-purple h-full" style="width: 100%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between items-center text-xs mb-1">
                                        <span class="font-semibold text-ink">Reading</span>
                                        <span class="font-bold text-green">67 / 68</span>
                                    </div>
                                    <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                                        <div class="bg-green h-full" style="width: 98%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3 small stats under score card -->
                        <div class="flex gap-4 mt-6 z-10 w-full max-w-[320px] justify-between">
                            <div class="bg-canvas border border-hairline py-2 px-3 rounded-md shadow-sm flex items-center gap-2 flex-grow text-center justify-center">
                                <span class="text-yellow text-lg font-bold">14</span>
                                <span class="text-[10px] text-muted uppercase font-bold tracking-wider">Streak</span>
                            </div>
                            <div class="bg-canvas border border-hairline py-2 px-3 rounded-md shadow-sm flex items-center gap-2 flex-grow text-center justify-center">
                                <span class="text-green text-lg font-bold">150</span>
                                <span class="text-[10px] text-muted uppercase font-bold tracking-wider">Soal</span>
                            </div>
                            <div class="bg-canvas border border-hairline py-2 px-3 rounded-md shadow-sm flex items-center gap-2 flex-grow text-center justify-center">
                                <span class="text-blue text-lg font-bold">95%</span>
                                <span class="text-[10px] text-muted uppercase font-bold tracking-wider font-variant-numeric: tabular-nums">Akurasi</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- Skill Section -->
        <section id="fitur" class="bg-canvas py-16">
            <div class="max-w-container mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                    <span class="text-label-lg text-green uppercase tracking-wider block font-bold">Materi Terarah</span>
                    <h2 class="text-display-lg font-bold text-ink">
                        Kuasai Seluruh Seksi TOEFL ITP
                    </h2>
                    <p class="text-body-lg text-muted">
                        Pelajaran dirancang khusus per-topik untuk mempercepat penguasaan pemahaman Anda.
                    </p>
                </div>

                <!-- Grid: 4 skill cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Listening Card -->
                    <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6 border-l-4 border-l-blue hover:-translate-y-1 hover:shadow-md transition duration-200 flex flex-col justify-between">
                        <div>
                            <span class="badge badge-listening">Listening</span>
                            <h3 class="text-title-lg text-ink font-bold mt-4 mb-2">Listening Comprehension</h3>
                            <p class="text-body-sm text-muted">
                                Latih pendengaran Anda dengan audio dialog pendek dan panjang standar TOEFL.
                            </p>
                        </div>
                        <div class="mt-6 flex items-center text-xs font-bold text-blue">
                            Pelajari Seksi &rarr;
                        </div>
                    </div>

                    <!-- Reading Card -->
                    <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6 border-l-4 border-l-green hover:-translate-y-1 hover:shadow-md transition duration-200 flex flex-col justify-between">
                        <div>
                            <span class="badge badge-reading">Reading</span>
                            <h3 class="text-title-lg text-ink font-bold mt-4 mb-2">Reading Comprehension</h3>
                            <p class="text-body-sm text-muted">
                                Pahami strategi menemukan ide pokok, referensi kata, dan kosakata khusus teks akademis.
                            </p>
                        </div>
                        <div class="mt-6 flex items-center text-xs font-bold text-green">
                            Pelajari Seksi &rarr;
                        </div>
                    </div>

                    <!-- Structure Card -->
                    <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6 border-l-4 border-l-purple hover:-translate-y-1 hover:shadow-md transition duration-200 flex flex-col justify-between">
                        <div>
                            <span class="badge badge-writing">Structure</span>
                            <h3 class="text-title-lg text-ink font-bold mt-4 mb-2">Structure & Expression</h3>
                            <p class="text-body-sm text-muted">
                                Kuasai pola klausa, subjek-predikat, paralelisme, dan pencarian kesalahan penulisan.
                            </p>
                        </div>
                        <div class="mt-6 flex items-center text-xs font-bold text-purple">
                            Pelajari Seksi &rarr;
                        </div>
                    </div>

                    <!-- Grammar Card -->
                    <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6 border-l-4 border-l-yellow hover:-translate-y-1 hover:shadow-md transition duration-200 flex flex-col justify-between">
                        <div>
                            <span class="badge badge-grammar">Grammar</span>
                            <h3 class="text-title-lg text-ink font-bold mt-4 mb-2">Grammar & Vocabulary</h3>
                            <p class="text-body-sm text-muted">
                                Perkaya kosakata akademis dan struktur kalimat kompleks Bahasa Inggris.
                            </p>
                        </div>
                        <div class="mt-6 flex items-center text-xs font-bold text-yellow">
                            Pelajari Seksi &rarr;
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gamification Section -->
        <section class="bg-surface py-16 border-t border-hairline">
            <div class="max-w-container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    
                    <!-- Left: Text (5/12) -->
                    <div class="lg:col-span-5 space-y-6">
                        <span class="text-label-lg text-yellow uppercase tracking-wider block font-bold">Belajar Lebih Seru</span>
                        <h2 class="text-display-md font-bold text-ink leading-tight">
                            Belajar Asyik Seperti Bermain Game
                        </h2>
                        <p class="text-body-md text-muted leading-relaxed">
                            Kami mengganti kebosanan belajar dengan elemen interaktif yang memicu motivasi harian Anda.
                        </p>
                        
                        <div class="space-y-4 pt-2">
                            <!-- Point 1 -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-yellow-light border border-yellow flex items-center justify-center text-yellow shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-ink text-title-md">Streak Harian</h4>
                                    <p class="text-body-sm text-muted">Jaga konsistensi belajar Anda setiap hari untuk mempertahankan barisan streak menyala.</p>
                                </div>
                            </div>
                            
                            <!-- Point 2 -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-green-light border border-green flex items-center justify-center text-green shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-ink text-title-md">XP Belajar</h4>
                                    <p class="text-body-sm text-muted">Kumpulkan Experience Points (XP) dari setiap materi dan kuis yang Anda selesaikan.</p>
                                </div>
                            </div>

                            <!-- Point 3 -->
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-blue-light border border-blue flex items-center justify-center text-blue shrink-0">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-ink text-title-md">Leaderboard Kompetitif</h4>
                                    <p class="text-body-sm text-muted">Bersaing secara sehat dengan pelajar lain di liga mingguan untuk menduduki peringkat teratas.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Visual mockup (7/12) -->
                    <div class="lg:col-span-7 bg-canvas border border-hairline rounded-lg shadow-lg p-6 relative overflow-hidden flex flex-col justify-between min-h-[360px]">
                        <!-- Top status bar inside mockup -->
                        <div class="flex justify-between items-center pb-4 border-b border-hairline">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 rounded-full bg-red"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow"></div>
                                <div class="w-3 h-3 rounded-full bg-green"></div>
                            </div>
                            <span class="text-xs font-semibold text-muted">Masbro.id/dashboard</span>
                        </div>
                        
                        <!-- Middle contents: mockup streak widget & XP progress bar -->
                        <div class="py-6 space-y-6 flex-grow">
                            <!-- Mockup Streak Widget -->
                            <div class="bg-yellow-light border border-yellow/40 rounded-lg p-4 flex items-center justify-between max-w-sm">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🔥</span>
                                    <div>
                                        <h5 class="text-title-md text-ink font-bold">14 Hari Beruntun</h5>
                                        <p class="text-xs text-muted">Kamu dalam performa terbaik!</p>
                                    </div>
                                </div>
                                <span class="text-xp-number font-bold text-yellow">14</span>
                            </div>

                            <!-- Mockup XP Bar -->
                            <div class="max-w-md space-y-2">
                                <div class="flex justify-between items-center text-xs">
                                    <span class="font-bold text-green uppercase tracking-wider">XP HARI INI</span>
                                    <span class="font-bold text-ink">340 / 500 XP</span>
                                </div>
                                <div class="w-full bg-hairline h-3 rounded-pill overflow-hidden">
                                    <div class="bg-yellow h-full rounded-pill transition-all" style="width: 68%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Social Proof Section -->
        <section class="bg-surface py-16 border-t border-hairline">
            <div class="max-w-container mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                    <span class="text-label-lg text-green uppercase tracking-wider block font-bold">Apa Kata Mereka</span>
                    <h2 class="text-display-md font-bold text-ink">
                        Hasil Nyata Dari Mereka Yang Belajar
                    </h2>
                </div>

                <!-- Side-by-side Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-canvas border border-hairline rounded-lg p-6 shadow-card flex flex-col justify-between hover:shadow-md transition">
                        <p class="text-body-md text-ink leading-relaxed mb-6">
                            "Mengerjakan simulasi TOEFL di Masbro membuat saya terbiasa dengan tekanan waktu ujian sesungguhnya. Navigasi soal sangat nyaman, audionya jernih, dan hasil estimasi skornya sangat akurat dengan hasil tes resmi saya!"
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-green text-white font-bold flex items-center justify-center">
                                AP
                            </div>
                            <div>
                                <h4 class="font-bold text-ink text-body-md">Ari Prasetyo</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-muted">Universitas Indonesia</span>
                                    <span class="badge badge-correct text-[10px] font-variant-numeric: tabular-nums">480 &rarr; 580</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="bg-canvas border border-hairline rounded-lg p-6 shadow-card flex flex-col justify-between hover:shadow-md transition">
                        <p class="text-body-md text-ink leading-relaxed mb-6">
                            "Latihan structure per-topik di sini sangat melatih kepekaan tata bahasa saya. Penjelasan detail setelah submit soal sangat membantu memahami pola jebakan TOEFL. Sangat suka dengan antarmukanya!"
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-purple text-white font-bold flex items-center justify-center">
                                SF
                            </div>
                            <div>
                                <h4 class="font-bold text-ink text-body-md">Sarah Fitri</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-muted">UGM Yogyakarta</span>
                                    <span class="badge badge-correct text-[10px] font-variant-numeric: tabular-nums">510 &rarr; 620</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section id="cara-kerja" class="bg-canvas py-16 border-t border-hairline">
            <div class="max-w-container mx-auto px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16 space-y-3">
                    <span class="text-label-lg text-green uppercase tracking-wider block font-bold">Proses Belajar</span>
                    <h2 class="text-display-md font-bold text-ink">
                        Bagaimana Masbro Bekerja?
                    </h2>
                </div>

                <!-- Horizontal Timeline -->
                <div class="relative">
                    <!-- Connector line for desktop -->
                    <div class="absolute top-8 left-0 right-0 h-0.5 border-t border-dashed border-hairline hidden md:block z-0"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
                        <!-- Step 1 -->
                        <div class="bg-canvas p-6 text-center space-y-4">
                            <div class="w-12 h-12 bg-green-light rounded-full text-green-dark flex items-center justify-center font-bold text-lg mx-auto border border-green shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <h3 class="text-title-md text-ink font-bold">1. Daftar Akun</h3>
                            <p class="text-body-sm text-muted max-w-xs mx-auto">
                                Registrasi instan dan gratis. Buat profil belajarmu dalam waktu kurang dari satu menit.
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-canvas p-6 text-center space-y-4">
                            <div class="w-12 h-12 bg-green-light rounded-full text-green-dark flex items-center justify-center font-bold text-lg mx-auto border border-green shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            </div>
                            <h3 class="text-title-md text-ink font-bold">2. Uji Simulasi</h3>
                            <p class="text-body-sm text-muted max-w-xs mx-auto">
                                Mulai uji simulasi TOEFL secara penuh atau latihan per-seksi untuk mendiagnosis level awalmu.
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-canvas p-6 text-center space-y-4">
                            <div class="w-12 h-12 bg-green-light rounded-full text-green-dark flex items-center justify-center font-bold text-lg mx-auto border border-green shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z" />
                                </svg>
                            </div>
                            <h3 class="text-title-md text-ink font-bold">3. Latihan & Naikkan Skor</h3>
                            <p class="text-body-sm text-muted max-w-xs mx-auto">
                                Ikuti materi belajar, kumpulkan XP harian, dan pantau grafik kenaikan skor secara berkala.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Band -->
        <section class="bg-ink text-white py-16 text-center">
            <div class="max-w-3xl mx-auto px-6 space-y-6">
                <h2 class="text-display-md font-bold text-white">
                    Siap Naikkan Skor TOEFL ITP Kamu?
                </h2>
                <p class="text-body-md text-white/70 max-w-xl mx-auto leading-relaxed">
                    Akses kuis latihan, peroleh streak harian, dan evaluasi hasil secara real-time.
                </p>
                <div class="pt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary px-8 py-3.5 shadow-md">
                        Daftar Sekarang - Gratis
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-canvas text-muted py-12 border-t border-hairline font-body">
            <div class="max-w-container mx-auto px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Column 1: Logo -->
                    <div class="space-y-4">
                        <a href="/" class="flex items-center gap-3 text-ink">
                            
                            <span class="text-lg font-bold tracking-tight text-ink">Masbro<span class="text-green">•</span></span>
                        </a>
                        <p class="text-xs text-muted max-w-xs leading-relaxed">
                            Belajar TOEFL ITP Lebih Efektif. Latihan simulasi real-time, materi terstruktur, dan analisis skor akurat.
                        </p>
                    </div>

                    <!-- Column 2: Fitur -->
                    <div class="space-y-3">
                        <h4 class="text-ink font-bold text-body-sm">Fitur</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="{{ route('login') }}" class="hover:text-ink transition-colors">Simulasi TOEFL</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-ink transition-colors">Latihan Soal</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-ink transition-colors">Analisis Skor</a></li>
                        </ul>
                    </div>

                    <!-- Column 3: Tentang -->
                    <div class="space-y-3">
                        <h4 class="text-ink font-bold text-body-sm">Tentang</h4>
                        <ul class="space-y-2 text-xs">
                            <li><a href="#" class="hover:text-ink transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-ink transition-colors">Syarat Ketentuan</a></li>
                            <li><a href="#" class="hover:text-ink transition-colors">Kebijakan Privasi</a></li>
                        </ul>
                    </div>

                    <!-- Column 4: Kontak -->
                    <div class="space-y-3">
                        <h4 class="text-ink font-bold text-body-sm">Hubungi Kami</h4>
                        <ul class="space-y-2 text-xs">
                            <li>Email: support@Masbro.id</li>
                            <li>WhatsApp: +62-812-3456-7890</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-hairline mt-10 pt-6 text-center text-xs">
                    <p>&copy; {{ date('Y') }} Masbro Portal. Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </footer>

    </body>
</html>
