<x-test-layout :timeLeft="$timeLeft">
    <x-slot name="title">Structure & Written Expression</x-slot>
    <x-slot name="sectionTitle">Structure & Written Expression</x-slot>

    <!-- Main Container -->
    <div class="max-w-container mx-auto px-6 lg:px-8 py-8 font-body">
        <form id="test-form" method="POST" action="{{ route('test.structure.submit', $session->id) }}">
            @csrf

            <!-- Grid Layout: Left (Questions), Right (Sidebar Navigation) -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 font-body">
                
                <!-- Left Column: Current Question Card -->
                <div class="lg:col-span-3 space-y-6">
                    <!-- Section Instruction Banner -->
                    <div class="bg-green-light border-l-4 border-green p-5 rounded-r-md shadow-sm">
                        <h4 class="font-bold text-green-dark text-body-md font-body">Petunjuk Section 2 (Structure & Written Expression)</h4>
                        <p class="text-body-sm text-muted mt-1 leading-relaxed font-body">
                            <strong>Soal 11 - 20 (Structure):</strong> Pilih satu kata atau frasa yang paling tepat untuk melengkapi bagian rumpang (___) pada kalimat.<br>
                            <strong>Soal 21 - 30 (Written Expression):</strong> Identifikasi satu kata atau frasa bergaris bawah (berlabel A, B, C, atau D) yang salah secara tata bahasa (gramatikal).
                        </p>
                    </div>

                    <!-- Progress Bar -->
                    <div class="bg-canvas p-5 rounded-lg border border-hairline shadow-sm space-y-2 font-body">
                        <div class="flex justify-between items-center text-label-sm text-muted uppercase tracking-widest font-semibold font-body">
                            <span>Kemajuan Pengerjaan</span>
                            <span id="progress-text">0 dari {{ $questions->count() }} Terjawab (0%)</span>
                        </div>
                        <div class="w-full bg-hairline rounded-pill h-2 overflow-hidden">
                            <div id="progress-bar" class="bg-green h-full rounded-pill transition-all duration-500 ease-bounce" style="width: 0%"></div>
                        </div>
                    </div>

                    <!-- Questions Display Blocks -->
                    @foreach($questions as $index => $q)
                        <div id="question-block-{{ $index }}" class="question-block hidden bg-canvas rounded-lg border border-hairline shadow-card overflow-hidden transition-all duration-200 font-body">
                            <!-- Question Header -->
                            <div class="bg-surface px-6 py-4 border-b border-hairline flex justify-between items-center">
                                <span class="font-bold text-ink text-body-md font-body">Soal {{ $index + 1 }} dari {{ $questions->count() }}</span>
                                <span class="px-3 py-1 bg-green-light text-green-dark rounded-pill text-xs font-semibold uppercase tracking-wider font-body">
                                    {{ str_replace('_', ' ', $q->sub_type) }}
                                </span>
                            </div>

                            <!-- Question Body -->
                            <div class="p-6 space-y-6 font-body">
                                
                                <!-- Question Text / Sentence -->
                                <div class="text-lg text-ink leading-relaxed font-body font-normal">
                                    @if($q->sub_type === 'written_expression')
                                        {{-- Format Written Expression brackets into underlines --}}
                                        {!! preg_replace('/\[([^\]]+)\] \(([A-D])\)/', '<span class="underline decoration-green decoration-2 underline-offset-4 relative font-semibold inline-block px-1 bg-surface border border-hairline rounded-sm">$1<sup class="text-xs text-green-dark font-bold ml-0.5">$2</sup></span>', $q->question_text) !!}
                                    @else
                                        {!! str_replace('___', '<span class="border-b-2 border-green inline-block w-16 mx-1"></span>', e($q->question_text)) !!}
                                    @endif
                                </div>

                                <!-- Options Cards -->
                                <div class="grid grid-cols-1 gap-3 pt-2 font-body">
                                    @foreach(['A', 'B', 'C', 'D'] as $opt)
                                        @php
                                            $optKey = 'option_' . strtolower($opt);
                                            $savedVal = $savedAnswers[$q->id] ?? null;
                                            $isChecked = ($savedVal === $opt);
                                        @endphp
                                        <label id="label-q{{ $q->id }}-{{ $opt }}" 
                                               class="option-card flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm
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
                                            <span class="text-body-md leading-snug">
                                                @if($q->sub_type === 'written_expression')
                                                    {{-- For written expression options, show the specific word that was highlighted --}}
                                                    <strong>{{ $q->$optKey }}</strong>
                                                @else
                                                    {{ $q->$optKey }}
                                                @endif
                                            </span>
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
                <div class="lg:col-span-1 font-body">
                    <div class="bg-canvas rounded-lg border border-hairline p-5 shadow-card sticky top-24 space-y-5">
                        <h4 class="font-bold text-ink text-body-sm border-b border-hairline pb-3 font-body">Daftar Nomor Soal</h4>
                        
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-4 gap-2 font-body">
                            @foreach($questions as $index => $q)
                                @php
                                    $savedVal = $savedAnswers[$q->id] ?? null;
                                    $isAnswered = !is_null($savedVal);
                                @endphp
                                <button type="button" id="grid-btn-{{ $index }}" onclick="showQuestion({{ $index }})"
                                        class="w-10 h-10 flex items-center justify-center font-bold text-sm rounded-md transition-all duration-120 border-2 cursor-pointer
                                               {{ $isAnswered ? 'bg-green text-white border-green' : 'bg-canvas text-muted border-hairline hover:border-green' }}">
                                    {{ $index + 11 }}
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
                    label.className = "option-card flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm border-hairline hover:border-green hover:bg-green-light/10 text-ink";
                    
                    const span = label.querySelector('span:first-child');
                    if (span) {
                        span.className = "flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-pill font-bold text-sm mr-4 transition-all duration-120 bg-surface text-muted border border-hairline";
                    }
                }
            });

            // Add active style to selected option
            const activeLabel = document.getElementById(`label-q${questionId}-${option}`);
            if (activeLabel) {
                activeLabel.className = "option-card flex items-center p-4 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm border-green bg-green-light font-semibold text-green-dark shadow-sm";
                
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
