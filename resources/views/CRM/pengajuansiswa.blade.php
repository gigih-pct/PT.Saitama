@extends('layouts.header_dashboard_crm')

@section('title', 'Pengajuan Siswa')

@section('content')
<div class="space-y-6">
    
    <!-- MAIN CARD -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Header Section -->
        <div class="bg-[#173A67] px-6 sm:px-10 py-6 sm:py-7 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4 sm:gap-5">
                <div class="w-10 h-10 sm:w-12 sm:h-12 bg-white/10 rounded-xl sm:rounded-2xl flex items-center justify-center">
                    <i data-lucide="file-text" class="w-5 h-5 sm:w-6 sm:h-6 text-red-500"></i>
                </div>
                <div>
                    <h1 class="text-white font-extrabold text-xl sm:text-2xl tracking-tight">Daftar Pengajuan</h1>
                    <p class="text-white/50 text-[9px] sm:text-[10px] font-extrabold uppercase tracking-[0.2em] mt-0.5">Verifikasi Berkas Siswa</p>
                </div>
                <span class="bg-[#D85B63] text-white text-[9px] sm:text-[10px] font-extrabold px-3 sm:px-4 py-1.5 rounded-full uppercase tracking-widest ml-1 sm:ml-2">A2</span>
            </div>
            
            <button class="w-full sm:w-12 h-12 bg-white/5 hover:bg-white/10 text-white rounded-xl sm:rounded-2xl flex items-center justify-center transition-all border border-white/10">
                <i data-lucide="filter" class="w-5 h-5"></i>
                <span class="sm:hidden ml-2 text-xs font-black uppercase tracking-widest">Filter Data</span>
            </button>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-8 space-y-4 bg-[#F8FAFC]/50">
            
            @php
                $submissions = [
                    ['name' => 'Agung', 'type' => 'Passport'],
                    ['name' => 'Budi', 'type' => 'Passport'],
                    ['name' => 'Sita', 'type' => 'Passport'],
                    ['name' => 'Yanto', 'type' => 'Passport'],
                    ['name' => 'Budiman', 'type' => 'Passport'],
                    ['name' => 'Ahmad', 'type' => 'Passport'],
                    ['name' => 'Lany', 'type' => 'Passport'],
                    ['name' => 'Dewi', 'type' => 'Passport'],
                ];
            @endphp

            @foreach($submissions as $sub)
            <!-- SUBMISSION ROW -->
            <div class="bg-white border border-gray-100 rounded-[1.5rem] sm:rounded-[2rem] p-5 sm:px-8 sm:py-5 flex flex-col lg:flex-row lg:items-center justify-between gap-4 lg:gap-8 hover:shadow-xl hover:shadow-blue-900/5 transition-all group border-b-4 border-b-transparent hover:border-b-blue-100">
                
                <!-- Top Row (Mobile/Tablet) -->
                <div class="flex items-center justify-between lg:hidden mb-1">
                     <div class="flex items-center gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#173A67] flex items-center justify-center text-xs font-extrabold shadow-sm">
                            {{ substr($sub['name'], 0, 1) }}
                        </div>
                        <div class="font-extrabold text-[#173A67] text-sm truncate">{{ $sub['name'] }}</div>
                     </div>
                     <div class="bg-gray-50 px-4 py-2 rounded-xl font-extrabold text-[9px] text-[#173A67] border border-gray-100 uppercase tracking-widest">
                        {{ $sub['type'] }}
                     </div>
                </div>

                <!-- Info (Desktop) -->
                <div class="hidden lg:flex items-center gap-5 w-60 shrink-0">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center text-sm font-extrabold shadow-sm group-hover:scale-110 transition-transform">
                        {{ substr($sub['name'], 0, 1) }}
                    </div>
                    <div class="font-extrabold text-[#173A67] text-base truncate">{{ $sub['name'] }}</div>
                </div>
                
                <!-- Document Type (Desktop) -->
                <div class="hidden lg:block bg-gray-50 px-8 py-3 rounded-2xl font-extrabold text-xs text-[#173A67] w-48 text-center border border-gray-100 uppercase tracking-widest group-hover:bg-white transition-colors">
                    {{ $sub['type'] }}
                </div>
                
                <!-- Actions -->
                <div class="grid grid-cols-4 sm:flex sm:items-center gap-2 sm:gap-3">
                    <!-- Bukti Download -->
                    <button class="col-span-2 sm:col-auto bg-white border-2 border-red-100 text-[#D85B63] text-[9px] sm:text-[10px] font-extrabold px-4 sm:px-6 py-3 rounded-xl sm:rounded-2xl flex items-center justify-center gap-2 sm:gap-2.5 hover:bg-[#D85B63] hover:text-white hover:border-[#D85B63] transition-all uppercase tracking-widest shadow-sm">
                        <span>Bukti</span>
                        <i data-lucide="download" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                    </button>
                    
                    <div class="flex gap-2 col-span-2 sm:col-auto">
                        <!-- Reject -->
                        <button class="flex-1 sm:w-12 sm:h-12 py-3 sm:py-0 rounded-xl sm:rounded-2xl bg-[#D85B63] text-white flex items-center justify-center hover:bg-red-600 hover:rotate-12 transition-all shadow-lg shadow-red-900/10 active:scale-90">
                            <i data-lucide="x" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        </button>

                        <!-- Accept -->
                        <button class="flex-1 sm:w-12 sm:h-12 py-3 sm:py-0 rounded-xl sm:rounded-2xl bg-[#22C55E] text-white flex items-center justify-center hover:bg-green-600 hover:rotate-12 transition-all shadow-lg shadow-green-900/10 active:scale-90">
                            <i data-lucide="check" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        </button>

                        <!-- Detail -->
                        <button class="flex-1 sm:w-12 sm:h-12 py-3 sm:py-0 rounded-xl sm:rounded-2xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 transition-all shadow-lg shadow-blue-900/10 active:scale-90 group-hover:rotate-12">
                            <i data-lucide="eye" class="w-5 h-5 sm:w-6 sm:h-6"></i>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="flex flex-col lg:flex-row items-center justify-between mt-10 gap-6">
        <div class="flex flex-col sm:flex-row items-center gap-4 w-full lg:w-auto">
            <button class="w-full sm:w-auto bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-8 py-3.5 text-xs font-extrabold rounded-2xl transition-all shadow-sm active:scale-95 flex items-center justify-center gap-2.5 uppercase tracking-widest">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Prev
            </button>
            <div class="flex gap-2">
                <span class="bg-[#173A67] text-white w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-extrabold shadow-xl shadow-blue-900/10">1</span>
                <span class="bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">2</span>
                <span class="bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">3</span>
                <span class="hidden sm:flex w-12 h-12 items-center justify-center text-gray-300 font-bold uppercase tracking-widest">...</span>
                <span class="hidden sm:flex bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">68</span>
            </div>
            <button class="w-full sm:w-auto bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-8 py-3.5 text-xs font-extrabold rounded-2xl transition-all shadow-sm active:scale-95 flex items-center justify-center gap-2.5 uppercase tracking-widest">
                Next <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="w-full lg:w-auto bg-blue-50 text-[#173A67] px-8 py-3.5 rounded-2xl text-[10px] sm:text-[11px] font-extrabold uppercase tracking-[0.2em] border border-blue-100 shadow-sm text-center">
            50 Siswa / Halaman
        </div>
    </div>

</div>
@endsection
