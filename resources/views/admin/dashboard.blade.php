@extends('layouts.header_dashboard_admin')

@section('content')
<div class="flex flex-col space-y-6 pb-6">
    
    <!-- TOP SECTION (Row 1) -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- PROFILE CARD (Left - 3 Columns) -->
        <div class="col-span-12 lg:col-span-3">
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 relative overflow-hidden flex flex-col items-center text-center justify-center group h-full min-h-[320px]">
                <!-- Background Decoration -->
                <div class="absolute top-0 left-0 w-full h-24 bg-[#173A67]"></div>
                
                <!-- Avatar -->
                <div class="relative z-10 mt-4">
                    <div class="w-24 h-24 rounded-full bg-white p-1 shadow-lg">
                        <div class="w-full h-full rounded-full bg-[#173A67] flex items-center justify-center text-3xl font-extrabold text-white">
                            {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <div class="mt-4 z-10">
                    <h2 class="text-xl font-extrabold text-[#173A67]">{{ Auth::guard('admin')->user()->name }}</h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ Auth::guard('admin')->user()->email }}</p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <span class="bg-blue-50 text-[#173A67] text-[10px] font-extrabold px-3 py-1.5 rounded-xl uppercase tracking-wider border border-blue-100">Administrator</span>
                    </div>
                </div>

                <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                        class="absolute top-4 right-4 bg-white/10 backdrop-blur-md text-white p-2 rounded-xl hover:bg-white/20 transition group-hover:scale-110">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- STATS OVERVIEW (Middle - 6 Columns) -->
        <div class="col-span-12 lg:col-span-6">
            <div class="grid grid-cols-2 gap-4 h-full">
                <!-- Stat 1: Total Siswa -->
                <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-24 h-24 text-[#173A67]"></i>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center mb-4 border border-blue-100">
                        <i data-lucide="users-2" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 font-extrabold uppercase tracking-[0.2em]">Total Siswa</span>
                        <div class="flex items-baseline gap-2 mt-1">
                            <p class="text-4xl font-black text-[#173A67]">{{ $stats['total_siswa'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat 2: Pendaftar Baru -->
                <a href="{{ route('admin.pengajuansiswa') }}" class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-orange-100 flex flex-col justify-between hover:shadow-lg transition group relative overflow-hidden ring-2 ring-orange-500/10 hover:ring-orange-500/30">
                    <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                        <i data-lucide="user-plus" class="w-24 h-24 text-orange-600"></i>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4 border border-orange-200">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-orange-600 font-extrabold uppercase tracking-[0.2em]">Pendaftar Baru</span>
                        <div class="flex items-center justify-between mt-1">
                            <p class="text-4xl font-black text-[#173A67]">{{ $stats['siswa_pending'] }}</p>
                            @if($stats['siswa_pending'] > 0)
                                <span class="flex h-3 w-3 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                                </span>
                            @endif
                        </div>
                    </div>
                </a>

                <!-- Stat 3: Berkas Pendaftaran -->
                <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group relative overflow-hidden">
                    <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center mb-4 border border-rose-100">
                        <i data-lucide="file-warning" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 font-extrabold uppercase tracking-[0.2em]">Berkas Daftar</span>
                        <div class="flex items-center justify-between mt-1">
                            <p class="text-4xl font-black text-[#173A67]">{{ $stats['berkas_pendaftaran'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Stat 4: Berkas Seleksi -->
                <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group relative overflow-hidden">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mb-4 border border-amber-100">
                        <i data-lucide="clipboard-list" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-[10px] text-gray-400 font-extrabold uppercase tracking-[0.2em]">Berkas Seleksi</span>
                        <p class="text-4xl font-black text-[#173A67] mt-1">{{ $stats['berkas_seleksi'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ATTENDANCE CARD (Right - 3 Columns) -->
        <div class="col-span-12 lg:col-span-3">
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 h-full flex flex-col group hover:shadow-md transition">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-[#173A67] font-black text-sm tracking-tight uppercase">Presensi Siswa</h3>
                    <div class="bg-emerald-50 text-emerald-600 px-2 py-1 rounded-lg text-[10px] font-black border border-emerald-100">
                        {{ $attendance_stats['percentage'] }}%
                    </div>
                </div>

                <!-- Circular Progress Mock -->
                <div class="flex-1 flex flex-col items-center justify-center py-4">
                    <div class="relative w-32 h-32 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="10" fill="transparent" class="text-gray-100" />
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="12" fill="transparent" stroke-dasharray="364.4" stroke-dashoffset="{{ 364.4 * (1 - $attendance_stats['percentage']/100) }}" class="text-[#173A67] transition-all duration-1000" stroke-linecap="round" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-2xl font-black text-[#173A67]">{{ $attendance_stats['percentage'] }}%</span>
                            <span class="text-[8px] text-gray-400 font-bold uppercase tracking-widest">Kehadiran</span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-2 gap-4 mt-4">
                    @foreach($attendance_stats['details'] as $detail)
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full {{ $detail['color'] }}"></span>
                        <div class="flex flex-col">
                            <span class="text-[8px] text-gray-400 font-extrabold uppercase tracking-widest">{{ $detail['label'] }}</span>
                            <span class="text-xs font-black text-[#173A67]">{{ number_format($detail['count']) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- CHART SECTION (Row 2) -->
    <div class="col-span-12 h-[400px] shrink-0" x-data="registrationTrendData()">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 h-full flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-[#173A67] font-extrabold text-lg">Tren Pendaftaran Siswa</h3>
                    <p class="text-xs text-gray-400 font-bold">Grafik pertumbuhan jumlah siswa bergabung</p>
                </div>
                
                <!-- Time Range Filter -->
                <div class="bg-gray-50 rounded-xl p-1 flex">
                    <button @click="setRange('1M')" 
                            :class="range === '1M' ? 'bg-white text-[#173A67] shadow-sm' : 'text-gray-400 hover:text-gray-600'"
                            class="px-4 py-1.5 rounded-lg text-[10px] font-extrabold transition-all">
                        1 Bulan
                    </button>
                    <button @click="setRange('6M')" 
                            :class="range === '6M' ? 'bg-white text-[#173A67] shadow-sm' : 'text-gray-400 hover:text-gray-600'"
                            class="px-4 py-1.5 rounded-lg text-[10px] font-extrabold transition-all">
                        6 Bulan
                    </button>
                    <button @click="setRange('1Y')" 
                            :class="range === '1Y' ? 'bg-white text-[#173A67] shadow-sm' : 'text-gray-400 hover:text-gray-600'"
                            class="px-4 py-1.5 rounded-lg text-[10px] font-extrabold transition-all">
                        1 Tahun
                    </button>
                </div>
            </div>

            <!-- Chart Container -->
            <div class="flex-1 w-full min-h-0 relative">
                <canvas id="trendChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        function registrationTrendData() {
            return {
                allData: @json($trend_data), 
                range: '1Y', 

                init() {
                    this.$nextTick(() => {
                        this.renderChart();
                    });
                },

                setRange(r) {
                    this.range = r;
                    this.updateChart();
                },

                getFilteredData() {
                    const daysMap = {
                        '1M': 30,
                        '6M': 180,
                        '1Y': 365
                    };
                    const limit = daysMap[this.range] || 365;
                    return this.allData.slice(-limit);
                },

                renderChart() {
                    const canvas = document.getElementById('trendChart');
                    if (!canvas) return;

                    const ctx = canvas.getContext('2d');
                    const filteredData = this.getFilteredData();

                    // Create Gradient
                    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                    gradient.addColorStop(0, 'rgba(23, 58, 103, 0.2)');
                    gradient.addColorStop(1, 'rgba(23, 58, 103, 0.0)');

                    // Use canvas._chart to avoid Alpine reactivity loop
                    if (canvas._chart) {
                        canvas._chart.destroy();
                    }

                    canvas._chart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: filteredData.map(d => {
                                const date = new Date(d.date);
                                return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
                            }),
                            datasets: [{
                                label: 'Siswa Baru',
                                data: filteredData.map(d => d.count),
                                borderColor: '#173A67',
                                borderWidth: 3,
                                backgroundColor: gradient,
                                fill: true,
                                tension: 0.4,
                                pointRadius: 0,
                                pointHoverRadius: 6,
                                pointHoverBackgroundColor: '#173A67',
                                pointHoverBorderColor: '#fff',
                                pointHoverBorderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    mode: 'index',
                                    intersect: false,
                                    backgroundColor: '#fff',
                                    titleColor: '#173A67',
                                    bodyColor: '#6B7280',
                                    borderColor: '#F3F4F6',
                                    borderWidth: 1,
                                    padding: 12,
                                    boxPadding: 4,
                                    usePointStyle: true,
                                    callbacks: {
                                        title: function(context) {
                                            const d = filteredData[context[0].dataIndex];
                                            return new Date(d.date).toLocaleDateString('id-ID', { 
                                                day: '2-digit', 
                                                month: 'long', 
                                                year: 'numeric' 
                                            });
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        maxRotation: 0,
                                        autoSkip: true,
                                        maxTicksLimit: 12,
                                        font: { size: 10, weight: '700' },
                                        color: '#9CA3AF'
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: '#F3F4F6',
                                        drawBorder: false,
                                        borderDash: [4, 4]
                                    },
                                    ticks: {
                                        stepSize: 1,
                                        font: { size: 10, weight: '700' },
                                        color: '#9CA3AF'
                                    }
                                }
                            },
                            interaction: {
                                mode: 'nearest',
                                axis: 'x',
                                intersect: false
                            }
                        }
                    });
                },

                updateChart() {
                    const canvas = document.getElementById('trendChart');
                    const chart = canvas ? canvas._chart : null;
                    const filteredData = this.getFilteredData();
                    
                    if (chart) {
                        chart.data.labels = filteredData.map(d => {
                            const date = new Date(d.date);
                            return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short' });
                        });
                        chart.data.datasets[0].data = filteredData.map(d => d.count);
                        chart.update('none');
                    }
                }
            }
        }
    </script>
    <!-- BOTTOM SECTION (Row 3) -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- LATEST PENDAFTARAN -->
        <div class="col-span-12 lg:col-span-6">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[480px]">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <div>
                        <h3 class="text-[#173A67] font-black text-sm flex items-center gap-2 uppercase tracking-tight">
                            <i data-lucide="file-text" class="w-4 h-4 text-rose-500"></i>
                            Pemberkasan Pendaftaran
                        </h3>
                        <p class="text-[10px] text-gray-400 font-black mt-1 uppercase tracking-widest">Total: {{ $doc_pendaftaran['pending'] }} Pending</p>
                    </div>
                    <a href="{{ route('admin.berkaspendaftaran') }}" class="text-[10px] font-black text-blue-500 hover:text-[#173A67] uppercase tracking-[0.2em] transition-colors">Lihat Semua</a>
                </div>

                <!-- Status Summary Pills -->
                <div class="px-6 py-4 flex gap-3 shrink-0">
                    <div class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-2xl border border-emerald-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Disetujui</p>
                        <p class="text-lg font-black leading-none">{{ $doc_pendaftaran['approved'] }}</p>
                    </div>
                    <div class="bg-amber-50 text-amber-600 px-4 py-2 rounded-2xl border border-amber-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Pending</p>
                        <p class="text-lg font-black leading-none">{{ $doc_pendaftaran['pending'] }}</p>
                    </div>
                    <div class="bg-rose-50 text-rose-600 px-4 py-2 rounded-2xl border border-rose-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Ditolak</p>
                        <p class="text-lg font-black leading-none">{{ $doc_pendaftaran['rejected'] }}</p>
                    </div>
                </div>

                <!-- Scrollable Content -->
                <div class="p-6 space-y-4 overflow-y-auto flex-1 custom-scrollbar">
                    @forelse($latest_pendaftaran as $item)
                    <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-3xl transition group cursor-pointer border border-transparent hover:border-gray-100">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-sm font-black shrink-0 group-hover:bg-[#173A67] group-hover:text-white transition-all">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-black text-[#173A67] truncate">{{ $item->user->name }}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="bg-white text-[9px] font-bold text-gray-500 px-2 py-0.5 rounded-full border border-gray-100 shadow-sm">{{ $item->nama_berkas }}</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                             @if($item->status == 'pending')
                                <span class="bg-amber-50 text-amber-600 px-3 py-1.5 rounded-xl text-[10px] font-black border border-amber-100">Menunggu</span>
                            @else
                                <span class="bg-gray-50 text-gray-400 px-3 py-1.5 rounded-xl text-[10px] font-black border border-gray-100">{{ ucfirst($item->status) }}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-50 py-10">
                        <i data-lucide="inbox" class="w-12 h-12 text-gray-200 mb-4"></i>
                        <p class="text-sm text-gray-400 font-black">Belum ada pengajuan baru</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- LATEST SELEKSI -->
        <div class="col-span-12 lg:col-span-6">
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[480px]">
                <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <div>
                        <h3 class="text-[#173A67] font-black text-sm flex items-center gap-2 uppercase tracking-tight">
                            <i data-lucide="clipboard-check" class="w-4 h-4 text-purple-500"></i>
                            Pemberkasan Seleksi
                        </h3>
                        <p class="text-[10px] text-gray-400 font-black mt-1 uppercase tracking-widest">Total: {{ $doc_seleksi['pending'] }} Pending</p>
                    </div>
                    <a href="{{ route('admin.berkasseleksi') }}" class="text-[10px] font-black text-blue-500 hover:text-[#173A67] uppercase tracking-[0.2em] transition-colors">Lihat Semua</a>
                </div>

                <!-- Status Summary Pills -->
                <div class="px-6 py-4 flex gap-3 shrink-0">
                    <div class="bg-emerald-50 text-emerald-600 px-4 py-2 rounded-2xl border border-emerald-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Disetujui</p>
                        <p class="text-lg font-black leading-none">{{ $doc_seleksi['approved'] }}</p>
                    </div>
                    <div class="bg-amber-50 text-amber-600 px-4 py-2 rounded-2xl border border-amber-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Pending</p>
                        <p class="text-lg font-black leading-none">{{ $doc_seleksi['pending'] }}</p>
                    </div>
                    <div class="bg-rose-50 text-rose-600 px-4 py-2 rounded-2xl border border-rose-100 flex-1 text-center">
                        <p class="text-[8px] font-black uppercase tracking-widest mb-1 opacity-60">Ditolak</p>
                        <p class="text-lg font-black leading-none">{{ $doc_seleksi['rejected'] }}</p>
                    </div>
                </div>

                <!-- Scrollable Content -->
                <div class="p-6 space-y-4 overflow-y-auto flex-1 custom-scrollbar">
                    @forelse($latest_seleksi as $item)
                    <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-3xl transition group cursor-pointer border border-transparent hover:border-gray-100">
                        <div class="w-12 h-12 rounded-2xl bg-gray-100 text-gray-400 flex items-center justify-center text-sm font-black shrink-0 group-hover:bg-[#173A67] group-hover:text-white transition-all">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-black text-[#173A67] truncate">{{ $item->user->name }}</h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="bg-white text-[9px] font-bold text-gray-500 px-2 py-0.5 rounded-full border border-gray-100 shadow-sm">{{ $item->nama_berkas }}</span>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                             @if($item->status == 'pending')
                                <span class="bg-amber-50 text-amber-600 px-3 py-1.5 rounded-xl text-[10px] font-black border border-amber-100">Menunggu</span>
                            @else
                                <span class="bg-gray-50 text-gray-400 px-3 py-1.5 rounded-xl text-[10px] font-black border border-gray-100">{{ ucfirst($item->status) }}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-50 py-10">
                        <i data-lucide="inbox" class="w-12 h-12 text-gray-200 mb-4"></i>
                        <p class="text-sm text-gray-400 font-black">Belum ada pengajuan baru</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- STYLE FOR SCROLLBAR -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E5E7EB;
            border-radius: 20px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #D1D5DB;
        }
    </style>

    <!-- ALERTS -->
    @if(session('success'))
    <div class="fixed bottom-6 right-6 bg-green-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-in slide-in-from-bottom-5 duration-300 z-50">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        <p class="text-sm font-bold">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="ml-2 hover:opacity-80">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif
</div>

<!-- EDIT PROFILE MODAL (Same as before) -->
<div id="editProfileModal" class="hidden fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" onclick="document.getElementById('editProfileModal').classList.add('hidden')"></div>
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
            <div class="bg-[#173A67] px-8 py-6">
                <h3 class="text-xl font-extrabold text-white">Edit Profil Admin</h3>
                <p class="text-blue-100 text-xs mt-1">Perbarui informasi akun administrator Anda.</p>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors"> <i data-lucide="x" class="w-6 h-6"></i> </button>
            </div>
            <form action="{{ route('admin.profile.update') }}" method="POST" class="p-8 space-y-5">
                @csrf
                @method('PUT')
                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Email</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                    </div>
                </div>
                <div class="border-t border-gray-100 my-4 pt-4">
                    <p class="text-xs text-orange-500 font-bold mb-4 flex items-center gap-2"> <i data-lucide="lock" class="w-3 h-3"></i> Kosongkan jika tidak ingin mengubah password </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Password Baru</label>
                            <input type="password" name="password" placeholder="********" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" placeholder="********" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                        </div>
                    </div>
                </div>
                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')" class="flex-1 bg-gray-100 text-gray-600 py-3.5 rounded-xl font-bold text-sm hover:bg-gray-200 transition-colors"> Batal </button>
                    <button type="submit" class="flex-1 bg-[#173A67] text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-95 transition-all"> Simpan Perubahan </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
