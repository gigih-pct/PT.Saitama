@extends('layouts.header_dashboard_crm')

@section('title', 'Kesiswaan')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="bg-[#102a4e] rounded-xl p-4 flex items-center justify-between shadow-md">
        <div class="flex items-center gap-4">
            <a href="{{ route('crm.kesiswaan') }}" class="text-white hover:bg-white/10 p-2 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-white font-bold text-lg">Detail Data Siswa</h1>
        </div>
    </div>

    <!-- TOP SECTION: Profile & Follow Up -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- CARD 1: PROFILE info -->
        <div class="col-span-12 lg:col-span-6 bg-white rounded-3xl shadow-sm p-8 flex items-center gap-8 relative overflow-hidden">
            <!-- Background Decoration (Optional, keeps it clean white as per design) -->
            
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Info -->
            <div class="space-y-2 z-10">
                <p class="text-[#102a4e] font-medium"><span class="font-bold">Nama :</span> Gigih</p>
                <p class="text-[#102a4e] font-medium"><span class="font-bold">NIM :</span> 23.12.2865</p>
                <p class="text-[#102a4e] font-medium"><span class="font-bold">Tgl Lahir :</span> 18 Mei 2001</p>
                
                <div class="bg-[#f3f4f6] px-4 py-1.5 rounded-full inline-block text-xs font-bold text-[#102a4e] mt-1">
                    Kesempatan: 5/5
                </div>

                <div class="flex gap-2 mt-2">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white font-bold px-6 py-1.5 rounded-full shadow-md text-sm transition flex items-center gap-2">
                        <span>PLATDA</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    </button>
                    <button class="bg-[#00902f] hover:bg-green-700 text-white font-bold px-6 py-1.5 rounded-full shadow-md text-sm transition">
                        Akun siswa
                    </button>
                </div>
            </div>
        </div>

        <!-- CARD 2: FOLLOW UP -->
        <div class="col-span-12 lg:col-span-6 bg-white rounded-3xl shadow-sm p-8 flex flex-col items-center justify-center text-center">
            
            <h2 class="text-[#102a4e] font-bold text-2xl mb-6">Follow Up 1 :</h2>

            <div class="flex gap-4 mb-6">
                <button class="bg-[#00902f] hover:bg-green-700 text-white font-bold px-8 py-2 rounded-full shadow-md flex items-center gap-2 transition">
                    Respon
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                </button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white font-bold px-8 py-2 rounded-full shadow-md flex items-center gap-2 transition">
                    Jepang
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                </button>
            </div>

            <div class="bg-[#f3f4f6] px-6 py-2 rounded-full flex items-center gap-3">
                <span class="font-bold text-[#102a4e]">12/08/2025</span>
                <button class="text-[#d95d5d]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 bg-[#d95d5d] text-white rounded-full p-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                </button>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-sm p-8">
        <h3 class="text-[#102a4e] font-bold text-lg text-center mb-6">Tahapan Siswa</h3>
        
        <div class="relative px-4 overflow-x-auto">
            <!-- Progress Bars -->
            <div class="flex min-w-[800px] h-14 text-white font-bold text-sm text-center">
                <div class="bg-[#00902f] flex-1 border-r border-white flex items-center justify-center rounded-l-xl">Pendidikan</div>
                <div class="bg-[#00902f] flex-1 border-r border-white flex items-center justify-center">BLK / Evaluasi</div>
                <div class="bg-[#00902f] flex-1 border-r border-white flex items-center justify-center">Seleksi I</div>
                <div class="bg-[#fbbf24] flex-1 border-r border-white flex items-center justify-center text-[#102a4e]">MCU</div>
                <div class="bg-[#ef4444] flex-1 border-r border-white flex items-center justify-center">Tes Bahasa</div>
                <div class="bg-[#ef4444] flex-1 border-r border-white flex items-center justify-center">PELATDA</div>
                <div class="bg-[#ef4444] flex-1 border-r border-white flex items-center justify-center">PELATNAS</div>
                <div class="bg-[#ef4444] flex-1 flex items-center justify-center rounded-r-xl">Jepang</div>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-8 mt-4 text-sm font-bold text-gray-700">
                <div class="flex items-center gap-2">
                    <span class="w-4 h-3 rounded-full bg-[#00902f]"></span> Lolos
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-3 rounded-full bg-[#fbbf24]"></span> Proses
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-4 h-3 rounded-full bg-[#ef4444]"></span> Belum lolos
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: Testimoni & Grafik -->
    <div class="flex flex-col lg:flex-row gap-6">
        
        <!-- Testimoni Card (5/12) -->
        <div class="w-full lg:w-3/12 bg-white rounded-3xl shadow-sm p-8 flex flex-col">
            <h3 class="text-center font-bold text-[#102a4e] mb-6">Testimoni</h3>
            
            <div class="bg-[#f3f4f6] rounded-xl p-8 flex-1 flex items-center justify-center text-center">
                <p class="font-bold text-[#102a4e] text-lg">Bagus!!!</p>
            </div>

            <div class="mt-6 flex justify-center">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white font-bold px-8 py-2 rounded-full shadow-md flex items-center gap-2 transition">
                    <span>File</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
            </div>
        </div>

        <!-- Grafik Performa Card (7/12) -->
        <div class="w-full lg:w-9/12 bg-white rounded-3xl shadow-sm p-8 flex flex-col">
            <h3 class="text-center font-bold text-[#102a4e] mb-6">Grafik Performa Siswa</h3>
            
            <div class="relative w-full h-80">
                <canvas id="performanceChart"></canvas>
            </div>
        </div>

    </div>

    <!-- Berkas Pendaftaran Title -->
    <div class="bg-[#102a4e] text-white p-4 rounded-xl font-bold">
        Berkas Pendaftaran
    </div>

    <!-- Berkas Pendaftaran List Placeholder matching design -->
    <div class="bg-[#f3f4f6] rounded-xl p-6 flex items-center justify-between">
        <span class="font-bold text-[#102a4e]">Fotocopy KTP</span>
         <div class="bg-white px-8 py-2 rounded-lg text-gray-400 text-sm italic">
            Keterangan
        </div>
         <button>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#102a4e]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
        </button>
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
                        borderColor: '#3b82f6', // Blue
                        backgroundColor: '#3b82f6',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#3b82f6',
                        pointRadius: 4,
                        tension: 0.4 // Smooth curve
                    },
                    {
                        label: 'Fisik & Mental',
                        data: [80, 55, 55, 75, 45, 30, 25, 45],
                        borderColor: '#ef4444', // Red
                        backgroundColor: '#ef4444',
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#ef4444',
                        pointRadius: 4,
                        tension: 0.4 // Smooth curve
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 20,
                            font: {
                                size: 12,
                                family: 'Inter',
                                weight: 'bold'
                            },
                            color: '#4b5563'
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(255, 255, 255, 0.9)',
                        titleColor: '#102a4e',
                        bodyColor: '#102a4e',
                        borderColor: '#e5e7eb',
                        borderWidth: 1
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        grid: {
                            color: '#f3f4f6',
                            borderDash: [5, 5]
                        },
                        ticks: {
                            stepSize: 20,
                            color: '#9ca3af',
                            font: {
                                family: 'Inter'
                            }
                        },
                        border: {
                            display: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#9ca3af',
                            font: {
                                size: 10,
                                family: 'Inter'
                            }
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
