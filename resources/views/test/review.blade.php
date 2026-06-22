<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Review Jawaban Tes') }}
            </h2>
            <a href="{{ route('test.result', $session->id) }}" class="inline-flex items-center px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Hasil</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 select-text">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Legend Info Card -->
            <div class="bg-white rounded-xl border border-slate-100 p-5 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0 text-sm">
                <span class="font-bold text-slate-800">Keterangan Penilaian:</span>
                <div class="flex flex-wrap gap-4">
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-emerald-100 border border-emerald-300 block"></span>
                        <span class="text-slate-600 font-medium">Benar</span>
                    </span>
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-red-100 border border-red-300 block"></span>
                        <span class="text-slate-600 font-medium">Salah</span>
                    </span>
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-slate-100 border border-slate-300 block"></span>
                        <span class="text-slate-600 font-medium">Tidak Menjawab</span>
                    </span>
                </div>
            </div>

            <!-- Questions Review List -->
            @php
                $currentSection = '';
                $currentPassageId = null;
            @endphp

            @foreach($questions as $index => $q)
                @php
                    $answer = $q->answers->first(); // retrieve answer for this session
                    $selected = $answer ? $answer->selected_answer : null;
                    $isCorrect = $answer ? $answer->is_correct : false;
                    $hasAnswered = !is_null($selected);
                @endphp

                <!-- Section Title Header (Listening / Structure / Reading) -->
                @if($currentSection !== $q->section)
                    @php
                        $currentSection = $q->section;
                        $sectionLabels = [
                            'listening' => 'SECTION 1: LISTENING COMPREHENSION',
                            'structure' => 'SECTION 2: STRUCTURE & WRITTEN EXPRESSION',
                            'reading' => 'SECTION 3: READING COMPREHENSION'
                        ];
                    @endphp
                    <div class="pt-6 pb-2 first:pt-0">
                        <h3 class="text-lg font-extrabold text-blue-900 border-b-2 border-blue-900 pb-2 uppercase tracking-wide">
                            {{ $sectionLabels[$q->section] ?? $q->section }}
                        </h3>
                    </div>
                @endif

                <!-- Reading Passage Display (Only show once when passage changes) -->
                @if($q->section === 'reading' && $q->passage_id !== $currentPassageId)
                    @php
                        $currentPassageId = $q->passage_id;
                    @endphp
                    @if($q->passage)
                        <div class="bg-slate-50 border border-slate-200 rounded-xl p-6 space-y-3 font-serif text-slate-800 shadow-inner">
                            <span class="px-2 py-0.5 bg-blue-900 text-white text-3xs font-bold rounded uppercase tracking-wider">Teks Bacaan (Passage)</span>
                            <h4 class="font-bold text-center text-slate-900 text-base">{{ $q->passage->title }}</h4>
                            <p class="whitespace-pre-line text-sm leading-relaxed">{{ $q->passage->content }}</p>
                        </div>
                    @endif
                @endif

                <!-- Question Card -->
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm">
                    <!-- Card Header -->
                    <div class="bg-slate-50 px-5 py-3.5 border-b border-slate-100 flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-full bg-slate-200 text-slate-800 flex items-center justify-center font-bold text-sm">
                                {{ $q->order_number }}
                            </span>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                                {{ str_replace('_', ' ', $q->sub_type) }}
                            </span>
                        </div>

                        <!-- Status Badge -->
                        @if(!$hasAnswered)
                            <span class="px-2.5 py-0.5 bg-slate-100 text-slate-600 border border-slate-200 rounded text-xs font-bold">
                                Tidak Menjawab
                            </span>
                        @elseif($isCorrect)
                            <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-800 border border-emerald-200 rounded text-xs font-bold">
                                Benar
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 bg-red-100 text-red-800 border border-red-200 rounded text-xs font-bold">
                                Salah
                            </span>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-4">
                        <!-- Transcript if listening -->
                        @if($q->transcript)
                            <div class="bg-slate-50 p-4 rounded-lg border border-slate-100 text-sm text-slate-700 whitespace-pre-line leading-relaxed italic">
                                {!! nl2br(e($q->transcript)) !!}
                            </div>
                        @endif

                        <!-- Question Text -->
                        <div class="font-bold text-slate-900 leading-snug">
                            @if($q->sub_type === 'written_expression')
                                {!! preg_replace('/\[([^\]]+)\] \(([A-D])\)/', '<span class="underline decoration-slate-800 decoration-2 underline-offset-4 relative font-semibold inline-block px-1">$1<sup class="text-2xs text-blue-900 font-extrabold ml-0.5">$2</sup></span>', $q->question_text) !!}
                            @else
                                {!! str_replace('___', '<span class="border-b border-slate-800 inline-block w-12 mx-1"></span>', e($q->question_text)) !!}
                            @endif
                        </div>

                        <!-- Options Display -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-1 text-sm">
                            @foreach(['A', 'B', 'C', 'D'] as $opt)
                                @php
                                    $optKey = 'option_' . strtolower($opt);
                                    
                                    // styling flags
                                    $isUserChoice = ($selected === $opt);
                                    $isCorrectAnswer = ($q->correct_answer === $opt);
                                    
                                    $cardStyle = 'border-slate-100 bg-slate-50/50 text-slate-700';
                                    $badgeStyle = 'bg-slate-200 text-slate-700';

                                    if ($isCorrectAnswer) {
                                        // Highlight correct answer in green
                                        $cardStyle = 'border-emerald-300 bg-emerald-50 text-emerald-950 font-semibold';
                                        $badgeStyle = 'bg-emerald-600 text-white';
                                    } elseif ($isUserChoice && !$isCorrect) {
                                        // Highlight wrong user choice in red
                                        $cardStyle = 'border-red-300 bg-red-50 text-red-950';
                                        $badgeStyle = 'bg-red-600 text-white';
                                    }
                                @endphp

                                <div class="flex items-center p-3 border rounded-xl {{ $cardStyle }}">
                                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-full font-bold text-xs mr-3 {{ $badgeStyle }}">
                                        {{ $opt }}
                                    </span>
                                    <span class="leading-relaxed">
                                        {{ $q->$optKey }}
                                        @if($isUserChoice)
                                            <span class="text-2xs font-bold uppercase ml-2 px-1.5 py-0.5 rounded bg-slate-800/10 text-slate-800">Pilihan Anda</span>
                                        @endif
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Footer Action Button -->
            <div class="flex justify-center pt-4">
                <a href="{{ route('test.result', $session->id) }}" class="px-8 py-3 bg-blue-900 hover:bg-blue-800 text-white font-bold rounded-xl shadow-md transition duration-150">
                    Selesai Review
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
