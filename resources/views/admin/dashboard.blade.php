@extends('layouts.header_dashboard_admin')

@section('content')
<div class="flex flex-col h-[calc(100vh-6rem)] space-y-6">
    
    <!-- TOP SECTION (Row 1) - Fixed Height -->
    <div class="grid grid-cols-12 gap-6 h-[280px] shrink-0">
        
        <!-- PROFILE CARD (Left - 3 Columns) -->
        <div class="col-span-12 lg:col-span-4 h-full">
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 h-full relative overflow-hidden flex flex-col items-center text-center justify-center group">
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
        <div class="col-span-12 lg:col-span-8 h-full">
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
            <div id="trendChart" class="flex-1 w-full min-h-0"></div>
            
            <!-- DEBUG: Temporary data check -->
            @if(app()->environment('local'))
            <div class="hidden">
                JSON Data Check: {{ json_encode(array_slice($trend_data, -5)) }}
            </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
             console.log('Alpine initialized');
        });

        function registrationTrendData() {
            return {
                allData: @json($trend_data), 
                range: '1Y', 
                chart: null,

                init() {
                    console.log('Component Init', this.allData);
                    if (!this.allData || this.allData.length === 0) {
                        console.error('No data found!');
                    }
                    if (typeof ApexCharts === 'undefined') {
                        console.error('ApexCharts is not defined! Check app.js imports.');
                    }

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
                    
                    // Slice from end (latest dates)
                    return this.allData.slice(-limit);
                },

                renderChart() {
                    const data = this.getFilteredData();
                    
                    const options = {
                        series: [{
                            name: 'Siswa Baru',
                            data: data.map(d => d.count)
                        }],
                        chart: {
                            type: 'area', // Area chart looks nice for trends
                            height: '100%',
                            fontFamily: 'Nunito, sans-serif',
                            toolbar: { show: false },
                            animations: {
                                enabled: true,
                                easing: 'easeinout',
                                speed: 800
                            }
                        },
                        colors: ['#173A67'],
                        fill: {
                            type: 'gradient',
                            gradient: {
                                shadeIntensity: 1,
                                opacityFrom: 0.7,
                                opacityTo: 0.1, // Fade out at bottom
                                stops: [0, 90, 100]
                            }
                        },
                        stroke: {
                            curve: 'smooth',
                            width: 3
                        },
                        dataLabels: {
                            enabled: false
                        },
                        xaxis: {
                            type: 'datetime',
                            categories: data.map(d => d.date),
                            tooltip: { enabled: false },
                            axisBorder: { show: false },
                            axisTicks: { show: false },
                            labels: {
                                style: {
                                    fontSize: '11px',
                                    fontWeight: 700,
                                    colors: '#9CA3AF'
                                },
                                datetimeFormatter: {
                                    year: 'yyyy',
                                    month: 'MMM \'yy',
                                    day: 'dd MMM'
                                }
                            }
                        },
                        yaxis: {
                            show: true,
                            labels: {
                                style: {
                                    fontSize: '11px',
                                    fontWeight: 700,
                                    colors: '#9CA3AF'
                                },
                                formatter: (val) => val.toFixed(0) // No decimals for people count
                            }
                        },
                        grid: {
                            show: true,
                            borderColor: '#F3F4F6',
                            strokeDashArray: 4,
                            padding: {
                                top: 10,
                                right: 10,
                                bottom: 0,
                                left: 10
                            } 
                        },
                        tooltip: {
                            theme: 'light',
                            x: {
                                format: 'dd MMM yyyy'
                            },
                        }
                    };

                    if (window.ApexCharts) {
                        this.chart = new ApexCharts(document.querySelector("#trendChart"), options);
                        this.chart.render();
                    }
                },

                updateChart() {
                    const data = this.getFilteredData();
                    if (this.chart) {
                        this.chart.updateSeries([{
                            data: data.map(d => d.count)
                        }]);
                        // Must also update categories for xaxis if not automatically handled by series update with correct X pairings?
                        // ApexCharts 'datetime' axis usually handles it better if we provide pairings or update options.
                        // Let's safe update options.
                        this.chart.updateOptions({
                             xaxis: {
                                categories: data.map(d => d.date)
                            }
                        });
                    }
                }
            }
        }
    </script>
    <div class="grid grid-cols-12 gap-6 flex-1 min-h-0">
        
        <!-- LATEST PENDAFTARAN -->
        <div class="col-span-12 lg:col-span-6 h-full">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <h3 class="text-[#173A67] font-extrabold text-sm flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-red-500"></i>
                        Pendaftaran Terbaru
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
        <div class="col-span-12 lg:col-span-6 h-full">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden h-full flex flex-col">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between shrink-0">
                    <h3 class="text-[#173A67] font-extrabold text-sm flex items-center gap-2">
                        <i data-lucide="clipboard-check" class="w-4 h-4 text-purple-500"></i>
                        Seleksi Terbaru
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
