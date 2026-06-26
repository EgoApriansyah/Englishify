<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-2 font-body">
            <a href="{{ route('material.index') }}" class="text-muted hover:text-green-dark transition-all duration-120">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
            <h2 class="font-bold text-xl text-ink leading-tight">
                {{ $material->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-surface min-h-screen font-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Left Column: Sidebar list of topics -->
                <div class="lg:col-span-1 font-body">
                    <div class="bg-canvas rounded-lg border border-hairline p-5 shadow-card sticky top-24 space-y-4">
                        <h4 class="font-bold text-ink text-xs uppercase tracking-wider border-b border-hairline pb-3 font-body">Daftar Topik Materi</h4>
                        
                        <div class="flex flex-col gap-1.5 font-body">
                            @foreach($allMaterials as $m)
                                @php $isActive = ($m->id === $material->id); @endphp
                                <a href="{{ route('material.show', $m->slug) }}" 
                                   class="px-3.5 py-2.5 rounded-md text-xs font-semibold transition-all duration-120 flex items-center justify-between cursor-pointer
                                          {{ $isActive ? 'bg-green text-white shadow-sm' : 'text-muted hover:bg-green-light/10 hover:text-green-dark font-normal' }}">
                                    <span class="truncate pr-2 font-body">{{ $m->title }}</span>
                                    @if($m->category === 'listening')
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 font-body {{ $isActive ? 'bg-green-dark text-white font-bold' : 'bg-surface text-muted border border-hairline font-normal' }}">LIS</span>
                                    @elseif($m->category === 'structure')
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 font-body {{ $isActive ? 'bg-green-dark text-white font-bold' : 'bg-surface text-muted border border-hairline font-normal' }}">STR</span>
                                    @else
                                        <span class="px-1.5 py-0.5 rounded text-[9px] uppercase tracking-wide shrink-0 font-body {{ $isActive ? 'bg-green-dark text-white font-bold' : 'bg-surface text-muted border border-hairline font-normal' }}">RDG</span>
                                    @endif
                                </a>
                            @endforeach
                        </div>

                        <div class="pt-2 font-body">
                            <a href="{{ route('material.index') }}" class="text-xs font-semibold text-green hover:text-green-dark flex items-center gap-1 transition-all duration-120">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                                </svg>
                                <span>Kembali ke Katalog</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Material Content Detail -->
                <div class="lg:col-span-3 space-y-6 font-body">
                    <div class="bg-canvas rounded-lg border border-hairline p-6 md:p-8 shadow-card space-y-6">
                        
                        <!-- Header Detail -->
                        <div class="flex flex-wrap items-center justify-between gap-4 pb-5 border-b border-hairline font-body">
                            <div class="space-y-1.5">
                                <span class="text-[10px] font-semibold px-3 py-1 rounded-pill uppercase tracking-wider font-body
                                             @if($material->category === 'listening') bg-blue-light text-blue
                                             @elseif($material->category === 'structure') bg-purple-light text-purple
                                             @else bg-green-light text-green-dark @endif">
                                    @if($material->category === 'listening') Listening Comprehension
                                    @elseif($material->category === 'structure') Structure & Written Expression
                                    @else Reading Comprehension @endif
                                </span>
                                <h3 class="text-2xl md:text-3xl font-bold text-ink leading-snug font-body">{{ $material->title }}</h3>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs font-semibold text-muted shrink-0 font-normal font-body">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span>Estimasi waktu baca: {{ $material->read_time }} menit</span>
                            </div>
                        </div>

                        <!-- Rendered HTML Content -->
                        <div class="text-ink leading-relaxed text-sm md:text-base space-y-5 select-text font-body font-normal">
                            {!! $material->content !!}
                        </div>

                        <!-- Interactive Complete Button -->
                        <div x-data="{ completed: localStorage.getItem('material_completed_{{ $material->id }}') === 'true' }" 
                             class="pt-6 border-t border-hairline flex flex-col sm:flex-row justify-between items-center gap-4 font-body">
                            <div>
                                <template x-if="completed">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-green-dark bg-green-light px-3.5 py-2 rounded-pill shadow-sm font-body">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                        Materi Selesai Dipelajari
                                    </span>
                                </template>
                                <template x-if="!completed">
                                    <span class="text-xs text-muted font-semibold font-body font-normal">Tandai materi ini jika Anda telah selesai mempelajarinya.</span>
                                </template>
                            </div>
                            <button @click="completed = !completed; localStorage.setItem('material_completed_{{ $material->id }}', completed)"
                                    :class="completed ? 'bg-surface hover:bg-green-light/10 text-muted border-hairline' : 'bg-green hover:bg-green-dark text-white shadow-sm border-transparent'"
                                    class="w-full sm:w-auto px-5 py-2.5 rounded-md text-xs font-semibold transition duration-120 border flex items-center justify-center gap-1.5 cursor-pointer">
                                <span x-text="completed ? 'Batalkan Status Selesai' : 'Tandai Selesai Belajar'"></span>
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
