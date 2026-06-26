<x-test-layout :timeLeft="$timeLeft">
    <x-slot name="title">Reading Comprehension</x-slot>
    <x-slot name="sectionTitle">Reading Comprehension</x-slot>

    <!-- Main Container: Full Width to maximize 2-column layout space -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-6 font-body">
        <form id="test-form" method="POST" action="{{ route('test.reading.submit', $session->id) }}">
            @csrf

            <!-- Grid Layout: Left & Middle (Passage & Questions), Right (Navigation Sidebar) -->
            <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">
                
                <!-- Passage & Questions container (takes 4 columns on xl) -->
                <div class="xl:col-span-4 space-y-6">
                    <!-- Progress and Instruction Bar -->
                    <div class="bg-canvas p-4 rounded-lg border border-hairline shadow-sm flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <div class="flex items-center space-x-2">
                            <span class="px-2.5 py-1 bg-green text-white rounded text-xs font-semibold uppercase tracking-wider">Section 3</span>
                            <span class="text-sm text-green-dark font-semibold font-body">Reading Comprehension (35 Soal)</span>
                        </div>
                        
                        <!-- Progress Bar in header -->
                        <div class="flex items-center space-x-4 w-full md:w-2/3">
                            <div class="text-xs text-muted font-bold whitespace-nowrap" id="progress-text">
                                0 dari 35 Terjawab
                            </div>
                            <div class="w-full bg-hairline rounded-pill h-2 overflow-hidden">
                                <div id="progress-bar" class="bg-green h-full rounded-pill transition-all duration-500 ease-bounce" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Passages Container -->
                    @foreach($passages as $pIndex => $passage)
                        <div id="passage-container-{{ $passage->id }}" class="passage-block {{ $pIndex === 0 ? '' : 'hidden' }} grid grid-cols-1 md:grid-cols-2 gap-6 h-[calc(100vh-210px)] min-h-[500px]">
                            
                            <!-- Left Column: Passage Text (Sticky & Scrollable) -->
                            <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col h-full overflow-hidden shadow-card">
                                <div class="border-b border-hairline pb-3 mb-4 flex justify-between items-center flex-shrink-0">
                                    <h3 class="font-bold text-green-dark text-lg uppercase tracking-tight font-body">Bacaan {{ $pIndex + 1 }}</h3>
                                    <span class="px-2.5 py-0.5 bg-surface text-muted border border-hairline rounded-pill text-xs font-semibold font-body font-normal">
                                        {{ str_word_count($passage->content) }} Kata
                                    </span>
                                </div>
                                <div class="overflow-y-auto pr-2 custom-scrollbar flex-grow text-base text-ink leading-relaxed font-body space-y-4 select-text font-normal">
                                    <h4 class="font-bold text-green-dark text-center text-lg mb-4 font-body">{{ $passage->title }}</h4>
                                    <p class="whitespace-pre-line text-body-md font-body">{{ $passage->content }}</p>
                                </div>
                            </div>

                            <!-- Middle Column: Questions (Scrollable) -->
                            <div class="flex flex-col h-full overflow-hidden font-body">
                                <div class="bg-surface px-4 py-2.5 rounded-t-lg border-t border-x border-hairline flex justify-between items-center flex-shrink-0">
                                    <span class="text-xs font-bold text-muted uppercase tracking-wider font-body">Pertanyaan Terkait</span>
                                    <span class="text-xs font-semibold text-green-dark font-body">Soal {{ $passage->questions->first()->order_number }} - {{ $passage->questions->last()->order_number }}</span>
                                </div>
                                <div class="relative questions-scroll-container bg-canvas rounded-b-lg border border-hairline p-6 overflow-y-auto custom-scrollbar flex-grow space-y-8 shadow-card">
                                    @foreach($passage->questions as $indexInPassage => $q)
                                        <div id="question-card-{{ $q->id }}" class="question-card p-4 rounded-lg border border-hairline bg-canvas hover:border-green/30 transition-all duration-200 space-y-4">
                                            <!-- Soal Header -->
                                            <div class="flex items-center space-x-2 border-b border-hairline pb-2">
                                                <span class="w-8 h-8 rounded-pill bg-surface text-green-dark flex items-center justify-center font-bold text-sm">
                                                    {{ $q->order_number }}
                                                </span>
                                                <span class="text-xs font-semibold text-muted uppercase tracking-wider">Pertanyaan</span>
                                            </div>

                                            <!-- Question Text -->
                                            <div class="text-body-md font-semibold text-ink leading-snug">
                                                {{ $q->question_text }}
                                            </div>

                                            <!-- Options -->
                                            <div class="grid grid-cols-1 gap-2.5 font-body">
                                                @foreach(['A', 'B', 'C', 'D'] as $opt)
                                                    @php
                                                        $optKey = 'option_' . strtolower($opt);
                                                        $savedVal = $savedAnswers[$q->id] ?? null;
                                                        $isChecked = ($savedVal === $opt);
                                                    @endphp
                                                    <label id="label-q{{ $q->id }}-{{ $opt }}" 
                                                           class="option-card flex items-center p-3 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm
                                                                  {{ $isChecked ? 'border-green bg-green-light font-semibold text-green-dark shadow-sm' : 'border-hairline hover:border-green hover:bg-green-light/10 text-ink' }}">
                                                        <input type="radio" 
                                                               name="answers[{{ $q->id }}]" 
                                                               value="{{ $opt }}" 
                                                               onchange="selectOption({{ $q->id }}, '{{ $opt }}', {{ $q->order_number }}, {{ $passage->id }})"
                                                               class="sr-only" 
                                                               {{ $isChecked ? 'checked' : '' }}>
                                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-pill font-bold text-xs mr-3 transition-all duration-120
                                                                     {{ $isChecked ? 'bg-green text-white shadow-sm' : 'bg-surface text-muted border border-hairline' }}">
                                                            {{ $opt }}
                                                        </span>
                                                        <span class="leading-normal">{{ $q->$optKey }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Right Column: Sidebar Navigation Grid (takes 1 column) -->
                <div class="xl:col-span-1 font-body">
                    <div class="bg-canvas rounded-lg border border-hairline p-5 shadow-card sticky top-24 space-y-5">
                        <div class="border-b border-hairline pb-3 flex justify-between items-center">
                            <h4 class="font-bold text-ink text-sm font-body">Navigasi Soal</h4>
                            <span class="px-2 py-0.5 bg-green-light text-green-dark rounded-pill text-[10px] font-bold uppercase">READING</span>
                        </div>
                        
                        <!-- Quick Passage Tabs -->
                        <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-center font-body">
                            @foreach($passages as $pIndex => $passage)
                                <button type="button" id="tab-p-{{ $passage->id }}" onclick="switchPassage({{ $passage->id }})"
                                        class="py-1.5 px-2 rounded-md border transition-all duration-120 cursor-pointer
                                               {{ $pIndex === 0 ? 'bg-green text-white border-green font-semibold' : 'bg-surface text-muted border-hairline hover:bg-green-light/10' }}">
                                    Bacaan {{ $pIndex + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Question Grid (31 - 65) -->
                        <div class="grid grid-cols-4 sm:grid-cols-7 xl:grid-cols-4 gap-2 pt-2 font-body">
                            @foreach($questions as $q)
                                @php
                                    $savedVal = $savedAnswers[$q->id] ?? null;
                                    $isAnswered = !is_null($savedVal);
                                @endphp
                                <button type="button" id="grid-btn-{{ $q->order_number }}" onclick="focusQuestion({{ $q->id }}, {{ $q->order_number }}, {{ $q->passage_id }})"
                                        class="w-full h-10 flex items-center justify-center font-bold text-sm rounded-md transition-all duration-120 border-2 cursor-pointer
                                               {{ $isAnswered ? 'bg-green text-white border-green' : 'bg-canvas text-muted border-hairline hover:border-green' }}">
                                    {{ $q->order_number }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Legend -->
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
        const totalQuestions = 35;
        let activePassageId = {{ $passages->first()->id }};
        let activeQuestionNum = 31;

        // Track answered state of each question
        const answeredState = {};
        @foreach($questions as $q)
            answeredState[{{ $q->id }}] = {{ !is_null($savedAnswers[$q->id] ?? null) ? 'true' : 'false' }};
        @endforeach

        function switchPassage(passageId) {
            // Hide all passage blocks
            document.querySelectorAll('.passage-block').forEach(block => {
                block.classList.add('hidden');
            });

            // Show target passage block
            document.getElementById(`passage-container-${passageId}`).classList.remove('hidden');

            // Update passage tab buttons styling
            document.querySelectorAll('[id^="tab-p-"]').forEach(btn => {
                btn.classList.remove('bg-green', 'text-white', 'border-green');
                btn.classList.add('bg-surface', 'text-muted', 'border-hairline', 'hover:bg-green-light/10');
            });

            const activeTab = document.getElementById(`tab-p-${passageId}`);
            if (activeTab) {
                activeTab.classList.remove('bg-surface', 'text-muted', 'border-hairline', 'hover:bg-green-light/10');
                activeTab.classList.add('bg-green', 'text-white', 'border-green');
            }

            activePassageId = passageId;
        }

        function focusQuestion(questionId, orderNumber, passageId, shouldScroll = true) {
            // Switch passage if different
            if (activePassageId !== passageId) {
                switchPassage(passageId);
            }

            // Remove active highlight from old grid button
            const oldGridBtn = document.getElementById(`grid-btn-${activeQuestionNum}`);
            if (oldGridBtn) {
                oldGridBtn.classList.remove('border-yellow');
                if (answeredState[getQuestionIdByNum(activeQuestionNum)]) {
                    oldGridBtn.classList.add('border-green');
                } else {
                    oldGridBtn.classList.add('border-hairline');
                }
            }

            // Set new active number
            activeQuestionNum = orderNumber;

            // Apply active highlight to new grid button
            const newGridBtn = document.getElementById(`grid-btn-${activeQuestionNum}`);
            if (newGridBtn) {
                newGridBtn.classList.remove('border-green', 'border-hairline');
                newGridBtn.classList.add('border-yellow');
            }

            // Highlight and scroll to the target question card
            const qCard = document.getElementById(`question-card-${questionId}`);
            if (qCard) {
                // Remove highlight from all other cards
                document.querySelectorAll('.question-card').forEach(card => {
                    card.classList.remove('border-green/30', 'bg-green-light/10');
                    card.classList.add('border-hairline');
                });

                // Add active highlight to target card
                qCard.classList.remove('border-hairline');
                qCard.classList.add('border-green/30', 'bg-green-light/10');

                // Scroll the parent container to show this card
                if (shouldScroll) {
                    const container = qCard.closest('.questions-scroll-container');
                    if (container) {
                        container.scrollTo({
                            top: qCard.offsetTop - 16,
                            behavior: 'smooth'
                        });
                    }
                }
            }
        }

        function getQuestionIdByNum(num) {
            const questionMap = {
                @foreach($questions as $q)
                    {{ $q->order_number }}: {{ $q->id }},
                @endforeach
            };
            return questionMap[num];
        }

        function selectOption(questionId, option, orderNumber, passageId) {
            // Remove active style from other option labels in this question
            const letters = ['A', 'B', 'C', 'D'];
            letters.forEach(letter => {
                const label = document.getElementById(`label-q${questionId}-${letter}`);
                if (label) {
                    label.className = "option-card flex items-center p-3 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm border-hairline hover:border-green hover:bg-green-light/10 text-ink";
                    
                    const span = label.querySelector('span:first-child');
                    if (span) {
                        span.className = "flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-pill font-bold text-xs mr-3 transition-all duration-120 bg-surface text-muted border border-hairline";
                    }
                }
            });

            // Add active style to selected option
            const activeLabel = document.getElementById(`label-q${questionId}-${option}`);
            if (activeLabel) {
                activeLabel.className = "option-card flex items-center p-3 border rounded-md cursor-pointer transition-all duration-120 select-none text-body-sm border-green bg-green-light font-semibold text-green-dark shadow-sm";
                
                const span = activeLabel.querySelector('span:first-child');
                if (span) {
                    span.className = "flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-pill font-bold text-xs mr-3 transition-all duration-120 bg-green text-white shadow-sm";
                }
            }

            // Update answered state
            answeredState[questionId] = true;

            // Highlight in grid sidebar
            const gridBtn = document.getElementById(`grid-btn-${orderNumber}`);
            if (gridBtn) {
                gridBtn.className = `w-full h-10 flex items-center justify-center font-bold text-sm rounded-md transition-all duration-120 border-2 bg-green text-white border-green ${activeQuestionNum === orderNumber ? 'border-yellow' : ''}`;
            }

            updateProgressBar();
            focusQuestion(questionId, orderNumber, passageId, false);
        }

        function updateProgressBar() {
            let answeredCount = 0;
            Object.keys(answeredState).forEach(key => {
                if (answeredState[key]) answeredCount++;
            });

            const percent = Math.round((answeredCount / totalQuestions) * 100);
            
            document.getElementById('progress-text').innerText = `${answeredCount} dari ${totalQuestions} Terjawab`;
            document.getElementById('progress-bar').style.width = `${percent}%`;
        }

        // Initialize display by focusing first question
        const firstQuestionId = {{ $questions->first()->id }};
        const firstPassageId = {{ $passages->first()->id }};
        focusQuestion(firstQuestionId, 31, firstPassageId);
    </script>
</x-test-layout>
