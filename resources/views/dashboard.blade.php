<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Peserta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner & Quick Start -->
            <div class="bg-gradient-to-r from-blue-900 to-indigo-900 rounded-2xl shadow-xl overflow-hidden text-white">
                <div class="p-8 md:p-10 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0">
                    <div class="space-y-2">
                        <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight">Selamat Datang, {{ $user->name }}!</h3>
                        <p class="text-blue-100 text-sm md:text-base max-w-xl">
                            Siap menguji kemampuan bahasa Inggris Anda? Klik tombol di sebelah kanan untuk memulai simulasi tes TOEFL ITP baru.
                        </p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('test.start') }}">
                            @csrf
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-8 py-3.5 rounded-xl shadow-lg hover:shadow-emerald-500/25 transition-all duration-200 transform hover:-translate-y-0.5 flex items-center space-x-2 text-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Mulai Tes Baru</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Stats & Summary -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Last Score Card -->
                <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6 flex items-center space-x-4">
                    <div class="p-4 bg-blue-50 rounded-lg text-blue-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Skor Terakhir Anda</p>
                        <h4 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $lastScore ? $lastScore : 'Belum Ada' }}
                        </h4>
                    </div>
                </div>

                <!-- Total Tests Card -->
                <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6 flex items-center space-x-4">
                    <div class="p-4 bg-indigo-50 rounded-lg text-indigo-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Jumlah Sesi Tes</p>
                        <h4 class="text-3xl font-extrabold text-slate-900 mt-1">
                            {{ $sessions->count() }} Sesi
                        </h4>
                    </div>
                </div>

                <!-- Active Session Card -->
                <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6 flex items-center space-x-4">
                    @if($activeSession)
                        <div class="p-4 bg-amber-50 rounded-lg text-amber-950">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-amber-600 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-grow">
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Sesi Sedang Berjalan</p>
                            <a href="{{ route('test.' . $activeSession->current_section, $activeSession->id) }}" class="inline-flex items-center text-sm font-bold text-amber-600 hover:text-amber-700 mt-1 hover:underline">
                                <span>Lanjutkan ({{ ucfirst($activeSession->current_section) }})</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="p-4 bg-emerald-50 rounded-lg text-emerald-950">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase tracking-wider">Status Sesi</p>
                            <h4 class="text-sm font-bold text-emerald-600 mt-1">Siap untuk memulai tes baru</h4>
                        </div>
                    @endif
                </div>
            </div>

            <!-- History Table -->
            <div class="bg-white shadow-md rounded-xl border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-lg text-slate-800">Riwayat Tes Anda</h3>
                </div>
                
                @if($sessions->isEmpty())
                    <div class="p-8 text-center text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-sm">Anda belum pernah mengambil tes TOEFL.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50 text-slate-500 font-bold text-xs uppercase tracking-wider border-b border-slate-100">
                                    <th class="px-6 py-4">Tanggal Tes</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4">Estimasi Skor</th>
                                    <th class="px-6 py-4 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm text-slate-700 font-medium">
                                @foreach($sessions as $session)
                                    <tr class="hover:bg-slate-50/55 transition-colors duration-150">
                                        <td class="px-6 py-4">
                                            {{ $session->started_at->timezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($session->finished_at)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                                    Selesai
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                                    Belum Selesai ({{ ucfirst($session->current_section) }})
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-base font-bold">
                                            @if($session->finished_at)
                                                @php
                                                    $correctListening = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'listening'); })->where('is_correct', true)->count();
                                                    $correctStructure = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'structure'); })->where('is_correct', true)->count();
                                                    $correctReading = $session->answers()->whereHas('question', function ($q) { $q->where('section', 'reading'); })->where('is_correct', true)->count();
                                                    
                                                    $listeningScaled  = round(31 + ($correctListening / 10) * 37);
                                                    $structureScaled  = round(31 + ($correctStructure / 20) * 37);
                                                    $readingScaled    = round(31 + ($correctReading / 35) * 37);
                                                    $totalScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);
                                                @endphp
                                                <span class="text-blue-900">{{ $totalScore }}</span>
                                            @else
                                                <span class="text-slate-400 font-normal italic">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if($session->finished_at)
                                                <div class="flex items-center justify-end space-x-3">
                                                    <a href="{{ route('test.result', $session->id) }}" class="text-blue-900 hover:text-blue-700 hover:underline">
                                                        Hasil
                                                    </a>
                                                    <span class="text-slate-300">|</span>
                                                    <a href="{{ route('test.review', $session->id) }}" class="text-slate-600 hover:text-slate-900 hover:underline">
                                                        Review
                                                    </a>
                                                </div>
                                            @else
                                                <a href="{{ route('test.' . $session->current_section, $session->id) }}" class="text-amber-600 hover:text-amber-700 hover:underline font-bold">
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

        </div>
    </div>
</x-app-layout>
