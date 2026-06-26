<x-app-layout>
    <div class="py-12 bg-surface min-h-screen font-body select-text">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Content Container Card -->
            <div class="relative overflow-hidden bg-canvas rounded-lg border border-hairline shadow-card p-6 md:p-10 space-y-12">
                
                <!-- Decorative background glows -->
                <div class="absolute top-0 left-1/4 w-72 h-72 bg-green-light/20 rounded-full blur-3xl opacity-60 pointer-events-none -translate-y-1/2"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-green-light/10 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                <div class="relative z-10 space-y-12">
                    <!-- Header Panel -->
                    <div class="text-center space-y-3 max-w-xl mx-auto">
                        <h3 class="text-2xl md:text-3.5xl font-bold text-ink tracking-tight">Papan Peringkat Englishify</h3>
                        <p class="text-sm text-muted leading-relaxed font-body font-normal">
                            Daftar skor tertinggi dari simulasi ujian TOEFL ITP peserta. Tunjukkan kemampuan terbaik Anda dan raih puncak klasemen!
                        </p>
                    </div>

                    <!-- PODIUM VISUAL (Top 3) -->
                    @php
                        $first = $top3[0] ?? null;
                        $second = $top3[1] ?? null;
                        $third = $top3[2] ?? null;
                    @endphp

                    @if(!$first)
                        <div class="bg-surface rounded-lg border border-dashed border-hairline p-12 text-center text-muted max-w-md mx-auto font-body">
                            <h4 class="font-bold text-ink text-base">Papan Peringkat Kosong</h4>
                            <p class="text-xs text-muted mt-1 font-body font-normal">Belum ada peserta yang menyelesaikan simulasi ujian TOEFL ITP.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-3 gap-3 md:gap-6 max-w-2xl mx-auto items-end pt-12 pb-6 px-1 font-body">
                            
                            <!-- PODIUM RANK 2: SILVER (LEFT) -->
                            <div class="flex flex-col justify-end">
                                @if($second)
                                    <div class="bg-canvas border-2 border-hairline rounded-lg p-4 md:p-5 text-center hover:scale-[1.02] hover:-translate-y-0.5 transition-all duration-300 shadow-card relative">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-ink border border-hairline text-white font-semibold rounded-pill text-[10px] md:text-xs shadow-sm whitespace-nowrap">
                                            🥈 Juara 2
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <div class="relative w-12 h-12 md:w-14 md:h-14 rounded-full bg-surface border-2 border-hairline text-ink flex items-center justify-center font-bold text-sm md:text-base mx-auto">
                                                {{ strtoupper(substr($second['user']->name, 0, 2)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-bold text-ink text-xs md:text-sm mt-3 truncate w-full" title="{{ $second['user']->name }}">
                                            {{ $second['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-3 py-1 bg-green text-white font-bold text-xs md:text-sm rounded-pill shadow-sm">
                                            <span>{{ $second['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-muted mt-2 font-semibold">
                                            {{ $second['date'] ? $second['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-hairline bg-surface rounded-lg p-4 md:p-5 text-center min-h-[140px] flex flex-col items-center justify-center">
                                        <div class="w-10 h-10 rounded-full border-2 border-dashed border-hairline text-muted flex items-center justify-center font-bold text-sm bg-canvas shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-muted text-xs mt-3">Menunggu</h4>
                                        <span class="text-[10px] font-semibold text-muted mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-hairline h-16 md:h-20 rounded-t-lg mt-4 flex flex-col items-center justify-center shadow-sm relative">
                                    <span class="text-ink font-semibold text-xl md:text-2xl tracking-widest">II</span>
                                    <span class="text-[8px] md:text-[10px] text-muted font-semibold uppercase tracking-wider">Perak</span>
                                </div>
                            </div>

                            <!-- PODIUM RANK 1: GOLD (CENTER) -->
                            <div class="flex flex-col justify-end relative">
                                @if($first)
                                    <div class="bg-canvas border-2 border-yellow rounded-lg p-5 md:p-7 text-center hover:scale-[1.02] hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-yellow/10 -top-4 md:-top-6 relative">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-yellow border border-yellow/20 text-ink font-bold rounded-pill text-[10px] md:text-xs shadow-md whitespace-nowrap">
                                            👑 Juara 1
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <!-- Glow effect -->
                                            <div class="absolute inset-0 rounded-full bg-yellow/20 blur-md opacity-40 animate-pulse"></div>
                                            <div class="relative w-14 h-14 md:w-16 md:h-16 rounded-full bg-green-light border-2 border-yellow text-green-dark flex items-center justify-center font-bold text-base md:text-xl mx-auto shadow-md">
                                                {{ strtoupper(substr($first['user']->name, 0, 2)) }}
                                                <!-- Crown element -->
                                                <span class="absolute -top-5 left-1/2 transform -translate-x-1/2 text-xl filter drop-shadow animate-bounce">👑</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-bold text-ink text-sm md:text-base mt-4 truncate w-full" title="{{ $first['user']->name }}">
                                            {{ $first['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-4 py-1.5 bg-green text-white font-bold text-sm md:text-base rounded-pill shadow-lg">
                                            <span>{{ $first['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-muted mt-2 font-semibold">
                                            {{ $first['date'] ? $first['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-hairline bg-surface rounded-lg p-5 md:p-7 text-center min-h-[160px] -top-4 md:-top-6 relative flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 rounded-full border-2 border-dashed border-hairline text-muted flex items-center justify-center font-bold text-base bg-canvas shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-muted text-sm mt-3">Menunggu</h4>
                                        <span class="text-xs font-semibold text-muted mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-yellow h-24 md:h-32 rounded-t-lg flex flex-col items-center justify-center shadow-md relative -top-4 md:-top-6">
                                    <span class="text-ink font-bold text-2xl md:text-3.5xl tracking-widest animate-pulse">I</span>
                                    <span class="text-[8px] md:text-[10px] text-ink font-semibold uppercase tracking-wider">Emas</span>
                                </div>
                            </div>

                            <!-- PODIUM RANK 3: BRONZE (RIGHT) -->
                            <div class="flex flex-col justify-end">
                                @if($third)
                                    <div class="bg-canvas border-2 border-hairline rounded-lg p-4 md:p-5 text-center hover:scale-[1.02] hover:-translate-y-0.5 transition-all duration-300 shadow-card relative">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-ink border border-hairline text-white font-semibold rounded-pill text-[10px] md:text-xs shadow-sm whitespace-nowrap">
                                            🥉 Juara 3
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <div class="relative w-12 h-12 md:w-14 md:h-14 rounded-full bg-surface border-2 border-hairline text-ink flex items-center justify-center font-bold text-sm md:text-base mx-auto">
                                                {{ strtoupper(substr($third['user']->name, 0, 2)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-bold text-ink text-xs md:text-sm mt-3 truncate w-full" title="{{ $third['user']->name }}">
                                            {{ $third['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-3 py-1 bg-green text-white font-bold text-xs md:text-sm rounded-pill shadow-sm">
                                            <span>{{ $third['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-muted mt-2 font-semibold">
                                            {{ $third['date'] ? $third['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-hairline bg-surface rounded-lg p-4 md:p-5 text-center min-h-[140px] flex flex-col items-center justify-center">
                                        <div class="w-10 h-10 rounded-full border-2 border-dashed border-hairline text-muted flex items-center justify-center font-bold text-sm bg-canvas shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-muted text-xs mt-3">Menunggu</h4>
                                        <span class="text-[10px] font-semibold text-muted mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-hairline h-12 md:h-14 rounded-t-lg mt-4 flex flex-col items-center justify-center shadow-sm relative">
                                    <span class="text-ink font-semibold text-lg md:text-xl tracking-widest">III</span>
                                    <span class="text-[8px] md:text-[10px] text-muted font-semibold uppercase tracking-wider">Perunggu</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- RANKINGS LIST (Rank 4+) -->
                    @if(!empty($others))
                        <div class="space-y-4 font-body">
                            <div class="flex items-center justify-between px-2 font-body">
                                <h3 class="font-bold text-sm md:text-base text-ink tracking-wider uppercase flex items-center gap-2">
                                    <span class="flex h-2 w-2 rounded-full bg-green animate-ping"></span>
                                     Klasemen Arena Ujian
                                </h3>
                                <span class="text-[10px] text-muted font-bold uppercase tracking-wider bg-surface px-3 py-1 rounded-pill border border-hairline font-body font-normal">{{ count($others) }} Peserta Lainnya</span>
                            </div>
                            
                            <div class="space-y-3 font-body">
                                @foreach($others as $index => $entry)
                                    @php
                                        $rank = $index + 4;
                                        // Compute a deterministic avatar gradient
                                        $nameHash = ord($entry['user']->name[0] ?? 'A') + ord($entry['user']->name[1] ?? 'B');
                                        
                                        // Determine rank badge style
                                        if ($rank == 4) {
                                            $rankBadge = 'bg-yellow-light text-yellow border-yellow/20';
                                            $leftAccent = 'bg-yellow';
                                        } elseif ($rank == 5) {
                                            $rankBadge = 'bg-purple-light text-purple border-purple/20';
                                            $leftAccent = 'bg-purple';
                                        } elseif ($rank <= 10) {
                                            $rankBadge = 'bg-green-light text-green-dark border-green/20';
                                            $leftAccent = 'bg-green';
                                        } else {
                                            $rankBadge = 'bg-surface text-muted border-hairline';
                                            $leftAccent = 'bg-hairline';
                                        }
                                    @endphp
                                    <div class="bg-canvas border border-hairline rounded-lg p-4 md:p-5 flex items-center justify-between hover:shadow-md hover:border-green/30 transition-all duration-300 relative overflow-hidden group">
                                        <!-- Left Accent Bar -->
                                        <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $leftAccent }}"></div>
                                        
                                        <div class="flex items-center space-x-4 pl-2">
                                            <!-- Rank Number Badge -->
                                            <span class="w-9 h-9 rounded-md border {{ $rankBadge }} font-bold flex items-center justify-center text-xs md:text-sm shadow-sm group-hover:scale-105 transition-transform duration-300">
                                                #{{ $rank }}
                                            </span>
                                            
                                            <!-- Avatar Initials -->
                                            <div class="w-10 h-10 rounded-full bg-green-light text-green-dark flex items-center justify-center font-bold text-xs md:text-sm shadow-sm border border-hairline">
                                                {{ strtoupper(substr($entry['user']->name, 0, 2)) }}
                                            </div>
                                            
                                            <!-- User Info -->
                                            <div>
                                                <h4 class="font-bold text-ink text-sm md:text-base group-hover:text-green transition-colors duration-300">{{ $entry['user']->name }}</h4>
                                                <p class="text-[10px] text-muted font-semibold tracking-wide flex items-center gap-1 mt-0.5 font-normal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-muted">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                    </svg>
                                                    {{ $entry['date'] ? $entry['date']->timezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }} WIB
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Score -->
                                        <div class="text-right flex items-center space-x-2">
                                            <div class="bg-green text-white font-bold text-sm md:text-base px-4 py-1.5 rounded-md shadow-sm group-hover:scale-105 transition-all duration-300">
                                                {{ $entry['score'] }}
                                            </div>
                                            <span class="text-[10px] text-muted font-bold uppercase tracking-widest hidden sm:inline font-normal">Poin</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
