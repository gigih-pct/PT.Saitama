@extends('layouts.header_dashboard_admin')

@section('content')
<div class="flex flex-col space-y-6 pb-6">
    
    <!-- TOP SECTION (Row 1) -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- PROFILE CARD (Left - 3 Columns) -->
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 relative overflow-hidden flex flex-col items-center text-center justify-center group h-full min-h-[280px]">
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
                    <p class="text-xs text-gray-500 font-medium">{{ Auth::guard('admin')->user()->email }}</p>
                    <span class="inline-block mt-3 bg-blue-50 text-[#173A67] text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">Administrator</span>
                </div>

                <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                        class="absolute top-4 right-4 bg-white/10 backdrop-blur-md text-white p-2 rounded-xl hover:bg-white/20 transition">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- STATS OVERVIEW (Right - 8 Columns) -->
        <div class="col-span-12 lg:col-span-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 h-full">
                
                <!-- Stat 1 -->
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="w-10 h-10 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center mb-4">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Total Siswa</span>
                        <p class="text-3xl font-extrabold text-[#173A67] mt-1 group-hover:translate-x-1 transition-transform">{{ $stats['total_siswa'] }}</p>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="w-10 h-10 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4">
                        <i data-lucide="school" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Total Kelas</span>
                        <p class="text-3xl font-extrabold text-[#173A67] mt-1 group-hover:translate-x-1 transition-transform">{{ $stats['total_kelas'] }}</p>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="w-10 h-10 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center mb-4">
                        <i data-lucide="file-warning" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Pending Pendaftaran</span>
                        <p class="text-3xl font-extrabold text-[#173A67] mt-1 group-hover:translate-x-1 transition-transform">{{ $stats['berkas_pendaftaran'] }}</p>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="bg-white rounded-3xl p-5 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group">
                    <div class="w-10 h-10 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center mb-4">
                        <i data-lucide="calendar-clock" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <span class="text-[11px] text-gray-400 font-bold uppercase tracking-wider">Pending Seleksi</span>
                        <p class="text-3xl font-extrabold text-[#173A67] mt-1 group-hover:translate-x-1 transition-transform">{{ $stats['berkas_seleksi'] }}</p>
                    </div>
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
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[400px]">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <h3 class="text-[#173A67] font-extrabold text-sm flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i>
                        Pengajuan Berkas Pendaftaran
                    </h3>
                    <a href="{{ route('admin.berkaspendaftaran') }}" class="text-[10px] font-bold text-gray-400 hover:text-[#173A67] uppercase tracking-wider">Lihat Semua</a>
                </div>
                <!-- Scrollable Content -->
                <div class="p-4 space-y-3 overflow-y-auto flex-1 custom-scrollbar">
                    @forelse($latest_pendaftaran as $item)
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-2xl transition group cursor-pointer border border-transparent hover:border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold shrink-0">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-[#173A67] truncate">{{ $item->user->name }}</h4>
                            <p class="text-[10px] text-gray-400 truncate">{{ $item->nama_berkas }}</p>
                        </div>
                        <div class="text-right shrink-0">
                             @if($item->status == 'pending')
                                <span class="bg-yellow-50 text-yellow-600 px-2.5 py-1 rounded-lg text-[10px] font-extrabold">Pending</span>
                            @else
                                <span class="bg-gray-50 text-gray-400 px-2.5 py-1 rounded-lg text-[10px] font-extrabold">{{ ucfirst($item->status) }}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                        <i data-lucide="inbox" class="w-8 h-8 text-gray-300 mb-2"></i>
                        <p class="text-xs text-gray-400 font-bold">Belum ada data.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- LATEST SELEKSI -->
        <div class="col-span-12 lg:col-span-6">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[400px]">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <h3 class="text-[#173A67] font-extrabold text-sm flex items-center gap-2">
                        <i data-lucide="clipboard-check" class="w-4 h-4 text-purple-500"></i>
                        Pengajuan Berkas Seleksi
                    </h3>
                    <a href="{{ route('admin.berkasseleksi') }}" class="text-[10px] font-bold text-gray-400 hover:text-[#173A67] uppercase tracking-wider">Lihat Semua</a>
                </div>
                <!-- Scrollable Content -->
                <div class="p-4 space-y-3 overflow-y-auto flex-1 custom-scrollbar">
                    @forelse($latest_seleksi as $item)
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-2xl transition group cursor-pointer border border-transparent hover:border-gray-100">
                        <div class="w-10 h-10 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold shrink-0">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-bold text-[#173A67] truncate">{{ $item->user->name }}</h4>
                            <p class="text-[10px] text-gray-400 truncate">{{ $item->nama_berkas }}</p>
                        </div>
                        <div class="text-right shrink-0">
                             @if($item->status == 'pending')
                                <span class="bg-yellow-50 text-yellow-600 px-2.5 py-1 rounded-lg text-[10px] font-extrabold">Pending</span>
                            @else
                                <span class="bg-gray-50 text-gray-400 px-2.5 py-1 rounded-lg text-[10px] font-extrabold">{{ ucfirst($item->status) }}</span>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="h-full flex flex-col items-center justify-center text-center opacity-50">
                        <i data-lucide="inbox" class="w-8 h-8 text-gray-300 mb-2"></i>
                        <p class="text-xs text-gray-400 font-bold">Belum ada data.</p>
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
