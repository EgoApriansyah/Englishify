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
                            Bacalah transkrip percakapan atau monolog di bawah ini dengan saksama, kemudian pilih satu jawaban yang paling tepat (A, B, C, atau D) untuk menjawab pertanyaan yang diajukan.
                        </p>
                    </div>

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
                                <!-- Transcript block -->
                                @if($q->transcript)
                                    <div class="bg-slate-50 p-5 rounded-xl border border-slate-200 font-sans text-slate-800 text-base leading-relaxed whitespace-pre-line shadow-inner">
                                        <div class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-2 select-none border-b border-slate-200 pb-1">
                                            Audio Transcript (Teks Percakapan)
                                        </div>
                                        {!! nl2br(e($q->transcript)) !!}
                                    </div>
                                @endif

                                <!-- Question Text -->
                                <div class="text-lg font-bold text-slate-900">
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
