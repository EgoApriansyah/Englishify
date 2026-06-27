<x-app-layout>

    <div class="py-12 bg-surface min-h-screen font-body select-text">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Sentence Builder Game Container with Alpine.js -->
            <div x-data="sentenceBuilderGame()" x-init="init()" class="bg-canvas rounded-lg border border-hairline shadow-card overflow-hidden relative" style="min-height: 520px;">
                
                <!-- BGM Audio -->
                <audio id="bgm-audio" src="{{ asset('assets/Overworld.mp3') }}" loop preload="auto"></audio>

                <!-- Confetti Canvas overlay -->
                <canvas id="confetti-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-20"></canvas>

                <!-- SECTION 1: CATEGORY SELECTION -->
                <div x-show="gameState === 'select_category'" class="p-8 md:p-12 space-y-8">
                    <div class="text-center space-y-3 font-body">
                        <div class="inline-flex p-3 bg-purple-light border border-hairline text-purple rounded-lg shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-purple animate-bounce">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-[32px] font-bold text-ink tracking-tight font-body">Sentence Builder</h3>
                        <p class="text-sm text-muted max-w-md mx-auto leading-relaxed font-body font-normal">
                            Susun kata-kata acak menjadi kalimat bahasa Inggris yang gramatikal secara tepat berdasarkan terjemahan atau petunjuk tata bahasa.
                        </p>
                    </div>

                    <!-- Category Cards Selection Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 font-body">
                        <!-- Category: Daily -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.02] transition duration-120 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-blue-light text-blue flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-ink text-base">Daily Conversations</h4>
                                <p class="text-xs text-muted leading-relaxed font-body font-normal">Kalimat santai sehari-hari untuk melatih kelancaran berkomunikasi.</p>
                                <div class="text-[10px] font-bold text-blue bg-blue-light py-1 px-2.5 rounded-pill inline-block uppercase tracking-wider font-body">
                                    High Score: <span x-text="highScores.daily || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('daily')" class="w-full bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold py-2.5 rounded-md transition duration-120 cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: TOEFL Structure -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.02] transition duration-120 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-purple-light text-purple flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-ink text-base">TOEFL Structure</h4>
                                <p class="text-xs text-muted leading-relaxed font-body font-normal">Penyusunan kalimat pasif, inversi, partisipel, dan konjungsi akademis.</p>
                                <div class="text-[10px] font-bold text-purple bg-purple-light py-1 px-2.5 rounded-pill inline-block uppercase tracking-wider font-body">
                                    High Score: <span x-text="highScores.toefl_structure || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('toefl_structure')" class="w-full bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold py-2.5 rounded-md transition duration-120 cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: Idioms -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.02] transition duration-120 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-green-light text-green-dark flex items-center justify-center shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.3 16.2 21 21m-6-3h6m-6 3h6m-9-3H3m12-6H3m12-6H3" />
                                    </svg>
                                </div>
                                <h4 class="font-bold text-ink text-base">Idiomatic Phrases</h4>
                                <p class="text-xs text-muted leading-relaxed font-body font-normal">Kuis menyusun ungkapan perumpamaan (*idiom*) bahasa Inggris populer.</p>
                                <div class="text-[10px] font-bold text-green-dark bg-green-light py-1 px-2.5 rounded-pill inline-block uppercase tracking-wider font-body">
                                    High Score: <span x-text="highScores.idioms || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('idioms')" class="w-full bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold py-2.5 rounded-md transition duration-120 cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: GAME PLAYING VIEW (Ink Dark Mode) -->
                <div x-show="gameState === 'playing'" class="fixed inset-0 w-screen h-screen bg-ink text-white z-50 p-6 md:p-8 flex flex-col justify-between" style="display: none;"
                     :class="feedbackState === 'wrong' ? 'animate-shake' : ''">
                    
                    <!-- Game Header Panel: Score, Combo, Progress -->
                    <div class="flex items-center justify-between gap-4 border-b border-gray-800 pb-4 font-body">
                        <div class="flex items-center gap-2">
                            <button @click="quitGame()" class="text-white hover:text-red p-2 rounded-md bg-gray-900 border border-gray-800 hover:bg-gray-800 transition duration-120 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            <span class="text-xs font-semibold text-purple uppercase tracking-widest bg-gray-900 border border-gray-800 px-3 py-2 rounded-md mr-1 font-body" x-text="getCategoryTitle()"></span>
                            
                            <!-- BGM Toggle Button -->
                            <button @click="toggleBgm()" class="p-2 rounded-md bg-gray-900 border border-gray-800 hover:bg-gray-800 text-white hover:text-purple transition duration-120 cursor-pointer flex items-center justify-center shrink-0 animate-none" title="Mute/Unmute Musik">
                                <template x-if="bgmEnabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </template>
                                <template x-if="!bgmEnabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-red">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </template>
                            </button>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Combo Indicator -->
                            <div x-show="combo > 0" class="flex items-center bg-red-light/10 border border-red/30 text-red font-bold text-xs px-3 py-1.5 rounded-md animate-pulse">
                                x<span x-text="combo"></span> Combo!
                            </div>
                            <!-- Score Display -->
                            <div class="px-4 py-1 bg-gray-900 border border-gray-800 rounded-md text-right">
                                <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Skor</span>
                                <span class="text-lg font-bold text-purple font-body" x-text="score"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Timer Bar (45 seconds total for sentences) -->
                    <div class="w-full bg-gray-900 border border-gray-800 h-3.5 rounded-pill overflow-hidden mt-3 relative">
                        <div class="h-full rounded-pill transition-all duration-100 linear"
                             :style="'width: ' + (timeLeft / 45 * 100) + '%'"
                             :class="timeLeft > 20 ? 'bg-purple' : (timeLeft > 10 ? 'bg-yellow' : 'bg-red animate-pulse')">
                        </div>
                    </div>

                    <!-- Sentence Progress Bubbles -->
                    <div class="flex justify-center items-center gap-1.5 mt-4">
                        <template x-for="idx in 5">
                            <span class="w-3.5 h-3.5 rounded-full border transition-all duration-300"
                                  :class="idx <= currentSentenceIndex ? 'bg-purple border-purple shadow-md shadow-purple/30' : 'bg-gray-900 border-gray-800'"></span>
                        </template>
                    </div>

                    <!-- Sentence Workspace: Dropzone and Scrambled Words -->
                    <div class="my-auto py-4 space-y-8 text-center font-body flex flex-col justify-center">
                        <!-- Translation Clue Box -->
                        <div class="max-w-2xl mx-auto bg-gray-900/60 border border-gray-800 p-5 rounded-lg backdrop-blur-sm shadow-md">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block mb-1">Clue / Terjemahan</span>
                            <p class="text-base text-white font-bold leading-relaxed" x-text="getSentenceClue()"></p>
                        </div>

                        <!-- Dropzone (User Answer words list) -->
                        <div class="flex justify-center flex-wrap gap-2.5 min-h-[60px] p-4 bg-black/40 border border-gray-800 rounded-lg max-w-3xl mx-auto w-full items-center">
                            <template x-for="(word, index) in userAnswer" :key="word.id">
                                <button @click="removeWord(index)" 
                                        class="px-4 py-2 bg-purple/10 border-2 border-purple text-purple-light hover:border-purple-light font-bold text-sm rounded-md flex items-center justify-center shadow-lg transform hover:-translate-y-0.5 active:translate-y-0 transition duration-120 cursor-pointer">
                                    <span x-text="word.text"></span>
                                </button>
                            </template>
                            <template x-if="userAnswer.length === 0">
                                <span class="text-sm text-gray-500 font-medium">Klik kata-kata di bawah untuk menyusun kalimat...</span>
                            </template>
                        </div>

                        <!-- Scrambled selector bubbles -->
                        <div class="flex justify-center flex-wrap gap-3 max-w-3xl mx-auto">
                            <template x-for="word in scrambledWords" :key="word.id">
                                <button @click="clickWord(word)" 
                                        :disabled="word.selected"
                                        :class="word.selected ? 'opacity-10 scale-95 border-ink bg-ink text-muted' : 'bg-gray-900/40 border border-gray-800 hover:border-purple hover:bg-gray-900/85 hover:-translate-y-0.5 text-white px-4 py-2.5 rounded-md flex items-center justify-center transition duration-120 select-none cursor-pointer shadow-md'"
                                        class="font-bold text-sm rounded-md flex items-center justify-center transition duration-120 select-none cursor-pointer shadow-md">
                                    <span x-text="word.text"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Action Controls Footer -->
                    <div class="flex items-center justify-between gap-4 border-t border-gray-800 pt-5 font-body">
                        <button @click="resetCurrentSentence()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md bg-gray-900 border border-gray-800 hover:bg-gray-800 text-white text-xs font-semibold transition duration-120 cursor-pointer shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>Reset Kalimat</span>
                        </button>

                        <div class="flex items-center gap-2">
                            <button @click="submitCheck()" class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-md bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold transition duration-120 cursor-pointer shadow-md">
                                <span>Periksa Kalimat</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>

                            <button @click="skipSentence()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-md bg-gray-900 border border-gray-800 hover:bg-gray-800 text-white text-xs font-semibold transition duration-120 cursor-pointer shadow-md">
                                <span>Skip</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: GAME OVER / SUMMARY -->
                <div x-show="gameState === 'game_over'" class="fixed inset-0 w-screen h-screen flex flex-col justify-center items-center bg-ink text-white z-50 p-6" style="display: none;">
                    <div class="space-y-3 text-center font-body">
                        <div class="inline-flex p-4 bg-purple/10 border border-purple/30 rounded-full text-purple shadow-md animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.622 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 3.75h6m-6 3h6m-6 3h6m-9 3h12" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-purple-400 tracking-tight font-body">Latihan Selesai!</h3>
                        <p class="text-sm text-muted font-medium max-w-sm mx-auto font-body font-normal">Luar biasa! Struktur kalimat Anda sudah semakin mantap.</p>
                    </div>

                    <!-- Final Score panel -->
                    <div class="max-w-xs w-full mx-auto bg-gray-900 border border-gray-800 rounded-lg p-6 grid grid-cols-2 gap-4 my-6 shadow-xl font-body">
                        <div class="border-r border-gray-800 text-center">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block font-body">Skor Akhir</span>
                            <span class="text-2xl font-bold text-purple-400 font-body" x-text="score"></span>
                        </div>
                        <div class="text-center">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block font-body">Max Combo</span>
                            <span class="text-2xl font-bold text-red font-body" x-text="maxCombo"></span>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-4 font-body">
                        <button @click="selectCategory(selectedCategory)" class="px-6 py-3.5 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-md shadow-lg transition duration-120 cursor-pointer border border-purple/20">
                            Main Lagi
                        </button>
                        <button @click="gameState = 'select_category'" class="px-6 py-3.5 bg-gray-900 hover:bg-gray-800 border border-gray-800 text-white font-semibold rounded-md transition duration-120 cursor-pointer">
                            Pilih Kategori Lain
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Sentence Builder Game Script -->
    <script>
        // Web Audio API Synthesized Sounds
        let audioCtx = null;
        function playSound(type) {
            try {
                if (!audioCtx) {
                    audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                }
                if (audioCtx.state === 'suspended') {
                    audioCtx.resume();
                }
                const osc = audioCtx.createOscillator();
                const gain = audioCtx.createGain();
                osc.connect(gain);
                gain.connect(audioCtx.destination);
                const now = audioCtx.currentTime;

                if (type === 'correct') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(523.25, now); // C5
                    osc.frequency.setValueAtTime(659.25, now + 0.08); // E5
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.22);
                    osc.start(now);
                    osc.stop(now + 0.22);
                } else if (type === 'wrong') {
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(130, now);
                    osc.frequency.linearRampToValueAtTime(70, now + 0.25);
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.25);
                    osc.start(now);
                    osc.stop(now + 0.25);
                } else if (type === 'tick') {
                    osc.type = 'triangle';
                    osc.frequency.setValueAtTime(1000, now);
                    gain.gain.setValueAtTime(0.15, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.04);
                    osc.start(now);
                    osc.stop(now + 0.04);
                } else if (type === 'win') {
                    const notes = [261.63, 329.63, 392.00, 523.25];
                    notes.forEach((freq, idx) => {
                        const oscN = audioCtx.createOscillator();
                        const gainN = audioCtx.createGain();
                        oscN.connect(gainN);
                        gainN.connect(audioCtx.destination);
                        oscN.type = 'sine';
                        oscN.frequency.setValueAtTime(freq, now + idx * 0.1);
                        gainN.gain.setValueAtTime(0.2, now + idx * 0.1);
                        gainN.gain.linearRampToValueAtTime(0, now + idx * 0.1 + 0.25);
                        oscN.start(now + idx * 0.1);
                        oscN.stop(now + idx * 0.1 + 0.25);
                    });
                }
            } catch (err) {
                console.error("Audio synthesiser error:", err);
            }
        }

        // Lightweight Confetti Particles Engine
        let confettiParticles = [];
        let confettiActive = false;
        let confettiCanvas, confettiCtx;

        function triggerConfetti() {
            confettiCanvas = document.getElementById('confetti-canvas');
            if (!confettiCanvas) return;
            confettiCtx = confettiCanvas.getContext('2d');
            confettiCanvas.width = confettiCanvas.parentElement.clientWidth;
            confettiCanvas.height = confettiCanvas.parentElement.clientHeight;
            confettiParticles = [];
            const colors = ['#8B5CF6', '#C084FC', '#2D6A4F', '#F4A261', '#E63946', '#1A3C2B'];
            for (let i = 0; i < 50; i++) {
                confettiParticles.push({
                    x: confettiCanvas.width / 2 + (Math.random() - 0.5) * 40,
                    y: confettiCanvas.height / 2 + (Math.random() - 0.5) * 20,
                    vx: (Math.random() - 0.5) * 6,
                    vy: (Math.random() - 1) * 8 - 2,
                    radius: Math.random() * 4 + 3,
                    color: colors[Math.floor(Math.random() * colors.length)],
                    rotation: Math.random() * 360,
                    rotationSpeed: (Math.random() - 0.5) * 8,
                    alpha: 1,
                    gravity: 0.25
                });
            }
            if (!confettiActive) {
                confettiActive = true;
                animateConfetti();
            }
        }

        function animateConfetti() {
            if (confettiParticles.length === 0) {
                confettiActive = false;
                confettiCtx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
                return;
            }
            requestAnimationFrame(animateConfetti);
            confettiCtx.clearRect(0, 0, confettiCanvas.width, confettiCanvas.height);
            for (let i = confettiParticles.length - 1; i >= 0; i--) {
                const p = confettiParticles[i];
                p.x += p.vx;
                p.y += p.vy;
                p.vy += p.gravity;
                p.rotation += p.rotationSpeed;
                p.alpha -= 0.015;
                if (p.alpha <= 0 || p.y > confettiCanvas.height) {
                    confettiParticles.splice(i, 1);
                    continue;
                }
                confettiCtx.save();
                confettiCtx.translate(p.x, p.y);
                confettiCtx.rotate(p.rotation * Math.PI / 180);
                confettiCtx.globalAlpha = p.alpha;
                confettiCtx.fillStyle = p.color;
                confettiCtx.fillRect(-p.radius, -p.radius / 2, p.radius * 2, p.radius);
                confettiCtx.restore();
            }
        }

        // Alpine.js Sentence Builder Controller
        function sentenceBuilderGame() {
            const categories = {
                daily: {
                    title: "Everyday Conversations",
                    sentences: [
                        { full: "How can I help you today?", translation: "Bagaimana saya bisa membantu Anda hari ini?", words: ["How", "can", "I", "help", "you", "today?"] },
                        { full: "Would you like some coffee?", translation: "Apakah Anda mau kopi?", words: ["Would", "you", "like", "some", "coffee?"] },
                        { full: "It is nice to meet you.", translation: "Senang bertemu dengan Anda.", words: ["It", "is", "nice", "to", "meet", "you."] },
                        { full: "I will call you back later.", translation: "Saya akan menelepon Anda kembali nanti.", words: ["I", "will", "call", "you", "back", "later."] },
                        { full: "Please make yourself at home.", translation: "Anggap saja seperti di rumah sendiri.", words: ["Please", "make", "yourself", "at", "home."] }
                    ]
                },
                toefl_structure: {
                    title: "TOEFL Structure",
                    sentences: [
                        { full: "Seldom have I seen such a beautiful painting.", translation: "Jarang sekali saya melihat lukisan seindah itu. (Inversi)", words: ["Seldom", "have", "I", "seen", "such", "a", "beautiful", "painting."] },
                        { full: "Had I known the truth, I would have acted differently.", translation: "Seandainya saya tahu kebenarannya, saya pasti bertindak berbeda. (Kondisional Lampau)", words: ["Had", "I", "known", "the", "truth,", "I", "would", "have", "acted", "differently."] },
                        { full: "Not only did she pass, but she also scored highest.", translation: "Dia tidak hanya lulus, tetapi dia juga mendapat nilai tertinggi. (Inversi Not Only)", words: ["Not", "only", "did", "she", "pass,", "but", "she", "also", "scored", "highest."] },
                        { full: "Under no circumstances should you press this red button.", translation: "Dalam kondisi bagaimanapun, Anda tidak boleh menekan tombol merah ini.", words: ["Under", "no", "circumstances", "should", "you", "press", "this", "red", "button."] },
                        { full: "The book which you lent me was extremely fascinating.", translation: "Buku yang Anda pinjamkan kepada saya sangat mengasyikkan. (Relative Clause)", words: ["The", "book", "which", "you", "lent", "me", "was", "extremely", "fascinating."] }
                    ]
                },
                idioms: {
                    title: "Idioms & Sayings",
                    sentences: [
                        { full: "Actions speak louder than words.", translation: "Tindakan berbicara lebih keras daripada kata-kata. (Bukti nyata)", words: ["Actions", "speak", "louder", "than", "words."] },
                        { full: "Don't cry over spilled milk.", translation: "Jangan menyesali apa yang sudah berlalu/terjadi.", words: ["Don't", "cry", "over", "spilled", "milk."] },
                        { full: "A piece of cake.", translation: "Sangat mudah sekali / perkara gampang.", words: ["A", "piece", "of", "cake."] },
                        { full: "Barking up the wrong tree.", translation: "Menuduh orang yang salah / salah sasaran.", words: ["Barking", "up", "the", "wrong", "tree."] },
                        { full: "Bite the bullet.", translation: "Menghadapi situasi sulit dengan keteguhan hati.", words: ["Bite", "the", "bullet."] }
                    ]
                }
            };

            return {
                gameState: 'select_category',
                selectedCategory: null,
                score: 0,
                combo: 0,
                maxCombo: 0,
                currentSentenceIndex: 0,
                timeLeft: 45,
                scrambledWords: [],
                userAnswer: [],
                feedbackState: '',
                timerInterval: null,
                highScores: {},
                bgmEnabled: true,
                bgmPlaying: false,

                init() {
                    const savedScores = localStorage.getItem('toefl_sentence_highscores');
                    if (savedScores) {
                        this.highScores = JSON.parse(savedScores);
                    }

                    const bgm = document.getElementById('bgm-audio');
                    if (bgm) {
                        bgm.volume = 1.0;
                    }
                },

                playBgm() {
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm && this.bgmEnabled && !this.bgmPlaying) {
                        bgm.play().then(() => {
                            this.bgmPlaying = true;
                        }).catch(err => {
                            console.log("BGM play blocked:", err);
                            this.bgmPlaying = false;
                        });
                    }
                },

                pauseBgm() {
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm && this.bgmPlaying) {
                        bgm.pause();
                        this.bgmPlaying = false;
                    }
                },

                toggleBgm() {
                    this.bgmEnabled = !this.bgmEnabled;
                    if (this.bgmEnabled) {
                        this.playBgm();
                    } else {
                        this.pauseBgm();
                    }
                },

                selectCategory(catKey) {
                    this.selectedCategory = catKey;
                    this.score = 0;
                    this.combo = 0;
                    this.maxCombo = 0;
                    this.currentSentenceIndex = 0;
                    this.loadSentence();
                    this.gameState = 'playing';
                    this.playBgm();
                },

                loadSentence() {
                    this.userAnswer = [];
                    this.feedbackState = '';
                    this.timeLeft = 45;

                    const sentenceList = categories[this.selectedCategory].sentences;
                    const sentenceObj = sentenceList[this.currentSentenceIndex];
                    
                    // Map words to objects
                    let words = sentenceObj.words.map((word, index) => ({
                        text: word,
                        id: index,
                        selected: false
                    }));

                    // Shuffle (Fisher-Yates)
                    do {
                        for (let i = words.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [words[i], words[j]] = [words[j], words[i]];
                        }
                    } while (words.map(w => w.text).join(' ') === sentenceObj.words.join(' '));

                    this.scrambledWords = words;

                    // Start timer
                    if (this.timerInterval) clearInterval(this.timerInterval);
                    
                    let lastWholeSecond = 45;
                    this.timerInterval = setInterval(() => {
                        this.timeLeft -= 0.1;
                        
                        const currentWholeSecond = Math.ceil(this.timeLeft);
                        if (this.timeLeft <= 6 && currentWholeSecond < lastWholeSecond && currentWholeSecond > 0) {
                            playSound('tick');
                            lastWholeSecond = currentWholeSecond;
                        }

                        if (this.timeLeft <= 0) {
                            clearInterval(this.timerInterval);
                            this.timeLeft = 0;
                            this.handleTimeOut();
                        }
                    }, 100);
                },

                clickWord(wordObj) {
                    if (wordObj.selected) return;
                    wordObj.selected = true;
                    this.userAnswer.push(wordObj);
                },

                removeWord(index) {
                    const wordObj = this.userAnswer[index];
                    wordObj.selected = false;
                    this.userAnswer.splice(index, 1);
                },

                resetCurrentSentence() {
                    this.userAnswer = [];
                    this.scrambledWords.forEach(w => w.selected = false);
                },

                submitCheck() {
                    if (this.userAnswer.length !== this.scrambledWords.length) {
                        alert("Harap susun semua kata terlebih dahulu!");
                        return;
                    }

                    const answerString = this.userAnswer.map(w => w.text).join(' ');
                    const correctString = categories[this.selectedCategory].sentences[this.currentSentenceIndex].words.join(' ');

                    if (answerString === correctString) {
                        // Correct!
                        clearInterval(this.timerInterval);
                        playSound('correct');
                        triggerConfetti();
                        
                        const speedBonus = Math.round(this.timeLeft * 8);
                        const comboMultiplier = 1 + (this.combo * 0.2);
                        const pointsGained = Math.round((150 + speedBonus) * comboMultiplier);
                        
                        this.score += pointsGained;
                        this.combo++;
                        this.maxCombo = Math.max(this.maxCombo, this.combo);
                        this.feedbackState = 'correct';

                        setTimeout(() => {
                            this.nextSentence();
                        }, 1500);
                    } else {
                        // Incorrect
                        playSound('wrong');
                        this.combo = 0;
                        this.feedbackState = 'wrong';
                        
                        setTimeout(() => {
                            this.feedbackState = '';
                            this.resetCurrentSentence();
                        }, 1200);
                    }
                },

                handleTimeOut() {
                    playSound('wrong');
                    this.combo = 0;
                    this.feedbackState = 'wrong';
                    
                    const sentenceObj = categories[this.selectedCategory].sentences[this.currentSentenceIndex];
                    this.userAnswer = sentenceObj.words.map((w, index) => ({
                        text: w,
                        id: 'timeout-' + index
                    }));

                    setTimeout(() => {
                        this.nextSentence();
                    }, 2500);
                },

                skipSentence() {
                    clearInterval(this.timerInterval);
                    this.combo = 0;
                    this.nextSentence();
                },

                nextSentence() {
                    this.currentSentenceIndex++;
                    const sentenceList = categories[this.selectedCategory].sentences;
                    
                    if (this.currentSentenceIndex >= sentenceList.length) {
                        clearInterval(this.timerInterval);
                        playSound('win');
                        
                        const currentHigh = this.highScores[this.selectedCategory] || 0;
                        if (this.score > currentHigh) {
                            this.highScores[this.selectedCategory] = this.score;
                            localStorage.setItem('toefl_sentence_highscores', JSON.stringify(this.highScores));
                        }
                        
                        this.gameState = 'game_over';
                        this.pauseBgm();
                    } else {
                        this.loadSentence();
                    }
                },

                quitGame() {
                    if (confirm("Apakah Anda yakin ingin keluar? Skor Anda saat ini akan hilang.")) {
                        if (this.timerInterval) clearInterval(this.timerInterval);
                        this.gameState = 'select_category';
                        this.pauseBgm();
                    }
                },

                getCategoryTitle() {
                    return categories[this.selectedCategory]?.title || '';
                },

                getSentenceClue() {
                    return categories[this.selectedCategory]?.sentences[this.currentSentenceIndex]?.translation || '';
                }
            };
        }
    </script>
</x-app-layout>
