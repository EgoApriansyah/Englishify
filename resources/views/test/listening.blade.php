<x-test-layout :timeLeft="$timeLeft">
    <x-slot name="title">Listening Comprehension</x-slot>
    <x-slot name="sectionTitle">Listening Comprehension</x-slot>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <form id="test-form" method="POST" action="{{ route('test.listening.submit', $session->id) }}">
            @csrf

            <!-- Grid Layout: Left (Questions), Right (Sidebar Navigation) -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Left Column: Current Question Card -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Section Instruction Banner -->
                    <div class="bg-blue-50 border-l-4 border-blue-900 p-4 rounded-r-lg shadow-sm">
                        <h4 class="font-bold text-blue-950 text-sm">Petunjuk Section 1 (Listening Comprehension)</h4>
                        <p class="text-xs text-blue-800 mt-1 leading-relaxed">
                            Dengarkan rekaman audio yang diputar, lalu jawab 18 pertanyaan yang diajukan dengan memilih opsi jawaban yang paling tepat (A, B, C, atau D).
                        </p>
                    </div>

                    <!-- Audio Player Card -->
                    <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm">Audio Simulasi Listening Comprehension</h4>
                                <p class="text-xs text-slate-400 mt-0.5 leading-relaxed">
                                    Hanya dapat diputar <strong>satu kali</strong>, tidak dapat dihentikan (pause) atau dipercepat (seek).
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <button type="button" id="play-audio-btn" onclick="startListeningAudio()" 
                                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 disabled:bg-slate-200 disabled:text-slate-400 text-white font-bold text-sm rounded-xl shadow-md shadow-indigo-600/10 flex items-center gap-2 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                  <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                </svg>
                                <span>Putar Audio</span>
                            </button>
                        </div>
                    </div>

                    <audio id="listening-audio" src="{{ asset('assets/LISTENING.mp3') }}" preload="auto"></audio>

                    <!-- Progress Bar -->
                    <div class="bg-white p-4 rounded-xl border border-slate-100 shadow-sm space-y-2">
                        <div class="flex justify-between items-center text-xs text-slate-500 font-bold uppercase tracking-wider">
                            <span>Kemajuan Pengerjaan</span>
                            <span id="progress-text">0 dari {{ $questions->count() }} Terjawab (0%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                            <div id="progress-bar" class="bg-blue-900 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Questions Display Blocks -->
                    @foreach($questions as $index => $q)
                        <div id="question-block-{{ $index }}" class="question-block hidden bg-white rounded-xl border border-slate-150 shadow-sm overflow-hidden transition-all duration-200">
                            <!-- Question Header -->
                            <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex justify-between items-center">
                                <span class="font-bold text-slate-800 text-base">Soal {{ $index + 1 }} dari {{ $questions->count() }}</span>
                                <span class="px-3 py-1 bg-slate-200 text-slate-700 rounded-full text-xs font-semibold uppercase">
                                    {{ str_replace('_', ' ', $q->sub_type) }}
                                </span>
                            </div>

                            <!-- Question Body -->
                            <div class="p-6 space-y-6">
                                <!-- Question Text -->
                                <div class="text-base font-semibold text-slate-600 italic">
                                    {{ $q->question_text }}
                                </div>

                                <!-- Options Cards -->
                                <div class="grid grid-cols-1 gap-3 pt-2">
                                    @foreach(['A', 'B', 'C', 'D'] as $opt)
                                        @php
                                            $optKey = 'option_' . strtolower($opt);
                                            $savedVal = $savedAnswers[$q->id] ?? null;
                                            $isChecked = ($savedVal === $opt);
                                        @endphp
                                        <label id="label-q{{ $q->id }}-{{ $opt }}" 
                                               class="option-card flex items-center p-4 border rounded-xl cursor-pointer transition-all duration-150 select-none 
                                                      {{ $isChecked ? 'border-blue-900 bg-blue-50/70 font-semibold text-blue-900 shadow-sm' : 'border-slate-200 hover:border-slate-300 hover:bg-slate-50/50 text-slate-700' }}">
                                            <input type="radio" 
                                                   name="answers[{{ $q->id }}]" 
                                                   value="{{ $opt }}" 
                                                   onchange="selectOption({{ $q->id }}, '{{ $opt }}', {{ $index }})"
                                                   class="sr-only" 
                                                   {{ $isChecked ? 'checked' : '' }}>
                                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full font-bold text-sm mr-4 transition-all duration-150
                                                         {{ $isChecked ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                                {{ $opt }}
                                            </span>
                                            <span class="text-base leading-snug">{{ $q->$optKey }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Navigation Action Buttons -->
                    <div class="flex justify-between items-center pt-2">
                        <button type="button" id="prev-btn" onclick="navigateQuestion(-1)" class="px-6 py-2.5 bg-white hover:bg-slate-50 border border-slate-300 text-slate-700 font-bold rounded-lg transition duration-150 flex items-center space-x-1 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Kembali</span>
                        </button>

                        <button type="button" id="next-btn" onclick="navigateQuestion(1)" class="px-6 py-2.5 bg-blue-900 hover:bg-blue-800 text-white font-bold rounded-lg shadow transition duration-150 flex items-center space-x-1">
                            <span>Selanjutnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right Column: Question Grid Navigation Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl border border-slate-150 p-5 shadow-sm sticky top-24 space-y-5">
                        <h4 class="font-bold text-slate-800 text-sm border-b border-slate-100 pb-3">Daftar Nomor Soal</h4>
                        
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-4 gap-2">
                            @foreach($questions as $index => $q)
                                @php
                                    $savedVal = $savedAnswers[$q->id] ?? null;
                                    $isAnswered = !is_null($savedVal);
                                @endphp
                                <button type="button" id="grid-btn-{{ $index }}" onclick="showQuestion({{ $index }})"
                                        class="w-10 h-10 flex items-center justify-center font-bold text-sm rounded-lg transition-all duration-150 border-2
                                               {{ $isAnswered ? 'bg-blue-900 text-white border-blue-900' : 'bg-white text-slate-500 border-slate-200 hover:border-slate-350' }}">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <div class="pt-4 border-t border-slate-100 space-y-2 text-xs text-slate-500 font-medium">
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-blue-900 border border-blue-900 block"></span>
                                <span>Sudah Dijawab</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-white border-2 border-slate-200 block"></span>
                                <span>Belum Dijawab</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-white border-2 border-amber-400 block"></span>
                                <span>Soal Aktif</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Question Control Script -->
    <script>
        let currentIdx = 0;
        const totalQuestions = {{ $questions->count() }};
        const questionBlocks = document.querySelectorAll('.question-block');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');

        // Track answered state of each question
        const answeredState = {};
        @foreach($questions as $index => $q)
            answeredState[{{ $q->id }}] = {{ !is_null($savedAnswers[$q->id] ?? null) ? 'true' : 'false' }};
        @endforeach

        function showQuestion(index) {
            if (index < 0 || index >= totalQuestions) return;

            // Hide current active block
            document.getElementById(`question-block-${currentIdx}`).classList.add('hidden');
            
            // Remove active border from old grid button
            const oldGridBtn = document.getElementById(`grid-btn-${currentIdx}`);
            if (oldGridBtn) {
                oldGridBtn.classList.remove('border-amber-400');
                if (answeredState[getQuestionIdByIdx(currentIdx)]) {
                    oldGridBtn.classList.add('border-blue-900');
                } else {
                    oldGridBtn.classList.add('border-slate-200');
                }
            }

            // Set new index
            currentIdx = index;

            // Show new active block
            document.getElementById(`question-block-${currentIdx}`).classList.remove('hidden');

            // Apply active border to new grid button
            const newGridBtn = document.getElementById(`grid-btn-${currentIdx}`);
            if (newGridBtn) {
                newGridBtn.classList.remove('border-blue-900', 'border-slate-200');
                newGridBtn.classList.add('border-amber-400');
            }

            // Enable/disable navigation buttons
            prevBtn.disabled = (currentIdx === 0);

            // Change next button to submit confirmation if on last question
            if (currentIdx === totalQuestions - 1) {
                nextBtn.innerHTML = `
                    <span>Selesai Section</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                `;
                nextBtn.classList.remove('bg-blue-900', 'hover:bg-blue-800');
                nextBtn.classList.add('bg-emerald-600', 'hover:bg-emerald-700');
                nextBtn.setAttribute('onclick', 'confirmSubmitSection()');
            } else {
                nextBtn.innerHTML = `
                    <span>Selanjutnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                `;
                nextBtn.classList.remove('bg-emerald-600', 'hover:bg-emerald-700');
                nextBtn.classList.add('bg-blue-900', 'hover:bg-blue-800');
                nextBtn.setAttribute('onclick', 'navigateQuestion(1)');
            }

            updateProgressBar();
        }

        function navigateQuestion(direction) {
            showQuestion(currentIdx + direction);
        }

        function getQuestionIdByIdx(idx) {
            const questionIds = [
                @foreach($questions as $q)
                    {{ $q->id }},
                @endforeach
            ];
            return questionIds[idx];
        }

        function selectOption(questionId, option, index) {
            // Remove active style from other option labels in this question
            const letters = ['A', 'B', 'C', 'D'];
            letters.forEach(letter => {
                const label = document.getElementById(`label-q${questionId}-${letter}`);
                if (label) {
                    label.classList.remove('border-blue-900', 'bg-blue-50/70', 'font-semibold', 'text-blue-900', 'shadow-sm');
                    label.classList.add('border-slate-200', 'hover:border-slate-300', 'hover:bg-slate-50/50', 'text-slate-700');
                    
                    const span = label.querySelector('span:first-child');
                    if (span) {
                        span.classList.remove('bg-blue-900', 'text-white', 'shadow-sm');
                        span.classList.add('bg-slate-100', 'text-slate-600', 'border', 'border-slate-200');
                    }
                }
            });

            // Add active style to selected option
            const activeLabel = document.getElementById(`label-q${questionId}-${option}`);
            if (activeLabel) {
                activeLabel.classList.add('border-blue-900', 'bg-blue-50/70', 'font-semibold', 'text-blue-900', 'shadow-sm');
                activeLabel.classList.remove('border-slate-200', 'hover:border-slate-300', 'hover:bg-slate-50/50', 'text-slate-700');
                
                const span = activeLabel.querySelector('span:first-child');
                if (span) {
                    span.classList.add('bg-blue-900', 'text-white', 'shadow-sm');
                    span.classList.remove('bg-slate-100', 'text-slate-600', 'border', 'border-slate-200');
                }
            }

            // Update answered state
            answeredState[questionId] = true;

            // Highlight in grid sidebar
            const gridBtn = document.getElementById(`grid-btn-${index}`);
            if (gridBtn) {
                gridBtn.classList.remove('bg-white', 'text-slate-500', 'border-slate-200');
                gridBtn.classList.add('bg-blue-900', 'text-white', 'border-blue-900');
            }

            updateProgressBar();
        }

        // --- Audio Player Logic ---
        const audio = document.getElementById('listening-audio');
        const playBtn = document.getElementById('play-audio-btn');
        let maxPlayedTime = 0;
        let isAlreadyPlayed = {{ $session->listening_audio_played ? 'true' : 'false' }};

        // Check if already played
        if (isAlreadyPlayed) {
            disableAudioButton("Audio Telah Diputar");
        }

        function startListeningAudio() {
            if (isAlreadyPlayed) return;

            audio.play().then(() => {
                isAlreadyPlayed = true;
                playBtn.disabled = true;
                playBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
                playBtn.classList.add('bg-slate-100', 'text-slate-500');
                playBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-slate-500 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Audio Sedang Diputar...</span>
                `;

                // Mark as played in Database
                fetch("{{ route('test.listening.play', $session->id) }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }).catch(err => {
                    console.error("Gagal menyimpan status pemutaran:", err);
                });
            }).catch(err => {
                console.error("Gagal memutar audio:", err);
                alert("Gagal memutar audio. Pastikan browser Anda mengizinkan pemutaran audio (autoplay policy) atau lakukan klik/interaksi terlebih dahulu.");
            });

            // Track maximum played time during natural playback
            audio.addEventListener('timeupdate', () => {
                if (!audio.seeking) {
                    maxPlayedTime = Math.max(maxPlayedTime, audio.currentTime);
                }
            });

            // Prevent seeking (forward or backward)
            audio.addEventListener('seeking', () => {
                if (Math.abs(audio.currentTime - maxPlayedTime) > 0.5) {
                    audio.currentTime = maxPlayedTime;
                }
            });

            // Prevent pausing/stopping the audio
            audio.addEventListener('pause', () => {
                if (!audio.ended) {
                    audio.play().catch(err => {
                        console.error("Gagal memutar kembali audio:", err);
                    });
                }
            });

            audio.addEventListener('ended', () => {
                disableAudioButton("Audio Selesai");
            });
        }

        function disableAudioButton(text) {
            playBtn.disabled = true;
            playBtn.classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
            playBtn.classList.add('bg-slate-100', 'text-slate-400');
            playBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-slate-400 inline-block mr-1">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
                <span>${text}</span>
            `;
        }

        function updateProgressBar() {
            let answeredCount = 0;
            Object.keys(answeredState).forEach(key => {
                if (answeredState[key]) answeredCount++;
            });

            const percent = Math.round((answeredCount / totalQuestions) * 100);
            
            document.getElementById('progress-text').innerText = `${answeredCount} dari ${totalQuestions} Terjawab (${percent}%)`;
            document.getElementById('progress-bar').style.width = `${percent}%`;
        }

        // Initialize display
        showQuestion(0);
    </script>
</x-test-layout>
