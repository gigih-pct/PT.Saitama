@extends('layouts.header_dashboard_siswa')

@section('title', 'Jadwal Evaluasi')

@section('content')
<div class="space-y-6">

    <!-- CARD: PROFILE (Wide) -->
    <!-- Reused from pembayaran.blade.php for consistency -->
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

    <!-- CARD: JADWAL EVALUASI -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-4 flex items-center gap-4">
            <h3 class="text-white font-bold text-lg">Jadwal Evaluasi</h3>
            
            <!-- Dropdown / Badge 'Seleksi I' -->
            <!-- Mimicking the white badge style from design -->
            <div class="bg-white px-4 py-1 rounded-full text-[#102a4e] font-bold text-sm cursor-pointer shadow-sm flex items-center gap-2">
                <span>Seleksi I</span>
            </div>
        </div>

        <!-- List -->
        <div class="p-8 space-y-4 bg-white overflow-x-auto">
            
            <!-- Item: Kanji -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Kanji</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Senin, 25 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

            <!-- Item: Kotoba -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Kotoba</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Senin, 25 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

            <!-- Item: Bunpou -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Bunpou</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Selasa, 26 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

            <!-- Item: Choukai -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Choukai</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Rabu, 27 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

            <!-- Item: Kaiwa -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Kaiwa</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Kamis, 28 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

            <!-- Item: Sit up -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between gap-4 min-w-[800px]">
                <div class="w-[20%] font-bold text-[#102a4e] text-base text-left">Sit up</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">Jumat, 29 Agustus 2025</div>
                <div class="w-[30%] font-bold text-[#102a4e] text-sm text-center">15.30 - 18.00</div>
                <div class="w-[20%] flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-lg shadow-md transition active:scale-95 text-sm">Presensi</button>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
