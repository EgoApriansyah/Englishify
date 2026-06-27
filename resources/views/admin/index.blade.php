<x-app-layout>
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Panel Admin</h1>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-green-100 rounded-lg p-6 shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-green-600 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-700">Total Siswa</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalStudents }}</p>
                </div>
            </div>
        </div>
        <div class="bg-purple-100 rounded-lg p-6 shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-purple-600 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-700">Tes Selesai</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalCompletedTests }}</p>
                </div>
            </div>
        </div>
        <div class="bg-blue-100 rounded-lg p-6 shadow hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <svg class="w-8 h-8 text-blue-600 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-700">Rata‑Rata TOEFL</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $averageToeflScore }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Chart 1: TOEFL Score Distribution -->
        <div class="bg-white rounded-lg p-5 border border-gray-200 shadow hover:shadow-md transition-shadow flex flex-col justify-between">
            <div>
                <h3 class="text-md font-bold text-gray-800 mb-1">Distribusi Skor TOEFL</h3>
                <p class="text-xs text-gray-500 mb-4">Jumlah siswa berdasarkan rentang skor TOEFL</p>
            </div>
            <div class="h-64 relative">
                <canvas id="scoreDistChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Section Performance -->
        <div class="bg-white rounded-lg p-5 border border-gray-200 shadow hover:shadow-md transition-shadow flex flex-col justify-between">
            <div>
                <h3 class="text-md font-bold text-gray-800 mb-1">Kinerja Per Bagian</h3>
                <p class="text-xs text-gray-500 mb-4">Skor rata-rata berdasarkan section tes</p>
            </div>
            <div class="h-64 relative">
                <canvas id="sectionPerfChart"></canvas>
            </div>
        </div>

        <!-- Chart 3: Completion Trend -->
        <div class="bg-white rounded-lg p-5 border border-gray-200 shadow hover:shadow-md transition-shadow flex flex-col justify-between">
            <div>
                <h3 class="text-md font-bold text-gray-800 mb-1">Tren Nilai & Penyelesaian</h3>
                <p class="text-xs text-gray-500 mb-4">Penyelesaian tes harian dan perkembangan nilai rata-rata</p>
            </div>
            <div class="h-64 relative">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Main Content: User Table + Add User Form -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- User Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-medium text-gray-800">Daftar Akun</h2>
            </div>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Role</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Bergabung</th>
                        <th class="px-4 py-2 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $user->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $user->email }}</td>
                            <td class="px-4 py-2 text-sm text-gray-800 capitalize">{{ $user->role }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2 text-center">
                                @if (Auth::id() !== $user->id)
                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-400 text-sm">(Anda)</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-500">Tidak ada akun.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add User Form -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-medium text-gray-800 mb-4">Tambah Akun</h2>
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="name">Nama</label>
                    <input id="name" name="name" type="text" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="email">Email</label>
                    <input id="email" name="email" type="email" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="password">Password</label>
                    <input id="password" name="password" type="password" required minlength="8" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1" for="role">Role</label>
                    <select id="role" name="role" required class="mt-1 block w-full border-gray-300 bg-white rounded-md shadow-sm focus:border-green-500 focus:ring-green-500">
                        <option value="student">Student</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition-colors">
                    Tambah Akun
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. TOEFL Score Distribution Chart
        const scoreDistCtx = document.getElementById('scoreDistChart').getContext('2d');
        const scoreDistData = @json(array_values($scoreDistribution));
        const scoreDistLabels = @json(array_keys($scoreDistribution));
        
        new Chart(scoreDistCtx, {
            type: 'bar',
            data: {
                labels: scoreDistLabels,
                datasets: [{
                    label: 'Jumlah Siswa',
                    data: scoreDistData,
                    backgroundColor: 'rgba(16, 185, 129, 0.8)',
                    borderColor: '#10B981',
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#9CA3AF' },
                        grid: { borderDash: [4, 4], color: '#E5E7EB' }
                    },
                    x: {
                        ticks: { color: '#9CA3AF' },
                        grid: { display: false }
                    }
                }
            }
        });

        // 2. Section Performance Chart
        const sectionPerfCtx = document.getElementById('sectionPerfChart').getContext('2d');
        const sectionPerfData = @json(array_values($sectionPerformance));
        const sectionPerfLabels = @json(array_keys($sectionPerformance));

        new Chart(sectionPerfCtx, {
            type: 'bar',
            data: {
                labels: sectionPerfLabels,
                datasets: [{
                    label: 'Rata-Rata Nilai',
                    data: sectionPerfData,
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.8)', // Blue
                        'rgba(139, 92, 246, 0.8)', // Purple
                        'rgba(245, 158, 11, 0.8)'   // Yellow/Orange
                    ],
                    borderColor: [
                        '#3B82F6',
                        '#8B5CF6',
                        '#F59E0B'
                    ],
                    borderWidth: 1.5,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        min: 310,
                        max: 680,
                        ticks: { color: '#9CA3AF' },
                        grid: { borderDash: [4, 4], color: '#E5E7EB' }
                    },
                    x: {
                        ticks: { color: '#9CA3AF' },
                        grid: { display: false }
                    }
                }
            }
        });

        // 3. Trend Chart
        const trendCtx = document.getElementById('trendChart').getContext('2d');
        const trendLabels = @json($trendLabels);
        const trendCounts = @json($trendCounts);
        const trendAvgScores = @json($trendAvgScores);

        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [
                    {
                        label: 'Skor Rata-Rata',
                        data: trendAvgScores,
                        borderColor: '#8B5CF6',
                        backgroundColor: 'rgba(139, 92, 246, 0.05)',
                        fill: true,
                        tension: 0.3,
                        yAxisID: 'yScore',
                        borderWidth: 2,
                        pointRadius: 3
                    },
                    {
                        label: 'Tes Selesai',
                        data: trendCounts,
                        type: 'bar',
                        backgroundColor: 'rgba(59, 130, 246, 0.25)',
                        borderColor: 'rgba(59, 130, 246, 0.5)',
                        borderWidth: 1,
                        yAxisID: 'yCount',
                        borderRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { boxWidth: 12, boxHeight: 12, color: '#4B5563' }
                    }
                },
                scales: {
                    yScore: {
                        type: 'linear',
                        position: 'left',
                        min: 310,
                        max: 680,
                        title: { display: true, text: 'Rata-Rata Skor', color: '#9CA3AF', font: { size: 10 } },
                        ticks: { color: '#9CA3AF' },
                        grid: { borderDash: [4, 4], color: '#E5E7EB' }
                    },
                    yCount: {
                        type: 'linear',
                        position: 'right',
                        beginAtZero: true,
                        ticks: { stepSize: 1, color: '#9CA3AF' },
                        title: { display: true, text: 'Jumlah Tes Selesai', color: '#9CA3AF', font: { size: 10 } },
                        grid: { drawOnChartArea: false }
                    },
                    x: {
                        ticks: { color: '#9CA3AF' },
                        grid: { display: false }
                    }
                }
            }
        });
    });
</script>
@endpush
</x-app-layout>
