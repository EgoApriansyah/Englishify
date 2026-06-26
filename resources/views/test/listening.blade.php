<x-test-layout :timeLeft="$timeLeft">
    <x-slot name="title">Listening Comprehension</x-slot>
    <x-slot name="sectionTitle">Listening Comprehension</x-slot>

    <!-- Main Container -->
    <div class="max-w-container mx-auto px-6 lg:px-8 py-8 font-body">
        <form id="test-form" method="POST" action="{{ route('test.listening.submit', $session->id) }}">
            @csrf

            <!-- Grid Layout: Left (Questions), Right (Sidebar Navigation) -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Left Column: Current Question Card -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Section Instruction Banner -->
                    <div class="bg-blue-light border-l-4 border-blue p-5 rounded-r-md shadow-sm">
                        <h4 class="font-bold text-ink text-body-md">Petunjuk Section 1 (Listening Comprehension)</h4>
                        <p class="text-body-sm text-muted mt-1 leading-relaxed">
                            Dengarkan rekaman audio yang diputar, lalu jawab 18 pertanyaan yang diajukan dengan memilih opsi jawaban yang paling tepat (A, B, C, atau D).
                        </p>
                    </div>

                    <!-- Audio Player Card -->
                    <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-card flex flex-col md:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-md bg-blue-light border border-hairline flex items-center justify-center text-blue shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-ink text-body-sm">Audio Simulasi Listening Comprehension</h4>
                                <p class="text-xs text-muted mt-0.5 leading-relaxed font-body">
                                    Hanya dapat diputar <strong>satu kali</strong>, tidak dapat dihentikan (pause) atau dipercepat (seek).
                                </p>
                            </div>
                        </div>
                        <div class="shrink-0">
                            <button type="button" id="play-audio-btn" onclick="startListeningAudio()" 
                                class="px-5 py-2.5 bg-green hover:bg-green-dark disabled:bg-hairline disabled:text-muted disabled:border-hairline border border-transparent text-white font-semibold text-body-sm rounded-md shadow-sm flex items-center gap-2 transition duration-120 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                  <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                </svg>
                                <span>Putar Audio</span>
                            </button>
                        </div>
                    </div>

                    <audio id="listening-audio" src="{{ asset('assets/LISTENING.mp3') }}" preload="auto"></audio>

                    <!-- Progress Bar -->
                    <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-sm space-y-2">
                        <div class="flex justify-between items-center text-label-sm text-muted uppercase tracking-widest font-semibold">
                            <span>Kemajuan Pengerjaan</span>
                            <span id="progress-text">0 dari {{ $questions->count() }} Terjawab (0%)</span>
                        </div>
                        <div class="w-full bg-hairline rounded-pill h-2 overflow-hidden">
                            <div id="progress-bar" class="bg-green h-full rounded-pill transition-all duration-500 ease-bounce" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Questions Display Blocks -->
                    @foreach($questions as $index => $q)
                        <div id="question-block-{{ $index }}" class="question-block hidden bg-canvas rounded-lg border border-hairline shadow-card overflow-hidden transition-all duration-200">
                            <!-- Question Header -->
                            <div class="bg-surface px-6 py-4 border-b border-hairline flex justify-between items-center">
                                <span class="font-bold text-ink text-body-md">Soal {{ $index + 1 }} dari {{ $questions->count() }}</span>
                                <span class="px-3 py-1 bg-blue-light text-blue rounded-pill text-xs font-semibold uppercase tracking-wider">
                                    {{ str_replace('_', ' ', $q->sub_type) }}
                                </span>
                            </div>

                            <!-- Question Body -->
                            <div class="p-6 space-y-6">
                                <!-- Question Text -->
                                <div class="text-body-lg font-medium text-ink font-body leading-relaxed">
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
                                               class="flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none 
                                                      {{ $isChecked ? 'border-green bg-green-light font-semibold text-green-dark shadow-sm' : 'border-hairline hover:border-green hover:bg-green-light/10 text-ink' }}">
                                            <input type="radio" 
                                                   name="answers[{{ $q->id }}]" 
                                                   value="{{ $opt }}" 
                                                   onchange="selectOption({{ $q->id }}, '{{ $opt }}', {{ $index }})"
                                                   class="sr-only" 
                                                   {{ $isChecked ? 'checked' : '' }}>
                                            <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-pill font-bold text-sm mr-4 transition-all duration-120
                                                         {{ $isChecked ? 'bg-green text-white shadow-sm' : 'bg-surface text-muted border border-hairline' }}">
                                                {{ $opt }}
                                            </span>
                                            <span class="text-body-md leading-snug">{{ $q->$optKey }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Navigation Action Buttons -->
                    <div class="flex justify-between items-center pt-2">
                        <button type="button" id="prev-btn" onclick="navigateQuestion(-1)" class="px-6 py-3 bg-canvas hover:border-green hover:text-green-dark border border-hairline rounded-md font-semibold text-body-sm transition duration-120 flex items-center space-x-1.5 shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Kembali</span>
                        </button>

                        <button type="button" id="next-btn" onclick="navigateQuestion(1)" class="px-6 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-sm transition duration-120 flex items-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer">
                            <span>Selanjutnya</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Right Column: Question Grid Navigation Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-canvas rounded-lg border border-hairline p-5 shadow-card sticky top-24 space-y-5">
                        <h4 class="font-bold text-ink text-body-sm border-b border-hairline pb-3">Daftar Nomor Soal</h4>
                        
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-4 gap-2">
                            @foreach($questions as $index => $q)
                                @php
                                    $savedVal = $savedAnswers[$q->id] ?? null;
                                    $isAnswered = !is_null($savedVal);
                                @endphp
                                <button type="button" id="grid-btn-{{ $index }}" onclick="showQuestion({{ $index }})"
                                        class="w-10 h-10 flex items-center justify-center font-bold text-sm rounded-md transition-all duration-120 border-2 cursor-pointer
                                               {{ $isAnswered ? 'bg-green text-white border-green' : 'bg-canvas text-muted border-hairline hover:border-green' }}">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <div class="pt-4 border-t border-hairline space-y-2 text-xs text-muted font-semibold">
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-green border border-green block"></span>
                                <span>Sudah Dijawab</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-canvas border border-hairline block"></span>
                                <span>Belum Dijawab</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="w-3.5 h-3.5 rounded bg-canvas border-2 border-yellow block"></span>
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
                oldGridBtn.classList.remove('border-yellow');
                if (answeredState[getQuestionIdByIdx(currentIdx)]) {
                    oldGridBtn.classList.add('border-green');
                } else {
                    oldGridBtn.classList.add('border-hairline');
                }
            }

            // Set new index
            currentIdx = index;

            // Show new active block
            document.getElementById(`question-block-${currentIdx}`).classList.remove('hidden');

            // Apply active border to new grid button
            const newGridBtn = document.getElementById(`grid-btn-${currentIdx}`);
            if (newGridBtn) {
                newGridBtn.classList.remove('border-green', 'border-hairline');
                newGridBtn.classList.add('border-yellow');
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
                nextBtn.className = "px-6 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-sm transition duration-120 flex items-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer";
                nextBtn.setAttribute('onclick', 'confirmSubmitSection()');
            } else {
                nextBtn.innerHTML = `
                    <span>Selanjutnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                `;
                nextBtn.className = "px-6 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-sm transition duration-120 flex items-center space-x-1.5 transform hover:-translate-y-px active:translate-y-0 cursor-pointer";
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
                    label.className = "flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none border-hairline hover:border-green hover:bg-green-light/10 text-ink";
                    
                    const span = label.querySelector('span:first-child');
                    if (span) {
                        span.className = "flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-pill font-bold text-sm mr-4 transition-all duration-120 bg-surface text-muted border border-hairline";
                    }
                }
            });

            // Add active style to selected option
            const activeLabel = document.getElementById(`label-q${questionId}-${option}`);
            if (activeLabel) {
                activeLabel.className = "flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none border-green bg-green-light font-semibold text-green-dark shadow-sm";
                
                const span = activeLabel.querySelector('span:first-child');
                if (span) {
                    span.className = "flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-pill font-bold text-sm mr-4 transition-all duration-120 bg-green text-white shadow-sm";
                }
            }

            // Update answered state
            answeredState[questionId] = true;

            // Highlight in grid sidebar
            const gridBtn = document.getElementById(`grid-btn-${index}`);
            if (gridBtn) {
                gridBtn.className = `w-10 h-10 flex items-center justify-center font-bold text-sm rounded-md transition-all duration-120 border-2 bg-green text-white border-green ${currentIdx === index ? 'border-yellow' : ''}`;
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
                playBtn.className = "px-5 py-2.5 bg-hairline text-muted border border-hairline font-semibold text-body-sm rounded-md flex items-center gap-2 cursor-not-allowed";
                playBtn.innerHTML = `
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-muted inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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

            // Prevent closing page trigger warning if needed, but not part of this element
            audio.addEventListener('ended', () => {
                disableAudioButton("Audio Selesai");
            });
        }

        function disableAudioButton(text) {
            playBtn.disabled = true;
            playBtn.className = "px-5 py-2.5 bg-hairline text-muted border border-hairline font-semibold text-body-sm rounded-md flex items-center gap-2 cursor-not-allowed";
            playBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-muted inline-block mr-1">
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
