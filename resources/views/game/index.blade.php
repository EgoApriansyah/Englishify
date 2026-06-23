<x-app-layout>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Game Container with Alpine.js -->
            <div x-data="wordScrambleGame()" x-init="init()" class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden relative" style="min-height: 520px;">
                
                <!-- BGM Audio -->
                <audio id="bgm-audio" src="{{ asset('assets/Overworld.mp3') }}" loop preload="auto"></audio>

                <!-- Confetti Canvas overlay -->
                <canvas id="confetti-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-20"></canvas>

                <!-- SECTION 1: CATEGORY SELECTION -->
                <div x-show="gameState === 'select_category'" class="p-8 md:p-12 space-y-8">
                    <div class="text-center space-y-3">
                        <div class="inline-flex p-3 bg-amber-50 rounded-2xl text-amber-500 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 animate-bounce">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 21L12 18.75L15 21L14.188 15.904L18.25 12L13.125 11.25L12 6L10.875 11.25L5.75 12L9.813 15.904Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">English Word Scramble</h3>
                        <p class="text-sm text-slate-500 max-w-md mx-auto leading-relaxed">
                            Susun kembali huruf-huruf acak menjadi kata yang benar berdasarkan petunjuk definisi. Kumpulkan poin dan pertahankan combo Anda!
                        </p>
                    </div>

                    <!-- Category Cards Selection Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                        <!-- Category: Vocabulary -->
                        <div class="bg-indigo-50/50 rounded-2xl border-2 border-indigo-150 p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-sm shadow-indigo-100/30">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-600 text-white flex items-center justify-center shadow-md shadow-indigo-600/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h4 class="font-extrabold text-slate-800 text-base">Academic Vocab</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Kosakata akademik tingkat tinggi yang sering muncul di teks TOEFL.</p>
                                <div class="text-[10px] font-bold text-indigo-700 bg-indigo-100/50 py-1 px-2.5 rounded-lg inline-block">
                                    High Score: <span x-text="highScores.vocabulary || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('vocabulary')" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2.5 rounded-xl transition cursor-pointer">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: Grammar -->
                        <div class="bg-purple-50/50 rounded-2xl border-2 border-purple-150 p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-sm shadow-purple-100/30">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center shadow-md shadow-purple-600/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <h4 class="font-extrabold text-slate-800 text-base">Grammar Terms</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Tebak istilah-istilah struktural tata bahasa Inggris.</p>
                                <div class="text-[10px] font-bold text-purple-700 bg-purple-100/50 py-1 px-2.5 rounded-lg inline-block">
                                    High Score: <span x-text="highScores.grammar || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('grammar')" class="w-full bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold py-2.5 rounded-xl transition cursor-pointer">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: Synonyms -->
                        <div class="bg-amber-50/50 rounded-2xl border-2 border-amber-150 p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-sm shadow-amber-100/30">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-md shadow-amber-500/20">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379L12 21l3.62-3.144c1.153-.086 2.294-.213 3.423-.379 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.018Z" />
                                    </svg>
                                </div>
                                <h4 class="font-extrabold text-slate-800 text-base">Synonyms speed</h4>
                                <p class="text-xs text-slate-500 leading-relaxed">Temukan persamaan kata dari ungkapan bahasa Inggris populer.</p>
                                <div class="text-[10px] font-bold text-amber-700 bg-amber-100/50 py-1 px-2.5 rounded-lg inline-block">
                                    High Score: <span x-text="highScores.synonyms || 0"></span>
                                </div>
                            </div>
                            <button @click="selectCategory('synonyms')" class="w-full bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold py-2.5 rounded-xl transition cursor-pointer">
                                Main Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SECTION 2: GAME BOARD -->
                <div x-show="gameState === 'playing'" class="fixed inset-0 w-screen h-screen bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 text-white z-50 p-6 md:p-8 flex flex-col justify-between" style="display: none;"
                     :class="feedbackState === 'wrong' ? 'animate-shake' : ''">
                    
                    <!-- Game Header Panel: Score, Combo, Progress -->
                    <div class="flex items-center justify-between gap-4 border-b border-slate-800 pb-4">
                        <div class="flex items-center gap-2">
                            <button @click="quitGame()" class="text-slate-300 hover:text-rose-500 p-2 rounded-xl bg-slate-900/60 border border-slate-700/50 hover:bg-slate-900 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            <span class="text-xs font-black text-cyan-400 uppercase tracking-widest bg-slate-900/60 border border-slate-700/50 px-3 py-2 rounded-xl mr-1" x-text="getCategoryTitle()"></span>
                            
                            <!-- BGM Toggle Button -->
                            <button @click="toggleBgm()" class="p-2 rounded-xl bg-slate-900/60 border border-slate-700/50 hover:bg-slate-900 text-slate-300 hover:text-indigo-400 transition cursor-pointer flex items-center justify-center shrink-0" title="Mute/Unmute Musik">
                                <template x-if="bgmEnabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </template>
                                <template x-if="!bgmEnabled">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-rose-550">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 9.75 19.5 12m0 0 2.25 2.25M19.5 12l2.25-2.25M19.5 12l-2.25 2.25m-10.5-6 4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                    </svg>
                                </template>
                            </button>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <!-- Combo Indicator -->
                            <div x-show="combo > 0" class="flex items-center bg-rose-500/10 border border-rose-500/30 text-rose-450 font-extrabold text-xs px-3 py-1.5 rounded-xl animate-pulse">
                                x<span x-text="combo"></span> Combo!
                            </div>
                            <!-- Score Display -->
                            <div class="px-4 py-1 bg-slate-900/60 border border-slate-700/50 rounded-xl text-right">
                                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest block">Skor</span>
                                <span class="text-lg font-black text-cyan-400" x-text="score"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Timer Bar (Shrinks and changes color) -->
                    <div class="w-full bg-slate-800/80 border border-slate-700/50 h-3.5 rounded-full overflow-hidden mt-3 relative">
                        <div class="h-full rounded-full transition-all duration-100 linear"
                             :style="'width: ' + (timeLeft / 30 * 100) + '%'"
                             :class="timeLeft > 15 ? 'bg-emerald-500' : (timeLeft > 6 ? 'bg-amber-500' : 'bg-rose-500 animate-pulse')">
                        </div>
                    </div>

                    <!-- Word Tracker Progress Bubbles -->
                    <div class="flex justify-center items-center gap-1.5 mt-4">
                        <template x-for="idx in 10">
                            <span class="w-3.5 h-3.5 rounded-full border transition-all duration-300"
                                  :class="idx <= currentWordIndex ? 'bg-cyan-400 border-cyan-400 shadow-md shadow-cyan-400/30' : 'bg-slate-850 border-slate-700'"></span>
                        </template>
                    </div>

                    <!-- Word Board: Clue and Scrambled Letters -->
                    <div class="my-auto py-4 space-y-6 text-center">
                        <!-- The Scrambled word letter slots -->
                        <div class="flex justify-center flex-wrap gap-2.5 min-h-[50px] items-center">
                            <template x-for="(letter, index) in userAnswer" :key="letter.id">
                                <button @click="removeLetter(index)" 
                                        class="w-12 h-12 bg-indigo-950/80 border-2 border-cyan-400 text-cyan-300 hover:border-cyan-300 font-extrabold text-xl rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/10 transform hover:-translate-y-0.5 active:translate-y-0 transition cursor-pointer">
                                    <span x-text="letter.char"></span>
                                </button>
                            </template>
                            <!-- Empty dashes when letters are not filled -->
                            <template x-for="n in Math.max(0, getWordLength() - userAnswer.length)">
                                <span class="w-12 h-12 border-2 border-dashed border-slate-800 bg-slate-900/40 rounded-xl flex items-center justify-center text-slate-650 font-black">?</span>
                            </template>
                        </div>

                        <!-- Clue Box -->
                        <div class="max-w-xl mx-auto bg-slate-900/60 border border-slate-800 p-4 rounded-2xl backdrop-blur-sm shadow-md">
                            <span class="text-[9px] font-bold text-slate-500 uppercase tracking-widest block mb-1">Clue / Definisi</span>
                            <p class="text-sm text-slate-200 font-bold leading-relaxed italic" x-text="getWordClue()"></p>
                        </div>

                        <!-- Scrambled bubbles selector -->
                        <div class="flex justify-center flex-wrap gap-3 pt-2">
                            <template x-for="letter in scrambledLetters" :key="letter.id">
                                <button @click="clickLetter(letter)" 
                                        :disabled="letter.selected"
                                        :class="letter.selected ? 'opacity-10 scale-90 border-slate-900 bg-slate-950 text-slate-700' : 'bg-indigo-900/40 border border-indigo-750/80 hover:border-cyan-400 hover:bg-indigo-950/80 hover:-translate-y-0.5 text-white'"
                                        class="w-12 h-12 border font-extrabold text-lg rounded-xl flex items-center justify-center transition select-none cursor-pointer shadow-md shadow-indigo-950/20">
                                    <span x-text="letter.char"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Action Controls Footer -->
                    <div class="flex items-center justify-between gap-4 border-t border-slate-800 pt-5">
                        <button @click="resetCurrentWord()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-750 hover:bg-slate-850 text-slate-350 text-xs font-bold transition cursor-pointer shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            <span>Reset</span>
                        </button>

                        <div class="flex items-center gap-2">
                            <button @click="useHint()" 
                                    :disabled="hintsUsed >= 3 || score < 50 || timeLeft < 5"
                                    :class="hintsUsed >= 3 || score < 50 || timeLeft < 5 ? 'opacity-40 cursor-not-allowed bg-amber-600/30 text-amber-500/70 border border-amber-800/40' : 'bg-amber-600 hover:bg-amber-700 text-white border border-amber-500'"
                                     class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold transition cursor-pointer shadow-md">
                                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.467 5.99 5.99 0 0 0-1.925 3.546 5.974 5.974 0 0 1-2.133-1A3.75 3.75 0 0 0 12 18Z" />
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 0 0 .495-7.467 5.99 5.99 0 0 0-1.925 3.546 5.974 5.974 0 0 1-2.133-1A3.75 3.75 0 0 0 12 18Z" />
                                   <path stroke-linecap="round" stroke-linejoin="round" d="M12 2.25V4.5m5.3-2.3-1.6 1.6m3.8 3.7h-2.25M12 19.5v2.25m-5.3-2.3 1.6-1.6m-3.8-3.7h2.25" />
                                 </svg>
                                <span>Hint (-50pt)</span>
                            </button>

                            <button @click="skipWord()" class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-750 hover:bg-slate-850 text-slate-350 text-xs font-bold transition cursor-pointer shadow-md">
                                <span>Skip</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Zm2.25 0h.008v.008H9.75V6Z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: GAME OVER / SUMMARY -->
                <div x-show="gameState === 'game_over'" class="fixed inset-0 w-screen h-screen flex flex-col justify-center items-center bg-gradient-to-br from-indigo-950 via-slate-900 to-purple-950 text-white z-50 p-6" style="display: none;">
                    <div class="space-y-3 text-center">
                        <div class="inline-flex p-4 bg-emerald-500/10 border border-emerald-550/30 rounded-full text-emerald-450 shadow-md shadow-emerald-500/10 animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.622 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 3.75h6m-6 3h6m-6 3h6m-9 3h12" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-black text-emerald-400 tracking-tight">Permainan Selesai!</h3>
                        <p class="text-sm text-slate-400 font-medium max-w-sm mx-auto">Bagus sekali! Anda berhasil menyelesaikan semua kata di sesi ini.</p>
                    </div>

                    <!-- Final Score panel -->
                    <div class="max-w-xs w-full mx-auto bg-slate-900 border border-slate-800 rounded-3xl p-6 grid grid-cols-2 gap-4 my-6 shadow-xl">
                        <div class="border-r border-slate-800 text-center">
                            <span class="text-[9px] font-bold text-slate-550 uppercase tracking-widest block">Skor Akhir</span>
                            <span class="text-2xl font-black text-cyan-400" x-text="score"></span>
                        </div>
                        <div class="text-center">
                            <span class="text-[9px] font-bold text-slate-550 uppercase tracking-widest block">Max Combo</span>
                            <span class="text-2xl font-black text-rose-500" x-text="maxCombo"></span>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-4">
                        <button @click="selectCategory(selectedCategory)" class="px-6 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-650/20 transition cursor-pointer border border-indigo-500/20">
                            Main Lagi
                        </button>
                        <button @click="gameState = 'select_category'" class="px-6 py-3.5 bg-slate-900 hover:bg-slate-850 border border-slate-800 text-slate-350 font-bold rounded-xl transition cursor-pointer">
                            Pilih Kategori Lain
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Word Scramble Game Script -->
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
                } else if (type === 'hint') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(880, now); // A5
                    gain.gain.setValueAtTime(0.25, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.12);
                    osc.start(now);
                    osc.stop(now + 0.12);
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
            const colors = ['#4f46e5', '#8b5cf6', '#f59e0b', '#10b981', '#ec4899', '#3b82f6'];
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

        // Alpine.js Word Scramble Game Controller
        function wordScrambleGame() {
            const categories = {
                vocabulary: {
                    title: "TOEFL Academic Vocabulary",
                    words: [
                        { word: "STUDY", clue: "Belajar atau memeriksa sesuatu secara mendalam." },
                        { word: "RESULT", clue: "Hasil akhir atau efek dari suatu tindakan atau percobaan." },
                        { word: "GROUP", clue: "Kumpulan orang, hewan, atau benda yang memiliki kesamaan." },
                        { word: "REPORT", clue: "Laporan atau informasi tertulis tentang suatu topik." },
                        { word: "CREATE", clue: "Membuat, menghasilkan, atau melahirkan sesuatu yang baru." },
                        { word: "SOURCE", clue: "Asal, permulaan, atau sumber utama informasi." },
                        { word: "DATA", clue: "Fakta, angka, atau informasi yang dikumpulkan untuk dianalisis." },
                        { word: "SIMPLE", clue: "Mudah dipahami, tidak rumit, atau mendasar." },
                        { word: "METHOD", clue: "Cara, prosedur, atau jalan terstruktur untuk mencapai sesuatu." },
                        { word: "TOPIC", clue: "Subjek utama atau tema pokok yang sedang dibicarakan." }
                    ]
                },
                grammar: {
                    title: "Grammar Mastery",
                    words: [
                        { word: "NOUN", clue: "Kata benda (contoh: book, cat, table, school)." },
                        { word: "VERB", clue: "Kata kerja yang menunjukkan tindakan (contoh: run, eat, read)." },
                        { word: "TENSE", clue: "Bentuk kata kerja yang menunjukkan waktu kejadian (past, present, future)." },
                        { word: "PLURAL", clue: "Bentuk jamak yang menunjukkan benda berjumlah lebih dari satu." },
                        { word: "WORD", clue: "Kumpulan huruf yang memiliki makna atau arti tertentu." },
                        { word: "SENTENCE", clue: "Kumpulan kata-kata yang membentuk satu pikiran utuh." },
                        { word: "SUBJECT", clue: "Pelaku atau tokoh utama yang melakukan tindakan dalam kalimat." },
                        { word: "OBJECT", clue: "Benda atau penerima tindakan dari subjek dalam kalimat." },
                        { word: "PRONOUN", clue: "Kata ganti benda atau orang (contoh: he, she, they, we)." },
                        { word: "ADJECTIVE", clue: "Kata sifat yang menerangkan kata benda (contoh: happy, red, big)." }
                    ]
                },
                synonyms: {
                    title: "Daily Synonyms",
                    words: [
                        { word: "HUGE", clue: "Persamaan kata atau sinonim dari kata 'BIG' (Sangat besar)." },
                        { word: "TINY", clue: "Persamaan kata atau sinonim dari kata 'SMALL' (Sangat kecil)." },
                        { word: "HAPPY", clue: "Persamaan kata atau sinonim dari kata 'GLAD' (Senang)." },
                        { word: "SMART", clue: "Persamaan kata atau sinonim dari kata 'CLEVER' (Pintar/cerdas)." },
                        { word: "ANGRY", clue: "Persamaan kata atau sinonim dari kata 'MAD' (Marah/kesal)." },
                        { word: "QUICK", clue: "Persamaan kata atau sinonim dari kata 'FAST' (Cepat)." },
                        { word: "SILENT", clue: "Persamaan kata atau sinonim dari kata 'QUIET' (Sunyi/sepi)." },
                        { word: "STRONG", clue: "Persamaan kata atau sinonim dari kata 'POWERFUL' (Kuat)." },
                        { word: "EASY", clue: "Persamaan kata atau sinonim dari kata 'SIMPLE' (Mudah)." },
                        { word: "PRETTY", clue: "Persamaan kata atau sinonim dari kata 'BEAUTIFUL' (Cantik/menawan)." }
                    ]
                }
            };

            return {
                gameState: 'select_category',
                selectedCategory: null,
                score: 0,
                combo: 0,
                maxCombo: 0,
                currentWordIndex: 0,
                timeLeft: 30,
                scrambledLetters: [],
                userAnswer: [],
                feedbackState: '',
                hintsUsed: 0,
                timerInterval: null,
                highScores: {},
                bgmEnabled: true,
                bgmPlaying: false,

                init() {
                    const savedScores = localStorage.getItem('toefl_game_highscores');
                    if (savedScores) {
                        this.highScores = JSON.parse(savedScores);
                    }

                    // Set BGM Volume
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm) {
                        bgm.volume = 1.0;
                    }
                    
                    // Listen for keyboard input
                    window.addEventListener('keydown', (e) => {
                        if (this.gameState !== 'playing') return;
                        const key = e.key.toUpperCase();
                        if (key === 'BACKSPACE') {
                            this.removeLastLetter();
                        } else if (key === 'ENTER') {
                            this.submitCheck();
                        } else if (key.length === 1 && key >= 'A' && key <= 'Z') {
                            this.typeLetter(key);
                        }
                    });
                },

                playBgm() {
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm && this.bgmEnabled && !this.bgmPlaying) {
                        bgm.play().then(() => {
                            this.bgmPlaying = true;
                        }).catch(err => {
                            console.log("BGM play blocked by browser policy, will retry on interaction:", err);
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
                    this.currentWordIndex = 0;
                    this.loadWord();
                    this.gameState = 'playing';
                    this.playBgm();
                },

                loadWord() {
                    this.userAnswer = [];
                    this.feedbackState = '';
                    this.hintsUsed = 0;
                    this.timeLeft = 30;

                    const wordsList = categories[this.selectedCategory].words;
                    const wordObj = wordsList[this.currentWordIndex];
                    
                    // Scramble letters
                    let letters = wordObj.word.split('').map((char, index) => ({
                        char: char,
                        id: index,
                        selected: false
                    }));

                    // Shuffle (Fisher-Yates)
                    do {
                        for (let i = letters.length - 1; i > 0; i--) {
                            const j = Math.floor(Math.random() * (i + 1));
                            [letters[i], letters[j]] = [letters[j], letters[i]];
                        }
                    } while (letters.map(l => l.char).join('') === wordObj.word);

                    this.scrambledLetters = letters;

                    // Start timer
                    if (this.timerInterval) clearInterval(this.timerInterval);
                    
                    let lastWholeSecond = 30;
                    this.timerInterval = setInterval(() => {
                        this.timeLeft -= 0.1;
                        
                        // play soft tick-tock sound in last 5 seconds
                        const currentWholeSecond = Math.ceil(this.timeLeft);
                        if (this.timeLeft <= 5 && currentWholeSecond < lastWholeSecond && currentWholeSecond > 0) {
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

                clickLetter(letterObj) {
                    if (letterObj.selected) return;
                    letterObj.selected = true;
                    this.userAnswer.push(letterObj);

                    // Check if complete
                    if (this.userAnswer.length === this.getWordLength()) {
                        this.submitCheck();
                    }
                },

                removeLetter(index) {
                    const letterObj = this.userAnswer[index];
                    letterObj.selected = false;
                    this.userAnswer.splice(index, 1);
                },

                removeLastLetter() {
                    if (this.userAnswer.length > 0) {
                        this.removeLetter(this.userAnswer.length - 1);
                    }
                },

                resetCurrentWord() {
                    this.userAnswer = [];
                    this.scrambledLetters.forEach(l => l.selected = false);
                },

                typeLetter(char) {
                    const available = this.scrambledLetters.find(l => l.char === char && !l.selected);
                    if (available) {
                        this.clickLetter(available);
                    }
                },

                submitCheck() {
                    const answer = this.userAnswer.map(l => l.char).join('');
                    const correctWord = categories[this.selectedCategory].words[this.currentWordIndex].word;

                    if (answer === correctWord) {
                        // Correct!
                        clearInterval(this.timerInterval);
                        playSound('correct');
                        triggerConfetti();
                        
                        // Calculate score: base 100 + speed bonus + combo multiplier
                        const speedBonus = Math.round(this.timeLeft * 12);
                        const comboMultiplier = 1 + (this.combo * 0.15);
                        const pointsGained = Math.round((100 + speedBonus) * comboMultiplier);
                        
                        this.score += pointsGained;
                        this.combo++;
                        this.maxCombo = Math.max(this.maxCombo, this.combo);
                        this.feedbackState = 'correct';

                        setTimeout(() => {
                            this.nextWord();
                        }, 1300);
                    } else {
                        // Incorrect
                        playSound('wrong');
                        this.combo = 0;
                        this.feedbackState = 'wrong';
                        
                        // clear incorrect answer to try again
                        setTimeout(() => {
                            if (this.feedbackState === 'wrong') {
                                this.feedbackState = '';
                                this.resetCurrentWord();
                            }
                        }, 1000);
                    }
                },

                handleTimeOut() {
                    playSound('wrong');
                    this.combo = 0;
                    this.feedbackState = 'wrong';
                    // Show correct answer by filling userAnswer
                    const correctWord = categories[this.selectedCategory].words[this.currentWordIndex].word;
                    this.userAnswer = correctWord.split('').map((char, index) => ({
                        char: char,
                        id: 'timeout-' + index
                    }));

                    setTimeout(() => {
                        this.nextWord();
                    }, 2200);
                },

                useHint() {
                    if (this.hintsUsed >= 3 || this.score < 50 || this.timeLeft < 5) return;
                    
                    const correctWord = categories[this.selectedCategory].words[this.currentWordIndex].word;
                    const nextCorrectChar = correctWord[this.userAnswer.length];
                    
                    // Deduct points
                    this.score -= 50;
                    this.hintsUsed++;
                    playSound('hint');

                    // Find that char in available scrambled letters and click it
                    const targetLetterObj = this.scrambledLetters.find(l => l.char === nextCorrectChar && !l.selected);
                    if (targetLetterObj) {
                        this.clickLetter(targetLetterObj);
                    }
                },

                skipWord() {
                    clearInterval(this.timerInterval);
                    this.combo = 0;
                    this.nextWord();
                },

                nextWord() {
                    this.currentWordIndex++;
                    const wordsList = categories[this.selectedCategory].words;
                    
                    if (this.currentWordIndex >= wordsList.length) {
                        // Game Over!
                        clearInterval(this.timerInterval);
                        playSound('win');
                        
                        // Save high score
                        const currentHigh = this.highScores[this.selectedCategory] || 0;
                        if (this.score > currentHigh) {
                            this.highScores[this.selectedCategory] = this.score;
                            localStorage.setItem('toefl_game_highscores', JSON.stringify(this.highScores));
                        }
                        
                        this.gameState = 'game_over';
                        this.pauseBgm();
                    } else {
                        this.loadWord();
                    }
                },

                quitGame() {
                    if (confirm("Apakah Anda yakin ingin keluar dari permainan? Skor Anda saat ini tidak akan disimpan.")) {
                        if (this.timerInterval) clearInterval(this.timerInterval);
                        this.gameState = 'select_category';
                        this.pauseBgm();
                    }
                },

                getCategoryTitle() {
                    return categories[this.selectedCategory]?.title || '';
                },

                getWordClue() {
                    return categories[this.selectedCategory]?.words[this.currentWordIndex]?.clue || '';
                },

                getWordLength() {
                    return categories[this.selectedCategory]?.words[this.currentWordIndex]?.word.length || 0;
                },

                getWordWord() {
                    return categories[this.selectedCategory]?.words[this.currentWordIndex]?.word || '';
                }
            };
        }
    </script>
</x-app-layout>
