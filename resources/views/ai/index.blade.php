<x-app-layout>
    <div class="py-12 bg-surface min-h-screen font-body select-text">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Tanya AI Header -->
            <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-full bg-purple-light border border-purple/30 p-1 shadow-md overflow-hidden flex-shrink-0">
                        <img src="{{ asset('images/koala-nerd.png') }}" class="w-full h-full object-cover object-top rounded-full" alt="Koala Tutor">
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-ink">Tanya Koala Tutor</h2>
                        <p class="text-sm text-muted">Asisten AI bahasa Inggrismu yang selalu siap sedia.</p>
                    </div>
                </div>
            </div>

            <!-- Chat Container with Alpine.js -->
            <div x-data="aiChat()" x-init="initChat()" class="bg-canvas rounded-lg border border-hairline shadow-card overflow-hidden flex flex-col" style="height: 65vh; min-height: 500px;">
                
                <!-- Messages Area -->
                <div id="chat-messages" class="flex-1 overflow-y-auto p-4 md:p-6 space-y-6 bg-surface/50 scroll-smooth">
                    
                    <!-- Welcome Message (Always visible) -->
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-purple-light overflow-hidden flex-shrink-0 shadow-sm border border-purple/20">
                            <img src="{{ asset('images/koala-nerd.png') }}" class="w-full h-full object-cover object-top" alt="AI">
                        </div>
                        <div class="bg-canvas border border-hairline rounded-2xl rounded-tl-none px-4 py-3 shadow-sm max-w-[85%] md:max-w-[75%]">
                            <p class="text-ink text-sm leading-relaxed">Halo! Aku Koala, tutor bahasa Inggrismu. Ada materi TOEFL atau tata bahasa yang ingin kamu tanyakan hari ini? Boleh ketik atau pakai suara, lho! 🐨✨</p>
                        </div>
                    </div>

                    <!-- Dynamic Messages Loop -->
                    <template x-for="(msg, index) in messages" :key="index">
                        <div class="flex w-full" :class="msg.role === 'user' ? 'justify-end' : 'justify-start'">
                            <div class="flex items-start gap-3 max-w-[85%] md:max-w-[75%]" :class="msg.role === 'user' ? 'flex-row-reverse' : 'flex-row'">
                                
                                <!-- Avatar -->
                                <div class="w-8 h-8 rounded-full overflow-hidden flex-shrink-0 shadow-sm border border-hairline"
                                     :class="msg.role === 'user' ? 'bg-blue-light' : 'bg-purple-light border-purple/20'">
                                    <template x-if="msg.role === 'model'">
                                        <img src="{{ asset('images/koala-nerd.png') }}" class="w-full h-full object-cover object-top" alt="AI">
                                    </template>
                                    <template x-if="msg.role === 'user'">
                                        <div class="w-full h-full flex items-center justify-center text-blue font-bold text-xs uppercase">
                                            {{ substr(auth()->user()->name, 0, 2) }}
                                        </div>
                                    </template>
                                </div>

                                <!-- Message Bubble -->
                                <div class="px-4 py-3 shadow-sm text-sm leading-relaxed"
                                     :class="msg.role === 'user' ? 'bg-blue-600 text-white rounded-2xl rounded-tr-none' : 'bg-canvas border border-hairline text-ink rounded-2xl rounded-tl-none'"
                                     x-html="formatMessage(msg.text)">
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Loading Indicator -->
                    <div x-show="isLoading" class="flex items-start gap-3" style="display: none;">
                        <div class="w-8 h-8 rounded-full bg-purple-light overflow-hidden flex-shrink-0 shadow-sm border border-purple/20">
                            <img src="{{ asset('images/koala-nerd.png') }}" class="w-full h-full object-cover object-top" alt="AI">
                        </div>
                        <div class="bg-canvas border border-hairline rounded-2xl rounded-tl-none px-4 py-3 shadow-sm flex gap-1.5 items-center">
                            <div class="w-2 h-2 bg-purple rounded-full animate-bounce" style="animation-delay: 0s"></div>
                            <div class="w-2 h-2 bg-purple rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                            <div class="w-2 h-2 bg-purple rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-4 bg-canvas border-t border-hairline">
                    
                    <!-- Voice Recording Indicator -->
                    <div x-show="isRecording" class="flex items-center justify-center gap-2 mb-3 text-xs font-bold text-red animate-pulse" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                        </svg>
                        Sedang Mendengarkan...
                    </div>

                    <form @submit.prevent="sendMessage" class="flex gap-2 items-end">
                        
                        <!-- Mic Button -->
                        <button type="button" @click="toggleVoice()" 
                                :class="isRecording ? 'bg-red-light text-red border-red/30 animate-pulse' : 'bg-surface border-hairline text-muted hover:text-purple hover:bg-purple-light'"
                                class="w-12 h-12 flex-shrink-0 rounded-full border flex items-center justify-center transition duration-150 shadow-sm cursor-pointer"
                                title="Klik untuk berbicara">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                            </svg>
                        </button>

                        <!-- Text Input -->
                        <div class="relative flex-1">
                            <textarea x-model="inputText" 
                                      @keydown.enter.prevent="if(!$event.shiftKey) sendMessage()"
                                      rows="1" 
                                      placeholder="Tulis pertanyaanmu di sini..." 
                                      class="w-full bg-surface border border-hairline rounded-2xl py-3 pl-4 pr-12 focus:ring-2 focus:ring-purple/50 focus:border-purple resize-none overflow-hidden text-sm shadow-sm transition duration-150 h-[48px] max-h-[120px] scrollbar-hide"></textarea>
                            
                            <!-- Send Button (Inside Textarea) -->
                            <button type="submit" 
                                    :disabled="isLoading || inputText.trim() === ''"
                                    class="absolute right-2 bottom-1.5 p-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed transition duration-150 cursor-pointer shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4 transform -rotate-45 ml-0.5 mb-0.5">
                                  <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Alpine.js Component Script -->
    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('aiChat', () => ({
                messages: [],
                inputText: '',
                isLoading: false,
                isRecording: false,
                recognition: null,

                initChat() {
                    // Check if browser supports Web Speech API
                    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                    if (SpeechRecognition) {
                        this.recognition = new SpeechRecognition();
                        this.recognition.continuous = false;
                        this.recognition.interimResults = false;
                        this.recognition.lang = 'id-ID'; // Default to Indonesian but it catches English too

                        this.recognition.onstart = () => {
                            this.isRecording = true;
                        };

                        this.recognition.onresult = (event) => {
                            const transcript = event.results[0][0].transcript;
                            this.inputText += (this.inputText ? ' ' : '') + transcript;
                            
                            // Auto resize textarea
                            this.$nextTick(() => {
                                const ta = document.querySelector('textarea');
                                if(ta) {
                                    ta.style.height = 'auto';
                                    ta.style.height = (ta.scrollHeight) + 'px';
                                }
                            });
                        };

                        this.recognition.onerror = (event) => {
                            console.error('Speech recognition error', event.error);
                            this.isRecording = false;
                            
                            if (event.error === 'not-allowed') {
                                alert('Akses mikrofon diblokir. Silakan klik ikon gembok di address bar browser Anda dan izinkan mikrofon.');
                            } else if (event.error === 'network') {
                                alert('Browser Anda tidak dapat mengakses layanan pengenalan suara. Jika Anda menggunakan browser Brave, fitur ini mungkin diblokir oleh sistem privasi. Cobalah gunakan Google Chrome.');
                            } else if (event.error === 'no-speech') {
                                // Ignore no-speech, just quietly stop
                            } else {
                                alert('Terjadi kesalahan pengenalan suara: ' + event.error);
                            }
                        };

                        this.recognition.onend = () => {
                            this.isRecording = false;
                            // Optionally auto-send if they stopped talking
                            // if (this.inputText.trim() !== '') {
                            //     this.sendMessage();
                            // }
                        };
                    }
                },

                toggleVoice() {
                    if (!this.recognition) {
                        alert("Maaf, browser Anda tidak mendukung fitur input suara.");
                        return;
                    }

                    if (this.isRecording) {
                        this.recognition.stop();
                    } else {
                        try {
                            this.recognition.start();
                        } catch (e) {
                            console.error("Could not start recording:", e);
                        }
                    }
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        const container = document.getElementById('chat-messages');
                        container.scrollTop = container.scrollHeight;
                    });
                },

                formatMessage(text) {
                    // Basic Markdown to HTML conversion
                    let formatted = text
                        .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                        .replace(/\*(.*?)\*/g, '<em>$1</em>')
                        .replace(/\n/g, '<br>');
                    return formatted;
                },

                async sendMessage() {
                    const msg = this.inputText.trim();
                    if (!msg || this.isLoading) return;

                    // Add user message to UI
                    this.messages.push({ role: 'user', text: msg });
                    this.inputText = '';
                    
                    // Reset textarea height
                    const ta = document.querySelector('textarea');
                    if(ta) ta.style.height = '48px';
                    
                    this.isLoading = true;
                    this.scrollToBottom();

                    // Prepare history (limit to last 10 messages to save context limit)
                    const history = this.messages.slice(0, -1).slice(-10);

                    try {
                        const response = await fetch('{{ route('ai.chat') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: msg,
                                history: history
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.messages.push({ role: 'model', text: data.reply });
                        } else {
                            this.messages.push({ role: 'model', text: 'Oops! ' + (data.error || 'Terjadi kesalahan sistem.') });
                        }
                    } catch (error) {
                        console.error('Error fetching AI reply:', error);
                        this.messages.push({ role: 'model', text: 'Maaf, gagal terhubung ke server. Silakan coba lagi.' });
                    } finally {
                        this.isLoading = false;
                        this.scrollToBottom();
                    }
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
