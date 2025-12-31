@extends('layouts.header_dashboard_keuangan')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-8">

    <!-- TOP SECTION: Profile and Kehadiran side-by-side -->
    <div class="flex flex-col lg:flex-row gap-6 items-stretch">
        
        <!-- CARD 1: PROFILE INFO -->
        <div class="flex-1 min-w-0 bg-white rounded-[2.5rem] shadow-sm p-10 flex flex-col justify-center relative overflow-hidden border border-gray-100">
            <div class="flex items-center gap-10 relative z-10">
                <!-- Avatar -->
                <div class="shrink-0">
                    <div class="w-32 h-32 rounded-full overflow-hidden border-[6px] border-[#FFF8E7] shadow-lg">
                        <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Info -->
                <div class="space-y-2">
                    <div class="space-y-1">
                        <p class="text-[#102a4e] text-lg"><span class="font-extrabold">Nama :</span> Maharani</p>
                        <p class="text-[#102a4e] text-lg"><span class="font-extrabold">NIS :</span> 23.2865</p>
                        <p class="text-[#102a4e] text-lg"><span class="font-extrabold">Tgl Lahir :</span> 10 Agustus 2004</p>
                    </div>
                    
                    <button class="bg-[#fbbf24] hover:bg-[#f59e0b] text-[#102a4e] font-black px-10 py-3 rounded-2xl shadow-md text-sm mt-4 transition-all uppercase tracking-wide">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Edit Button (Top Right) -->
            <div class="absolute top-10 right-10">
                 <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-black px-7 py-2.5 rounded-2xl flex items-center gap-2 shadow-md transition-all text-sm uppercase italic tracking-tighter">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    <span>Edit</span>
                </button>
            </div>
        </div>

        <!-- CARD 2: KEHADIRAN -->
        <div class="w-full lg:w-[400px] bg-white rounded-[2.5rem] shadow-sm p-10 flex flex-col items-center justify-center text-center border border-gray-100">
             <div class="flex items-center gap-4 mb-8">
                 <span class="font-black text-[#102a4e] text-xl">Kehadiran</span>
                 <span class="bg-[#00902f] text-white text-[12px] uppercase font-black px-6 py-2 rounded-full shadow-sm tracking-widest">Baik</span>
             </div>
             <h2 class="text-[#102a4e] font-black text-8xl tracking-tighter">75%</h2>
        </div>
    </div>

    <!-- PEMBAYARAN TABLE SECTION -->
    <div class="bg-white rounded-[2.5rem] shadow-sm overflow-hidden border border-gray-100">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-10 py-6">
            <h3 class="text-white font-black text-xl tracking-tight">Pembayaran</h3>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-10 space-y-5">
            
            <!-- ROW 1 -->
            <div class="bg-[#f3f4f6] rounded-[2rem] px-10 py-6 flex items-center justify-between gap-10 hover:bg-[#ebecef] transition-colors">
                <div class="w-48 font-black text-[#102a4e] text-lg">Budi A ..</div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[#102a4e] font-bold text-base">Jumlah Pembayaran:</span>
                    <span class="bg-[#fbbf24] text-[#102a4e] font-black text-base px-8 py-2.5 rounded-full shadow-md">Rp 4.000.000</span>
                </div>

                <div class="bg-[#00902f] text-white text-xs font-black px-8 py-3 rounded-full shadow-md tracking-wider uppercase">Biaya Pendaftaran</div>
                
                <div class="flex items-center gap-4">
                    <button class="bg-[#d95d5d] text-white px-8 py-2.5 rounded-2xl text-sm font-black flex items-center gap-2 shadow-md hover:bg-red-700 transition">
                        <span>File</span> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    </button>
                    <button class="bg-[#d95d5d] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-red-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    </button>
                </div>
            </div>

            <!-- ROW 2 -->
             <div class="bg-[#f3f4f6] rounded-[2rem] px-10 py-6 flex items-center justify-between gap-10 hover:bg-[#ebecef] transition-colors">
                <div class="w-48 font-black text-[#102a4e] text-lg">Yanto</div>
                
                <div class="flex items-center gap-4">
                    <span class="text-[#102a4e] font-bold text-base">Jumlah Pembayaran:</span>
                    <span class="bg-[#fbbf24] text-[#102a4e] font-black text-base px-8 py-2.5 rounded-full shadow-md">Rp 200.000</span>
                </div>

                <div class="bg-[#00902f] text-white text-xs font-black px-8 py-3 rounded-full shadow-md tracking-wider uppercase">Biaya Pendaftaran</div>
                
                <div class="flex items-center gap-4">
                    <button class="bg-[#d95d5d] text-white px-8 py-2.5 rounded-2xl text-sm font-black flex items-center gap-2 shadow-md hover:bg-red-700 transition">
                        <span>File</span> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    </button>
                    <button class="bg-[#d95d5d] text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md hover:bg-red-700 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    </button>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
