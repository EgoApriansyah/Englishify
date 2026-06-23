<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2">
            <a href="{{ route('material.index') }}" class="text-slate-400 hover:text-indigo-600 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ $material->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Left Column: Sidebar list of topics -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm sticky top-24 space-y-4">
                        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wider border-b border-slate-100 pb-3">Daftar Topik Materi</h4>
                        
                        <div class="flex flex-col gap-1.5">
                            @foreach($allMaterials as $m)
                                @php $isActive = ($m->id === $material->id); @endphp
                                <a href="{{ route('material.show', $m->slug) }}" 
                                   class="px-3.5 py-2.5 rounded-xl text-xs font-bold transition-all duration-150 flex items-center justify-between
                                          {{ $isActive ? 'bg-indigo-600 text-white shadow-md shadow-indigo-600/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <span class="truncate pr-2">{{ $m->title }}</span>
                                    @if($m->category === 'listening')
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 {{ $isActive ? 'bg-indigo-500 text-white' : 'bg-slate-100 text-slate-500' }}">LIS</span>
                                    @elseif($m->category === 'structure')
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 {{ $isActive ? 'bg-indigo-500 text-white' : 'bg-slate-100 text-slate-500' }}">STR</span>
                                    @else
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 {{ $isActive ? 'bg-indigo-500 text-white' : 'bg-slate-100 text-slate-500' }}">RDG</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>

                        <div class="pt-2">
                            <a href="{{ route('material.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-700 flex items-center gap-1 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                                <span>Kembali ke Katalog</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Material Content Detail -->
                <div class="lg:col-span-3 space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 md:p-8 shadow-sm space-y-6">
                        
                        <!-- Header Detail -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-5 border-b border-slate-100">
                            <div class="space-y-1.5">
                                <span class="text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider
                                             @if($material->category === 'listening') bg-indigo-50 text-indigo-700
                                             @elseif($material->category === 'structure') bg-purple-50 text-purple-700
                                             @else bg-sky-50 text-sky-700 @endif">
                                    @if($material->category === 'listening') Listening Comprehension
                                    @elseif($material->category === 'structure') Structure & Written Expression
                                    @else Reading Comprehension @endif
                                </span>
                                <h3 class="text-2xl md:text-3xl font-extrabold text-slate-800 tracking-tight">{{ $material->title }}</h3>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs font-semibold text-slate-400 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Estimasi waktu baca: {{ $material->read_time }} menit</span>
                            </div>
                        </div>

                        <!-- Rendered HTML Content -->
                        <div class="text-slate-650 leading-relaxed text-sm md:text-base space-y-5">
                            {!! $material->content !!}
                        </div>

                        <!-- Interactive Complete Button -->
                        <div x-data="{ completed: localStorage.getItem('material_completed_{{ $material->id }}') === 'true' }" 
                             class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div>
                                <template x-if="completed">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3.5 py-2 rounded-xl border border-emerald-100/50 shadow-sm shadow-emerald-50/50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Materi Selesai Dipelajari
                                    </span>
                                </template>
                                <template x-if="!completed">
                                    <span class="text-xs text-slate-400 font-semibold">Tandai materi ini jika Anda telah selesai mempelajarinya.</span>
                                </template>
                            </div>
                            <button @click="completed = !completed; localStorage.setItem('material_completed_{{ $material->id }}', completed)"
                                    :class="completed ? 'bg-slate-100 hover:bg-slate-200 text-slate-600 border-slate-200' : 'bg-indigo-600 hover:bg-indigo-700 text-white shadow-md shadow-indigo-600/10 border-transparent'"
                                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl text-xs font-bold transition duration-200 border flex items-center justify-center gap-1.5 cursor-pointer">
                                <span x-text="completed ? 'Batalkan Status Selesai' : 'Tandai Selesai Belajar'"></span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
