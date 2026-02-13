@extends('layouts.header_dashboard_crm')

@section('title', 'Data Kelas')

@section('content')
<div class="space-y-6">
    
    <!-- MAIN CARD -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Header Section -->
        <div class="bg-[#173A67] px-6 sm:px-10 py-6 sm:py-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/10 rounded-xl sm:rounded-2xl flex items-center justify-center">
                    <i data-lucide="layers" class="w-5 h-5 sm:w-6 sm:h-6 text-red-500"></i>
                </div>
                <div>
                    <h1 class="text-white font-extrabold text-xl sm:text-2xl tracking-tight">Data Kelas</h1>
                    <p class="text-white/50 text-[9px] sm:text-[10px] font-extrabold uppercase tracking-[0.2em] mt-0.5">Manajemen Kelas & Kelompok Belajar</p>
                </div>
                <span class="bg-[#D85B63] text-white text-[9px] sm:text-[10px] font-extrabold px-3 sm:px-4 py-1.5 rounded-full uppercase tracking-widest ml-1 sm:ml-2">Angkatan IV</span>
            </div>
            
            <button class="w-full sm:w-12 h-12 bg-white/5 hover:bg-white/10 text-white rounded-xl sm:rounded-2xl flex items-center justify-center transition-all border border-white/10">
                <i data-lucide="filter" class="w-5 h-5"></i>
                <span class="sm:hidden ml-2 text-xs font-black uppercase tracking-widest">Filter Data</span>
            </button>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-8 space-y-4 bg-[#F8FAFC]/50">
            
            @php
                $classes = [
                    ['name' => 'Kelas A1', 'count' => 45],
                    ['name' => 'Kelas A2', 'count' => 42],
                    ['name' => 'Kelas A3', 'count' => 38],
                    ['name' => 'Kelas A4', 'count' => 40],
                    ['name' => 'Kelas A5', 'count' => 45],
                ];
            @endphp

            @foreach($classes as $class)
            <!-- CLASS ROW -->
            <div class="bg-white border border-gray-100 rounded-[1.5rem] sm:rounded-[2rem] p-5 sm:px-8 sm:py-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4 sm:gap-8 hover:shadow-xl hover:shadow-blue-900/5 transition-all group border-b-4 border-b-transparent hover:border-b-blue-100">
                <!-- Info -->
                <div class="flex items-center gap-4 sm:gap-5 w-full sm:w-60 shrink-0">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center text-xs sm:text-sm font-extrabold shadow-sm group-hover:scale-110 transition-transform">
                        {{ substr($class['name'], -2) }}
                    </div>
                    <div class="font-extrabold text-[#173A67] text-sm sm:text-base truncate">{{ $class['name'] }}</div>
                </div>
                
                <!-- Student Count -->
                <div class="bg-gray-50 px-6 sm:px-8 py-3 rounded-xl sm:rounded-2xl font-extrabold text-[10px] sm:text-xs text-[#173A67] flex-1 max-w-full sm:max-w-sm text-center border border-gray-100 uppercase tracking-widest group-hover:bg-white transition-colors">
                    Jumlah Siswa: {{ $class['count'] }}
                </div>
                
                <!-- Actions -->
                <button class="w-full sm:w-12 h-12 py-3 sm:py-0 rounded-xl sm:rounded-2xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 transition-all shadow-lg shadow-blue-900/10 active:scale-90 group-hover:rotate-12">
                    <i data-lucide="eye" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                    <span class="sm:hidden ml-2 text-xs font-black uppercase tracking-widest">Lihat Detail</span>
                </button>
            </div>
            @endforeach

        </div>

    </div>

</div>
@endsection
