<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Content Container Card -->
            <div class="relative overflow-hidden bg-white rounded-3xl border border-slate-200/80 shadow-xl p-6 md:p-10 space-y-12">
                
                <!-- Decorative background glows (inside the white card) -->
                <div class="absolute top-0 left-1/4 w-72 h-72 bg-indigo-50 rounded-full blur-3xl opacity-60 pointer-events-none -translate-y-1/2"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-rose-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                <div class="relative z-10 space-y-12">
                    <!-- Header Panel -->
                    <div class="text-center space-y-3 max-w-xl mx-auto">

                        <h3 class="text-2xl md:text-3.5xl font-black text-slate-800 tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900">Papan Peringkat TOEFL ITP</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
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
                        <div class="bg-slate-50 rounded-2xl border border-dashed border-slate-200 p-12 text-center text-slate-500 max-w-md mx-auto">
                            <h4 class="font-extrabold text-slate-700 text-base">Papan Peringkat Kosong</h4>
                            <p class="text-xs text-slate-400 mt-1">Belum ada peserta yang menyelesaikan simulasi ujian TOEFL ITP.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-3 gap-3 md:gap-6 max-w-2xl mx-auto items-end pt-12 pb-6 px-1">
                            
                            <!-- PODIUM RANK 2: SILVER (LEFT) -->
                            <div class="flex flex-col justify-end">
                                @if($second)
                                    <div class="bg-gradient-to-b from-slate-50 to-white border-2 border-slate-200 rounded-3xl p-4 md:p-5 text-center hover:scale-[1.04] hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-slate-100/50 relative ring-4 ring-slate-100/20">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-gradient-to-r from-slate-400 to-indigo-500 border border-slate-300 text-white font-black rounded-full text-[10px] md:text-xs shadow-md whitespace-nowrap">
                                            🥈 Juara 2
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <!-- Glow effect -->
                                            <div class="absolute inset-0 rounded-full bg-slate-300 blur-sm opacity-40 animate-pulse"></div>
                                            <div class="relative w-12 h-12 md:w-14 md:h-14 rounded-full bg-gradient-to-tr from-slate-400 via-indigo-300 to-slate-200 text-white flex items-center justify-center font-black text-sm md:text-base mx-auto shadow-md border-2 border-white">
                                                {{ strtoupper(substr($second['user']->name, 0, 2)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-bold text-slate-850 text-xs md:text-sm mt-3 truncate w-full" title="{{ $second['user']->name }}">
                                            {{ $second['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-3 py-1 bg-gradient-to-r from-slate-400 to-indigo-550 text-white font-black text-xs md:text-sm rounded-full shadow-md">
                                            <span>{{ $second['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-slate-400 mt-2 font-semibold">
                                            {{ $second['date'] ? $second['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-slate-200 bg-slate-50/40 rounded-3xl p-4 md:p-5 text-center min-h-[140px] flex flex-col items-center justify-center">
                                        <div class="w-10 h-10 rounded-full border-2 border-dashed border-slate-300 text-slate-400 flex items-center justify-center font-black text-sm bg-white shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-slate-400 text-xs mt-3">Menunggu</h4>
                                        <span class="text-[10px] font-semibold text-slate-300 mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-gradient-to-b from-slate-300 via-slate-400 to-slate-600 h-16 md:h-20 rounded-t-2xl mt-4 flex flex-col items-center justify-center shadow-lg border-t border-white/45 relative">
                                    <span class="text-white font-black text-xl md:text-2xl tracking-widest drop-shadow-sm">II</span>
                                    <span class="text-[8px] md:text-[10px] text-slate-100 font-bold uppercase tracking-wider">Perak</span>
                                </div>
                            </div>

                            <!-- PODIUM RANK 1: GOLD (CENTER) -->
                            <div class="flex flex-col justify-end relative">
                                @if($first)
                                    <div class="bg-gradient-to-b from-amber-50 to-white border-2 border-amber-400 rounded-3xl p-5 md:p-7 text-center hover:scale-[1.04] hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-amber-500/10 -top-4 md:-top-6 ring-4 ring-amber-400/20 relative">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-gradient-to-r from-amber-500 to-orange-500 border border-amber-300 text-white font-black rounded-full text-[10px] md:text-xs shadow-md whitespace-nowrap">
                                            👑 Juara 1
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <!-- Glow effect -->
                                            <div class="absolute inset-0 rounded-full bg-amber-400 blur-md opacity-40 animate-pulse"></div>
                                            <div class="relative w-14 h-14 md:w-16 md:h-16 rounded-full bg-gradient-to-tr from-amber-500 via-yellow-400 to-orange-505 text-white flex items-center justify-center font-black text-base md:text-xl mx-auto shadow-lg border-2 border-white">
                                                {{ strtoupper(substr($first['user']->name, 0, 2)) }}
                                                <!-- Crown element -->
                                                <span class="absolute -top-5 left-1/2 transform -translate-x-1/2 text-xl filter drop-shadow animate-bounce">👑</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-extrabold text-slate-800 text-sm md:text-base mt-4 truncate w-full" title="{{ $first['user']->name }}">
                                            {{ $first['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-4 py-1.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-black text-sm md:text-base rounded-full shadow-lg">
                                            <span>{{ $first['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-slate-500 mt-2 font-semibold">
                                            {{ $first['date'] ? $first['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-slate-200 bg-slate-50/40 rounded-3xl p-5 md:p-7 text-center min-h-[160px] -top-4 md:-top-6 relative flex flex-col items-center justify-center">
                                        <div class="w-12 h-12 rounded-full border-2 border-dashed border-slate-300 text-slate-400 flex items-center justify-center font-black text-base bg-white shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-slate-400 text-sm mt-3">Menunggu</h4>
                                        <span class="text-xs font-semibold text-slate-300 mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-gradient-to-b from-amber-400 via-yellow-500 to-amber-700 h-24 md:h-32 rounded-t-2xl flex flex-col items-center justify-center shadow-xl border-t border-white/50 relative -top-4 md:-top-6">
                                    <span class="text-white font-black text-2xl md:text-3.5xl tracking-widest drop-shadow-md animate-pulse">I</span>
                                    <span class="text-[8px] md:text-[10px] text-amber-100 font-bold uppercase tracking-wider">Emas</span>
                                </div>
                            </div>

                            <!-- PODIUM RANK 3: BRONZE (RIGHT) -->
                            <div class="flex flex-col justify-end">
                                @if($third)
                                    <div class="bg-gradient-to-b from-orange-50/70 to-white border-2 border-orange-300 rounded-3xl p-4 md:p-5 text-center hover:scale-[1.04] hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-orange-100/50 relative ring-4 ring-orange-100/20">
                                        <!-- Rank Badge -->
                                        <div class="absolute -top-3.5 left-1/2 transform -translate-x-1/2 px-3 py-0.5 bg-gradient-to-r from-orange-400 to-amber-600 border border-orange-300 text-white font-black rounded-full text-[10px] md:text-xs shadow-md whitespace-nowrap">
                                            🥉 Juara 3
                                        </div>
                                        
                                        <!-- User Avatar/Initials -->
                                        <div class="relative inline-block mt-2">
                                            <!-- Glow effect -->
                                            <div class="absolute inset-0 rounded-full bg-orange-400 blur-sm opacity-40 animate-pulse"></div>
                                            <div class="relative w-12 h-12 md:w-14 md:h-14 rounded-full bg-gradient-to-tr from-orange-500 via-amber-500 to-orange-400 text-white flex items-center justify-center font-black text-sm md:text-base mx-auto shadow-md border-2 border-white">
                                                {{ strtoupper(substr($third['user']->name, 0, 2)) }}
                                            </div>
                                        </div>
                                        
                                        <!-- Name -->
                                        <h4 class="font-bold text-slate-850 text-xs md:text-sm mt-3 truncate w-full" title="{{ $third['user']->name }}">
                                            {{ $third['user']->name }}
                                        </h4>
                                        
                                        <!-- Score Badge -->
                                        <div class="mt-2 inline-flex px-3 py-1 bg-gradient-to-r from-orange-400 to-amber-600 text-white font-black text-xs md:text-sm rounded-full shadow-md">
                                            <span>{{ $third['score'] }}</span>
                                        </div>
                                        
                                        <!-- Date -->
                                        <p class="text-[9px] text-slate-400 mt-2 font-semibold">
                                            {{ $third['date'] ? $third['date']->timezone('Asia/Jakarta')->format('d/m/Y') : '-' }}
                                        </p>
                                    </div>
                                @else
                                    <!-- Placeholder -->
                                    <div class="border-2 border-dashed border-slate-200 bg-slate-50/40 rounded-3xl p-4 md:p-5 text-center min-h-[140px] flex flex-col items-center justify-center">
                                        <div class="w-10 h-10 rounded-full border-2 border-dashed border-slate-300 text-slate-400 flex items-center justify-center font-black text-sm bg-white shadow-inner">
                                            ?
                                        </div>
                                        <h4 class="font-bold text-slate-400 text-xs mt-3">Menunggu</h4>
                                        <span class="text-[10px] font-semibold text-slate-300 mt-1">-</span>
                                    </div>
                                @endif
                                <div class="bg-gradient-to-b from-orange-400 via-orange-500 to-orange-700 h-12 md:h-14 rounded-t-2xl mt-4 flex flex-col items-center justify-center shadow-lg border-t border-white/40 relative">
                                    <span class="text-white font-black text-lg md:text-xl tracking-widest drop-shadow-sm">III</span>
                                    <span class="text-[8px] md:text-[10px] text-orange-100 font-bold uppercase tracking-wider">Perunggu</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- RANKINGS LIST (Rank 4+) -->
                    @if(!empty($others))
                        <div class="space-y-4">
                            <div class="flex items-center justify-between px-2">
                                <h3 class="font-black text-sm md:text-base text-slate-700 tracking-wider uppercase flex items-center gap-2">
                                    <span class="flex h-2 w-2 rounded-full bg-indigo-500 animate-ping"></span>
                                     Klasemen Arena Ujian
                                </h3>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider bg-slate-100 px-3 py-1 rounded-full">{{ count($others) }} Peserta Lainnya</span>
                            </div>
                            
                            <div class="space-y-3">
                                @foreach($others as $index => $entry)
                                    @php
                                        $rank = $index + 4;
                                        // Compute a deterministic avatar gradient
                                        $nameHash = ord($entry['user']->name[0] ?? 'A') + ord($entry['user']->name[1] ?? 'B');
                                        $gradients = [
                                            'from-pink-500 to-rose-500',
                                            'from-purple-500 to-indigo-500',
                                            'from-blue-500 to-cyan-500',
                                            'from-teal-500 to-emerald-500',
                                            'from-emerald-400 to-teal-600',
                                            'from-yellow-400 to-orange-500',
                                            'from-orange-500 to-red-500',
                                            'from-violet-500 to-fuchsia-500'
                                        ];
                                        $avatarGradient = $gradients[$nameHash % count($gradients)];
                                        
                                        // Determine rank badge style
                                        if ($rank == 4) {
                                            $rankBadge = 'bg-fuchsia-50 text-fuchsia-700 border-fuchsia-200';
                                            $leftAccent = 'bg-gradient-to-b from-fuchsia-400 to-purple-600';
                                        } elseif ($rank == 5) {
                                            $rankBadge = 'bg-violet-50 text-violet-700 border-violet-200';
                                            $leftAccent = 'bg-gradient-to-b from-violet-400 to-indigo-600';
                                        } elseif ($rank <= 10) {
                                            $rankBadge = 'bg-cyan-50 text-cyan-700 border-cyan-200';
                                            $leftAccent = 'bg-gradient-to-b from-cyan-400 to-blue-500';
                                        } else {
                                            $rankBadge = 'bg-slate-100 text-slate-600 border-slate-200';
                                            $leftAccent = 'bg-slate-200';
                                        }
                                    @endphp
                                    <div class="bg-white border border-slate-100 rounded-2xl p-4 md:p-5 flex items-center justify-between hover:shadow-md hover:border-indigo-100 transition-all duration-300 relative overflow-hidden group">
                                        <!-- Left Accent Bar -->
                                        <div class="absolute left-0 top-0 bottom-0 w-1.5 {{ $leftAccent }}"></div>
                                        
                                        <div class="flex items-center space-x-4 pl-2">
                                            <!-- Rank Number Badge -->
                                            <span class="w-9 h-9 rounded-xl border {{ $rankBadge }} font-black flex items-center justify-center text-xs md:text-sm shadow-sm group-hover:scale-105 transition-transform duration-300">
                                                #{{ $rank }}
                                            </span>
                                            
                                            <!-- Avatar Initials -->
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br {{ $avatarGradient }} text-white flex items-center justify-center font-black text-xs md:text-sm shadow-md border border-white">
                                                {{ strtoupper(substr($entry['user']->name, 0, 2)) }}
                                            </div>
                                            
                                            <!-- User Info -->
                                            <div>
                                                <h4 class="font-bold text-slate-800 text-sm md:text-base group-hover:text-indigo-600 transition-colors duration-300">{{ $entry['user']->name }}</h4>
                                                <p class="text-[10px] text-slate-400 font-semibold tracking-wide flex items-center gap-1 mt-0.5">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3 h-3 text-slate-350">
                                                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                    </svg>
                                                    {{ $entry['date'] ? $entry['date']->timezone('Asia/Jakarta')->format('d M Y, H:i') : '-' }} WIB
                                                </p>
                                            </div>
                                        </div>
                                        
                                        <!-- Score -->
                                        <div class="text-right flex items-center space-x-2">
                                            <div class="bg-gradient-to-r from-indigo-500 to-purple-650 text-white font-black text-sm md:text-base px-4 py-1.5 rounded-xl shadow-md group-hover:scale-105 transition-all duration-300">
                                                {{ $entry['score'] }}
                                            </div>
                                            <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-widest hidden sm:inline">Poin</span>
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
