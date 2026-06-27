@php
    $navUser = Auth::user();
    $lastFinishedSession = $navUser ? $navUser->testSessions()->whereNotNull('finished_at')->orderBy('finished_at', 'desc')->first() : null;
    $navLastScore = null;
    if ($lastFinishedSession) {
        $correctListening = $lastFinishedSession->answers()->whereHas('question', function ($q) { $q->where('section', 'listening'); })->where('is_correct', true)->count();
        $correctStructure = $lastFinishedSession->answers()->whereHas('question', function ($q) { $q->where('section', 'structure'); })->where('is_correct', true)->count();
        $correctReading = $lastFinishedSession->answers()->whereHas('question', function ($q) { $q->where('section', 'reading'); })->where('is_correct', true)->count();
        
        $listeningScaled  = round(31 + ($correctListening / 18) * 37);
        $structureScaled  = round(31 + ($correctStructure / 20) * 37);
        $readingScaled    = round(31 + ($correctReading / 35) * 37);
        $navLastScore = round((($listeningScaled + $structureScaled + $readingScaled) / 3) * 10);
    }
@endphp

<!-- ============================================
     DESKTOP/TABLET SIDEBAR
     ============================================ -->
<aside class="fixed top-0 bottom-0 left-0 w-60 bg-ink z-20 flex flex-col justify-between py-6 px-4 border-r border-white/5 hidden sm:flex transition-transform duration-300 transform" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <div>
        <!-- Logo Area -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 mb-8 border-b border-white/10 pb-4">

            <span class="text-xl font-bold text-white tracking-tight flex items-center">
                Englishify<span class="text-green ml-0.5">•</span>
            </span>
        </a>

        <!-- Navigation Stack -->
        <nav class="space-y-1">
            <div class="px-3 pb-2 text-[10px] font-bold text-white/30 uppercase tracking-widest">
                Menu Utama
            </div>
            
            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('dashboard') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Materi Link -->
            <a href="{{ route('material.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('material.*') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span>Materi</span>
            </a>

            <!-- Mini Game Link -->
            <a href="{{ route('game.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('game.*') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Mini Game</span>
            </a>

            <!-- Leaderboard Link -->
            <a href="{{ route('leaderboard.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('leaderboard.*') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                <span>Leaderboard</span>
            </a>

            <!-- Profile Link -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('profile.edit') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil</span>
            </a>

            <!-- Admin Link (Only for admins) -->
            @if(Auth::user() && Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-120 {{ request()->routeIs('admin.*') ? 'bg-green/15 text-green font-semibold' : 'text-white/60 hover:bg-white/5 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    <span>Panel Admin</span>
                </a>
            @endif
        </nav>
    </div>

    <!-- User Section Bottom -->
    <div class="border-t border-white/10 pt-4 px-2 space-y-3">
        @if($navUser)
            <div class="flex items-center gap-3">
                @if($navUser->profile_image)
                    <img src="{{ asset('storage/' . $navUser->profile_image) }}" class="w-10 h-10 rounded-full object-cover shrink-0 border border-white/10" alt="Avatar">
                @else
                    <div class="w-10 h-10 rounded-full bg-green text-white font-bold flex items-center justify-center shrink-0">
                        {{ strtoupper(substr($navUser->name, 0, 2)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <div class="text-sm font-bold text-white truncate">{{ $navUser->name }}</div>
                    <div class="text-xs text-white/50 truncate">
                        TOEFL: <span class="font-semibold text-green">{{ $navLastScore ?? '-' }}</span>
                    </div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left text-xs font-semibold text-red hover:text-red-500 transition-colors flex items-center gap-2 py-1 cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Keluar</span>
                </button>
            </form>
        @endif
    </div>
</aside>

<!-- ============================================
     MOBILE BOTTOM NAVIGATION
     ============================================ -->
<nav class="fixed bottom-0 left-0 right-0 h-16 bg-canvas border-t border-hairline flex items-center justify-around z-30 sm:hidden px-2 shadow-lg">
    
    <!-- Dashboard Link -->
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center flex-grow py-1 text-center {{ request()->routeIs('dashboard') ? 'text-green font-bold' : 'text-muted' }}">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-[10px] mt-0.5">Dashboard</span>
    </a>

    <!-- Materi Link -->
    <a href="{{ route('material.index') }}" class="flex flex-col items-center justify-center flex-grow py-1 text-center {{ request()->routeIs('material.*') ? 'text-green font-bold' : 'text-muted' }}">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <span class="text-[10px] mt-0.5">Materi</span>
    </a>

    <!-- Game Link -->
    <a href="{{ route('game.index') }}" class="flex flex-col items-center justify-center flex-grow py-1 text-center {{ request()->routeIs('game.*') ? 'text-green font-bold' : 'text-muted' }}">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-[10px] mt-0.5">Game</span>
    </a>

    <!-- Leaderboard Link -->
    <a href="{{ route('leaderboard.index') }}" class="flex flex-col items-center justify-center flex-grow py-1 text-center {{ request()->routeIs('leaderboard.*') ? 'text-green font-bold' : 'text-muted' }}">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
        </svg>
        <span class="text-[10px] mt-0.5">Skor</span>
    </a>

    <!-- Profil Link -->
    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center flex-grow py-1 text-center {{ request()->routeIs('profile.edit') ? 'text-green font-bold' : 'text-muted' }}">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-[10px] mt-0.5">Profil</span>
    </a>
</nav>

