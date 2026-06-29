<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-display-sm text-ink leading-tight">
            {{ __('Hasil Analisis Tes TOEFL ITP') }}
        </h2>
    </x-slot>

    @php
        $levelName = 'BASIC';
        $levelClass = 'bg-red-light text-red border border-red/20';
        if ($totalScore >= 543) {
            $levelName = 'ADVANCED';
            $levelClass = 'bg-green-light text-green-dark border border-green/20';
        } elseif ($totalScore >= 460) {
            $levelName = 'INTERMEDIATE';
            $levelClass = 'bg-yellow-light text-yellow border border-yellow/20';
        }
    @endphp

    <div class="py-12 bg-surface min-h-screen font-body">
        <div class="max-w-container mx-auto px-6 lg:px-8 space-y-12">
            
            <!-- Hero Skor (Light Blue Background) -->
            <div class="bg-[#CDE8F6] rounded-lg shadow-lg overflow-hidden border border-blue-200 relative p-10 md:p-12">
                <!-- Decorative background score text -->
                <div class="absolute bottom-0 right-0 text-[180px] md:text-[240px] font-bold text-ink/[0.03] leading-none select-none translate-y-24 translate-x-12 pointer-events-none font-body">
                    {{ $totalScore }}
                </div>

                <div class="relative z-10 grid grid-cols-1 md:grid-cols-12 gap-8 items-center font-body">
                    <div class="md:col-span-8 space-y-4">
                        <span class="text-label-sm text-green-dark uppercase tracking-widest block font-bold">Skor TOEFL ITP Estimasi</span>
                        <div class="flex items-center gap-6 flex-wrap">
                            <h3 class="text-ink font-bold text-[64px] leading-none select-text">{{ $totalScore }}</h3>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-pill text-xs font-bold uppercase tracking-wider {{ $levelClass }}">
                                {{ $levelName }}
                            </span>
                        </div>
                        <p class="text-ink/80 text-body-sm max-w-xl font-body leading-relaxed pt-2">
                            Skor dihitung menggunakan formula konversi standar linier berdasarkan jumlah jawaban benar di setiap seksi tes yang diselesaikan.
                        </p>
                    </div>

                    <div class="md:col-span-4 flex justify-end">
                        <div class="bg-white/40 border border-white/60 rounded-md p-5 text-left text-ink max-w-xs w-full font-body">
                            <span class="text-label-sm text-green-dark uppercase tracking-widest block mb-2 font-bold">Skala Resmi ITP</span>
                            <span class="text-xl font-bold font-body text-ink">310 &mdash; 677</span>
                            <p class="text-[11px] text-ink/75 leading-relaxed mt-2 font-body font-normal">
                                Skala resmi TOEFL ITP berkisar antara 310 untuk nilai minimum hingga 677 untuk nilai maksimum.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Breakdown Skor (3 Kolom) -->
            <div class="bg-canvas border border-hairline rounded-lg shadow-card p-8 font-body">
                <h3 class="font-bold text-display-sm text-ink mb-6 pb-2 border-b border-hairline">Rincian Skor Per Bagian</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Section 1: Listening -->
                    <div class="bg-surface border border-hairline rounded-md p-6 space-y-3">
                        <span class="text-label-sm text-blue uppercase tracking-widest block font-bold font-body">1. Listening</span>
                        <div class="flex justify-between items-baseline font-body">
                            <span class="text-3xl font-bold text-ink">{{ $listeningScaled }}</span>
                            <span class="text-body-sm text-muted font-normal">{{ $listeningRaw }} / 18 Benar</span>
                        </div>
                        <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                            <div class="bg-blue h-full" style="width: {{ ($listeningRaw/18)*100 }}%"></div>
                        </div>
                    </div>

                    <!-- Section 2: Structure -->
                    <div class="bg-surface border border-hairline rounded-md p-6 space-y-3">
                        <span class="text-label-sm text-purple uppercase tracking-widest block font-bold font-body">2. Structure</span>
                        <div class="flex justify-between items-baseline font-body">
                            <span class="text-3xl font-bold text-ink">{{ $structureScaled }}</span>
                            <span class="text-body-sm text-muted font-normal">{{ $structureRaw }} / 20 Benar</span>
                        </div>
                        <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                            <div class="bg-purple h-full" style="width: {{ ($structureRaw/20)*100 }}%"></div>
                        </div>
                    </div>

                    <!-- Section 3: Reading -->
                    <div class="bg-surface border border-hairline rounded-md p-6 space-y-3">
                        <span class="text-label-sm text-green-dark uppercase tracking-widest block font-bold font-body">3. Reading</span>
                        <div class="flex justify-between items-baseline font-body">
                            <span class="text-3xl font-bold text-ink">{{ $readingScaled }}</span>
                            <span class="text-body-sm text-muted font-normal">{{ $readingRaw }} / 35 Benar</span>
                        </div>
                        <div class="w-full bg-hairline h-1.5 rounded-pill overflow-hidden">
                            <div class="bg-green h-full" style="width: {{ ($readingRaw/35)*100 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Analisis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-canvas border border-hairline rounded-lg shadow-card p-8 font-body">
                <!-- Kekuatan -->
                <div class="border-l-4 border-green bg-green-light/20 p-6 rounded-r-md space-y-2">
                    <span class="text-label-sm text-green-dark uppercase tracking-widest font-bold block font-body">Kekuatan Analitis</span>
                    <h4 class="text-body-lg font-bold text-ink font-body">Pemahaman Topik Kuat</h4>
                    <p class="text-body-sm text-muted leading-relaxed font-body font-normal">
                        Anda menunjukkan akurasi yang baik pada materi seksi yang diselesaikan. Pertahankan performa ini dan fokus memperluas pembendaharaan kosakata akademis.
                    </p>
                </div>

                <!-- Kelemahan -->
                <div class="border-l-4 border-red bg-red-light/20 p-6 rounded-r-md space-y-2">
                    <span class="text-label-sm text-red uppercase tracking-widest font-bold block font-body">Rekomendasi Perbaikan</span>
                    <h4 class="text-body-lg font-bold text-ink font-body">Tingkatkan Manajemen Waktu</h4>
                    <p class="text-body-sm text-muted leading-relaxed font-body font-normal">
                        Perhatikan batas waktu di seksi tertentu. Manfaatkan fitur latihan soal per-seksi di Masbro untuk melatih kecepatan membaca dan analisis struktur tata bahasa Anda.
                    </p>
                </div>
            </div>

            <!-- History & Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start font-body">
                
                <!-- History Table (8/12) -->
                <div class="lg:col-span-8 bg-canvas border border-hairline rounded-lg shadow-card overflow-hidden">
                    <div class="px-6 py-5 border-b border-hairline">
                        <h4 class="font-bold text-display-sm text-ink font-body">Riwayat 5 Tes Terakhir</h4>
                    </div>
                    @php
                        $recentSessions = \App\Models\TestSession::where('user_id', Auth::id())
                            ->whereNotNull('finished_at')
                            ->latest()
                            ->take(5)
                            ->get();
                    @endphp
                    @if($recentSessions->isEmpty())
                        <div class="p-8 text-center text-muted font-body font-normal">
                            Tidak ada riwayat tes sebelumnya.
                        </div>
                    @else
                        <div class="overflow-x-auto font-body font-normal">
                            <table class="w-full text-left border-collapse font-body">
                                <thead>
                                    <tr class="bg-surface text-ink font-bold text-xs uppercase tracking-widest border-b border-hairline">
                                        <th class="px-6 py-4">Tanggal</th>
                                        <th class="px-6 py-4">Skor</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-hairline text-body-sm text-ink font-medium">
                                    @foreach($recentSessions as $rSession)
                                        @php
                                            $rListening = $rSession->answers()->whereHas('question', function ($q) { $q->where('section', 'listening'); })->where('is_correct', true)->count();
                                            $rStructure = $rSession->answers()->whereHas('question', function ($q) { $q->where('section', 'structure'); })->where('is_correct', true)->count();
                                            $rReading = $rSession->answers()->whereHas('question', function ($q) { $q->where('section', 'reading'); })->where('is_correct', true)->count();
                                            
                                            $rlScaled  = round(31 + ($rListening / 18) * 37);
                                            $rsScaled  = round(31 + ($rStructure / 20) * 37);
                                            $rrScaled  = round(31 + ($rReading / 35) * 37);
                                            $rTotal = round((($rlScaled + $rsScaled + $rrScaled) / 3) * 10);
                                        @endphp
                                        <tr class="hover:bg-green-light/10 transition-colors duration-150">
                                            <td class="px-6 py-4 text-muted">
                                                {{ $rSession->started_at->timezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB
                                            </td>
                                            <td class="px-6 py-4 font-bold text-green-dark">
                                                {{ $rTotal }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

                <!-- Action Button Card (4/12) -->
                <div class="lg:col-span-4 bg-canvas border border-hairline rounded-lg shadow-card p-6 space-y-4">
                    <span class="text-label-sm text-green uppercase tracking-widest font-bold block mb-2 font-body">Langkah Selanjutnya</span>
                    <a href="{{ route('test.review', $session->id) }}" class="w-full text-center bg-green hover:bg-green-dark text-white font-semibold py-3 px-4 rounded-md shadow-sm transition duration-120 flex items-center justify-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>Review Jawaban</span>
                    </a>

                    <a href="{{ route('dashboard') }}" class="w-full text-center bg-canvas hover:bg-green-light/10 border border-green text-green-dark font-semibold py-3 px-4 rounded-md shadow-sm transition duration-120 flex items-center justify-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Ke Dashboard</span>
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>

