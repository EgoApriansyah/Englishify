<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masbro Test - {{ $title ?? 'Section' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-body text-ink bg-surface antialiased select-none min-h-screen">
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Top Bar Header -->
        <header class="bg-canvas border-b border-hairline sticky top-0 z-50 text-ink shadow-sm">
            <div class="max-w-container mx-auto px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-xl font-bold tracking-tight text-ink flex items-center">
                        Masbro<span class="text-green ml-0.5">•</span>
                    </span>
                    @php
                        $badgeColor = 'bg-green-light text-green-dark border-green-muted';
                        if (strtolower($sectionTitle) === 'listening comprehension') {
                            $badgeColor = 'bg-blue-light text-blue border-blue-light';
                        } elseif (strtolower($sectionTitle) === 'structure & written expression') {
                            $badgeColor = 'bg-purple-light text-purple border-purple-light';
                        }
                    @endphp
                    <span class="hidden md:inline px-2.5 py-0.5 text-xs border rounded-pill font-semibold uppercase tracking-wider {{ $badgeColor }}">{{ $sectionTitle }}</span>
                </div>

                <!-- Timer & Control -->
                <div class="flex items-center space-x-6">
                    <div id="timer-box" class="flex items-center space-x-2 bg-canvas px-4 py-1.5 rounded-md border border-hairline font-bold text-ink transition-all duration-300">
                        <svg id="timer-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="countdown-timer" class="font-variant-numeric: tabular-nums">--:--</span>
                    </div>

                    <!-- Submit Button -->
                    <button type="button" onclick="confirmSubmitSection()" class="bg-green hover:bg-green-dark text-white px-5 py-2 rounded-md font-semibold text-body-sm transition-all duration-120 shadow-sm flex items-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                        <span>Selesai Section</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Minimal Footer -->
        <footer class="bg-canvas border-t border-hairline py-4 text-center text-xs text-muted font-body">
            <div class="max-w-container mx-auto px-6">
                &copy; {{ date('Y') }} Masbro Portal. Hak Cipta Dilindungi. Jangan memuat ulang halaman untuk mencegah hilangnya data pengerjaan.
            </div>
        </footer>
    </div>

    <!-- Timer JavaScript -->
    <script>
        // Total time left in seconds passed from backend
        let timeRemaining = parseInt("{{ $timeLeft }}") || 0;
        const timerText = document.getElementById('countdown-timer');
        const timerBox = document.getElementById('timer-box');
        const timerIcon = document.getElementById('timer-icon');

        function updateTimerDisplay() {
            if (timeRemaining <= 0) {
                timerText.innerText = "00:00";
                // Auto submit form
                autoSubmitSection();
                return;
            }

            let minutes = Math.floor(timeRemaining / 60);
            let seconds = timeRemaining % 60;

            // Pad with zero
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            timerText.innerText = `${minutes}:${seconds}`;

            // Visual indicator when less than 5 minutes (300 seconds) but more than 1 minute (60 seconds)
            if (timeRemaining <= 300 && timeRemaining > 60) {
                timerBox.className = "flex items-center space-x-2 bg-yellow-light px-4 py-1.5 rounded-md border border-yellow font-bold text-yellow transition-all duration-300";
                timerIcon.className = "h-5 w-5 text-yellow";
            } else if (timeRemaining <= 60) {
                // Warning state when less than 1 minute
                timerBox.className = "flex items-center space-x-2 bg-red-light px-4 py-1.5 rounded-md border-2 border-red font-bold text-red transition-all duration-300 animate-pulse";
                timerIcon.className = "h-5 w-5 text-red";
            }

            timeRemaining--;
        }

        // Run timer update every second
        const timerInterval = setInterval(updateTimerDisplay, 1000);
        updateTimerDisplay(); // Initial run

        function autoSubmitSection() {
            clearInterval(timerInterval);
            alert("Waktu pengerjaan section ini telah habis! Jawaban Anda akan disimpan otomatis.");
            const form = document.getElementById('test-form');
            if (form) {
                form.submit();
            }
        }

        function confirmSubmitSection() {
            if (confirm("Apakah Anda yakin ingin menyelesaikan section ini? Semua jawaban yang Anda pilih akan disimpan dan Anda tidak dapat kembali ke section ini.")) {
                clearInterval(timerInterval);
                const form = document.getElementById('test-form');
                if (form) {
                    form.submit();
                }
            }
        }
    </script>
</body>
</html>

