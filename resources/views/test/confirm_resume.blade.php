<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-display-sm text-ink leading-tight">
            {{ __('Konfirmasi Sesi Tes') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-surface min-h-screen font-body">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-canvas overflow-hidden shadow-card rounded-lg border border-hairline">
                <!-- Header Alert -->
                <div class="bg-yellow-light p-6 border-b border-hairline flex items-start space-x-4">
                    <div class="p-2 bg-canvas rounded-md text-yellow border border-yellow/20 shadow-sm shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-ink">Sesi Tes Belum Selesai</h3>
                        <p class="text-body-sm text-muted mt-1 font-body">
                            Sistem mendeteksi bahwa Anda memiliki sesi tes yang sedang berjalan dan belum diselesaikan.
                        </p>
                    </div>
                </div>

                <!-- Body details -->
                <div class="p-6 space-y-4">
                    <div class="bg-surface p-4 rounded-md border border-hairline text-body-sm text-ink space-y-2 font-body">
                        <div class="flex justify-between">
                            <span class="font-semibold text-muted font-body">Waktu Mulai:</span>
                            <span class="font-bold text-ink font-body">{{ $activeSession->started_at->timezone('Asia/Jakarta')->format('d M Y - H:i') }} WIB</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-muted font-body">Seksi Terakhir:</span>
                            <span class="font-semibold px-3 py-1 bg-green-light text-green-dark rounded-pill text-xs uppercase tracking-wider font-body">{{ $activeSession->current_section }}</span>
                        </div>
                    </div>

                    <div class="text-body-sm text-muted leading-relaxed font-body">
                        Apakah Anda ingin <strong>melanjutkan</strong> sesi tes tersebut atau <strong>memulai baru</strong>? Memulai tes baru akan menghapus semua jawaban dan kemajuan dari sesi sebelumnya secara permanen.
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row sm:space-x-3 space-y-3 sm:space-y-0 pt-4">
                        <form method="POST" action="{{ route('test.start') }}" class="flex-1">
                            @csrf
                            <input type="hidden" name="confirm_resume" value="1">
                            <button type="submit" class="w-full bg-green hover:bg-green-dark text-white text-center py-2.5 px-4 rounded-md font-semibold text-body-sm shadow-sm transition duration-120 flex items-center justify-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Lanjutkan Sesi</span>
                            </button>
                        </form>

                        <form method="POST" action="{{ route('test.start') }}" class="flex-1" onsubmit="return confirm('Apakah Anda yakin ingin memulai tes baru? Sesi sebelumnya beserta semua jawabannya akan dihapus secara permanen.')">
                            @csrf
                            <input type="hidden" name="confirm_new" value="1">
                            <button type="submit" class="w-full bg-canvas hover:bg-red-light text-red border border-hairline hover:border-red text-center py-2.5 px-4 rounded-md font-semibold text-body-sm shadow-sm transition duration-120 flex items-center justify-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span>Mulai Baru</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

