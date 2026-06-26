<x-app-layout>
    <div class="py-12 bg-surface min-h-screen font-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-ink rounded-lg shadow-card overflow-hidden text-white border border-hairline relative min-h-[160px]">
                <!-- Decorative Koala Background Image on the right -->
                <div class="absolute right-0 top-0 bottom-0 w-full sm:w-1/2 md:w-5/12 h-full z-0">
                    <img src="{{ asset('images/koala.png') }}" class="w-full h-full object-cover object-center opacity-70" alt="Koala Background">
                    <!-- overlay gradient to blend with the dark background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/60 to-transparent"></div>
                </div>

                <div class="p-8 md:p-10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 relative z-10">
                    <div class="space-y-2 max-w-xl md:max-w-2xl">
                        <h3 class="text-2xl md:text-3xl font-bold tracking-tight text-white font-body">Pusat Pembelajaran Englishify</h3>
                        <p class="text-white/70 text-sm md:text-base font-normal font-body">
                            Tingkatkan pemahaman tata bahasa, strategi mendengarkan, dan teknik membaca cepat dengan panduan materi terstruktur di bawah ini.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Interactive filter interface -->
            <div x-data="{ activeCategory: 'all' }" class="space-y-6">
                <!-- Category Tabs Navigation -->
                <div class="flex flex-wrap gap-2 border-b border-hairline pb-4 font-body">
                    <button @click="activeCategory = 'all'" 
                            :class="activeCategory === 'all' ? 'bg-green text-white border-green shadow-sm' : 'bg-canvas border border-hairline text-muted hover:bg-green-light/10 hover:text-green-dark'"
                            class="px-5 py-2.5 rounded-md text-sm font-semibold transition duration-120 cursor-pointer border">
                        Semua Topik
                    </button>
                    <button @click="activeCategory = 'listening'" 
                            :class="activeCategory === 'listening' ? 'bg-green text-white border-green shadow-sm' : 'bg-canvas border border-hairline text-muted hover:bg-green-light/10 hover:text-green-dark'"
                            class="px-5 py-2.5 rounded-md text-sm font-semibold transition duration-120 cursor-pointer border">
                        Listening
                    </button>
                    <button @click="activeCategory = 'structure'" 
                            :class="activeCategory === 'structure' ? 'bg-green text-white border-green shadow-sm' : 'bg-canvas border border-hairline text-muted hover:bg-green-light/10 hover:text-green-dark'"
                            class="px-5 py-2.5 rounded-md text-sm font-semibold transition duration-120 cursor-pointer border">
                        Structure & Grammar
                    </button>
                    <button @click="activeCategory = 'reading'" 
                            :class="activeCategory === 'reading' ? 'bg-green text-white border-green shadow-sm' : 'bg-canvas border border-hairline text-muted hover:bg-green-light/10 hover:text-green-dark'"
                            class="px-5 py-2.5 rounded-md text-sm font-semibold transition duration-120 cursor-pointer border">
                        Reading
                    </button>
                </div>

                <!-- Grid Catalog Card -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($materials as $material)
                        <div x-show="activeCategory === 'all' || activeCategory === '{{ $material->category }}'"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform translate-y-4"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             class="bg-canvas rounded-lg border border-hairline shadow-card p-6 flex flex-col justify-between hover:shadow-md hover:-translate-y-0.5 transition duration-120 font-body">
                             
                             <div>
                                 <!-- Header Card: Icon and badge -->
                                 <div class="flex items-center justify-between mb-4">
                                     <div class="w-10 h-10 rounded-md flex items-center justify-center 
                                                 @if($material->category === 'listening') bg-blue-light text-blue 
                                                 @elseif($material->category === 'structure') bg-purple-light text-purple 
                                                 @else bg-green-light text-green-dark @endif">
                                         @if($material->category === 'listening')
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                               <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                             </svg>
                                         @elseif($material->category === 'structure')
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                               <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                             </svg>
                                         @else
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                               <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                             </svg>
                                         @endif
                                     </div>
                                     <div class="flex items-center gap-2">
                                         <span class="text-[11px] font-semibold px-3 py-1 rounded-pill uppercase tracking-wider
                                                      @if($material->category === 'listening') bg-blue-light text-blue
                                                      @elseif($material->category === 'structure') bg-purple-light text-purple
                                                      @else bg-green-light text-green-dark @endif">
                                             @if($material->category === 'listening') Listening
                                             @elseif($material->category === 'structure') Structure
                                             @else Reading @endif
                                         </span>
                                         <span class="flex items-center gap-1 text-[11px] font-semibold text-muted font-normal">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                               <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                             </svg>
                                             {{ $material->read_time }} min
                                         </span>
                                     </div>
                                 </div>

                                 <!-- Title & Description -->
                                 <h4 class="text-lg font-bold text-ink mb-2">{{ $material->title }}</h4>
                                 <p class="text-xs text-muted leading-relaxed mb-6 font-body font-normal">{{ $material->description }}</p>
                             </div>

                             <!-- Button Link -->
                             <div>
                                 <a href="{{ route('material.show', $material->slug) }}" 
                                    class="inline-flex w-full items-center justify-center gap-1.5 px-4 py-2.5 rounded-md border border-green hover:border-green-dark bg-transparent hover:bg-green-light/10 text-xs font-semibold text-green-dark transition duration-120 cursor-pointer shadow-sm">
                                     <span>Mulai Belajar</span>
                                     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3.5 h-3.5">
                                       <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                     </svg>
                                 </a>
                             </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
