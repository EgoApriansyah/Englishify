<x-test-layout :timeLeft="$timeLeft">
    <x-slot name="title">Reading Comprehension</x-slot>
    <x-slot name="sectionTitle">Reading Comprehension</x-slot>

    <!-- Main Container: Full Width to maximize 2-column layout space -->
    <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <form id="test-form" method="POST" action="{{ route('test.reading.submit', $session->id) }}">
            @csrf

            <!-- Grid Layout: Left & Middle (Passage & Questions), Right (Navigation Sidebar) -->
            <div class="grid grid-cols-1 xl:grid-cols-5 gap-6">
                
                <!-- Passage & Questions container (takes 4 columns on xl) -->
                <div class="xl:col-span-4 space-y-6">
                    <!-- Progress and Instruction Bar -->
                    <div class="bg-white p-4 rounded-xl border border-slate-150 shadow-sm flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0">
                        <div class="flex items-center space-x-2">
                            <span class="px-2.5 py-1 bg-blue-900 text-white rounded font-bold text-xs">Section 3</span>
                            <span class="text-sm text-slate-600 font-medium">Reading Comprehension (35 Soal)</span>
                        </div>
                        
                        <!-- Progress Bar in header -->
                        <div class="flex items-center space-x-4 w-full md:w-2/3">
                            <div class="text-xs text-slate-500 font-bold whitespace-nowrap" id="progress-text">
                                0 dari 35 Terjawab
                            </div>
                            <div class="w-full bg-slate-150 rounded-full h-2 overflow-hidden">
                                <div id="progress-bar" class="bg-blue-900 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Passages Container -->
                    @foreach($passages as $pIndex => $passage)
                        <div id="passage-container-{{ $passage->id }}" class="passage-block {{ $pIndex === 0 ? '' : 'hidden' }} grid grid-cols-1 md:grid-cols-2 gap-6 h-[calc(100vh-210px)] min-h-[500px]">
                            
                            <!-- Left Column: Passage Text (Sticky & Scrollable) -->
                            <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col h-full overflow-hidden shadow-sm">
                                <div class="border-b border-slate-100 pb-3 mb-4 flex justify-between items-center flex-shrink-0">
                                    <h3 class="font-extrabold text-slate-800 text-lg uppercase tracking-tight">Bacaan {{ $pIndex + 1 }}</h3>
                                    <span class="px-2 py-0.5 bg-slate-100 text-slate-600 rounded text-xs font-semibold">
                                        {{ str_word_count($passage->content) }} Kata
                                    </span>
                                </div>
                                <div class="overflow-y-auto pr-2 custom-scrollbar flex-grow text-base text-slate-850 leading-relaxed font-serif space-y-4 select-text">
                                    <h4 class="font-bold text-slate-900 text-center text-lg mb-4">{{ $passage->title }}</h4>
                                    <p class="whitespace-pre-line">{{ $passage->content }}</p>
                                </div>
                            </div>

                            <!-- Middle Column: Questions (Scrollable) -->
                            <div class="flex flex-col h-full overflow-hidden">
                                <div class="bg-slate-100 px-4 py-2.5 rounded-t-xl border-t border-x border-slate-200 flex justify-between items-center flex-shrink-0">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pertanyaan Terkait</span>
                                    <span class="text-xs font-semibold text-slate-600">Soal {{ $passage->questions->first()->order_number }} - {{ $passage->questions->last()->order_number }}</span>
                                </div>
                                <div class="bg-white rounded-b-xl border border-slate-200 p-6 overflow-y-auto custom-scrollbar flex-grow space-y-8 shadow-sm">
                                    @foreach($passage->questions as $indexInPassage => $q)
                                        <div id="question-card-{{ $q->id }}" class="question-card p-4 rounded-xl border border-slate-100 bg-slate-50/30 hover:border-slate-200 transition-all duration-200 space-y-4">
                                            <!-- Soal Header -->
                                            <div class="flex items-center space-x-2 border-b border-slate-100 pb-2">
                                                <span class="w-8 h-8 rounded-full bg-slate-200 text-slate-800 flex items-center justify-center font-bold text-sm">
                                                    {{ $q->order_number }}
                                                </span>
                                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pertanyaan</span>
                                            </div>

                                            <!-- Question Text -->
                                            <div class="text-base font-bold text-slate-900 leading-snug">
                                                {{ $q->question_text }}
                                            </div>

                                            <!-- Options -->
                                            <div class="grid grid-cols-1 gap-2.5">
                                                @foreach(['A', 'B', 'C', 'D'] as $opt)
                                                    @php
                                                        $optKey = 'option_' . strtolower($opt);
                                                        $savedVal = $savedAnswers[$q->id] ?? null;
                                                        $isChecked = ($savedVal === $opt);
                                                    @endphp
                                                    <label id="label-q{{ $q->id }}-{{ $opt }}" 
                                                           class="option-card flex items-center p-3 border rounded-xl cursor-pointer transition-all duration-150 select-none text-sm
                                                                  {{ $isChecked ? 'border-blue-900 bg-blue-50/70 font-semibold text-blue-900 shadow-sm' : 'border-slate-200 hover:border-slate-350 hover:bg-slate-50/50 text-slate-700' }}">
                                                        <input type="radio" 
                                                               name="answers[{{ $q->id }}]" 
                                                               value="{{ $opt }}" 
                                                               onchange="selectOption({{ $q->id }}, '{{ $opt }}', {{ $q->order_number }}, {{ $passage->id }})"
                                                               class="sr-only" 
                                                               {{ $isChecked ? 'checked' : '' }}>
                                                        <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full font-bold text-xs mr-3 transition-all duration-150
                                                                     {{ $isChecked ? 'bg-blue-900 text-white shadow-sm' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
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
                <div class="xl:col-span-1">
                    <div class="bg-white rounded-xl border border-slate-200 p-5 shadow-sm sticky top-24 space-y-5">
                        <div class="border-b border-slate-100 pb-3 flex justify-between items-center">
                            <h4 class="font-bold text-slate-800 text-sm">Navigasi Soal</h4>
                            <span class="px-2 py-0.5 bg-blue-50 text-blue-900 rounded-md font-bold text-2xs uppercase">READING</span>
                        </div>
                        
                        <!-- Quick Passage Tabs -->
                        <div class="grid grid-cols-2 gap-2 text-xs font-semibold text-center">
                            @foreach($passages as $pIndex => $passage)
                                <button type="button" id="tab-p-{{ $passage->id }}" onclick="switchPassage({{ $passage->id }})"
                                        class="py-1.5 px-2 rounded-lg border transition-all duration-150
                                               {{ $pIndex === 0 ? 'bg-blue-900 text-white border-blue-900' : 'bg-slate-50 text-slate-600 border-slate-200 hover:bg-slate-100' }}">
                                    Bacaan {{ $pIndex + 1 }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Question Grid (31 - 65) -->
                        <div class="grid grid-cols-4 sm:grid-cols-7 xl:grid-cols-4 gap-2 pt-2">
                            @foreach($questions as $q)
                                @php
                                    $savedVal = $savedAnswers[$q->id] ?? null;
                                    $isAnswered = !is_null($savedVal);
                                @endphp
                                <button type="button" id="grid-btn-{{ $q->order_number }}" onclick="focusQuestion({{ $q->id }}, {{ $q->order_number }}, {{ $q->passage_id }})"
                                        class="w-full h-10 flex items-center justify-center font-bold text-sm rounded-lg transition-all duration-150 border-2
                                               {{ $isAnswered ? 'bg-blue-900 text-white border-blue-900' : 'bg-white text-slate-500 border-slate-200 hover:border-slate-350' }}">
                                    {{ $q->order_number }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Legend -->
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
                btn.classList.remove('bg-blue-900', 'text-white', 'border-blue-900');
                btn.classList.add('bg-slate-55', 'bg-slate-50', 'text-slate-600', 'border-slate-200');
            });

            const activeTab = document.getElementById(`tab-p-${passageId}`);
            if (activeTab) {
                activeTab.classList.remove('bg-slate-55', 'bg-slate-50', 'text-slate-600', 'border-slate-200');
                activeTab.classList.add('bg-blue-900', 'text-white', 'border-blue-900');
            }

            activePassageId = passageId;
        }

        function focusQuestion(questionId, orderNumber, passageId) {
            // Switch passage if different
            if (activePassageId !== passageId) {
                switchPassage(passageId);
            }

            // Remove active highlight from old grid button
            const oldGridBtn = document.getElementById(`grid-btn-${activeQuestionNum}`);
            if (oldGridBtn) {
                oldGridBtn.classList.remove('border-amber-400');
                if (answeredState[getQuestionIdByNum(activeQuestionNum)]) {
                    oldGridBtn.classList.add('border-blue-900');
                } else {
                    oldGridBtn.classList.add('border-slate-200');
                }
            }

            // Set new active number
            activeQuestionNum = orderNumber;

            // Apply active highlight to new grid button
            const newGridBtn = document.getElementById(`grid-btn-${activeQuestionNum}`);
            if (newGridBtn) {
                newGridBtn.classList.remove('border-blue-900', 'border-slate-200');
                newGridBtn.classList.add('border-amber-400');
            }

            // Highlight and scroll to the target question card
            const qCard = document.getElementById(`question-card-${questionId}`);
            if (qCard) {
                // Remove highlight from all other cards
                document.querySelectorAll('.question-card').forEach(card => {
                    card.classList.remove('border-blue-300', 'bg-blue-50/10');
                    card.classList.add('border-slate-100');
                });

                // Add active highlight to target card
                qCard.classList.remove('border-slate-100');
                qCard.classList.add('border-blue-300', 'bg-blue-50/10');

                // Scroll the parent container to show this card
                qCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
                    label.classList.remove('border-blue-900', 'bg-blue-50/70', 'font-semibold', 'text-blue-900', 'shadow-sm');
                    label.classList.add('border-slate-200', 'hover:border-slate-350', 'hover:bg-slate-50/50', 'text-slate-700');
                    
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
                activeLabel.classList.remove('border-slate-200', 'hover:border-slate-355', 'hover:bg-slate-50/50', 'text-slate-700');
                
                const span = activeLabel.querySelector('span:first-child');
                if (span) {
                    span.classList.add('bg-blue-900', 'text-white', 'shadow-sm');
                    span.classList.remove('bg-slate-100', 'text-slate-600', 'border', 'border-slate-200');
                }
            }

            // Update answered state
            answeredState[questionId] = true;

            // Highlight in grid sidebar
            const gridBtn = document.getElementById(`grid-btn-${orderNumber}`);
            if (gridBtn) {
                gridBtn.classList.remove('bg-white', 'text-slate-500', 'border-slate-200');
                gridBtn.classList.add('bg-blue-900', 'text-white', 'border-blue-900');
            }

            updateProgressBar();
            focusQuestion(questionId, orderNumber, passageId);
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
