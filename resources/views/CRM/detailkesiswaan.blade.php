@extends('layouts.header_dashboard_crm')

@section('title', 'Kesiswaan')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-[#173A67] rounded-3xl px-10 py-6 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-6">
            <a href="{{ route('crm.kesiswaan') }}" class="w-12 h-12 bg-white/10 hover:bg-white/20 text-white rounded-2xl flex items-center justify-center transition-all border border-white/10 active:scale-95">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </a>
            <div>
                <h1 class="text-white font-extrabold text-2xl tracking-tight">Detail Data Siswa</h1>
                <p class="text-white/50 text-[10px] font-extrabold uppercase tracking-[0.2em] mt-0.5">Informasi Lengkap Progres Siswa</p>
            </div>
        </div>
        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center border border-white/10">
            <i data-lucide="info" class="w-6 h-6 text-white"></i>
        </div>
    </div>

    <!-- TOP SECTION: Profile & Follow Up -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- CARD 1: PROFILE info -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-[2.5rem] shadow-sm p-10 flex items-center gap-10 relative overflow-hidden border border-gray-100 group">
            <!-- Background Decoration -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-50 rounded-full opacity-50 group-hover:scale-110 transition-transform duration-700"></div>
            
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="w-40 h-40 rounded-[2.5rem] overflow-hidden border-8 border-gray-50 shadow-xl shadow-blue-900/10">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-3 -right-3 w-12 h-12 bg-green-500 rounded-2xl border-4 border-white flex items-center justify-center text-white shadow-lg">
                    <i data-lucide="check" class="w-6 h-6"></i>
                </div>
            </div>

            <!-- Info -->
            <div class="space-y-4 z-10 flex-1">
                <div class="space-y-1">
                    <h2 class="text-[#173A67] font-extrabold text-3xl tracking-tight">Gigih</h2>
                    <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="hash" class="w-3.5 h-3.5"></i> 23.12.2865
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Tanggal Lahir</p>
                        <p class="text-[#173A67] font-bold text-sm">18 Mei 2001</p>
                    </div>
                    <div class="bg-gray-50/80 p-4 rounded-2xl border border-gray-100">
                        <p class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest mb-1">Kesempatan</p>
                        <p class="text-[#173A67] font-bold text-sm">5 / 5 Sesi</p>
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <button class="bg-[#D85B63] hover:bg-[#c44f56] text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-lg shadow-red-900/10 text-[11px] transition-all flex items-center gap-3 uppercase tracking-widest active:scale-95">
                        <span>PLATDA</span>
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button class="bg-white border-2 border-green-100 text-green-600 font-extrabold px-8 py-3.5 rounded-2xl shadow-sm text-[11px] hover:bg-green-500 hover:text-white hover:border-green-500 transition-all uppercase tracking-widest active:scale-95">
                        Akun Siswa
                    </button>
                </div>
            </div>
        </div>

        <!-- CARD 2: FOLLOW UP -->
        <div class="col-span-12 lg:col-span-5 bg-[#173A67] rounded-[2.5rem] shadow-sm p-10 flex flex-col items-center justify-center text-center relative overflow-hidden border border-[#173A67]">
            <!-- Decoration -->
            <div class="absolute top-0 right-0 w-40 h-40 bg-white/5 rounded-full -mr-20 -mt-20"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-white/5 rounded-full -ml-20 -mb-20"></div>

            <div class="w-16 h-16 bg-white/10 rounded-2xl flex items-center justify-center mb-6">
                <i data-lucide="phone-forwarded" class="w-8 h-8 text-white"></i>
            </div>
            
            <h2 class="text-white/50 font-extrabold text-[11px] uppercase tracking-[0.3em] mb-4">Follow Up Tahap 1</h2>

            <div class="flex gap-4 mb-8">
                <button class="bg-green-500 hover:bg-green-600 text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-xl shadow-green-900/20 flex items-center gap-3 transition-all text-sm active:scale-95">
                    Respon
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white font-extrabold px-8 py-3.5 rounded-2xl shadow-xl shadow-blue-900/20 flex items-center gap-3 transition-all text-sm active:scale-95">
                    Jepang
                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                </button>
            </div>

            <div class="bg-white/10 border border-white/10 px-8 py-3.5 rounded-full flex items-center gap-4 transition-all hover:bg-white/20 cursor-pointer group/date shadow-inner">
                <span class="font-extrabold text-white text-base tracking-wider">12/08/2025</span>
                <div class="w-8 h-8 bg-[#D85B63] text-white rounded-xl flex items-center justify-center shadow-lg group-hover/date:rotate-12 transition-transform">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- TAHAPAN SISWA -->
    <div class="bg-white rounded-[2.5rem] shadow-sm p-10 border border-gray-100">
        <div class="flex items-center justify-between mb-10">
            <div>
                <h3 class="text-[#173A67] font-extrabold text-2xl tracking-tight">Tahapan Siswa</h3>
                <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mt-1">Status Progres Pendidikan & Keberangkatan</p>
            </div>
            <!-- Legend -->
            <div class="flex items-center gap-6 text-[10px] font-extrabold uppercase tracking-widest">
                <div class="flex items-center gap-2.5">
                    <span class="w-4 h-4 rounded-lg bg-green-500 shadow-sm"></span>
                    <span class="text-slate-400">Lolos</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="w-4 h-4 rounded-lg bg-orange-500 shadow-sm"></span>
                    <span class="text-slate-400">Proses</span>
                </div>
                <div class="flex items-center gap-2.5">
                    <span class="w-4 h-4 rounded-lg bg-red-500 shadow-sm"></span>
                    <span class="text-slate-400">Belum lolos</span>
                </div>
            </div>
        </div>
        
        <div class="relative px-2">
            <!-- Progress Bars -->
            <div class="flex min-w-[800px] h-16 text-white font-extrabold text-[10px] text-center uppercase tracking-widest shadow-inner rounded-[1.25rem] overflow-hidden border border-gray-50">
                <div class="bg-green-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">Pendidikan</div>
                <div class="bg-green-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">BLK / Evaluasi</div>
                <div class="bg-green-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">Seleksi I</div>
                <div class="bg-orange-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">MCU</div>
                <div class="bg-red-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">Tes Bahasa</div>
                <div class="bg-red-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">PELATDA</div>
                <div class="bg-red-500 flex-1 border-r border-white/20 flex items-center justify-center hover:opacity-90 transition-opacity">PELATNAS</div>
                <div class="bg-red-500 flex-1 flex items-center justify-center hover:opacity-90 transition-opacity">Jepang</div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: Testimoni & Grafik -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- Testimoni Card -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-[2.5rem] shadow-sm p-10 flex flex-col border border-gray-100">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center text-[#D85B63]">
                    <i data-lucide="quote" class="w-5 h-5"></i>
                </div>
                <h3 class="text-[#173A67] font-extrabold text-lg uppercase tracking-tight">Testimoni</h3>
            </div>
            
            <div class="bg-gray-50/80 rounded-[2rem] p-10 flex-1 flex flex-col items-center justify-center text-center border border-gray-100 relative shadow-inner">
                <i data-lucide="star" class="w-12 h-12 text-orange-400/20 absolute -top-4 -left-4"></i>
                <p class="font-extrabold text-[#173A67] text-2xl italic tracking-tight">"Bagus!!!"</p>
                <p class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest mt-4">Kesan Pesan Siswa</p>
            </div>

            <div class="mt-8 flex justify-center">
                <button class="bg-[#D85B63] hover:bg-[#c44f56] text-white font-extrabold px-10 py-4 rounded-2xl shadow-xl shadow-red-900/10 flex items-center gap-3 transition-all text-xs uppercase tracking-widest active:scale-95">
                    <span>Lihat File</span>
                    <i data-lucide="download" class="w-4 h-4"></i>
                </button>
            </div>
        </div>

        <!-- Grafik Performa Card -->
        <div class="col-span-12 lg:col-span-8 bg-white rounded-[2.5rem] shadow-sm p-10 flex flex-col border border-gray-100">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-[#173A67]">
                        <i data-lucide="trending-up" class="w-5 h-5"></i>
                    </div>
                    <h3 class="text-[#173A67] font-extrabold text-lg uppercase tracking-tight">Grafik Performa</h3>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#173A67]"></span>
                        <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest">Bahasa</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-[#D85B63]"></span>
                        <span class="text-[9px] font-extrabold text-slate-400 uppercase tracking-widest">Fisik & Mental</span>
                    </div>
                </div>
            </div>
            
            <div class="relative w-full h-[320px]">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>

    </div>

    <!-- DOCUMENT SECTION -->
    <div class="space-y-4">
        <div class="flex items-center gap-4 px-4">
            <div class="w-2 h-8 bg-[#D85B63] rounded-full"></div>
            <h3 class="text-[#173A67] font-extrabold text-xl tracking-tight uppercase">Berkas Pendaftaran</h3>
        </div>

        <div class="grid grid-cols-1 gap-4">
            @php
                $docs = [
                    'Fotocopy KTP',
                    'Akte Kelahiran',
                    'Ijazah Terakhir',
                    'Kartu Keluarga'
                ];
            @endphp

            @foreach($docs as $doc)
            <div class="bg-white border border-gray-100 rounded-[2rem] p-6 flex items-center justify-between shadow-sm hover:shadow-md transition-all group">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center shadow-sm group-hover:rotate-12 transition-transform">
                        <i data-lucide="file-check" class="w-6 h-6"></i>
                    </div>
                    <span class="font-extrabold text-[#173A67] text-base">{{ $doc }}</span>
                </div>

                <div class="flex items-center gap-8">
                    <div class="bg-gray-50 px-8 py-3 rounded-2xl text-slate-400 text-[10px] font-extrabold uppercase tracking-widest border border-transparent group-hover:border-blue-100 transition-all shadow-inner italic">
                         - TERSIMPAN -
                    </div>
                    <button class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center hover:bg-[#173A67] hover:text-white transition-all shadow-sm active:scale-90">
                        <i data-lucide="edit-3" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('performanceChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Minggu 2', 'Minggu 4', 'Minggu 6', 'Minggu 8', 'Minggu 10', 'Minggu 12', 'Minggu 14', 'Minggu 16'],
                datasets: [
                    {
                        label: 'Bahasa',
                        data: [20, 25, 60, 55, 65, 80, 75, 90],
                        borderColor: '#173A67',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            gradient.addColorStop(0, 'rgba(23, 58, 103, 0.1)');
                            gradient.addColorStop(1, 'rgba(23, 58, 103, 0)');
                            return gradient;
                        },
                        fill: true,
                        borderWidth: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#173A67',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        tension: 0.4
                    },
                    {
                        label: 'Fisik & Mental',
                        data: [80, 55, 55, 75, 45, 30, 25, 45],
                        borderColor: '#D85B63',
                        backgroundColor: (context) => {
                            const chart = context.chart;
                            const {ctx, chartArea} = chart;
                            if (!chartArea) return null;
                            const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                            gradient.addColorStop(0, 'rgba(216, 91, 99, 0.1)');
                            gradient.addColorStop(1, 'rgba(216, 91, 99, 0)');
                            return gradient;
                        },
                        fill: true,
                        borderWidth: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#D85B63',
                        pointBorderWidth: 3,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(255, 255, 255, 0.95)',
                        titleColor: '#173A67',
                        bodyColor: '#64748b',
                        padding: 16,
                        cornerRadius: 16,
                        displayColors: true,
                        usePointStyle: true,
                        borderWidth: 1,
                        borderColor: '#f1f5f9',
                        titleFont: {
                            family: 'Outfit',
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            family: 'Outfit',
                            size: 13,
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: '#f8fafc',
                            drawBorder: false,
                        },
                        ticks: {
                            stepSize: 20,
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                weight: 'bold',
                                family: 'Outfit'
                            },
                        },
                        border: {
                            display: false,
                            dash: [10, 10]
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 11,
                                weight: 'bold',
                                family: 'Outfit'
                            },
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
