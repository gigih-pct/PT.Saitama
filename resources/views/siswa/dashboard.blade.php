@extends('layouts.header_dashboard_siswa')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    @if (session('status_message'))
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-xl shadow-sm mb-6" role="alert">
            <p class="font-bold">Informasi Akun</p>
            <p>{{ session('status_message') }}</p>
        </div>
    @endif

    <!-- TOP SECTION: PROFILE & STATUS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 animate-in fade-in slide-in-from-top-4 duration-700">
        
        <!-- CARD 1: PROFILE INFO -->
        <div class="bg-white rounded-[2.5rem] shadow-sm p-10 flex flex-col md:flex-row items-center gap-10 relative overflow-hidden group border border-gray-50">
            <!-- Subtle Background -->
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#173A67]/5 rounded-full group-hover:scale-110 transition-transform duration-700"></div>

            <!-- Avatar -->
            <div class="flex-shrink-0 relative">
                <div class="w-32 h-32 rounded-[2rem] bg-gray-100 p-1 rotate-3 group-hover:rotate-0 transition-transform duration-500 shadow-lg shadow-[#173A67]/10 overflow-hidden">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Info -->
            <div class="flex-1 space-y-4 relative z-10">
                <div>
                    <h2 class="text-2xl font-extrabold text-[#173A67] tracking-tight">{{ Auth::user()->name ?? 'Siswa' }}</h2>
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Siswa Aktif • Angkatan VI</p>
                </div>

                <!-- Data Grid -->
                <div class="grid grid-cols-2 gap-y-4 gap-x-6">
                    <div>
                        <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest">NIS</p>
                        <p class="text-sm font-bold text-[#173A67]">23.12865</p>
                    </div>
                    <div>
                        <p class="text-[9px] text-gray-400 font-extrabold uppercase tracking-widest">Kelas</p>
                        <p class="text-sm font-bold text-[#173A67]/80">{{ Auth::user()->kelas->nama_kelas ?? '-' }}</p>
                    </div>
                    <div class="col-span-2 border-t border-gray-50 pt-3">
                        <button class="bg-[#22C55E]/10 text-[#22C55E] text-[10px] font-extrabold px-5 py-2.5 rounded-xl hover:bg-[#22C55E] hover:text-white transition-all shadow-sm">
                            REQUEST DOKUMEN
                        </button>
                    </div>
                </div>
            </div>

            <button class="absolute top-8 right-8 text-gray-300 hover:text-[#D85B63] transition-colors">
                 <i data-lucide="settings" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- CARD 2: STATUS SISWA -->
        <div class="bg-[#173A67] rounded-[2.5rem] shadow-xl p-10 flex flex-col justify-between relative overflow-hidden group">
             <!-- Decor -->
             <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/5 rounded-tl-full -mb-16 -mr-16"></div>
             
             <div class="flex justify-between items-start relative z-10">
                 <div>
                     <h3 class="text-white/70 font-bold text-xs uppercase tracking-widest">Status Terkini</h3>
                     <h2 class="text-white font-extrabold text-2xl tracking-tight mt-1">Seleksi Tahap I</h2>
                 </div>
                 <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center text-white">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                 </div>
             </div>

             <div class="mt-10 relative z-10">
                 <div class="flex items-center gap-4 bg-white/10 rounded-3xl p-4 backdrop-blur-md border border-white/10">
                    <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-[#22C55E] shadow-inner">
                        <i data-lucide="check-circle-2" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <p class="text-white font-extrabold text-xl">LOLOS</p>
                        <p class="text-white/50 text-[10px] font-bold uppercase tracking-wider">Verifikasi 12 Des 2025</p>
                    </div>
                 </div>
             </div>
        </div>
    </div>

    <!-- TAHAPAN SISWA (PROGRESS BAR) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm p-10 border border-gray-50">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h3 class="text-[#173A67] font-extrabold text-lg tracking-tight">Alur Pendidikan</h3>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Progress perjalan anda</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-[#22C55E]"></span>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Selesai</span>
                </div>
                <div class="flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Berjalan</span>
                </div>
            </div>
        </div>
        
        <div class="relative px-2">
            <!-- Progress Steps -->
            <div class="grid grid-cols-6 gap-3">
                @php
                    $steps = [
                        ['Pendidikan', true],
                        ['BLK', true],
                        ['Seleksi I', true],
                        ['MCU', 'proses'],
                        ['Bahasa', false],
                        ['PELATDA', false]
                    ];
                @endphp
                @foreach($steps as $step)
                <div class="relative group">
                    <div class="h-14 rounded-2xl flex items-center justify-center text-[10px] font-extrabold uppercase tracking-tighter text-center px-2 transition-all
                        {{ $step[1] === true ? 'bg-[#22C55E]/10 text-[#22C55E]' : ($step[1] === 'proses' ? 'bg-yellow-50 text-yellow-600 border border-yellow-100 shadow-sm' : 'bg-gray-50 text-gray-300') }}">
                        {{ $step[0] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- MIDDLE SECTION: PEMBAYARAN & PEMBERKASAN -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- Pembayaran -->
        <div class="col-span-12 lg:col-span-6 bg-white rounded-3xl shadow-sm p-6 relative">
            <div class="flex justify-between items-center mb-6 px-2">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-[#102a4e]">Pembayaran</h3>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5">
                </div>
                <button class="text-red-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                </button>
            </div>

            <div class="bg-[#e5e7eb] rounded-xl py-12 flex items-center justify-center gap-4 font-bold text-[#102a4e] text-lg">
                <span>Rp 250.000</span>
                <span>/</span>
                <span>Rp 4.500.000</span>
            </div>
        </div>

        <!-- Pemberkasan -->
        <div class="col-span-12 lg:col-span-6 bg-white rounded-3xl shadow-sm p-6">
             <div class="flex justify-between items-center bg-[#102a4e] text-white px-4 py-3 rounded-xl mb-6">
                 <div class="flex items-center gap-2">
                    <span class="font-bold">Pemberkasan</span>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5 bg-white rounded-full p-0.5">
                 </div>
                 <button class="bg-[#ef4444] text-xs font-bold px-3 py-1 rounded shadow-sm hover:bg-red-600 transition">Berkas Lainnya</button>
             </div>

             <div class="space-y-4 px-2">
                 <!-- Item 1 -->
                 <div class="flex items-center justify-between">
                     <span class="font-bold text-[#102a4e] text-sm">Fotocopy Ijasah SD</span>
                     <div class="flex items-center gap-8">
                         <span class="text-[#102a4e] font-bold text-xl">✓</span> <!-- Checkmark -->
                         <span class="bg-[#ef4444] text-white text-xs font-bold px-6 py-1.5 rounded-full inline-block w-24 text-center">Ditolak</span>
                     </div>
                 </div>
                 <!-- Item 2 -->
                 <div class="flex items-center justify-between">
                     <span class="font-bold text-[#102a4e] text-sm">Fotocopy Ijasah SMP</span>
                     <div class="flex items-center gap-8">
                         <span class="text-black font-bold text-xl">✕</span> <!-- X mark -->
                         <span class="bg-[#e5e7eb] text-gray-400 text-xs font-bold px-6 py-1.5 rounded-full inline-block w-24 text-center">-</span>
                     </div>
                 </div>
             </div>
        </div>
    </div>
    
    <!-- BOTTOM SECTION: JADWAL, BAHASA, NILAI -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- JADWAL -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6">
             <div class="flex items-center gap-3 bg-[#102a4e] text-white px-4 py-2 rounded-xl mb-4">
                 <span class="font-bold text-sm">Jadwal</span>
                 <span class="bg-white text-[#102a4e] text-xs font-bold px-3 py-0.5 rounded-full">Hari ini</span>
             </div>
             
             <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Kanji</span>
                 <span class="font-bold text-[#102a4e] text-sm">13.00 - 15.00</span>
                 <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5">
             </div>
             
             <!-- Spacer for visual balance -->
             <div class="h-4"></div>
        </div>

        <!-- BAHASA -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6">
             <div class="flex items-center justify-between bg-[#102a4e] text-white px-4 py-2 rounded-xl mb-4">
                 <div class="flex items-center gap-3">
                     <span class="font-bold text-sm">Bahasa</span>
                     <span class="bg-white text-[#102a4e] text-xs font-bold px-3 py-0.5 rounded-full">Evaluasi I</span>
                 </div>
                 <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16m-7 6h7"/></svg>
             </div>
             
             <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Kanji</span>
                 <span class="bg-[#d95d5d] text-white font-bold w-8 h-8 flex items-center justify-center rounded-full text-xs shadow-md">7.7</span>
             </div>
        </div>

        <!-- NILAI AKHIR -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6">
             <div class="flex items-center justify-between bg-[#102a4e] text-white px-4 py-2 rounded-xl mb-4">
                 <span class="font-bold text-sm ml-2">Laporan Nilai Akhir</span>
                 <span class="bg-[#00902f] text-white text-xs font-bold px-4 py-1 rounded-full">Siap Seleksi</span>
             </div>
             
             <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Kanji</span>
                 <span class="text-gray-500 font-medium text-xs">3 jam</span>
                 <span class="bg-[#d95d5d] text-white font-bold w-8 h-8 flex items-center justify-center rounded-full text-xs shadow-md">7.7</span>
             </div>
        </div>
    </div>

</div>
@endsection
