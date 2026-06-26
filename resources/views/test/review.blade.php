<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center font-body">
            <h2 class="font-bold text-xl text-ink leading-tight">
                {{ __('Review Jawaban Tes') }}
            </h2>
            <a href="{{ route('test.result', $session->id) }}" class="inline-flex items-center px-4 py-2 bg-green hover:bg-green-dark text-white rounded-md text-sm font-semibold transition-colors shadow-sm cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>Kembali ke Hasil</span>
            </a>
        </div>
    </x-slot>

    <div class="py-12 select-text font-body">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Legend Info Card -->
            <div class="bg-canvas rounded-lg border border-hairline p-5 shadow-card flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0 text-sm">
                <span class="font-bold text-ink">Keterangan Penilaian:</span>
                <div class="flex flex-wrap gap-4 font-semibold text-xs uppercase tracking-wider">
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-green-light border border-green/30 block"></span>
                        <span class="text-green-dark font-semibold">Benar</span>
                    </span>
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-red-light border border-red/30 block"></span>
                        <span class="text-red font-semibold">Salah</span>
                    </span>
                    <span class="flex items-center space-x-1.5">
                        <span class="w-3.5 h-3.5 rounded bg-surface border border-hairline block"></span>
                        <span class="text-muted font-semibold">Tidak Menjawab</span>
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
                        <h3 class="text-lg font-bold text-green-dark border-b-2 border-green pb-2 uppercase tracking-wide">
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
                        <div class="bg-canvas border border-hairline rounded-lg p-6 space-y-3 text-ink shadow-card font-body font-normal">
                            <span class="px-2.5 py-0.5 bg-green text-white text-[10px] font-bold rounded-pill uppercase tracking-wider font-body">Teks Bacaan (Passage)</span>
                            <h4 class="font-bold text-center text-green-dark text-base">{{ $q->passage->title }}</h4>
                            <p class="whitespace-pre-line text-sm leading-relaxed">{{ $q->passage->content }}</p>
                        </div>
                    @endif
                @endif

                <!-- Question Card -->
                <div class="bg-canvas rounded-lg border border-hairline overflow-hidden shadow-card font-body">
                    <!-- Card Header -->
                    <div class="bg-surface px-5 py-3.5 border-b border-hairline flex justify-between items-center">
                        <div class="flex items-center space-x-2">
                            <span class="w-7 h-7 rounded-pill bg-surface text-green-dark flex items-center justify-center font-bold text-sm">
                                {{ $q->order_number }}
                            </span>
                            <span class="text-xs font-semibold text-muted uppercase tracking-wider">
                                {{ str_replace('_', ' ', $q->sub_type) }}
                            </span>
                        </div>

                        <!-- Status Badge -->
                        @if(!$hasAnswered)
                            <span class="px-2.5 py-0.5 bg-surface text-muted border border-hairline rounded-pill text-xs font-semibold uppercase tracking-wider">
                                Tidak Menjawab
                            </span>
                        @elseif($isCorrect)
                            <span class="px-2.5 py-0.5 bg-green-light text-green-dark rounded-pill text-xs font-semibold uppercase tracking-wider border border-green/20">
                                Benar
                            </span>
                        @else
                            <span class="px-2.5 py-0.5 bg-red-light text-red rounded-pill text-xs font-semibold uppercase tracking-wider border border-red/20">
                                Salah
                            </span>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-5 space-y-4">
                        <!-- Transcript if listening -->
                        @if($q->transcript)
                            <div class="bg-surface p-4 rounded-md border border-hairline text-sm text-ink whitespace-pre-line leading-relaxed">
                                {!! nl2br(e($q->transcript)) !!}
                            </div>
                        @endif

                        <!-- Question Text -->
                        <div class="font-semibold text-ink leading-snug text-body-md font-body">
                            @if($q->sub_type === 'written_expression')
                                {!! preg_replace('/\[([^\]]+)\] \(([A-D])\)/', '<span class="underline decoration-green decoration-2 underline-offset-4 relative font-semibold inline-block px-1 bg-surface border border-hairline rounded-sm">$1<sup class="text-xs text-green-dark font-bold ml-0.5">$2</sup></span>', $q->question_text) !!}
                            @else
                                {!! str_replace('___', '<span class="border-b border-green inline-block w-12 mx-1"></span>', e($q->question_text)) !!}
                            @endif
                        </div>

                        <!-- Options Display -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 pt-1 text-sm font-body">
                            @foreach(['A', 'B', 'C', 'D'] as $opt)
                                @php
                                    $optKey = 'option_' . strtolower($opt);
                                    
                                    // styling flags
                                    $isUserChoice = ($selected === $opt);
                                    $isCorrectAnswer = ($q->correct_answer === $opt);
                                    
                                    $cardStyle = 'border-hairline bg-canvas text-ink';
                                    $badgeStyle = 'bg-surface text-muted border border-hairline';

                                    if ($isCorrectAnswer) {
                                        // Highlight correct answer in green
                                        $cardStyle = 'border-green bg-green-light text-green-dark font-semibold shadow-sm';
                                        $badgeStyle = 'bg-green text-white shadow-sm';
                                    } elseif ($isUserChoice && !$isCorrect) {
                                        // Highlight wrong user choice in red
                                        $cardStyle = 'border-red bg-red-light text-red font-semibold';
                                        $badgeStyle = 'bg-red text-white';
                                    }
                                @endphp

                                <div class="flex items-center p-3 border rounded-md {{ $cardStyle }}">
                                    <span class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-pill font-bold text-xs mr-3 {{ $badgeStyle }}">
                                        {{ $opt }}
                                    </span>
                                    <span class="leading-relaxed font-body">
                                        {{ $q->$optKey }}
                                        @if($isUserChoice)
                                            <span class="text-[10px] font-semibold uppercase tracking-wider ml-2 px-1.5 py-0.5 rounded bg-green/10 text-green-dark border border-green/10">Pilihan Anda</span>
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
                <a href="{{ route('test.result', $session->id) }}" class="px-8 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-md transition duration-120 cursor-pointer">
                    Selesai Review
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
