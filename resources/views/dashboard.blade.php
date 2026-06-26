<x-app-layout>
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-display-sm font-bold text-ink">Selamat pagi, {{ $user->name }}</h1>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-yellow-light text-yellow rounded-full font-bold text-xs border border-yellow/30">
                    🔥 14 Hari Streak
                </span>
            </div>
            <p class="text-body-md text-muted mt-1">Kamu dalam performa terbaik! Tetap jaga konsistensi belajarmu.</p>
        </div>
        
        <!-- Start Test Action -->
        <div>
            @if($activeSession)
                <a href="{{ route('test.' . $activeSession->current_section, $activeSession->id) }}" class="btn btn-primary bg-yellow hover:bg-yellow-dark text-ink font-bold flex items-center gap-2">
                    <span>Lanjutkan Tes ({{ ucfirst($activeSession->current_section) }})</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <form method="POST" action="{{ route('test.start') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        <span>Mulai Tes TOEFL Baru</span>
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Stat Row (4 cards) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1 -->
        <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-card">
            <span class="text-label-sm text-green uppercase tracking-wider block font-bold">XP Hari Ini</span>
            <div class="flex items-baseline mt-2">
                <span class="text-xp-number font-bold text-ink">340</span>
                <span class="text-xs text-muted ml-1">/ 500 XP</span>
            </div>
            <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden mt-3">
                <div class="bg-yellow h-full" style="width: 68%"></div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-card">
            <span class="text-label-sm text-blue uppercase tracking-wider block font-bold">Soal Selesai</span>
            <div class="flex items-baseline mt-2">
                <span class="text-xp-number font-bold text-ink">120</span>
                <span class="text-xs text-muted ml-1">Soal</span>
            </div>
            <p class="text-[10px] text-muted mt-3">Meningkat 15% dari minggu lalu</p>
        </div>
        <!-- Card 3 -->
        <div class="bg-ink p-5 rounded-lg border border-white/5 shadow-card relative overflow-hidden text-white">
            <!-- Decorative Koala Background Image covering the entire card -->
            <div class="absolute inset-0 z-0 pointer-events-none">
                <img src="{{ asset('images/koala-nerd.png') }}" class="w-full h-full object-cover" style="object-position: right 15%;" alt="Koala Nerd Background">
                <!-- overlay dark gradient to ensure text contrast on the left -->
                <div class="absolute inset-0 bg-gradient-to-r from-ink/90 via-ink/50 to-transparent"></div>
            </div>

            <div class="relative z-10">
                <span class="text-label-sm text-purple-light uppercase tracking-wider block font-bold">Akurasi</span>
                <div class="flex items-baseline mt-2">
                    <span class="text-xp-number font-bold text-white">85%</span>
                    <span class="text-xs text-white/70 ml-1">Rata-rata</span>
                </div>
                <p class="text-[10px] text-white/85 mt-3 font-normal">Seksi Reading tertinggi</p>
            </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-card">
            <span class="text-label-sm text-yellow uppercase tracking-wider block font-bold">Peringkat Liga</span>
            <div class="flex items-baseline mt-2">
                <span class="text-xp-number font-bold text-ink font-variant-numeric: tabular-nums">#3</span>
                <span class="text-xs text-muted ml-1">Liga Emas</span>
            </div>
            <p class="text-[10px] text-muted mt-3">Aman dari zona degradasi</p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-8">
        <!-- Left Column: Plan & Chart (7/12) -->
        <div class="lg:col-span-7 space-y-8">
            <!-- Today's Plan Card -->
            <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6">
                <h3 class="text-title-lg font-bold text-ink mb-4">Rencana Hari Ini</h3>
                <div class="space-y-4">
                    <!-- Lesson 1 -->
                    <div class="flex items-center justify-between p-4 bg-surface border border-hairline rounded-lg hover:-translate-y-px transition duration-150">
                        <div class="flex items-center gap-3">
                            <span class="badge badge-listening">Listening</span>
                            <div>
                                <h4 class="font-bold text-ink text-sm">Strategi Dialog Pendek</h4>
                                <p class="text-xs text-muted">Durasi estimasi: 15 menit</p>
                            </div>
                        </div>
                        <a href="{{ route('material.index') }}" class="btn btn-secondary btn-sm h-8 rounded-md">Mulai</a>
                    </div>
                    
                    <!-- Lesson 2 -->
                    <div class="flex items-center justify-between p-4 bg-surface border border-hairline rounded-lg hover:-translate-y-px transition duration-150">
                        <div class="flex items-center gap-3">
                            <span class="badge badge-grammar">Grammar</span>
                            <div>
                                <h4 class="font-bold text-ink text-sm">Subject-Verb Agreement</h4>
                                <p class="text-xs text-muted">Durasi estimasi: 10 menit</p>
                            </div>
                        </div>
                        <a href="{{ route('material.index') }}" class="btn btn-secondary btn-sm h-8 rounded-md">Mulai</a>
                    </div>

                    <!-- Lesson 3 -->
                    <div class="flex items-center justify-between p-4 bg-surface border border-hairline rounded-lg hover:-translate-y-px transition duration-150">
                        <div class="flex items-center gap-3">
                            <span class="badge badge-reading">Reading</span>
                            <div>
                                <h4 class="font-bold text-ink text-sm">Menemukan Gagasan Utama</h4>
                                <p class="text-xs text-muted">Durasi estimasi: 20 menit</p>
                            </div>
                        </div>
                        <a href="{{ route('material.index') }}" class="btn btn-secondary btn-sm h-8 rounded-md">Mulai</a>
                    </div>
                </div>
            </div>

            <!-- Progress Chart Card -->
            <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-title-lg font-bold text-ink">Statistik Belajar (30 Hari)</h3>
                    <span class="text-xs font-semibold text-muted">Target Harian: 150 XP</span>
                </div>
                <!-- Mock SVG Line Chart -->
                <div class="h-48 w-full bg-surface border border-hairline rounded-lg p-4 flex items-end justify-between relative overflow-hidden">
                    <!-- Grid lines -->
                    <div class="absolute inset-x-0 top-1/4 border-t border-dashed border-hairline/60"></div>
                    <div class="absolute inset-x-0 top-2/4 border-t border-dashed border-hairline/60"></div>
                    <div class="absolute inset-x-0 top-3/4 border-t border-dashed border-hairline/60"></div>
                    
                    <!-- Line graph path -->
                    <svg class="absolute inset-0 h-full w-full" preserveAspectRatio="none" viewBox="0 0 100 100">
                        <!-- Gradient under line -->
                        <path d="M 0 100 L 10 90 L 20 85 L 30 92 L 40 70 L 50 65 L 60 78 L 70 50 L 80 40 L 90 48 L 100 30 L 100 100 Z" fill="rgba(34, 197, 94, 0.08)"></path>
                        <!-- Green line -->
                        <path d="M 0 100 L 10 90 L 20 85 L 30 92 L 40 70 L 50 65 L 60 78 L 70 50 L 80 40 L 90 48 L 100 30" fill="none" stroke="#22C55E" stroke-width="2.5" stroke-linecap="round"></path>
                    </svg>
                    
                    <!-- Labels -->
                    <span class="text-[9px] text-muted absolute left-2 top-2">XP</span>
                    <span class="text-[9px] text-muted absolute bottom-2 right-2">Hari</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Leaderboard (5/12) -->
        <div class="lg:col-span-5">
            <!-- Leaderboard Card -->
            <div class="bg-canvas border border-hairline rounded-lg shadow-card p-6 h-full">
                <h3 class="text-title-lg font-bold text-ink mb-4">Peringkat Liga Emas</h3>
                <div class="space-y-3">
                    <!-- Row 1 -->
                    <div class="flex items-center justify-between p-3 rounded-lg border border-hairline bg-surface">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold">🥇</span>
                            <div class="w-8 h-8 rounded-full bg-blue text-white flex items-center justify-center font-bold text-xs">AM</div>
                            <span class="text-sm font-bold text-ink">Ahmad Maulana</span>
                        </div>
                        <span class="text-xs font-bold text-ink">950 XP</span>
                    </div>
                    
                    <!-- Row 2 -->
                    <div class="flex items-center justify-between p-3 rounded-lg border border-hairline bg-surface">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold">🥈</span>
                            <div class="w-8 h-8 rounded-full bg-purple text-white flex items-center justify-center font-bold text-xs">DN</div>
                            <span class="text-sm font-bold text-ink">Dina Nurdiana</span>
                        </div>
                        <span class="text-xs font-bold text-ink">870 XP</span>
                    </div>

                    <!-- Row 3 (User itself highlighted) -->
                    <div class="flex items-center justify-between p-3 rounded-lg border border-green bg-green-light font-bold">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold">🥉</span>
                            <div class="w-8 h-8 rounded-full bg-green text-white flex items-center justify-center font-bold text-xs">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <span class="text-sm text-green-dark">{{ $user->name }} (Anda)</span>
                        </div>
                        <span class="text-xs text-green-dark">720 XP</span>
                    </div>

                    <!-- Row 4 -->
                    <div class="flex items-center justify-between p-3 rounded-lg border border-hairline bg-surface">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-muted">4</span>
                            <div class="w-8 h-8 rounded-full bg-blue text-white flex items-center justify-center font-bold text-xs">BP</div>
                            <span class="text-sm font-bold text-ink font-normal">Budi Pradipta</span>
                        </div>
                        <span class="text-xs font-bold text-ink">610 XP</span>
                    </div>

                    <!-- Row 5 -->
                    <div class="flex items-center justify-between p-3 rounded-lg border border-hairline bg-surface">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-muted">5</span>
                            <div class="w-8 h-8 rounded-full bg-yellow text-white flex items-center justify-center font-bold text-xs">RI</div>
                            <span class="text-sm font-bold text-ink font-normal">Riana Indah</span>
                        </div>
                        <span class="text-xs font-bold text-ink">540 XP</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table Card -->
    <div class="bg-canvas shadow-card rounded-lg border border-hairline overflow-hidden">
        <div class="px-6 py-5 border-b border-hairline">
            <h3 class="text-title-lg font-bold text-ink">Riwayat Tes Anda</h3>
        </div>
        
        @if($sessions->isEmpty())
            <div class="p-12 text-center text-muted">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-hairline mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="text-body-sm">Anda belum pernah mengambil tes TOEFL.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface text-ink font-bold text-xs uppercase tracking-wider border-b border-hairline">
                            <th class="px-6 py-4">Tanggal Tes</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Estimasi Skor</th>
                            <th class="px-6 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-hairline text-body-sm text-ink font-medium">
                        @foreach($sessions as $session)
                            <tr class="hover:bg-green-light/10 transition-colors duration-120">
                                <td class="px-6 py-4 text-muted font-normal">
                                    {{ $session->started_at->timezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB
                                </td>
                                <td class="px-6 py-4">
                                    @if($session->finished_at)
                                        <span class="badge badge-correct">
                                            Selesai
                                        </span>
                                    @else
                                        <span class="badge badge-streak">
                                            Belum Selesai ({{ ucfirst($session->current_section) }})
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-bold font-variant-numeric: tabular-nums">
                                    @if($session->finished_at)
                                        @php
                                            $correctListening = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'listening'); })->where('is_correct', true)->count();
                                            $correctStructure = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'structure'); })->where('is_correct', true)->count();
                                            $correctReading = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'reading'); })->where('is_correct', true)->count();
                                            
                                            $listeningScaled  = round(31 + ($correctListening / 18) * 37);
                                            $structureScaled  = round(31 + ($correctStructure / 20) * 37);
                                            $readingScaled    = round(31 + ($correctReading / 35) * 37);
                                            $totalScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);
                                        @endphp
                                        <span class="text-green-dark text-base">{{ $totalScore }}</span>
                                    @else
                                        <span class="text-muted font-normal">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if($session->finished_at)
                                        <div class="flex items-center justify-end space-x-3 font-semibold text-xs">
                                            <a href="{{ route('test.result', $session->id) }}" class="text-green-dark hover:underline">
                                                Hasil
                                            </a>
                                            <span class="text-hairline">|</span>
                                            <a href="{{ route('test.review', $session->id) }}" class="text-muted hover:text-ink hover:underline">
                                                Review
                                            </a>
                                        </div>
                                    @else
                                        <a href="{{ route('test.' . $session->current_section, $session->id) }}" class="text-yellow hover:text-yellow-dark hover:underline font-bold text-xs">
                                            Lanjutkan
                                        </a>
                                    @endif
                                </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          @endif
      </div>
  </x-app-layout>

