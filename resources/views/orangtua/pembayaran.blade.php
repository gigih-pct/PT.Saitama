@extends('layouts.header_dashboard_orangtua')

@section('title', 'Pembayaran')

@section('content')
<div class="space-y-6">

    <!-- PROFILE HEADER (Reused) -->
    <div class="bg-white rounded-3xl shadow-sm p-8 flex items-center justify-center gap-12 text-center md:text-left">
        <!-- Avatar -->
        <div class="relative shrink-0">
            <div class="w-40 h-40 rounded-full border-4 border-[#0ea5e9] p-1 mx-auto">
                <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full rounded-full object-cover">
            </div>
        </div>

        <!-- Info -->
        <div class="space-y-4">
            <div class="space-y-1">
                <p class="text-[#102a4e] text-lg"><span class="font-bold">Nama :</span> <span class="font-medium">Gigih</span></p>
                <p class="text-[#102a4e] text-lg"><span class="font-bold">NIM :</span> <span class="font-medium">23.12.2865</span></p>
                <p class="text-[#102a4e] text-lg"><span class="font-bold">Tgl Lahir :</span> <span class="font-medium">18 Mei 2001</span></p>
            </div>
            
            <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-lg transition active:scale-95 text-base mx-auto md:mx-0">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6 bg-white rounded-full p-0.5">
                    <span>Hubungi Kami</span>
            </button>
        </div>
    </div>

    <!-- PEMBAYARAN LIST -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-5 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="text-white font-bold text-lg">Pembayaran</span>
                <span class="bg-[#d95d5d] text-white text-xs font-bold px-4 py-1 rounded-full">BRI</span>
            </div>
            <button class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
            </button>
        </div>

        <!-- List Items -->
        <div class="p-8 space-y-4">
            
            <!-- Item 1: Pendaftaran -->
            <div class="bg-[#f3f4f6] rounded-2xl px-8 py-6 flex items-center justify-between">
                <span class="text-[#102a4e] font-bold text-lg w-1/4">Biaya Pendaftaran</span>
                
                <div class="flex items-center gap-4 text-[#102a4e] font-bold text-lg">
                    <span>Rp 250.000</span>
                    <span>/</span>
                    <span>Rp 250.000</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="bg-[#00902f] text-white font-bold px-8 py-2 rounded-xl text-center w-32 shadow-md">Lunas</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl shadow-md transition active:scale-95">Bayar</button>
                </div>
            </div>

            <!-- Item 2: Pendidikan -->
            <div class="bg-[#f3f4f6] rounded-2xl px-8 py-6 flex items-center justify-between">
                <span class="text-[#102a4e] font-bold text-lg w-1/4">Biaya Pendidikan</span>
                
                <div class="flex items-center gap-4 text-[#102a4e] font-bold text-lg">
                    <span>Rp 250.000</span>
                    <span>/</span>
                    <span>Rp 4.500.000</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="bg-[#fbbf24] text-[#102a4e] font-bold px-8 py-2 rounded-xl text-center w-32 shadow-md">60%</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl shadow-md transition active:scale-95">Bayar</button>
                </div>
            </div>

            <!-- Item 3: BLK -->
            <div class="bg-[#f3f4f6] rounded-2xl px-8 py-6 flex items-center justify-between">
                <span class="text-[#102a4e] font-bold text-lg w-1/4">Biaya BLK</span>
                
                <div class="flex items-center gap-4 text-[#102a4e] font-bold text-lg pl-12">
                     <span>-</span>
                    <span>/</span>
                    <span>-</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="bg-white text-[#102a4e] font-bold px-4 py-2 rounded-xl text-center w-32 shadow-sm border border-gray-200 text-sm">Tidak BLK</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl shadow-md transition active:scale-95">Bayar</button>
                </div>
            </div>

             <!-- Item 4: Asrama -->
             <div class="bg-[#f3f4f6] rounded-2xl px-8 py-6 flex items-center justify-between">
                <span class="text-[#102a4e] font-bold text-lg w-1/4">Biaya Asrama</span>
                
                <div class="flex items-center gap-4 text-[#102a4e] font-bold text-lg pl-12">
                    <span>-</span>
                    <span>/</span>
                    <span>-</span>
                </div>

                <div class="flex items-center gap-4">
                    <span class="bg-white text-[#102a4e] font-bold px-4 py-2 rounded-xl text-center w-32 shadow-sm border border-gray-200 text-sm">Tidak Asrama</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl shadow-md transition active:scale-95">Bayar</button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
