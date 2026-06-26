<x-app-layout>
    <div class="py-12 font-body">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Game Container with Alpine.js -->
            <div x-data="collector3DGame()" x-init="init()" class="bg-canvas rounded-lg border border-hairline shadow-card overflow-hidden relative" style="min-height: 520px;">
                
                <!-- BGM Audio -->
                <audio id="bgm-audio" src="{{ asset('assets/Overworld.mp3') }}" loop preload="auto"></audio>

                <!-- SECTION 1: CATEGORY SELECTION -->
                <div x-show="gameState === 'select_category'" class="p-8 md:p-12 space-y-8">
                    <div class="text-center space-y-3">
                        <div class="inline-flex p-3 bg-green-light border border-green-muted text-green-dark rounded-lg shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10 text-green animate-pulse">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3.5xl font-semibold font-display text-ink tracking-tight">English Collector</h3>
                        <p class="text-sm text-muted max-w-md mx-auto leading-relaxed font-body">
                            Kendalikan bola energi neon dalam 3D! Kumpulkan kristal huruf yang benar untuk mengeja kata target sambil menghindari rintangan huruf yang salah.
                        </p>
                    </div>

                    <!-- Category Cards Selection Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                        <!-- Category: Vocabulary -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-blue-light text-blue flex items-center justify-center shadow-md font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h4 class="font-semibold font-display text-ink text-base">Academic Vocab</h4>
                                <p class="text-xs text-muted leading-relaxed font-body">Kumpulkan kosakata akademik tingkat tinggi yang sering muncul di TOEFL.</p>
                            </div>
                            <button @click="selectCategory('vocabulary')" class="w-full bg-green hover:bg-green-dark text-white text-xs font-semibold py-2.5 rounded-md transition cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: Grammar -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-yellow-light text-yellow flex items-center justify-center shadow-md font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                    </svg>
                                </div>
                                <h4 class="font-semibold font-display text-ink text-base">Grammar Terms</h4>
                                <p class="text-xs text-muted leading-relaxed font-body">Pahami berbagai struktur tata bahasa dengan mengeja istilah bahasanya.</p>
                            </div>
                            <button @click="selectCategory('grammar')" class="w-full bg-green hover:bg-green-dark text-white text-xs font-semibold py-2.5 rounded-md transition cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>

                        <!-- Category: Synonyms -->
                        <div class="bg-canvas rounded-lg border border-hairline p-6 flex flex-col justify-between space-y-4 hover:scale-[1.03] transition duration-200 shadow-card">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-md bg-purple-light text-purple flex items-center justify-center shadow-md font-semibold">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                      <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379L12 21l3.62-3.144c1.153-.086 2.294-.213 3.423-.379 1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v5.018Z" />
                                    </svg>
                                </div>
                                <h4 class="font-semibold font-display text-ink text-base">Synonyms Collector</h4>
                                <p class="text-xs text-muted leading-relaxed font-body">Spesial pengumpulan kata sinonim/persamaan istilah bahasa Inggris populer.</p>
                            </div>
                            <button @click="selectCategory('synonyms')" class="w-full bg-green hover:bg-green-dark text-white text-xs font-semibold py-2.5 rounded-md transition cursor-pointer shadow-sm">
                                Main Sekarang
                            </button>
                        </div>
                    </div>

                    <!-- General High Score indicator -->
                    <div class="text-center pt-2">
                        <span class="text-xs font-semibold text-green bg-green-light px-4 py-2 rounded-pill border border-green-muted">
                            🏆 Skor Tertinggi 3D: <span class="font-black font-mono text-green-dark" x-text="highScore">0</span>
                        </span>
                    </div>
                </div>

                <!-- SECTION 2: 3D PLAYING CANVAS GRID -->
                <div x-show="gameState === 'playing'" class="fixed inset-0 w-screen h-screen bg-ink z-50" style="display: none;">
                    <div id="canvas-container" class="w-full h-full relative" @click="handleCanvasClick($event)">
                        <canvas id="game-canvas" class="w-full h-full block"></canvas>
                    </div>

                    <!-- Overlay UI: Header (Score, Lives, Target Word) -->
                    <div class="absolute top-0 left-0 right-0 p-4 bg-gradient-to-b from-black/80 to-transparent pointer-events-none z-10 flex justify-between items-start">
                        <!-- Left Info -->
                        <div class="flex items-center gap-3 pointer-events-auto">
                            <!-- Exit -->
                            <button @click="quitGame()" class="text-canvas hover:text-red p-2 rounded-md bg-body/30 border border-hairline/20 hover:bg-body/50 transition cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                            </button>
                            
                            <!-- BGM Toggle -->
                            <button @click="toggleBgm()" class="p-2 rounded-md bg-body/30 border border-hairline/20 hover:bg-body/50 text-canvas hover:text-green transition cursor-pointer flex items-center justify-center" title="Musik">
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

                            <!-- Lives/Hearts -->
                            <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-md bg-body/30 border border-hairline/20">
                                <template x-for="n in 3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" 
                                         class="w-5 h-5 transition duration-300"
                                         :class="n <= lives ? 'text-red scale-100' : 'text-muted/30 scale-90'">
                                      <path d="m11.645 20.91l-.007-.003c-.022-.012-.045-.025-.07-.036A21.944 21.944 0 0 1 3 12c0-3.8 3-7 7-7c2.4 0 4.5 1.2 5.7 3.1c1.2-1.9 3.3-3.1 5.7-3.1c4 0 7 3.2 7 7c0 4.8-6.2 8.6-8.56 8.871a.98.98 0 0 1-.79-.228Z" />
                                    </svg>
                                </template>
                            </div>
                        </div>

                        <!-- Right Info (Target word spelling tracker & score) -->
                        <div class="flex flex-col items-end gap-2">
                            <!-- Score Display -->
                            <div class="px-4 py-1.5 bg-body/30 border border-hairline/20 rounded-md text-right">
                                <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Skor</span>
                                <span class="text-lg font-mono font-bold text-green" x-text="score"></span>
                            </div>

                            <!-- Target Word Spelling -->
                            <div class="flex items-center gap-1 px-4 py-2 bg-body/45 border border-hairline/20 rounded-md">
                                <template x-for="(char, index) in targetWord">
                                    <span class="w-8 h-8 rounded-md font-mono font-bold text-lg flex items-center justify-center transition-all duration-300"
                                          :class="index < currentLetterIndex 
                                                  ? 'bg-green border border-green-muted shadow-md text-white' 
                                                  : 'bg-body/45 text-muted/40 border border-hairline/10'">
                                        <span x-text="char"></span>
                                    </span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Overlay UI: Bottom Clue Box -->
                    <div class="absolute bottom-6 left-0 right-0 px-6 pointer-events-none z-10">
                        <div class="max-w-xl mx-auto bg-ink/90 border border-hairline/20 p-4 rounded-md text-center pointer-events-auto backdrop-blur-sm shadow-lg">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block mb-1">Clue / Definisi</span>
                            <p class="text-sm text-canvas font-bold leading-relaxed" x-text="clue"></p>
                        </div>
                    </div>

                    <!-- Overlay UI: Swipe/Tap Guideline (Fades out) -->
                    <div x-data="{ visible: true }" x-init="setTimeout(() => visible = false, 3500)" x-show="visible" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" 
                          class="absolute inset-0 flex items-center justify-between px-8 pointer-events-none z-25">
                        <div class="flex flex-col items-center text-muted/40 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                            </svg>
                            <span class="text-[10px] mt-1.5 font-bold uppercase tracking-widest">Ketuk Kiri</span>
                        </div>
                        <div class="flex flex-col items-center text-muted/40 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-10 h-10">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                            <span class="text-[10px] mt-1.5 font-bold uppercase tracking-widest">Ketuk Kanan</span>
                        </div>
                    </div>
                </div>

                <!-- SECTION 3: GAME OVER / FAIL SCREEN (Ink Dark Mode) -->
                <div x-show="gameState === 'game_over'" class="fixed inset-0 w-screen h-screen flex flex-col justify-center items-center bg-ink text-canvas z-50 p-6" style="display: none;">
                    <div class="space-y-3 text-center">
                        <div class="inline-flex p-4 bg-red/10 border border-red/20 rounded-full text-red shadow-md animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold font-display text-red tracking-tight">Permainan Selesai</h3>
                        <p class="text-sm text-muted font-medium max-w-sm mx-auto">
                            Nyawa Anda habis! Cobalah melatih fokus Anda lebih baik dan dapatkan ejaan huruf yang tepat.
                        </p>
                    </div>

                    <!-- Final Score panel -->
                    <div class="max-w-xs mx-auto bg-body/25 border border-hairline/20 rounded-lg p-6 grid grid-cols-2 gap-4 my-6 shadow-xl text-center">
                        <div class="border-r border-hairline/10">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Skor Anda</span>
                            <span class="text-2xl font-mono font-bold text-green" x-text="score"></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Terbaik 3D</span>
                            <span class="text-2xl font-mono font-bold text-yellow" x-text="highScore"></span>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-4">
                        <button @click="selectCategory(selectedCategory)" class="px-6 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-md transition duration-120 hover:scale-[1.02] cursor-pointer">
                            Coba Lagi
                        </button>
                        <button @click="gameState = 'select_category'" class="px-6 py-3 bg-body/30 hover:bg-body/50 border border-hairline/20 text-canvas font-semibold rounded-md transition duration-120 hover:scale-[1.02] cursor-pointer">
                            Pilih Kategori Lain
                        </button>
                    </div>
                </div>

                <!-- SECTION 4: WIN / CONGRATS SCREEN (Ink Dark Mode) -->
                <div x-show="gameState === 'win_all'" class="fixed inset-0 w-screen h-screen flex flex-col justify-center items-center bg-ink text-canvas z-50 p-6" style="display: none;">
                    <div class="space-y-3 text-center">
                        <div class="inline-flex p-4 bg-green/10 border border-green/20 rounded-full text-green shadow-md animate-bounce">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-12 h-12">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 18.75h-9m9 0a3 3 0 0 1 3 3h-15a3 3 0 0 1 3-3m9 0v-3.375c0-.621-.503-1.125-1.125-1.125h-6.75c-.622 0-1.125.504-1.125 1.125v3.375m9 0h-9M9 3.75h6m-6 3h6m-6 3h6m-9 3h12" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold font-display text-green tracking-tight">Selamat! 🎉</h3>
                        <p class="text-sm text-muted font-medium max-w-sm mx-auto">
                            Luar biasa! Anda sukses mengumpulkan dan mengeja seluruh kata dengan sempurna di mode 3D!
                        </p>
                    </div>

                    <!-- Final Score panel -->
                    <div class="max-w-xs mx-auto bg-body/25 border border-hairline/20 rounded-lg p-6 grid grid-cols-2 gap-4 my-6 shadow-xl text-center">
                        <div class="border-r border-hairline/10">
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Skor Akhir</span>
                            <span class="text-2xl font-mono font-bold text-green" x-text="score"></span>
                        </div>
                        <div>
                            <span class="text-[9px] font-bold text-muted uppercase tracking-widest block">Terbaik 3D</span>
                            <span class="text-2xl font-mono font-bold text-yellow" x-text="highScore"></span>
                        </div>
                    </div>

                    <!-- Action buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-3 pt-4">
                        <button @click="selectCategory(selectedCategory)" class="px-6 py-3 bg-green hover:bg-green-dark text-white font-semibold rounded-md shadow-md transition duration-120 hover:scale-[1.02] cursor-pointer">
                            Main Lagi
                        </button>
                        <button @click="gameState = 'select_category'" class="px-6 py-3 bg-body/30 hover:bg-body/50 border border-hairline/20 text-canvas font-semibold rounded-md transition duration-120 hover:scale-[1.02] cursor-pointer">
                            Pilih Kategori Lain
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Include Three.js via CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <!-- 3D Collector Game Script -->
    <script>
        // Web Audio API Sound Synthesizer
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
                    osc.frequency.setValueAtTime(587.33, now); // D5
                    osc.frequency.setValueAtTime(880.00, now + 0.08); // A5
                    gain.gain.setValueAtTime(0.3, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.22);
                    osc.start(now);
                    osc.stop(now + 0.22);
                } else if (type === 'wrong') {
                    osc.type = 'sawtooth';
                    osc.frequency.setValueAtTime(150, now);
                    osc.frequency.linearRampToValueAtTime(80, now + 0.28);
                    gain.gain.setValueAtTime(0.4, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.28);
                    osc.start(now);
                    osc.stop(now + 0.28);
                } else if (type === 'move') {
                    osc.type = 'sine';
                    osc.frequency.setValueAtTime(440, now); // A4
                    osc.frequency.linearRampToValueAtTime(554.37, now + 0.08); // C#5
                    gain.gain.setValueAtTime(0.15, now);
                    gain.gain.linearRampToValueAtTime(0, now + 0.08);
                    osc.start(now);
                    osc.stop(now + 0.08);
                } else if (type === 'win') {
                    const notes = [293.66, 369.99, 440.00, 587.33, 739.99]; // D major arpeggio
                    notes.forEach((freq, idx) => {
                        const oscN = audioCtx.createOscillator();
                        const gainN = audioCtx.createGain();
                        oscN.connect(gainN);
                        gainN.connect(audioCtx.destination);
                        oscN.type = 'sine';
                        oscN.frequency.setValueAtTime(freq, now + idx * 0.08);
                        gainN.gain.setValueAtTime(0.25, now + idx * 0.08);
                        gainN.gain.linearRampToValueAtTime(0, now + idx * 0.08 + 0.3);
                        oscN.start(now + idx * 0.08);
                        oscN.stop(now + idx * 0.08 + 0.3);
                    });
                }
            } catch (err) {
                console.error("Audio synthesiser error:", err);
            }
        }

        // Global Three.js variables
        let scene, camera, renderer, animationFrameId;
        let roadGridLines = [];
        let playerGroup, playerMesh;
        let currentWave = [];
        let particles = [];
        
        let gameInstance = null;
        let currentLaneIndex = 1; // 0 = left, 1 = center, 2 = right
        const laneXs = [-2, 0, 2];
        const crystalSpeed = 0.16; // speed obstacle approach
        let cameraShake = 0;

        // Create Letter textures for 3D Sprites
        function createLetterSprite(char, colorStr) {
            const canvas = document.createElement('canvas');
            canvas.width = 128;
            canvas.height = 128;
            const ctx = canvas.getContext('2d');
            
            // Draw bubble background
            ctx.fillStyle = colorStr;
            ctx.beginPath();
            ctx.arc(64, 64, 52, 0, Math.PI * 2);
            ctx.fill();
            
            // Draw white border
            ctx.strokeStyle = '#ffffff';
            ctx.lineWidth = 5;
            ctx.stroke();
            
            // Draw character
            ctx.fillStyle = '#ffffff';
            ctx.font = 'bold 70px Arial, sans-serif';
            ctx.textAlign = 'center';
            ctx.textBaseline = 'middle';
            ctx.fillText(char, 64, 64);
            
            const texture = new THREE.CanvasTexture(canvas);
            const material = new THREE.SpriteMaterial({ map: texture, transparent: true });
            const sprite = new THREE.Sprite(material);
            sprite.scale.set(1.4, 1.4, 1.4);
            return sprite;
        }

        // Helper to construct a single crystal obstacle
        function createCrystal(char, colorStr) {
            const crystalGeom = new THREE.OctahedronGeometry(0.55, 0);
            const crystalMat = new THREE.MeshStandardMaterial({
                color: new THREE.Color(colorStr),
                emissive: new THREE.Color(colorStr),
                emissiveIntensity: 0.6,
                roughness: 0.15,
                metalness: 0.85,
                transparent: true,
                opacity: 0.9
            });
            const crystalMesh = new THREE.Mesh(crystalGeom, crystalMat);
            crystalMesh.position.y = 0.55;

            // Halo below crystal
            const ringGeom = new THREE.RingGeometry(0.3, 0.4, 16);
            const ringMat = new THREE.MeshBasicMaterial({ 
                color: new THREE.Color(colorStr), 
                side: THREE.DoubleSide, 
                transparent: true, 
                opacity: 0.25 
            });
            const ringMesh = new THREE.Mesh(ringGeom, ringMat);
            ringMesh.rotation.x = Math.PI / 2;
            ringMesh.position.y = 0.01;

            const letterSprite = createLetterSprite(char, colorStr);
            letterSprite.position.set(0, 1.4, 0);

            const group = new THREE.Group();
            group.add(crystalMesh);
            group.add(ringMesh);
            group.add(letterSprite);
            return group;
        }

        // Initialize WebGL Scene
        function initThree() {
            const container = document.getElementById('canvas-container');
            if (!container) return;

            const width = container.clientWidth;
            const height = container.clientHeight;

            // Setup Scene, Camera, Renderer
            scene = new THREE.Scene();
            scene.fog = new THREE.FogExp2(0x111827, 0.02); // fade obstacles into distance with dark ink fog

            camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 100);
            camera.position.set(0, 3.5, 8.5);
            camera.lookAt(0, 1, 0);

            renderer = new THREE.WebGLRenderer({ antialias: true, canvas: document.getElementById('game-canvas') });
            renderer.setSize(width, height);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

            // Lights
            const ambient = new THREE.AmbientLight(0xffffff, 0.4);
            scene.add(ambient);

            const dirLight = new THREE.DirectionalLight(0xffffff, 0.8);
            dirLight.position.set(5, 10, 7);
            scene.add(dirLight);

            // Grid road visual
            roadGridLines = [];
            const lineCount = 12;
            const lineSpacing = 4.5;
            for (let i = 0; i < lineCount; i++) {
                const geom = new THREE.BufferGeometry().setFromPoints([
                    new THREE.Vector3(-3.2, 0, 0),
                    new THREE.Vector3(3.2, 0, 0)
                ]);
                const mat = new THREE.LineBasicMaterial({ color: 0x16A34A, transparent: true, opacity: 0.6 }); // Englishify green-dark line
                const line = new THREE.Line(geom, mat);
                line.position.z = -i * lineSpacing;
                scene.add(line);
                roadGridLines.push(line);
            }

            // Left/Right highway boundaries
            const leftBoundGeom = new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(-3.2, 0, 10),
                new THREE.Vector3(-3.2, 0, -50)
            ]);
            const rightBoundGeom = new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(3.2, 0, 10),
                new THREE.Vector3(3.2, 0, -50)
            ]);
            const borderMat = new THREE.LineBasicMaterial({ color: 0x22C55E, linewidth: 2 }); // Englishify green
            scene.add(new THREE.Line(leftBoundGeom, borderMat));
            scene.add(new THREE.Line(rightBoundGeom, borderMat));

            // Lane dividers (guide lines)
            const laneDivLeftGeom = new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(-1.0, 0, 10),
                new THREE.Vector3(-1.0, 0, -50)
            ]);
            const laneDivRightGeom = new THREE.BufferGeometry().setFromPoints([
                new THREE.Vector3(1.0, 0, 10),
                new THREE.Vector3(1.0, 0, -50)
            ]);
            const dividerMat = new THREE.LineBasicMaterial({ color: 0x111827 }); // Englishify ink
            scene.add(new THREE.Line(laneDivLeftGeom, dividerMat));
            scene.add(new THREE.Line(laneDivRightGeom, dividerMat));

            // Stars background
            const starsGeom = new THREE.BufferGeometry();
            const starsCount = 200;
            const starPositions = new Float32Array(starsCount * 3);
            for (let i = 0; i < starsCount * 3; i += 3) {
                starPositions[i] = (Math.random() - 0.5) * 45; // X
                starPositions[i + 1] = Math.random() * 15 + 1.5; // Y
                starPositions[i + 2] = (Math.random() - 0.5) * 60; // Z
            }
            starsGeom.setAttribute('position', new THREE.BufferAttribute(starPositions, 3));
            const starMat = new THREE.PointsMaterial({ color: 0xffffff, size: 0.12, transparent: true, opacity: 0.7 });
            const stars = new THREE.Points(starsGeom, starMat);
            scene.add(stars);

            // Player mesh
            const playerGeom = new THREE.IcosahedronGeometry(0.55, 1);
            const playerMat = new THREE.MeshStandardMaterial({
                color: 0x22C55E, // Englishify green
                emissive: 0x16A34A, // Englishify green-dark
                emissiveIntensity: 0.8,
                roughness: 0.1,
                metalness: 0.8
            });
            playerMesh = new THREE.Mesh(playerGeom, playerMat);
            playerMesh.position.y = 0.55;

            // Halo below player
            const playerRingGeom = new THREE.RingGeometry(0.35, 0.45, 16);
            const playerRingMat = new THREE.MeshBasicMaterial({ color: 0x22C55E, side: THREE.DoubleSide, transparent: true, opacity: 0.45 });
            const playerRing = new THREE.Mesh(playerRingGeom, playerRingMat);
            playerRing.rotation.x = Math.PI / 2;
            playerRing.position.y = 0.01;

            playerGroup = new THREE.Group();
            playerGroup.add(playerMesh);
            playerGroup.add(playerRing);
            
            // Set starting position (lane indices are 0: left=-2, 1: center=0, 2: right=2)
            currentLaneIndex = 1;
            playerGroup.position.set(0, 0, 5.0);
            scene.add(playerGroup);

            // Reset dynamic structures
            currentWave = [];
            particles = [];
            cameraShake = 0;

            // Listen for window resize
            window.addEventListener('resize', onWindowResize);

            // Start animation loop
            animate();
        }

        // Resize handler
        function onWindowResize() {
            const container = document.getElementById('canvas-container');
            if (!container) return;
            const width = container.clientWidth;
            const height = container.clientHeight;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        }

        // Spawn a new obstacle wave (3 crystals - 1 correct, 2 incorrect)
        function spawnWave(correctChar, correctLaneIdx) {
            clearWave();

            const alphabets = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const lanes = [-2, 0, 2];

            lanes.forEach((laneX, index) => {
                const isCorrect = (index === correctLaneIdx);
                let char = correctChar;

                if (!isCorrect) {
                    do {
                        char = alphabets[Math.floor(Math.random() * 26)];
                    } while (char === correctChar);
                }

                // Dynamic premium colors per category
                const colorStr = gameInstance.categoryColors[gameInstance.selectedCategory] || '#22C55E';
                const crystal = createCrystal(char, colorStr);
                crystal.position.set(laneX, 0, -42); // start far back
                scene.add(crystal);

                currentWave.push({
                    group: crystal,
                    laneX: laneX,
                    char: char,
                    isCorrect: isCorrect,
                    collected: false
                });
            });
        }

        // Clear active wave meshes
        function clearWave() {
            currentWave.forEach(c => {
                scene.remove(c.group);
                c.group.traverse(node => {
                    if (node.geometry) node.geometry.dispose();
                    if (node.material) {
                        if (Array.isArray(node.material)) {
                            node.material.forEach(m => m.dispose());
                        } else {
                            node.material.dispose();
                        }
                    }
                });
            });
            currentWave = [];
        }

        // Physics Particle Blast
        function spawnExplosion(x, y, z, colorStr) {
            const count = 25;
            const geom = new THREE.BoxGeometry(0.12, 0.12, 0.12);
            const mat = new THREE.MeshBasicMaterial({ color: new THREE.Color(colorStr), transparent: true, opacity: 1 });

            for (let i = 0; i < count; i++) {
                const mesh = new THREE.Mesh(geom, mat.clone());
                mesh.position.set(x, y, z);
                
                const velocity = new THREE.Vector3(
                     (Math.random() - 0.5) * 0.22,
                     (Math.random() - 0.2) * 0.25 + 0.1,
                     (Math.random() - 0.5) * 0.22
                );

                scene.add(mesh);
                particles.push({
                    mesh: mesh,
                    velocity: velocity,
                    life: 1.0,
                    decay: Math.random() * 0.035 + 0.015
                });
            }
        }

        let lastMoveTime = 0;
        function moveLeft() {
            const now = Date.now();
            if (now - lastMoveTime < 150) return;
            lastMoveTime = now;

            if (currentLaneIndex > 0) {
                currentLaneIndex--;
                playSound('move');
            }
        }

        function moveRight() {
            const now = Date.now();
            if (now - lastMoveTime < 150) return;
            lastMoveTime = now;

            if (currentLaneIndex < 2) {
                currentLaneIndex++;
                playSound('move');
            }
        }

        // Main WebGL Game tick/rendering loop
        function animate() {
            animationFrameId = requestAnimationFrame(animate);

            // Cycle the road highway grid lines to simulate speed
            const gridSpacing = 4.5;
            roadGridLines.forEach(line => {
                line.position.z += crystalSpeed;
                if (line.position.z > 8.5) {
                    line.position.z -= roadGridLines.length * gridSpacing;
                }
            });

            // Slowly rotate player energy sphere
            if (playerMesh) {
                playerMesh.rotation.x += 0.025;
                playerMesh.rotation.y += 0.015;
            }

            // Interpolate player mesh to the target lane position
            if (playerGroup) {
                const targetX = laneXs[currentLaneIndex];
                playerGroup.position.x = THREE.MathUtils.lerp(playerGroup.position.x, targetX, 0.22);
            }

            // Move and update obstacles
            currentWave.forEach(c => {
                c.group.position.z += crystalSpeed;
                c.group.children[0].rotation.x += 0.02;
                c.group.children[0].rotation.y += 0.03;

                // Collision detection
                if (!c.collected && c.group.position.z >= 4.4 && c.group.position.z <= 5.6) {
                    const playerX = laneXs[currentLaneIndex];
                    if (Math.abs(c.laneX - playerX) < 0.6) {
                        c.collected = true;
                        handleCollision(c);
                    }
                }
            });

            // Wave passed beyond player without collection
            if (currentWave.length > 0 && currentWave[0].group.position.z > 7.2) {
                clearWave();
                setTimeout(() => {
                    if (gameInstance && gameInstance.gameState === 'playing') {
                        gameInstance.spawnNextWaveForCurrentLetter();
                    }
                }, 500);
            }

            // Update explosion particles
            for (let i = particles.length - 1; i >= 0; i--) {
                const p = particles[i];
                p.mesh.position.add(p.velocity);
                p.velocity.y -= 0.006;
                p.life -= p.decay;
                p.mesh.material.opacity = p.life;
                p.mesh.scale.setScalar(p.life);

                if (p.life <= 0) {
                    scene.remove(p.mesh);
                    p.mesh.geometry.dispose();
                    p.mesh.material.dispose();
                    particles.splice(i, 1);
                }
            }

            // Screen shake effect
            camera.position.set(0, 3.5, 8.5);
            camera.lookAt(0, 1, 0);
            if (cameraShake > 0) {
                camera.position.x += (Math.random() - 0.5) * cameraShake;
                camera.position.y += (Math.random() - 0.5) * cameraShake;
                cameraShake *= 0.85;
                if (cameraShake < 0.01) cameraShake = 0;
            }

            renderer.render(scene, camera);
        }

        // Collision logic
        function handleCollision(crystal) {
            if (crystal.isCorrect) {
                playSound('correct');
                const expColor = gameInstance.categoryColors[gameInstance.selectedCategory] || '#22C55E';
                spawnExplosion(crystal.laneX, 0.5, 5, expColor);
                gameInstance.collectLetter(crystal.char);
            } else {
                playSound('wrong');
                spawnExplosion(crystal.laneX, 0.5, 5, '#EF4444');
                cameraShake = 0.45;
                gameInstance.deductLife();
                
                clearWave();
                setTimeout(() => {
                    if (gameInstance && gameInstance.gameState === 'playing') {
                        gameInstance.spawnNextWaveForCurrentLetter();
                    }
                }, 600);
            }
        }

        // Clean up memory and cancel rendering
        function stopThree() {
            if (animationFrameId) {
                cancelAnimationFrame(animationFrameId);
                animationFrameId = null;
            }
            clearWave();
            particles.forEach(p => {
                scene.remove(p.mesh);
                p.mesh.geometry.dispose();
                p.mesh.material.dispose();
            });
            particles = [];
            
            if (playerGroup) {
                scene.remove(playerGroup);
                playerMesh.geometry.dispose();
                playerMesh.material.dispose();
                playerGroup = null;
            }
            
            if (renderer) {
                renderer.dispose();
                renderer = null;
            }
            window.removeEventListener('resize', onWindowResize);
        }

        // Alpine.js game controller definition
        function collector3DGame() {
            return {
                gameState: 'select_category',
                selectedCategory: null,
                score: 0,
                highScore: 0,
                lives: 3,
                currentWordIndex: 0,
                currentLetterIndex: 0,
                targetWord: '',
                spelledWord: '',
                clue: '',
                bgmEnabled: true,
                bgmPlaying: false,
                categoryColors: {
                    vocabulary: '#3B82F6', // Blue for listening/vocab
                    grammar: '#EAB308',    // Yellow for grammar/streak
                    synonyms: '#8B5CF6'    // Purple for synonyms/writing
                },
                categories: {
                    vocabulary: {
                        title: "Academic Vocabulary",
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
                        title: "Grammar Terms",
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
                        title: "English Synonyms",
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
                },

                init() {
                    gameInstance = this;
                    const savedHighScore = localStorage.getItem('toefl_game3d_highscore');
                    if (savedHighScore) {
                        this.highScore = parseInt(savedHighScore) || 0;
                    }

                    // Set BGM Volume
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm) {
                        bgm.volume = 1.0;
                    }

                    // Handle keyboard controls
                    window.addEventListener('keydown', (e) => {
                        if (this.gameState !== 'playing') return;
                        if (e.repeat) return;
                        if (e.key === 'ArrowLeft' || e.key.toLowerCase() === 'a') {
                            moveLeft();
                        } else if (e.key === 'ArrowRight' || e.key.toLowerCase() === 'd') {
                            moveRight();
                        }
                    });
                },

                playBgm() {
                    const bgm = document.getElementById('bgm-audio');
                    if (bgm && this.bgmEnabled && !this.bgmPlaying) {
                        bgm.play().then(() => {
                            this.bgmPlaying = true;
                        }).catch(err => {
                            console.log("BGM play blocked by browser:", err);
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
                    this.lives = 3;
                    this.currentWordIndex = 0;
                    this.gameState = 'playing';
                    
                    this.playBgm();

                    this.$nextTick(() => {
                        initThree();
                        this.loadWord();
                    });
                },

                loadWord() {
                    const wordsList = this.categories[this.selectedCategory].words;
                    const wordObj = wordsList[this.currentWordIndex];
                    this.targetWord = wordObj.word;
                    this.clue = wordObj.clue;
                    this.currentLetterIndex = 0;
                    this.spelledWord = '';

                    this.spawnNextWaveForCurrentLetter();
                },

                spawnNextWaveForCurrentLetter() {
                    if (this.gameState !== 'playing') return;
                    const correctChar = this.targetWord[this.currentLetterIndex];
                    const correctLane = Math.floor(Math.random() * 3);
                    spawnWave(correctChar, correctLane);
                },

                collectLetter(char) {
                    this.spelledWord += char;
                    this.score += 50;
                    this.currentLetterIndex++;

                    if (this.currentLetterIndex >= this.targetWord.length) {
                        playSound('win');
                        this.score += 150;

                        setTimeout(() => {
                            this.currentWordIndex++;
                            const wordsList = this.categories[this.selectedCategory].words;
                            if (this.currentWordIndex >= wordsList.length) {
                                this.handleWin();
                            } else {
                                this.loadWord();
                            }
                        }, 800);
                    } else {
                        this.spawnNextWaveForCurrentLetter();
                    }
                },

                deductLife() {
                    this.lives--;
                    if (this.lives <= 0) {
                        this.handleGameOver();
                    }
                },

                handleGameOver() {
                    this.gameState = 'game_over';
                    this.pauseBgm();
                    if (this.score > this.highScore) {
                        this.highScore = this.score;
                        localStorage.setItem('toefl_game3d_highscore', this.highScore);
                    }
                    stopThree();
                },

                handleWin() {
                    this.gameState = 'win_all';
                    this.pauseBgm();
                    if (this.score > this.highScore) {
                        this.highScore = this.score;
                        localStorage.setItem('toefl_game3d_highscore', this.highScore);
                    }
                    stopThree();
                },

                quitGame() {
                    if (confirm("Apakah Anda yakin ingin keluar dari permainan? Skor Anda saat ini tidak akan disimpan.")) {
                        this.gameState = 'select_category';
                        this.pauseBgm();
                        stopThree();
                    }
                },

                handleCanvasClick(event) {
                    if (this.gameState !== 'playing') return;
                    
                    const width = window.innerWidth;
                    const clickX = event.clientX;
                    
                    if (clickX < width / 2) {
                        moveLeft();
                    } else {
                        moveRight();
                    }
                }
            };
        }
    </script>
</x-app-layout>
