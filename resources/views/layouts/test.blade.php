<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TOEFL ITP Test - {{ $title ?? 'Section' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F9FAFB;
        }
        .bg-primary {
            background-color: #1E3A5F;
        }
        .text-primary {
            color: #1E3A5F;
        }
        .border-primary {
            border-color: #1E3A5F;
        }
        .hover-bg-primary:hover {
            background-color: #152943;
        }
        /* Custom scrollbar for Reading passage */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #F1F1F1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
</head>
<body class="antialiased select-none">
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Top Bar Header -->
        <header class="bg-primary text-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <span class="text-xl font-bold tracking-wider">TOEFL ITP Portal</span>
                    <span class="hidden md:inline px-2 py-0.5 text-xs bg-blue-500 rounded font-semibold text-blue-100">{{ $sectionTitle }}</span>
                </div>

                <!-- Timer -->
                <div class="flex items-center space-x-6">
                    <div id="timer-box" class="flex items-center space-x-2 bg-slate-800 bg-opacity-65 px-4 py-1.5 rounded-lg border border-slate-700 font-mono text-lg font-bold transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" id="timer-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="countdown-timer">--:--</span>
                    </div>

                    <!-- Submit Button -->
                    <button type="button" onclick="confirmSubmitSection()" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-1.5 rounded-lg font-semibold text-sm transition-colors duration-150 shadow-sm flex items-center space-x-1">
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
        <footer class="bg-white border-t border-gray-200 py-4 text-center text-xs text-gray-500">
            <div class="max-w-7xl mx-auto px-4">
                &copy; {{ date('Y') }} TOEFL ITP Test Portal. Hak Cipta Dilindungi. Jangan memuat ulang halaman untuk mencegah hilangnya data pengerjaan.
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

            // Visual indicator when less than 5 minutes (300 seconds)
            if (timeRemaining <= 300) {
                timerBox.classList.remove('bg-slate-800', 'border-slate-700');
                timerBox.classList.add('bg-red-900', 'bg-opacity-90', 'border-red-500', 'text-red-100', 'animate-pulse');
                timerIcon.classList.remove('text-gray-400');
                timerIcon.classList.add('text-red-300');
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
