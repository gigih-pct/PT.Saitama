@extends('layouts.header_dashboard_siswa')

@section('title', 'Nilai Siswa')

@section('content')
<div class="space-y-6">
    <style>
        .layout-row { display: flex; flex-direction: column; gap: 1.5rem; }
        .col-profile { width: 100%; }
        .col-scores { width: 100%; }
        
        @media (min-width: 768px) {
            .layout-row { flex-direction: row; }
            .col-profile { width: 41.666667%; } /* 5/12 */
            .col-scores { width: 58.333333%; } /* 7/12 */
        }
        @media (min-width: 1024px) {
            .col-profile { width: 33.333333%; } /* 4/12 */
            .col-scores { width: 66.666667%; } /* 8/12 */
        }
    </style>

    <!-- ROW 1: PROFILE & SCORES -->
    <div class="layout-row items-stretch">
        
        <!-- CARD: PROFILE (Left) -->
        <div class="col-profile bg-white rounded-3xl shadow-sm p-6 flex flex-col items-center justify-center text-center relative h-full overflow-hidden shrink-0">
             <!-- Avatar Circle -->
             <div class="relative w-32 h-32 mb-4 flex items-center justify-center">
                <!-- Blue circle background -->
                <div class="absolute inset-0 bg-[#0ea5e9] rounded-full opacity-10"></div>
                
                <!-- Avatar Image -->
                <div class="relative w-28 h-28 rounded-full border-[5px] border-[#0ea5e9] overflow-hidden bg-white">
                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/avatar.jpg') }}" 
                         class="w-full h-full rounded-full object-cover"
                         onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff'">
                </div>
            </div>

            <div class="space-y-2 mb-6 text-left w-full max-w-[200px]">
                <p class="text-gray-700 text-xs lg:text-sm flex items-center justify-between"><span class="font-bold text-[#102a4e]">Nama :</span> <span class="font-medium text-right truncate ml-2">{{ Auth::user()->name }}</span></p>
                <p class="text-gray-700 text-xs lg:text-sm flex items-center justify-between"><span class="font-bold text-[#102a4e]">NIM :</span> <span class="font-medium text-right ml-2">{{ Auth::user()->nim ?? '23.12.2865' }}</span></p>
                <p class="text-gray-700 text-xs lg:text-sm flex items-center justify-between"><span class="font-bold text-[#102a4e]">Tgl Lahir :</span> <span class="font-medium text-right ml-2">{{ Auth::user()->tgl_lahir ?? '18 Mei 2001' }}</span></p>
            </div>

            <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-4 py-2.5 rounded-xl flex items-center justify-center gap-2 shadow-lg transition active:scale-95 w-full max-w-[200px] text-xs lg:text-sm">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-4 h-4 bg-white rounded-full p-0.5">
                 <span>Hubungi Kami</span>
            </button>
        </div>

        <!-- CARD: SCORES (Right) -->
        <div class="col-scores bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col h-full shrink-0">
            <!-- Header -->
            <div class="bg-[#102a4e] px-6 py-4 flex items-center justify-between shrink-0">
                <h3 class="text-white font-bold text-sm lg:text-base">Nilai Evaluasi Seleksi</h3>
                <span class="bg-[#16a34a] text-white text-[10px] lg:text-xs font-bold px-3 py-1 rounded-full shadow-sm whitespace-nowrap">Siap Seleksi</span>
            </div>

            <!-- List -->
            <div class="p-6 space-y-3 flex-1 flex flex-col justify-center">
                @php
                    $scores = [
                        ['label' => 'Kanji', 'score' => 7.7, 'color' => 'bg-[#d95d5d]', 'text-color' => 'text-[#102a4e]'],
                        ['label' => 'Kotoba', 'score' => 8.7, 'color' => 'bg-[#102a4e]', 'text-color' => 'text-[#102a4e]'],
                        ['label' => 'Bunpou', 'score' => 6.7, 'color' => 'bg-[#0ea5e9]', 'text-color' => 'text-[#102a4e]'],
                        ['label' => 'Choukai', 'score' => 5.7, 'color' => 'bg-[#ef4444]', 'text-color' => 'text-[#102a4e]'],
                    ];
                @endphp

                @foreach($scores as $item)
                <div class="bg-[#f3f4f6] rounded-full px-4 lg:px-6 py-2.5 flex items-center justify-between">
                    <span class="font-bold {{ $item['text-color'] }} w-1/3 text-xs lg:text-sm">{{ $item['label'] }}</span>
                    <span class="text-gray-500 font-medium text-[10px] lg:text-xs w-1/3 text-center">3 jam</span>
                    <div class="w-1/3 flex justify-end">
                         <div class="{{ $item['color'] }} text-white w-8 h-8 lg:w-9 lg:h-9 flex items-center justify-center rounded-full font-bold text-xs lg:text-sm shadow-md border-2 border-white">
                            {{ $item['score'] }}
                         </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ROW 2: TAHAPAN SISWA -->
     <div class="bg-white rounded-3xl shadow-sm p-8">
        <h3 class="text-[#102a4e] font-bold text-lg text-center mb-6">Tahapan Siswa</h3>
        
        <div class="relative px-4">
            <!-- Progress Bars -->
            <div class="flex w-full h-12 rounded-full overflow-hidden text-white font-bold text-xs sm:text-sm text-center leading-[48px]">
                <div class="bg-[#00902f] w-[16.6%] border-r border-white">Pendidikan</div>
                <div class="bg-[#00902f] w-[16.6%] border-r border-white">BLK / Evaluasi</div>
                <div class="bg-[#00902f] w-[16.6%] border-r border-white">Seleksi I</div>
                <div class="bg-[#fbbf24] w-[16.6%] border-r border-white text-[#102a4e]">MCU</div>
                <div class="bg-[#ef4444] w-[16.6%] border-r border-white">Tes Bahasa</div>
                <div class="bg-[#ef4444] w-[16.6%]">PELATDA</div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-8 mt-4 text-xs font-bold text-gray-600">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#00902f]"></span> Lolos
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#fbbf24]"></span> Proses
                </div>
                <!-- Note: Design shows Red as "Belum lolos" or similar in context, but adding generic Fail/Stop -->
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-[#ef4444]"></span> Belum lolos
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 3: PELANGGARAN & GRAFIK -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- PELANGGARAN -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6 flex flex-col h-full">
            <h3 class="font-bold text-[#102a4e] text-center mb-4 text-sm">Pelanggaran</h3>
            <div class="flex-1 bg-[#d95d5d] rounded-2xl flex items-center justify-center text-white shadow-sm min-h-[160px]">
                <span class="text-7xl font-bold">1</span>
            </div>
        </div>

        <!-- GRAFIK -->
        <div class="col-span-12 lg:col-span-8 bg-white rounded-3xl shadow-sm p-6 pb-2">
            <h3 class="font-bold text-[#102a4e] text-center mb-2 text-sm">Grafik Performa Siswa</h3>
            
            <div class="relative w-full h-60">
                <canvas id="performanceChart"></canvas>
            </div>
            
            <!-- Legend -->
            <div class="flex justify-center gap-6 mt-2 mb-2 text-xs font-semibold text-gray-500">
                 <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full border border-[#0ea5e9] bg-white ring-2 ring-[#0ea5e9] ring-offset-1"></div>
                    <span class="text-[#0ea5e9]">o--</span> 
                    <span>Bahasa</span>
                </div>
                 <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full border border-[#d95d5d] bg-white ring-2 ring-[#d95d5d] ring-offset-1"></div>
                     <span class="text-[#d95d5d]">o--</span> 
                    <span>Fisik & Mental</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ROW 4: BOTTOM CARDS -->
    <div class="grid grid-cols-12 gap-6">
        <!-- Bahasa -->
         <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col">
             <div class="bg-[#102a4e] px-4 py-3 flex items-center justify-between">
                 <span class="text-white font-bold text-sm">Bahasa</span>
                 <button class="bg-[#d95d5d] text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider hover:bg-red-600 transition">Minggu 2</button>
                 <button class="text-white hover:bg-white/10 p-1 rounded"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg></button>
             </div>
             <div class="p-6 flex-1 bg-white"></div> <!-- Content placeholder -->
         </div>

         <!-- Fisik & Mental -->
         <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm overflow-hidden flex flex-col">
             <div class="bg-[#102a4e] px-4 py-3">
                 <span class="text-white font-bold text-sm">Fisik & Mental</span>
             </div>
             <div class="p-6 flex-1 bg-white"></div> <!-- Content placeholder -->
         </div>

         <!-- Kehadiran -->
         <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm flex flex-col">
             <div class="p-5">
                 <h3 class="font-bold text-[#102a4e] text-center mb-4 text-sm">Kehadiran</h3>
                 <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between mb-4">
                     <span class="font-bold text-[#102a4e] text-sm">Masuk</span>
                     <span class="bg-[#102a4e] text-white w-7 h-7 flex items-center justify-center rounded-full font-bold text-xs">9</span>
                 </div>
                 <div class="bg-[#102a4e] rounded-xl h-10 w-full"></div>
             </div>
         </div>
    </div>

</div>

<!-- ChartJS Script -->
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
                        data: [30, 28, 75, 50, 55, 70, 65, 85],
                        borderColor: '#0ea5e9', // Blue
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#0ea5e9',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        borderWidth: 2,
                        tension: 0
                    },
                    {
                        label: 'Fisik & Mental',
                        data: [95, 40, 40, 75, 30, 15, 10, 30],
                        borderColor: '#d95d5d', // Red
                        backgroundColor: 'transparent',
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#d95d5d',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        borderWidth: 2,
                        tension: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 20,
                            font: { size: 10 }
                        },
                        grid: {
                            borderDash: [5, 5],
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: { size: 10 }
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
