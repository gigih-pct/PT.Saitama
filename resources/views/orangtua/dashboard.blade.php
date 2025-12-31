@extends('layouts.header_dashboard_orangtua')

@section('title', 'Laporan Siswa')

@section('content')
<div class="space-y-6">

    <!-- TOP SECTION: PROFILE & STATUS -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- CARD 1: PROFILE INFO -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl shadow-sm p-8 flex items-center gap-8">
            <!-- Avatar -->
            <div class="relative shrink-0">
                <div class="w-40 h-40 rounded-full border-4 border-[#0ea5e9] p-1">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full rounded-full object-cover">
                </div>
            </div>

            <!-- Info -->
            <div class="space-y-4">
                <div class="space-y-1">
                    <p class="text-[#102a4e] text-lg"><span class="font-bold">Nama :</span> <span class="font-medium">Gigih</span></p>
                    <p class="text-[#102a4e] text-lg"><span class="font-bold">NIS :</span> <span class="font-medium">23.2865</span></p>
                    <p class="text-[#102a4e] text-lg"><span class="font-bold">Tgl Lahir :</span> <span class="font-medium">18 Mei 2001</span></p>
                </div>
                
                <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-lg transition active:scale-95 text-base">
                     <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6 bg-white rounded-full p-0.5">
                     <span>Hubungi Kami</span>
                </button>
            </div>
        </div>

        <!-- CARD 2: STATUS SISWA -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-3xl shadow-sm p-8 flex flex-col justify-between text-center">
             <h3 class="text-[#102a4e] font-bold text-lg mb-4">Status Siswa</h3>
             
             <div class="space-y-4">
                 <div class="bg-[#e5e7eb] py-3 px-6 rounded-xl font-bold text-[#102a4e] text-lg">
                     Seleksi Tahap I
                 </div>
                 
                 <div class="bg-[#00902f] py-4 px-6 rounded-xl font-bold text-white text-2xl shadow-md">
                     Lolos
                 </div>

                 <div class="bg-[#e5e7eb] py-2 px-6 rounded-full text-gray-500 font-medium text-sm">
                    Menunggu tahap berikutnya...
                 </div>
             </div>
        </div>
    </div>

    <!-- TAHAPAN SISWA (PROGRESS BAR) -->
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

    <!-- GRAFIK PERFORMA SISWA -->
    <div class="bg-white rounded-3xl shadow-sm p-8">
        <h3 class="text-[#102a4e] font-bold text-lg text-center mb-8">Grafik Performa Siswa</h3>
        
        <div class="relative w-full h-[300px] flex items-end justify-center px-4 md:px-12 pb-8">
            <!-- Simple SVG Placeholder Line Chart -->
            <svg viewBox="0 0 800 300" class="w-full h-full overflow-visible">
                <!-- Grid Lines -->
                <line x1="0" y1="250" x2="800" y2="250" stroke="#eee" stroke-width="1" />
                <line x1="0" y1="200" x2="800" y2="200" stroke="#eee" stroke-width="1" stroke-dasharray="4 4" />
                <line x1="0" y1="150" x2="800" y2="150" stroke="#eee" stroke-width="1" stroke-dasharray="4 4" />
                <line x1="0" y1="100" x2="800" y2="100" stroke="#eee" stroke-width="1" stroke-dasharray="4 4" />
                <line x1="0" y1="50" x2="800" y2="50" stroke="#eee" stroke-width="1" stroke-dasharray="4 4" />
                
                <!-- Y Axis Labels -->
                <text x="-30" y="250" class="text-gray-400 text-xs text-right">0</text>
                <text x="-30" y="200" class="text-gray-400 text-xs text-right">20</text>
                <text x="-30" y="150" class="text-gray-400 text-xs text-right">40</text>
                <text x="-30" y="100" class="text-gray-400 text-xs text-right">60</text>
                <text x="-30" y="50" class="text-gray-400 text-xs text-right">80</text>
                <text x="-30" y="0" class="text-gray-400 text-xs text-right">100</text>

                <!-- Data Line Blue (Bahasa) -->
                <polyline points="50,230 150,240 250,150 350,200 450,180 550,150 650,160 750,120" 
                          fill="none" stroke="#0ea5e9" stroke-width="3" />
                 <circle cx="50" cy="230" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="150" cy="240" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="250" cy="150" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="350" cy="200" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="450" cy="180" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="550" cy="150" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="650" cy="160" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>
                 <circle cx="750" cy="120" r="4" fill="white" stroke="#0ea5e9" stroke-width="2"/>

                <!-- Data Line Red (Fisik) -->
                 <polyline points="50,100 150,180 250,180 350,120 450,220 550,230 650,240 750,210" 
                          fill="none" stroke="#f87171" stroke-width="3" />
                 <circle cx="50" cy="100" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="150" cy="180" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="250" cy="180" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="350" cy="120" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="450" cy="220" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="550" cy="230" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="650" cy="240" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 <circle cx="750" cy="210" r="4" fill="white" stroke="#f87171" stroke-width="2"/>
                 
                 <!-- X Axis Labels -->
                 <text x="50" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 2</text>
                 <text x="150" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 4</text>
                 <text x="250" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 6</text>
                 <text x="350" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 8</text>
                 <text x="450" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 10</text>
                 <text x="550" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 12</text>
                 <text x="650" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 14</text>
                 <text x="750" y="270" text-anchor="middle" class="text-gray-500 text-xs">Minggu 16</text>
            </svg>

             <!-- Legend -->
            <div class="absolute bottom-0 w-full flex justify-center gap-8 text-sm font-bold text-gray-500">
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full border-2 border-[#0ea5e9]"></span> Bahasa
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full border-2 border-[#f87171]"></span> Fisik & Mental
                </div>
            </div>
        </div>
    </div>
    
    <!-- PEMBAYARAN BAR -->
    <div class="bg-white rounded-2xl shadow-sm p-4 flex items-center justify-center relative">
        <div class="flex items-center gap-2 text-[#102a4e] font-bold text-lg">
            <span>Pembayaran</span>
             <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6">
        </div>
        
        <!-- Note icon -->
        <div class="absolute right-8 text-[#d95d5d]">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        </div>
    </div>

    <!-- AMOUNT BAR -->
    <div class="bg-[#f3f4f6] rounded-xl py-6 flex items-center justify-center gap-8 font-bold text-[#102a4e] text-lg">
        <span>Rp 250.000</span>
        <span>/</span>
        <span>Rp 4.500.000</span>
    </div>

    <!-- BOTTOM ROW: NILAI, KEHADIRAN, PELANGGARAN -->
    <div class="grid grid-cols-12 gap-6">

        <!-- NILAI EVALUASI SELEKSI -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6 space-y-4">
             <div class="flex items-center justify-between bg-[#102a4e] text-white px-4 py-3 rounded-xl">
                 <span class="font-bold text-sm">Nilai Evaluasi Seleksi</span>
                 <span class="bg-[#fbbf24] text-[#102a4e] text-xs font-bold px-4 py-1 rounded-full">Siap Seleksi</span>
             </div>
             
             <!-- Items -->
             <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Kanji</span>
                 <span class="text-gray-500 text-xs">3 jam</span>
                 <span class="bg-[#d95d5d] text-white font-bold w-8 h-8 flex items-center justify-center rounded-full text-xs">7.7</span>
             </div>
             <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Kotoba</span>
                 <span class="text-gray-500 text-xs">3 jam</span>
                 <span class="bg-[#102a4e] text-white font-bold w-8 h-8 flex items-center justify-center rounded-full text-xs">8.7</span>
             </div>
              <div class="bg-[#f3f4f6] rounded-full px-5 py-3 flex items-center justify-between">
                 <span class="font-bold text-[#102a4e] text-sm">Bunpou</span>
                 <span class="text-gray-500 text-xs">3 jam</span>
                 <span class="bg-[#0ea5e9] text-white font-bold w-8 h-8 flex items-center justify-center rounded-full text-xs">6.8</span>
             </div>
        </div>

        <!-- KEHADIRAN -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-6">
             <h3 class="text-[#102a4e] font-bold text-center mb-6">Kehadiran</h3>
             
             <div class="flex items-center justify-center gap-8">
                 <!-- Legend List -->
                 <div class="space-y-3">
                     <div class="flex items-center justify-between w-24">
                         <span class="font-bold text-[#102a4e] text-sm">Masuk</span>
                         <span class="bg-[#102a4e] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">9</span>
                     </div>
                     <div class="flex items-center justify-between w-24">
                         <span class="font-bold text-[#102a4e] text-sm">Izin</span>
                         <span class="bg-[#d95d5d] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                     </div>
                     <div class="flex items-center justify-between w-24">
                         <span class="font-bold text-[#102a4e] text-sm">Sakit</span>
                         <span class="bg-[#0ea5e9] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">0</span>
                     </div>
                     <div class="flex items-center justify-between w-24">
                         <span class="font-bold text-[#102a4e] text-sm">Absen</span>
                         <span class="bg-[#ef4444] text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                     </div>
                 </div>

                 <!-- Chart Box -->
                 <div class="w-32 h-24 bg-[#102a4e] rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-md">
                     75%
                 </div>
             </div>
        </div>

        <!-- PELANGGARAN -->
        <div class="col-span-12 lg:col-span-4 flex flex-col items-center">
             <h3 class="text-[#102a4e] font-bold text-center mb-4">Pelanggaran</h3>
             <div class="flex-1 w-full bg-[#d95d5d] rounded-3xl shadow-md flex items-center justify-center relative">
                 <span class="text-white font-bold text-[80px]">1</span>
             </div>
        </div>

    </div>

</div>
@endsection
