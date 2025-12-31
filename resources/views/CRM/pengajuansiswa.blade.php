@extends('layouts.header_dashboard_crm')

@section('title', 'Pengajuan Siswa')

@section('content')
<div class="space-y-6">
    
    <!-- MAIN CARD -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Header Section -->
        <div class="bg-[#173A67] px-10 py-7 flex items-center justify-between">
            <div class="flex items-center gap-5">
                <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center">
                    <i data-lucide="file-text" class="w-6 h-6 text-red-500"></i>
                </div>
                <div>
                    <h1 class="text-white font-extrabold text-2xl tracking-tight">Daftar Pengajuan</h1>
                    <p class="text-white/50 text-[10px] font-extrabold uppercase tracking-[0.2em] mt-0.5">Verifikasi Berkas Siswa</p>
                </div>
                <span class="bg-[#D85B63] text-white text-[10px] font-extrabold px-4 py-1.5 rounded-full uppercase tracking-widest ml-2">A2</span>
            </div>
            
            <button class="w-12 h-12 bg-white/5 hover:bg-white/10 text-white rounded-2xl flex items-center justify-center transition-all border border-white/10">
                <i data-lucide="filter" class="w-5 h-5"></i>
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
            <div class="bg-white border border-gray-100 rounded-[2rem] px-8 py-5 flex items-center justify-between gap-8 hover:shadow-xl hover:shadow-blue-900/5 transition-all group border-b-4 border-b-transparent hover:border-b-blue-100">
                <!-- Info -->
                <div class="flex items-center gap-5 w-60 shrink-0">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#173A67] flex items-center justify-center text-sm font-extrabold shadow-sm group-hover:scale-110 transition-transform">
                        {{ substr($sub['name'], 0, 1) }}
                    </div>
                    <div class="font-extrabold text-[#173A67] text-base truncate">{{ $sub['name'] }}</div>
                </div>
                
                <!-- Document Type -->
                <div class="bg-gray-50 px-8 py-3 rounded-2xl font-extrabold text-xs text-[#173A67] w-48 text-center border border-gray-100 uppercase tracking-widest group-hover:bg-white transition-colors">
                    {{ $sub['type'] }}
                </div>
                
                <!-- Actions -->
                <div class="flex items-center gap-3">
                    <!-- Bukti Download -->
                    <button class="bg-white border-2 border-red-100 text-[#D85B63] text-[10px] font-extrabold px-6 py-3 rounded-2xl flex items-center gap-2.5 hover:bg-[#D85B63] hover:text-white hover:border-[#D85B63] transition-all uppercase tracking-widest shadow-sm">
                        <span>Bukti</span>
                        <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                    
                    <!-- Reject -->
                    <button class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all shadow-sm group/btn active:scale-90">
                        <i data-lucide="x" class="w-6 h-6"></i>
                    </button>

                    <!-- Accept -->
                    <button class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center hover:bg-green-600 hover:text-white transition-all shadow-sm group/btn active:scale-90">
                        <i data-lucide="check" class="w-6 h-6"></i>
                    </button>

                    <!-- Detail -->
                    <button class="w-12 h-12 rounded-2xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 transition-all shadow-lg shadow-blue-900/10 active:scale-90 group-hover:rotate-12">
                        <i data-lucide="eye" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between mt-10">
        <div class="flex items-center gap-4">
            <button class="bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-8 py-3 text-xs font-extrabold rounded-2xl transition-all shadow-sm active:scale-95 flex items-center gap-2.5 uppercase tracking-widest">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Prev
            </button>
            <div class="flex gap-2">
                <span class="bg-[#173A67] text-white w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-extrabold shadow-xl shadow-blue-900/10">1</span>
                <span class="bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">2</span>
                <span class="bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">3</span>
                <span class="w-12 h-12 flex items-center justify-center text-gray-300 font-bold uppercase tracking-widest">...</span>
                <span class="bg-white border border-gray-100 text-gray-400 w-12 h-12 flex items-center justify-center rounded-2xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all uppercase">68</span>
            </div>
            <button class="bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-8 py-3 text-xs font-extrabold rounded-2xl transition-all shadow-sm active:scale-95 flex items-center gap-2.5 uppercase tracking-widest">
                Next <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="bg-blue-50 text-[#173A67] px-8 py-3 rounded-2xl text-[11px] font-extrabold uppercase tracking-[0.2em] border border-blue-100 shadow-sm">
            50 Siswa / Halaman
        </div>
    </div>

</div>
@endsection
