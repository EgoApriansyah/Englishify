<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('practice.index') }}" class="text-slate-500 hover:text-slate-800 transition-colors p-1 hover:bg-slate-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Dictation Practice') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="dictationPlayer()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- LEFT SIDE: Video Player & Instructions -->
                <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 shadow-xl p-5 md:p-6 space-y-6">
                    <!-- Title Header -->
                    <div class="space-y-1.5">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 bg-indigo-55/10 text-indigo-700 text-[10px] font-black rounded-full uppercase tracking-wider">
                                {{ $video->category }}
                            </span>
                            <span class="px-2 py-0.5 bg-rose-50 text-rose-700 text-[10px] font-black rounded-full uppercase tracking-wider">
                                {{ $video->difficulty }}
                            </span>
                        </div>
                        <h3 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $video->title }}</h3>
                    </div>

                    <!-- YouTube Video Embed Wrapper -->
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md">
                        <div id="youtube-player" class="w-full h-full"></div>
                    </div>

                    <!-- Help Box / Score Banner -->
                    <div x-show="checked" class="p-4 rounded-2xl border transition-all duration-300"
                         :class="scorePercentage >= 80 ? 'bg-emerald-50 border-emerald-200 text-emerald-950' : (scorePercentage >= 50 ? 'bg-amber-50 border-amber-200 text-amber-950' : 'bg-rose-50 border-rose-200 text-rose-950')"
                         style="display: none;">
                        <div class="flex items-center space-x-3">
                            <div class="p-2 rounded-xl" :class="scorePercentage >= 50 ? 'bg-emerald-100' : 'bg-rose-100'">
                                <span class="text-xl font-bold" x-text="scorePercentage >= 80 ? '🏆' : (scorePercentage >= 50 ? '👏' : '✍️')"></span>
                            </div>
                            <div>
                                <h4 class="font-extrabold text-sm" x-text="'Skor Latihan: ' + correctCount + ' / ' + totalBlanks + ' (' + scorePercentage + '%)'"></h4>
                                <p class="text-xs opacity-75 font-semibold mt-0.5" x-text="scorePercentage >= 80 ? 'Hebat! Pendengaran dan ejaan Anda sangat presisi.' : 'Terus berlatih untuk meningkatkan kepekaan dengar Anda!'"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Instructions Panel -->
                    <div class="p-4 bg-slate-50 border border-slate-200/60 rounded-2xl space-y-2">
                        <h4 class="font-extrabold text-slate-700 text-xs uppercase tracking-wider">Cara Berlatih Dictation:</h4>
                        <ol class="list-decimal list-inside text-[11px] text-slate-500 font-medium space-y-1">
                            <li>Klik tombol putar <span class="inline-flex p-0.5 bg-emerald-500 text-white rounded">🔊</span> di samping kalimat untuk mendengarkan potongan video kalimat tersebut.</li>
                            <li>Kolom input kata akan aktif saat potongan kalimat tersebut diputar.</li>
                            <li>Ketik kata yang hilang berdasarkan apa yang Anda dengar. Gunakan huruf petunjuk awal sebagai panduan.</li>
                            <li>Setelah semua kolom terisi, klik **Periksa Latihan** di bagian bawah untuk melihat skor dan koreksi.</li>
                        </ol>
                    </div>
                </div>

                <!-- RIGHT SIDE: Scrollable Dictation List -->
                <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden flex flex-col h-[620px]">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h4 class="font-extrabold text-slate-800 text-sm tracking-wide uppercase">✏️ Lengkapi Kata Rumpang</h4>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider" x-text="filledBlanksCount + ' / ' + totalBlanks + ' Kolom Terisi'"></span>
                    </div>

                    <!-- Dictation Sentences List -->
                    <div class="p-5 overflow-y-auto space-y-4 flex-grow scroll-smooth" id="dictation-container">
                        @foreach($video->transcript_data as $index => $sentence)
                            @php
                                $totalSentenceBlanks = count($sentence['blanks']);
                            @endphp
                            <div id="sentence-card-{{ $sentence['id'] }}"
                                 class="p-4 rounded-2xl border transition-all duration-300 text-left relative"
                                 :class="activeSentenceId === {{ $sentence['id'] }} 
                                        ? 'bg-slate-50 border-indigo-400 shadow-sm shadow-indigo-100/50 scale-[1.01]' 
                                        : 'bg-white border-slate-100 hover:border-slate-200'">
                                
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="w-6 h-6 rounded-lg bg-indigo-50 border border-indigo-100 text-indigo-700 font-black flex items-center justify-center text-[10px]">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider"
                                              x-text="getSentenceBlanksFilled({{ $sentence['id'] }}, {{ $totalSentenceBlanks }})"></span>
                                    </div>

                                    <!-- Replay Audio Button -->
                                    <button @click="playSentence({{ json_encode($sentence) }})"
                                            class="p-1.5 bg-emerald-50 hover:bg-emerald-500 hover:text-white border border-emerald-100 hover:border-emerald-500 text-emerald-700 rounded-lg shadow-sm transition-all cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                          <path d="M10 3.75a2 2 0 1 0-4 0v3.5a2 2 0 1 0 4 0v-3.5ZM5.25 10a.75.75 0 0 1 .75-.75h8a.75.75 0 0 1 0 1.5H6a.75.75 0 0 1-.75-.75ZM3 13.75a.75.75 0 0 1 .75-.75h12.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" />
                                          <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-9-3.75a3 3 0 0 0-3 3v.25a.75.75 0 0 0 1.5 0V9.25a1.5 1.5 0 0 1 3 0v1a.75.75 0 0 0 1.5 0v-1a3 3 0 0 0-3-3Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Sentence with input blanks -->
                                <p class="text-sm leading-loose tracking-wide font-semibold text-slate-800">
                                    @php
                                        $words = explode(' ', $sentence['text']);
                                    @endphp
                                    @foreach($words as $wIndex => $word)
                                        @php
                                            $isBlanked = false;
                                            $blankDetail = null;
                                            foreach($sentence['blanks'] as $b) {
                                                if($b['word_index'] === $wIndex) {
                                                    $isBlanked = true;
                                                    $blankDetail = $b;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        @if($isBlanked)
                                            @php
                                                // strip punctuation
                                                $cleanWord = preg_replace('/[.,\/#!$%\^&\*;:{}=\-_`~()?]/', '', $word);
                                                $punctuation = str_replace($cleanWord, '', $word);
                                            @endphp
                                            <span class="inline-block relative mx-0.5">
                                                <input type="text" 
                                                       x-model="answers['{{ $sentence['id'] }}']['{{ $wIndex }}']"
                                                       :disabled="!isUnlocked({{ $sentence['id'] }})"
                                                       placeholder="{{ $blankDetail['hint'] }}..."
                                                       class="w-16 text-center border-b-2 bg-slate-50 focus:bg-white text-xs font-black py-0 px-1 rounded transition-all focus:outline-none disabled:opacity-55 disabled:cursor-not-allowed"
                                                       :class="checked 
                                                              ? (isCorrect('{{ $sentence['id'] }}', '{{ $wIndex }}', '{{ strtolower($cleanWord) }}') 
                                                                ? 'border-emerald-500 text-emerald-700 bg-emerald-50/50' 
                                                                : 'border-rose-400 text-rose-700 bg-rose-50/50') 
                                                              : (activeSentenceId === {{ $sentence['id'] }} ? 'border-indigo-400 focus:border-indigo-600' : 'border-slate-200')"
                                                       maxlength="{{ strlen($cleanWord) }}">
                                                
                                                <!-- Punctuation outside input -->
                                                @if($punctuation)
                                                    <span class="text-slate-700 font-bold select-none">{{ $punctuation }}</span>
                                                @endif

                                                <!-- Correct answer bubble on hover after checked -->
                                                <template x-if="checked && !isCorrect('{{ $sentence['id'] }}', '{{ $wIndex }}', '{{ strtolower($cleanWord) }}')">
                                                    <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-1 px-1.5 py-0.5 bg-slate-800 text-white text-[9px] font-black rounded shadow opacity-90 whitespace-nowrap z-20"
                                                          x-text="'{{ $cleanWord }}'"></span>
                                                </template>
                                            </span>
                                        @else
                                            <span class="text-slate-700 font-medium">{{ $word }}</span>
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <!-- Bottom Action Panel -->
                    <div class="p-4 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row gap-3 items-center justify-between">
                        <!-- Navigation controls -->
                        <div class="flex items-center space-x-2">
                            <button @click="navigateSentence('prev')" 
                                    class="p-2 bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 rounded-xl text-xs font-black cursor-pointer flex items-center gap-1 shadow-sm">
                                ◀️ Prev
                            </button>
                            <button @click="replayCurrentSentence()" 
                                    class="p-2 bg-indigo-50 border border-indigo-150 hover:bg-indigo-100 text-indigo-700 rounded-xl text-xs font-black cursor-pointer flex items-center gap-1 shadow-sm">
                                🔊 Putar Ulang
                            </button>
                            <button @click="navigateSentence('next')" 
                                    class="p-2 bg-white border border-slate-200 hover:bg-slate-100 text-slate-700 rounded-xl text-xs font-black cursor-pointer flex items-center gap-1 shadow-sm">
                                Next ▶️
                            </button>
                        </div>

                        <!-- Check Action Button -->
                        <button @click="checkAnswers()" 
                                class="w-full sm:w-auto px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs rounded-xl shadow-md shadow-emerald-100 hover:shadow-lg transition-all duration-200 flex items-center justify-center gap-1.5 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            Periksa Latihan
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- YouTube Iframe API Script -->
    <script>
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        window.player = null;

        function onYouTubeIframeAPIReady() {
            window.dispatchEvent(new CustomEvent('youtube-api-ready'));
        }
    </script>

    <!-- AlpineJS Dictation Logic -->
    <script>
        function dictationPlayer() {
            return {
                sentences: @json($video->transcript_data),
                youtubeId: '{{ $video->youtube_id }}',
                isPlaying: false,
                currentTime: 0,
                activeSentenceId: null,
                unlockedSentences: {}, // tracks which sentence inputs are unlocked
                answers: {}, // tracks user answers: { sentenceId: { wordIndex: '' } }
                totalBlanks: 0,
                filledBlanksCount: 0,
                checked: false,
                correctCount: 0,
                scorePercentage: 0,
                timer: null,

                init() {
                    // Initialize answers state and total blanks count
                    this.sentences.forEach(s => {
                        this.answers[s.id] = {};
                        s.blanks.forEach(b => {
                            this.answers[s.id][b.word_index] = '';
                            this.totalBlanks++;
                        });
                    });

                    // Set first sentence active
                    if (this.sentences.length > 0) {
                        this.activeSentenceId = this.sentences[0].id;
                        this.unlockedSentences[this.activeSentenceId] = true;
                    }

                    if (window.YT && window.YT.Player) {
                        this.initPlayer();
                    } else {
                        window.addEventListener('youtube-api-ready', () => {
                            this.initPlayer();
                        });
                    }

                    // Watch answers to count filled blanks
                    this.$watch('answers', () => {
                        this.countFilledBlanks();
                    }, { deep: true });
                },

                initPlayer() {
                    window.player = new YT.Player('youtube-player', {
                        videoId: this.youtubeId,
                        playerVars: {
                            playsinline: 1,
                            controls: 1,
                            disablekb: 1,
                            fs: 0,
                            rel: 0,
                            showinfo: 0,
                            modestbranding: 1
                        },
                        events: {
                            onReady: () => {
                                this.startPolling();
                            },
                            onStateChange: (event) => {
                                if (event.data === YT.PlayerState.PLAYING) {
                                    this.isPlaying = true;
                                } else {
                                    this.isPlaying = false;
                                }
                            }
                        }
                    });
                },

                startPolling() {
                    this.timer = setInterval(() => {
                        if (window.player && this.isPlaying) {
                            this.currentTime = window.player.getCurrentTime();
                            this.syncActiveSentence();
                        }
                    }, 200);
                },

                syncActiveSentence() {
                    // Loop through sentences to set the active one based on playhead
                    let found = null;
                    for (let s of this.sentences) {
                        if (this.currentTime >= s.start && this.currentTime <= s.end) {
                            found = s;
                            break;
                        }
                    }

                    if (found && this.activeSentenceId !== found.id) {
                        this.activeSentenceId = found.id;
                        this.unlockedSentences[found.id] = true;

                        // Scroll elements into view
                        const cardEl = document.getElementById('sentence-card-' + found.id);
                        const container = document.getElementById('dictation-container');
                        if (cardEl && container) {
                            container.scrollTo({
                                top: cardEl.offsetTop - container.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    }
                },

                isUnlocked(sentenceId) {
                    return !!this.unlockedSentences[sentenceId];
                },

                playSentence(sentence) {
                    if (!window.player) return;
                    window.player.seekTo(sentence.start, true);
                    this.currentTime = sentence.start;
                    this.activeSentenceId = sentence.id;
                    this.unlockedSentences[sentence.id] = true;
                    
                    window.player.playVideo();
                    this.isPlaying = true;
                    
                    // Stop video when it hits the end of this sentence
                    let stopCheck = setInterval(() => {
                        if (window.player) {
                            let curr = window.player.getCurrentTime();
                            if (curr >= sentence.end || curr < sentence.start - 0.5) {
                                window.player.pauseVideo();
                                clearInterval(stopCheck);
                            }
                        } else {
                            clearInterval(stopCheck);
                        }
                    }, 100);
                },

                replayCurrentSentence() {
                    let active = this.sentences.find(s => s.id === this.activeSentenceId);
                    if (active) {
                        this.playSentence(active);
                    }
                },

                navigateSentence(direction) {
                    let currIndex = this.sentences.findIndex(s => s.id === this.activeSentenceId);
                    if (currIndex !== -1) {
                        let nextIndex = direction === 'next' ? currIndex + 1 : currIndex - 1;
                        if (nextIndex >= 0 && nextIndex < this.sentences.length) {
                            let nextSentence = this.sentences[nextIndex];
                            this.playSentence(nextSentence);
                        }
                    }
                },

                getSentenceBlanksFilled(sentenceId, totalBlanks) {
                    let filled = 0;
                    if (this.answers[sentenceId]) {
                        Object.values(this.answers[sentenceId]).forEach(val => {
                            if (val.trim() !== '') filled++;
                        });
                    }
                    return filled + ' / ' + totalBlanks + ' Terisi';
                },

                countFilledBlanks() {
                    let filled = 0;
                    Object.values(this.answers).forEach(sentenceAns => {
                        Object.values(sentenceAns).forEach(val => {
                            if (val.trim() !== '') filled++;
                        });
                    });
                    this.filledBlanksCount = filled;
                },

                isCorrect(sentenceId, wIndex, targetCleanWord) {
                    if (!this.answers[sentenceId] || !this.answers[sentenceId][wIndex]) return false;
                    let answer = this.answers[sentenceId][wIndex].trim().toLowerCase();
                    return answer === targetCleanWord;
                },

                checkAnswers() {
                    this.correctCount = 0;
                    this.sentences.forEach(s => {
                        s.blanks.forEach(b => {
                            let words = s.text.split(' ');
                            let rawWord = words[b.word_index];
                            let cleanWord = rawWord.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()?]/g, '').toLowerCase();
                            
                            if (this.isCorrect(s.id, b.word_index, cleanWord)) {
                                this.correctCount++;
                            }
                        });
                    });

                    this.scorePercentage = Math.round((this.correctCount / this.totalBlanks) * 100);
                    this.checked = true;
                },

                formatTime(seconds) {
                    if (isNaN(seconds)) return '00:00';
                    let mins = Math.floor(seconds / 60);
                    let secs = Math.floor(seconds % 60);
                    return (mins < 10 ? '0' : '') + mins + ':' + (secs < 10 ? '0' : '') + secs;
                },

                destroy() {
                    if (this.timer) {
                        clearInterval(this.timer);
                    }
                }
            }
        }
    </script>
</x-app-layout>
