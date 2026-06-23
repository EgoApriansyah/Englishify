<x-app-layout>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- solid Indigo Welcome Banner -->
            <div class="bg-indigo-900 rounded-2xl shadow-lg overflow-hidden text-white">
                <div class="p-8 md:p-10 flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <div class="space-y-2">
                        <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight">Pusat Pembelajaran TOEFL</h3>
                        <p class="text-indigo-100 text-sm md:text-base max-w-xl">
                            Tingkatkan pemahaman tata bahasa, strategi mendengarkan, dan teknik membaca cepat dengan panduan materi terstruktur di bawah ini.
                        </p>
                    </div>
                    <div class="shrink-0 bg-indigo-800/40 p-4 rounded-2xl border border-indigo-700/50">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-200">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Interative filter interface -->
            <div x-data="{ activeCategory: 'all' }" class="space-y-6">
                <!-- Category Tabs Navigation -->
                <div class="flex flex-wrap gap-2 border-b border-slate-200 pb-4">
                    <button @click="activeCategory = 'all'" 
                            :class="activeCategory === 'all' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition duration-200 cursor-pointer">
                        Semua Topik
                    </button>
                    <button @click="activeCategory = 'listening'" 
                            :class="activeCategory === 'listening' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition duration-200 cursor-pointer">
                        Listening
                    </button>
                    <button @click="activeCategory = 'structure'" 
                            :class="activeCategory === 'structure' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition duration-200 cursor-pointer">
                        Structure & Grammar
                    </button>
                    <button @click="activeCategory = 'reading'" 
                            :class="activeCategory === 'reading' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'bg-white border border-slate-200 text-slate-600 hover:bg-slate-50'"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition duration-200 cursor-pointer">
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
                             class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 flex flex-col justify-between hover:shadow-md hover:scale-[1.01] transition duration-200">
                             
                             <div>
                                 <!-- Header Card: Icon and badge -->
                                 <div class="flex items-center justify-between mb-4">
                                     <div class="w-10 h-10 rounded-xl flex items-center justify-center 
                                                 @if($material->category === 'listening') bg-indigo-50 text-indigo-600 
                                                 @elseif($material->category === 'structure') bg-purple-50 text-purple-600 
                                                 @else bg-sky-50 text-sky-600 @endif">
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
                                         <span class="text-[11px] font-bold px-3 py-1 rounded-full uppercase tracking-wider
                                                      @if($material->category === 'listening') bg-indigo-50 text-indigo-700
                                                      @elseif($material->category === 'structure') bg-purple-50 text-purple-700
                                                      @else bg-sky-50 text-sky-700 @endif">
                                             @if($material->category === 'listening') Listening
                                             @elseif($material->category === 'structure') Structure
                                             @else Reading @endif
                                         </span>
                                         <span class="flex items-center gap-1 text-[11px] font-semibold text-slate-400">
                                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                               <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                             </svg>
                                             {{ $material->read_time }} min
                                         </span>
                                     </div>
                                 </div>

                                 <!-- Title & Description -->
                                 <h4 class="text-lg font-bold text-slate-800 tracking-tight mb-2">{{ $material->title }}</h4>
                                 <p class="text-sm text-slate-500 leading-relaxed mb-6">{{ $material->description }}</p>
                             </div>

                             <!-- Button Link -->
                             <div>
                                 <a href="{{ route('material.show', $material->slug) }}" 
                                    class="inline-flex w-full items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-indigo-200 hover:border-indigo-600 bg-white hover:bg-indigo-50/30 text-xs font-bold text-indigo-600 hover:text-indigo-700 transition duration-200 cursor-pointer">
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
