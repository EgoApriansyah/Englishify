<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Hasil Analisis Tes TOEFL ITP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Result Main Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100 grid grid-cols-1 md:grid-cols-3">
                <!-- Left panel: Total Score -->
                <div class="bg-gradient-to-br from-blue-900 to-indigo-950 p-8 text-center text-white flex flex-col justify-center items-center space-y-4">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-200">Estimasi Skor TOEFL ITP</span>
                    
                    <div class="relative flex items-center justify-center">
                        <!-- Score Display -->
                        <div class="text-6xl md:text-7xl font-extrabold tracking-tight mt-2 select-text">
                            {{ $totalScore }}
                        </div>
                    </div>
                    
                    <span class="text-xs text-blue-100 bg-blue-800/50 px-3 py-1 rounded-full font-medium">Skala ITP: 310 - 677</span>
                    
                    <p class="text-xs text-blue-200/80 leading-relaxed pt-4 border-t border-blue-800/40 w-full">
                        Skor dihitung menggunakan formula konversi standar linier berdasarkan jumlah jawaban benar di setiap section.
                    </p>
                </div>

                <!-- Right panel: Breakdown per section (takes 2 cols on md) -->
                <div class="md:col-span-2 p-8 space-y-6 flex flex-col justify-between">
                    <div>
                        <h3 class="font-extrabold text-slate-900 text-lg border-b border-slate-100 pb-3 mb-5">Rincian Skor Per Bagian</h3>
                        
                        <div class="space-y-5">
                            <!-- Section 1: Listening -->
                            <div class="space-y-1.5">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-bold text-slate-800">1. Listening Comprehension</span>
                                    <span class="font-bold text-slate-900">{{ $listeningRaw }} / 10 Benar <span class="text-slate-400 font-normal">({{ $listeningScaled }} Scaled)</span></span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-blue-900 h-2.5 rounded-full" style="width: {{ ($listeningRaw/10)*100 }}%"></div>
                                </div>
                            </div>

                            <!-- Section 2: Structure -->
                            <div class="space-y-1.5">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-bold text-slate-800">2. Structure & Written Expression</span>
                                    <span class="font-bold text-slate-900">{{ $structureRaw }} / 20 Benar <span class="text-slate-400 font-normal">({{ $structureScaled }} Scaled)</span></span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-indigo-700 h-2.5 rounded-full" style="width: {{ ($structureRaw/20)*100 }}%"></div>
                                </div>
                            </div>

                            <!-- Section 3: Reading -->
                            <div class="space-y-1.5">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="font-bold text-slate-800">3. Reading Comprehension</span>
                                    <span class="font-bold text-slate-900">{{ $readingRaw }} / 35 Benar <span class="text-slate-400 font-normal">({{ $readingScaled }} Scaled)</span></span>
                                </div>
                                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-purple-700 h-2.5 rounded-full" style="width: {{ ($readingRaw/35)*100 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0 pt-6 border-t border-slate-100">
                        <a href="{{ route('test.review', $session->id) }}" class="flex-1 text-center bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-xl shadow-md transition duration-150 flex items-center justify-center space-x-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <span>Review Jawaban</span>
                        </a>

                        <a href="{{ route('dashboard') }}" class="flex-1 text-center bg-white hover:bg-slate-55 hover:bg-slate-50 border border-slate-300 text-slate-700 font-bold py-3 px-4 rounded-xl shadow-sm transition duration-150 flex items-center justify-center space-x-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                            <span>Kembali ke Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Score Level Interpretation Info Card -->
            <div class="bg-white rounded-xl border border-slate-100 p-6 shadow-sm space-y-4">
                <h4 class="font-bold text-slate-800 text-base border-b border-slate-50 pb-2">Interpretasi Tingkat Skor TOEFL ITP</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div class="p-3 bg-red-50 text-red-900 rounded-lg space-y-1">
                        <span class="font-bold block">310 - 459 (Basic)</span>
                        <p class="text-xs text-red-800">Mampu memahami percakapan dasar sehari-hari dan struktur kalimat yang sangat sederhana.</p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-900 rounded-lg space-y-1">
                        <span class="font-bold block">460 - 542 (Intermediate)</span>
                        <p class="text-xs text-amber-800">Memiliki pemahaman tata bahasa yang cukup baik dan dapat memahami percakapan serta bacaan bertema umum.</p>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-900 rounded-lg space-y-1">
                        <span class="font-bold block">543 - 677 (Advanced)</span>
                        <p class="text-xs text-emerald-800">Menunjukkan kemampuan pemahaman tingkat tinggi pada struktur gramatikal kompleks serta materi akademis.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
