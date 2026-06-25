<x-app-layout>

    <div class="py-12" x-data="{ modalOpen: false, activeVideo: null }">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Main Content Container Card -->
            <div class="relative overflow-hidden bg-white rounded-3xl border border-slate-200/80 shadow-xl p-6 md:p-10 space-y-12">
                <!-- Decorative background glows -->
                <div class="absolute top-0 left-1/4 w-72 h-72 bg-indigo-50 rounded-full blur-3xl opacity-60 pointer-events-none -translate-y-1/2"></div>
                <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-emerald-50 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                <div class="relative z-10 space-y-10">
                    <!-- Header Panel -->
                    <div class="text-center space-y-3 max-w-xl mx-auto">
                        <div class="inline-flex p-3 bg-indigo-50 border border-indigo-100 text-indigo-650 rounded-2xl shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8 text-indigo-600 animate-pulse">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl md:text-3.5xl font-black text-slate-800 tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900">Practice Mode (Latihan Menyimak)</h3>
                        <p class="text-sm text-slate-500 leading-relaxed font-medium">
                            Tingkatkan kemampuan mendengarkan, mengeja, dan berbicara bahasa Inggris Anda secara mandiri menggunakan video pembelajaran interaktif.
                        </p>
                    </div>

                    <!-- Video Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($videos as $video)
                            @php
                                $diffColor = '';
                                if ($video->difficulty === 'Easy') {
                                    $diffColor = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                } elseif ($video->difficulty === 'Medium') {
                                    $diffColor = 'bg-amber-50 text-amber-700 border-amber-200';
                                } else {
                                    $diffColor = 'bg-rose-50 text-rose-700 border-rose-200';
                                }
                            @endphp
                            <div class="bg-white border border-slate-200/80 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:border-indigo-150 transition-all duration-300 group flex flex-col h-full">
                                <!-- Video Thumbnail Overlay -->
                                <div class="relative cursor-pointer overflow-hidden aspect-video bg-slate-900" 
                                     @click="activeVideo = {{ json_encode($video) }}; modalOpen = true;">
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/mqdefault.jpg" 
                                         alt="{{ $video->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300 opacity-85">
                                    
                                    <!-- Thumbnail gradient overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                                    
                                    <!-- Play Hover Button -->
                                    <div class="absolute inset-0 flex items-center justify-center opacity-90 group-hover:opacity-100 group-hover:scale-110 transition-all duration-300">
                                        <div class="p-4 bg-indigo-600/90 text-white rounded-full shadow-lg shadow-indigo-600/30 backdrop-blur-sm border border-white/20">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                              <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Duration Badge -->
                                    <span class="absolute bottom-3 right-3 px-2 py-0.5 bg-slate-900/85 text-white font-bold text-[10px] rounded-lg tracking-wider border border-white/10">{{ $video->duration }}</span>
                                </div>

                                <!-- Card Content -->
                                <div class="p-6 flex flex-col flex-grow space-y-3">
                                    <!-- Badges -->
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2.5 py-0.5 border text-[10px] font-black rounded-full uppercase tracking-wider {{ $diffColor }}">
                                            {{ $video->difficulty }}
                                        </span>
                                        <span class="px-2.5 py-0.5 bg-indigo-50 border border-indigo-100 text-indigo-700 text-[10px] font-black rounded-full uppercase tracking-wider">
                                            {{ $video->category }}
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h4 class="font-extrabold text-slate-800 text-base line-clamp-2 leading-tight group-hover:text-indigo-600 transition-colors duration-300">
                                        {{ $video->title }}
                                    </h4>

                                    <!-- Description -->
                                    <p class="text-xs text-slate-400 font-medium line-clamp-3 leading-relaxed flex-grow">
                                        {{ $video->description }}
                                    </p>

                                    <!-- Action Button -->
                                    <button class="w-full mt-4 py-2.5 bg-slate-50 hover:bg-indigo-600 hover:text-white border border-slate-200/80 hover:border-indigo-600 text-slate-700 font-extrabold text-xs rounded-xl shadow-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
                                            @click="activeVideo = {{ json_encode($video) }}; modalOpen = true;">
                                        Mulai Latihan
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-3.5 h-3.5">
                                          <path fill-rule="evenodd" d="M3 10a.75.75 0 0 1 .75-.75h10.638L10.23 5.29a.75.75 0 1 1 1.04-1.08l5.5 5.25a.75.75 0 0 1 0 1.08l-5.5 5.25a.75.75 0 1 1-1.04-1.08l4.158-3.96H3.75A.75.75 0 0 1 3 10Z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

        <!-- Mode Selection Modal -->
        <div class="fixed inset-0 z-50 overflow-y-auto" 
             x-show="modalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             style="display: none;">
            
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="modalOpen = false"></div>

            <!-- Modal Content Wrapper -->
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div class="relative bg-white rounded-3xl max-w-2xl w-full p-6 md:p-8 text-left shadow-2xl border border-slate-100 transform transition-all overflow-hidden"
                     x-show="modalOpen"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <!-- Close Button -->
                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-650 p-1 rounded-full hover:bg-slate-100 transition-colors" 
                            @click="modalOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <!-- Video Preview Info -->
                    <template x-if="activeVideo">
                        <div class="space-y-6">
                            <div class="flex flex-col md:flex-row gap-5 items-start">
                                <!-- Small Thumbnail Preview -->
                                <div class="w-full md:w-48 aspect-video rounded-2xl overflow-hidden bg-slate-900 border border-slate-100 shrink-0 relative">
                                    <img :src="'https://img.youtube.com/vi/' + activeVideo.youtube_id + '/mqdefault.jpg'" 
                                         alt="" class="w-full h-full object-cover opacity-90">
                                </div>
                                <!-- Video Title and Description -->
                                <div class="space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-0.5 border text-[9px] font-black rounded-full uppercase tracking-wider"
                                              :class="activeVideo.difficulty === 'Easy' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : (activeVideo.difficulty === 'Medium' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-rose-50 text-rose-700 border-rose-200')"
                                              x-text="activeVideo.difficulty"></span>
                                        <span class="px-2 py-0.5 bg-slate-100 text-slate-600 border border-slate-200 text-[9px] font-black rounded-full uppercase tracking-wider" 
                                              x-text="activeVideo.category"></span>
                                        <span class="text-[10px] text-slate-400 font-bold" x-text="'⏱️ ' + activeVideo.duration"></span>
                                    </div>
                                    <h3 class="font-extrabold text-lg text-slate-800 leading-tight" x-text="activeVideo.title"></h3>
                                    <p class="text-xs text-slate-400 font-medium leading-relaxed" x-text="activeVideo.description"></p>
                                </div>
                            </div>

                            <hr class="border-slate-100">

                            <!-- Option Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Shadowing Option -->
                                <a :href="'/practice/' + activeVideo.id + '/shadowing'"
                                   class="border-2 border-indigo-100 hover:border-indigo-500 bg-indigo-50/10 hover:bg-indigo-50/20 p-5 rounded-2xl flex flex-col space-y-3 transition-all duration-200 group text-left">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-650 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                        </svg>
                                    </div>
                                    <h4 class="font-extrabold text-slate-850 text-sm md:text-base">Shadowing Practice</h4>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                                        Latih kelancaran berbicara & pengucapan (*pronunciation*) dengan membaca teks transkrip aktif secara real-time mengikuti video pembicara.
                                    </p>
                                </a>

                                <!-- Dictation Option -->
                                <a :href="'/practice/' + activeVideo.id + '/dictation'"
                                   class="border-2 border-emerald-100 hover:border-emerald-500 bg-emerald-50/10 hover:bg-emerald-50/20 p-5 rounded-2xl flex flex-col space-y-3 transition-all duration-200 group text-left">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-650 flex items-center justify-center group-hover:scale-105 transition-transform duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </div>
                                    <h4 class="font-extrabold text-slate-850 text-sm md:text-base">Dictation Practice</h4>
                                    <p class="text-[11px] text-slate-400 font-medium leading-relaxed">
                                        Latih kepekaan dengar & ketepatan mengeja kata dengan melengkapi kata-kata kosong yang sengaja dihilangkan dari potongan video.
                                    </p>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
