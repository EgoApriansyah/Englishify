<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-3">
            <a href="{{ route('practice.index') }}" class="text-slate-500 hover:text-slate-800 transition-colors p-1 hover:bg-slate-100 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Shadowing Practice') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6" x-data="shadowingPlayer()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
                
                <!-- LEFT SIDE: Video Player & Custom Controls -->
                <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 shadow-xl p-5 md:p-6 space-y-6">
                    <!-- Title Header -->
                    <div class="space-y-1.5">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 bg-indigo-55/10 text-indigo-700 text-[10px] font-black rounded-full uppercase tracking-wider">
                                {{ $video->category }}
                            </span>
                            <span class="px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[10px] font-black rounded-full uppercase tracking-wider">
                                {{ $video->difficulty }}
                            </span>
                        </div>
                        <h3 class="font-extrabold text-slate-800 text-lg leading-tight">{{ $video->title }}</h3>
                    </div>

                    <!-- YouTube Video Embed Wrapper -->
                    <div class="relative w-full aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shadow-md">
                        <div id="youtube-player" class="w-full h-full"></div>
                    </div>

                    <!-- Custom Controller Dashboard -->
                    <div class="p-4 bg-slate-50 border border-slate-200/60 rounded-2xl space-y-4">
                        <!-- Progress Slider -->
                        <div class="space-y-1">
                            <input type="range" min="0" :max="duration" step="0.1" x-model="currentTime"
                                   @input="seekVideo(currentTime)"
                                   class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-indigo-600 focus:outline-none">
                            <div class="flex justify-between text-[10px] text-slate-400 font-bold">
                                <span x-text="formatTime(currentTime)">00:00</span>
                                <span x-text="formatTime(duration)">00:00</span>
                            </div>
                        </div>

                        <!-- Controls Panel -->
                        <div class="flex items-center justify-between">
                            <!-- Left: Loop Toggle -->
                            <div class="flex items-center space-x-2">
                                <button @click="loopSentence = !loopSentence"
                                        class="p-2 border rounded-xl font-bold text-xs flex items-center gap-1 cursor-pointer transition-all duration-200"
                                        :class="loopSentence ? 'bg-indigo-600 text-white border-indigo-600 shadow-sm shadow-indigo-100' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.656 48.656 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                    </svg>
                                    <span class="hidden sm:inline">Ulang Kalimat</span>
                                </button>
                                
                                <button @click="autoScroll = !autoScroll"
                                        class="p-2 border rounded-xl font-bold text-xs flex items-center gap-1 cursor-pointer transition-all duration-200"
                                        :class="autoScroll ? 'bg-indigo-650/10 text-indigo-700 border-indigo-200' : 'bg-white text-slate-500 border-slate-200 hover:bg-slate-50'">
                                    <span>Scroll Otomatis</span>
                                </button>
                            </div>

                            <!-- Center: Playback Control -->
                            <div class="flex items-center space-x-3">
                                <!-- Rewind 5s -->
                                <button @click="skipBackward()" class="p-2.5 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl text-slate-650 shadow-sm cursor-pointer transition-transform duration-100 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                    </svg>
                                </button>

                                <!-- Play/Pause -->
                                <button @click="togglePlay()" class="p-3.5 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 shadow-md shadow-indigo-200 cursor-pointer transition-transform duration-100 active:scale-95">
                                    <template x-if="isPlaying">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                          <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
                                        </svg>
                                    </template>
                                    <template x-if="!isPlaying">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                          <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                        </svg>
                                    </template>
                                </button>

                                <!-- Forward 5s -->
                                <button @click="skipForward()" class="p-2.5 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl text-slate-650 shadow-sm cursor-pointer transition-transform duration-100 active:scale-95">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Right: Speed Selector -->
                            <div>
                                <select x-model="playbackRate" @change="changeSpeed(playbackRate)" class="text-xs font-extrabold text-slate-600 bg-white border border-slate-200 rounded-xl px-2 py-1.5 focus:outline-none focus:ring-1 focus:ring-indigo-500 cursor-pointer">
                                    <option value="0.75">0.75x</option>
                                    <option value="1">1.00x</option>
                                    <option value="1.25">1.25x</option>
                                    <option value="1.5">1.50x</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE: Scrollable Transcript -->
                <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 shadow-xl overflow-hidden flex flex-col h-[580px]">
                    <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                        <h4 class="font-extrabold text-slate-800 text-sm tracking-wide uppercase">📝 Transkrip Sinkronisasi</h4>
                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Ketuk teks untuk melompat</span>
                    </div>

                    <!-- Transcript Container -->
                    <div class="p-5 overflow-y-auto space-y-3 flex-grow scroll-smooth" id="transcript-container">
                        <template x-for="(sentence, index) in sentences" :key="sentence.id">
                            <div :id="'sentence-' + sentence.id"
                                 @click="seekToSentence(sentence)"
                                 class="p-4 rounded-2xl border transition-all duration-300 cursor-pointer select-none text-left"
                                 :class="activeSentenceId === sentence.id 
                                        ? 'bg-emerald-50/70 border-emerald-450 text-emerald-950 shadow-sm shadow-emerald-100 scale-[1.01]' 
                                        : 'bg-white border-slate-100 hover:border-slate-300 text-slate-500 hover:text-slate-700'">
                                <div class="flex items-center justify-between mb-1">
                                    <span class="text-[9px] font-bold tracking-widest uppercase opacity-75" 
                                          :class="activeSentenceId === sentence.id ? 'text-emerald-700' : 'text-slate-400'"
                                          x-text="'Kalimat ' + (index + 1)"></span>
                                    <span class="text-[9px] font-bold"
                                          :class="activeSentenceId === sentence.id ? 'text-emerald-600' : 'text-slate-400'"
                                          x-text="formatTime(sentence.start)"></span>
                                </div>
                                <p class="text-sm font-bold leading-relaxed tracking-wide" x-text="sentence.text"></p>
                            </div>
                        </template>
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
            // Player will be initialized by the Alpine component
            window.dispatchEvent(new CustomEvent('youtube-api-ready'));
        }
    </script>

    <!-- AlpineJS Player Logic -->
    <script>
        function shadowingPlayer() {
            return {
                sentences: @json($video->transcript_data),
                youtubeId: '{{ $video->youtube_id }}',
                isPlaying: false,
                currentTime: 0,
                duration: 0,
                playbackRate: 1,
                activeSentenceId: null,
                loopSentence: false,
                autoScroll: true,
                timer: null,

                init() {
                    if (window.YT && window.YT.Player) {
                        this.initPlayer();
                    } else {
                        window.addEventListener('youtube-api-ready', () => {
                            this.initPlayer();
                        });
                    }
                },

                initPlayer() {
                    window.player = new YT.Player('youtube-player', {
                        videoId: this.youtubeId,
                        playerVars: {
                            playsinline: 1,
                            controls: 0, // hide player controls for custom UI
                            disablekb: 1,
                            fs: 0,
                            rel: 0,
                            showinfo: 0,
                            modestbranding: 1
                        },
                        events: {
                            onReady: (event) => {
                                this.duration = event.target.getDuration();
                                // Start timer to poll current time
                                this.startPolling();
                            },
                            onStateChange: (event) => {
                                if (event.data === YT.PlayerState.PLAYING) {
                                    this.isPlaying = true;
                                    this.duration = window.player.getDuration();
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
                            this.syncTranscript();
                        }
                    }, 100);
                },

                syncTranscript() {
                    let active = null;
                    for (let sentence of this.sentences) {
                        if (this.currentTime >= sentence.start && this.currentTime <= sentence.end) {
                            active = sentence;
                            break;
                        }
                    }

                    if (active) {
                        // Check if we need to loop the active sentence
                        if (this.loopSentence && this.activeSentenceId === active.id) {
                            if (this.currentTime >= active.end - 0.2) {
                                window.player.seekTo(active.start, true);
                                this.currentTime = active.start;
                                return;
                            }
                        }

                        if (this.activeSentenceId !== active.id) {
                            this.activeSentenceId = active.id;
                            
                            // Scroll to active sentence card
                            if (this.autoScroll) {
                                const activeEl = document.getElementById('sentence-' + active.id);
                                const container = document.getElementById('transcript-container');
                                if (activeEl && container) {
                                    container.scrollTo({
                                        top: activeEl.offsetTop - container.offsetTop - 80,
                                        behavior: 'smooth'
                                    });
                                }
                            }
                        }
                    } else {
                        // If loop is on, keep active sentence active or loop back
                        this.activeSentenceId = null;
                    }
                },

                togglePlay() {
                    if (!window.player) return;
                    if (this.isPlaying) {
                        window.player.pauseVideo();
                        this.isPlaying = false;
                    } else {
                        window.player.playVideo();
                        this.isPlaying = true;
                    }
                },

                seekVideo(seconds) {
                    if (!window.player) return;
                    window.player.seekTo(seconds, true);
                    this.syncTranscript();
                },

                seekToSentence(sentence) {
                    if (!window.player) return;
                    window.player.seekTo(sentence.start, true);
                    this.currentTime = sentence.start;
                    if (!this.isPlaying) {
                        window.player.playVideo();
                        this.isPlaying = true;
                    }
                    this.syncTranscript();
                },

                skipForward() {
                    if (!window.player) return;
                    let target = Math.min(this.currentTime + 5, this.duration);
                    this.seekVideo(target);
                },

                skipBackward() {
                    if (!window.player) return;
                    let target = Math.max(this.currentTime - 5, 0);
                    this.seekVideo(target);
                },

                changeSpeed(rate) {
                    if (!window.player) return;
                    window.player.setPlaybackRate(parseFloat(rate));
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
