@extends('layouts.header_dashboard_siswa')

@section('title', 'Pembayaran Siswa')

@section('content')
<div class="space-y-6">

    <!-- CARD: PROFILE (Wide) -->
    <div class="bg-white rounded-3xl shadow-sm p-8 flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16 text-center md:text-left min-h-[300px]">
         <!-- Avatar Circle -->
         <div class="relative w-40 h-40 lg:w-48 lg:h-48 flex items-center justify-center shrink-0">
            <!-- Blue circle background -->
            <div class="absolute inset-0 bg-[#0ea5e9] rounded-full"></div>
            
            <!-- Avatar Image -->
            <div class="relative w-36 h-36 lg:w-44 lg:h-44 rounded-full border-[6px] border-[#0ea5e9] overflow-hidden bg-white">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/avatar.jpg') }}" 
                     class="w-full h-full rounded-full object-cover"
                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff'">
            </div>
        </div>

        <!-- Info -->
        <div class="flex flex-col items-center md:items-start space-y-4">
            <div class="space-y-2">
                <p class="text-gray-700 text-sm lg:text-base"><span class="font-bold text-[#102a4e]">Nama :</span> <span class="font-medium text-[#102a4e]">{{ Auth::user()->name }}</span></p>
                <p class="text-gray-700 text-sm lg:text-base"><span class="font-bold text-[#102a4e]">NIM :</span> <span class="font-medium text-[#102a4e]">{{ Auth::user()->nim ?? '23.12.2865' }}</span></p>
                <p class="text-gray-700 text-sm lg:text-base"><span class="font-bold text-[#102a4e]">Tgl Lahir :</span> <span class="font-medium text-[#102a4e]">{{ Auth::user()->tgl_lahir ?? '18 Mei 2001' }}</span></p>
            </div>

            <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-lg transition active:scale-95 text-sm">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5 bg-white rounded-full p-0.5">
                 <span>Hubungi Kami</span>
            </button>
        </div>
    </div>

    <!-- CARD: PEMBAYARAN -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-4">
            <h3 class="text-white font-bold text-lg">Pembayaran</h3>
        </div>

        <!-- List -->
        <div class="p-8 space-y-6 bg-white overflow-x-auto">
            
            <!-- Item: Biaya Pendaftaran -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex items-center justify-between gap-4 min-w-[900px]">
                <!-- Title -->
                <div class="w-[30%] font-bold text-[#102a4e] text-lg text-left">Biaya Pendaftaran</div>
                
                <!-- Price -->
                <div class="w-[40%] flex justify-center items-center gap-8">
                    <span class="font-bold text-[#102a4e] text-base">Rp 250.000</span>
                    <span class="font-bold text-[#102a4e] text-base">/</span>
                    <span class="font-bold text-[#102a4e] text-base">Rp 250.000</span>
                </div>
                
                <!-- Actions -->
                <div class="w-[30%] flex justify-end items-center gap-4">
                    <span class="bg-[#009933] text-white font-bold text-sm px-6 py-2.5 rounded-lg min-w-[100px] text-center shadow-sm">Lunas</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md transition active:scale-95 text-sm min-w-[90px]">Bayar</button>
                </div>
            </div>

            <!-- Item: Biaya Pendidikan -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex items-center justify-between gap-4 min-w-[900px]">
                <div class="w-[30%] font-bold text-[#102a4e] text-lg text-left">Biaya Pendidikan</div>
                
                <div class="w-[40%] flex justify-center items-center gap-8">
                    <span class="font-bold text-[#102a4e] text-base">Rp 250.000</span>
                    <span class="font-bold text-[#102a4e] text-base">/</span>
                    <span class="font-bold text-[#102a4e] text-base">Rp 4.500.000</span>
                </div>
                
                <div class="w-[30%] flex justify-end items-center gap-4">
                    <span class="bg-[#ffcc00] text-[#102a4e] font-bold text-sm px-6 py-2.5 rounded-lg min-w-[100px] text-center shadow-sm">60%</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md transition active:scale-95 text-sm min-w-[90px]">Bayar</button>
                </div>
            </div>

            <!-- Item: Biaya BLK -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex items-center justify-between gap-4 min-w-[900px]">
                <div class="w-[30%] font-bold text-[#102a4e] text-lg text-left">Biaya BLK</div>
                
                <div class="w-[40%] flex justify-center items-center gap-8">
                    <span class="font-bold text-[#102a4e] text-base">-</span>
                    <span class="font-bold text-[#102a4e] text-base">/</span>
                    <span class="font-bold text-[#102a4e] text-base">-</span>
                </div>
                
                <div class="w-[30%] flex justify-end items-center gap-4">
                    <span class="bg-white text-[#102a4e] font-bold text-sm px-6 py-2.5 rounded-lg min-w-[100px] text-center shadow-sm">Tidak BLK</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md transition active:scale-95 text-sm min-w-[90px]">Bayar</button>
                </div>
            </div>

             <!-- Item: Biaya Asrama -->
             <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex items-center justify-between gap-4 min-w-[900px]">
                <div class="w-[30%] font-bold text-[#102a4e] text-lg text-left">Biaya Asrama</div>
                
                <div class="w-[40%] flex justify-center items-center gap-8">
                    <span class="font-bold text-[#102a4e] text-base">-</span>
                    <span class="font-bold text-[#102a4e] text-base">/</span>
                    <span class="font-bold text-[#102a4e] text-base">-</span>
                </div>
                
                <div class="w-[30%] flex justify-end items-center gap-4">
                    <span class="bg-white text-[#102a4e] font-bold text-sm px-6 py-2.5 rounded-lg min-w-[100px] text-center shadow-sm">Tidak Asrama</span>
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-lg shadow-md transition active:scale-95 text-sm min-w-[90px]">Bayar</button>
                </div>
            </div>

        </div>
    </div>

    <!-- CARD: PERLENGKAPAN -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden mb-8">
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-4">
            <h3 class="text-white font-bold text-lg">Perlengkapan</h3>
        </div>
        
        <div class="p-8 bg-[#eff0f2] min-h-[100px]">
            <!-- Content placeholder for Perlengkapan -->
        </div>
    </div>

</div>
@endsection
