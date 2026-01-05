@extends('layouts.header_dashboard_sensei')

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
                        <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full rounded-full object-cover">
                    </div>
                </div>

                <div class="mt-4 z-10">
                    <h2 class="text-xl font-extrabold text-[#173A67]">{{ Auth::user()->name }}</h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">{{ Auth::user()->email }}</p>
                    <div class="mt-4 flex items-center justify-center gap-2">
                        <span class="bg-blue-50 text-[#173A67] text-[10px] font-extrabold px-3 py-1.5 rounded-xl uppercase tracking-wider border border-blue-100">Sensei</span>
                        <a href="{{ route('sensei.pengajaran') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-extrabold px-3 py-1.5 rounded-xl uppercase tracking-wider transition-all">Pengajaran</a>
                    </div>
                </div>

                <div class="mt-6 w-full flex justify-center">
                     <button class="text-[10px] flex items-center gap-2 text-gray-400 hover:text-[#173A67] font-bold uppercase tracking-widest transition-colors">
                        <i data-lucide="edit-3" class="w-3 h-3"></i> Edit Profil
                    </button>
                </div>
            </div>
        </div>

        <!-- STATS & SCHEDULE (Middle - 6 Columns) -->
        <div class="col-span-12 lg:col-span-6">
            <div class="flex flex-col gap-6 h-full">
                <!-- Stats Row -->
                <div class="grid grid-cols-2 gap-4">
                     <!-- Stat 1: Total Kelas -->
                    <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group relative overflow-hidden h-40">
                        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform">
                            <i data-lucide="school" class="w-24 h-24 text-[#173A67]"></i>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center mb-4 border border-blue-100">
                            <i data-lucide="building-2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 font-extrabold uppercase tracking-[0.2em]">Total Kelas</span>
                            <p class="text-4xl font-black text-[#173A67] mt-1">{{ $total_kelas }}</p>
                        </div>
                    </div>

                    <!-- Stat 2: Total Siswa -->
                    <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition group relative overflow-hidden h-40">
                         <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform">
                            <i data-lucide="users" class="w-24 h-24 text-orange-600"></i>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-600 flex items-center justify-center mb-4 border border-orange-100">
                            <i data-lucide="users-2" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-[10px] text-gray-400 font-extrabold uppercase tracking-[0.2em]">Total Siswa</span>
                            <p class="text-4xl font-black text-[#173A67] mt-1">{{ $total_siswa }}</p>
                        </div>
                    </div>
                </div>

                <!-- Schedule Card -->
                <div class="bg-[#173A67] rounded-[2.5rem] p-6 shadow-sm border border-[#173A67] flex-1 relative overflow-hidden text-white flex flex-col justify-center">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full -ml-16 -mb-16"></div>
                    
                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center">
                                <i data-lucide="calendar-clock" class="w-5 h-5 text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg leading-tight">Jadwal Mengajar</h3>
                                <p class="text-[10px] opacity-60 font-bold uppercase tracking-widest">Minggu Ini</p>
                            </div>
                        </div>
                        <span class="bg-white/10 px-3 py-1 rounded-lg text-[10px] font-bold border border-white/10">Minggu I</span>
                    </div>

                    <div class="space-y-3 relative z-10">
                         <div class="bg-white/10 p-3 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-white/20 transition cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-8 bg-red-400 rounded-full"></span>
                                <div>
                                    <p class="font-bold text-sm">Kanji</p>
                                    <p class="text-[10px] opacity-70">Selasa, 13:00 - 15:00</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold opacity-50">A1</span>
                        </div>
                        <div class="bg-white/10 p-3 rounded-2xl flex items-center justify-between border border-white/5 hover:bg-white/20 transition cursor-pointer">
                            <div class="flex items-center gap-3">
                                <span class="w-1.5 h-8 bg-blue-400 rounded-full"></span>
                                <div>
                                    <p class="font-bold text-sm">Kotoba</p>
                                    <p class="text-[10px] opacity-70">Rabu, 09:00 - 11:00</p>
                                </div>
                            </div>
                            <span class="text-xs font-bold opacity-50">B2</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KEHADIRAN & NILAI (Right - 3 Columns) -->
        <div class="col-span-12 lg:col-span-3">
            <div class="bg-white rounded-[2.5rem] p-6 shadow-sm border border-gray-100 h-full flex flex-col group hover:shadow-md transition relative overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-[#173A67] font-black text-sm tracking-tight uppercase">Kehadiran</h3>
                    <div class="bg-emerald-50 text-emerald-600 px-2 py-1 rounded-lg text-[10px] font-black border border-emerald-100">
                        Baik
                    </div>
                </div>

                <!-- Circular Progress -->
                <div class="flex-1 flex flex-col items-center justify-center py-4">
                    <div class="relative w-32 h-32 flex items-center justify-center">
                        <svg class="w-full h-full transform -rotate-90">
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="10" fill="transparent" class="text-gray-100" />
                            <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="12" fill="transparent" stroke-dasharray="364.4" stroke-dashoffset="{{ 364.4 * (1 - $kehadiran/100) }}" class="text-[#173A67] transition-all duration-1000" stroke-linecap="round" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-3xl font-black text-[#173A67]">{{ $kehadiran }}%</span>
                            <span class="text-[8px] text-gray-400 font-bold uppercase tracking-widest">Hadir</span>
                        </div>
                    </div>
                </div>

                <!-- Nilai Summary -->
                <div class="mt-4 pt-4 border-t border-gray-50 space-y-3">
                    <h4 class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">Rata-rata Nilai</h4>
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-2xl">
                        <span class="text-xs font-bold text-[#173A67]">Bahasa</span>
                        <span class="text-xs font-black bg-blue-100 text-blue-700 px-2 py-1 rounded-lg">{{ $avg_bahasa }}</span>
                    </div>
                     <div class="flex justify-between items-center bg-gray-50 p-3 rounded-2xl">
                        <span class="text-xs font-bold text-[#173A67]">Sikap</span>
                        <span class="text-xs font-black bg-emerald-100 text-emerald-700 px-2 py-1 rounded-lg">{{ $avg_sikap }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHART SECTION (Row 2) -->
    <div class="col-span-12 h-[350px] shrink-0">
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 h-full flex flex-col">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-[#173A67] font-extrabold text-lg">Grafik Performa Kelas</h3>
                    <p class="text-xs text-gray-400 font-bold">Perkembangan nilai rata-rata siswa</p>
                </div>
            </div>

            <!-- Chart Container -->
            <div class="flex-1 w-full min-h-0 relative">
                <canvas id="chartGuru"></canvas>
            </div>
        </div>
    </div>

</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('chartGuru');
        if(ctx) {
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chart_data['labels']) !!},
                    datasets: [
                        { 
                            label: 'Bahasa', 
                            data: {!! json_encode($chart_data['bahasa']) !!}, 
                            borderColor: '#173A67',
                            backgroundColor: 'rgba(23, 58, 103, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#173A67',
                            pointBorderWidth: 2
                        },
                        { 
                            label: 'Fisik & Mental', 
                            data: {!! json_encode($chart_data['fmd']) !!}, 
                            borderColor: '#D85B63',
                            backgroundColor: 'rgba(216, 91, 99, 0.1)',
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointBackgroundColor: '#fff',
                            pointBorderColor: '#D85B63',
                            pointBorderWidth: 2
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'top',
                            align: 'end',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 8,
                                font: { family: "'Plus Jakarta Sans', sans-serif", size: 11, weight: 600 }
                            }
                        },
                        tooltip: {
                            backgroundColor: '#fff',
                            titleColor: '#173A67',
                            bodyColor: '#6B7280',
                            borderColor: '#F3F4F6',
                            borderWidth: 1,
                            padding: 10,
                            usePointStyle: true,
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10 }, color: '#9CA3AF' }
                        },
                        y: {
                            grid: { color: '#F3F4F6', borderDash: [4, 4] },
                            ticks: { font: { size: 10 }, color: '#9CA3AF' },
                            beginAtZero: true,
                            max: 100
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection