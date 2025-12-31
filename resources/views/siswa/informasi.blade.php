@extends('layouts.header_dashboard_siswa')

@section('title', 'Informasi')

@section('content')
<div class="space-y-8">

    <!-- CARD: PROFILE (Reuse) -->
    <div class="bg-white rounded-3xl shadow-sm p-8 flex flex-col md:flex-row items-center justify-center gap-8 md:gap-16 text-center md:text-left min-h-[300px]">
         <!-- Avatar Circle -->
         <div class="relative w-40 h-40 lg:w-48 lg:h-48 flex items-center justify-center shrink-0">
            <div class="absolute inset-0 bg-[#0ea5e9] rounded-full"></div>
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
    <br>
    <!-- SELEKSI REKOMENDASI -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-[#102a4e] px-8 py-5">
            <h3 class="text-white font-bold text-xl">Seleksi Rekomendasi</h3>
        </div>
        <div class="p-8 space-y-4 bg-white">
            <!-- Row 1 -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex flex-col lg:flex-row items-center justify-between gap-4 lg:gap-8">
                <div class="shrink-0">
                    <div class="bg-white rounded-xl px-10 py-3 text-[#102a4e] font-bold text-center shadow-sm w-full lg:w-48 text-lg">
                        Seleksi I
                    </div>
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-left flex-1 whitespace-nowrap">
                    Senin, 25 Agustus 2025
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-right flex-1 whitespace-nowrap">
                    15.30 - 18.00
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-right flex-1 lg:pr-8">
                    Balai Kota
                </div>
            </div>

            <!-- Row 2 -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-6 flex flex-col lg:flex-row items-center justify-between gap-4 lg:gap-8">
                <div class="shrink-0">
                    <div class="bg-white rounded-xl px-10 py-3 text-[#102a4e] font-bold text-center shadow-sm w-full lg:w-48 text-lg">
                        PLATDA
                    </div>
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-left flex-1 whitespace-nowrap">
                    Senin, 25 Agustus 2025
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-right flex-1 whitespace-nowrap">
                    15.30 - 18.00
                </div>
                <div class="font-bold text-[#102a4e] text-lg text-center lg:text-right flex-1 lg:pr-8">
                    Balai Kota
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- KONTAK KAMI -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <div class="bg-[#102a4e] px-8 py-4">
            <h3 class="text-white font-bold text-lg">Kontak kami</h3>
        </div>
        <div class="p-8 space-y-4 bg-white overflow-x-auto">
            
            <!-- Row 1 -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between min-w-[900px] gap-4">
                <div class="w-[25%] shrink-0">
                    <div class="bg-white rounded-xl px-8 py-2.5 text-[#102a4e] font-bold text-center shadow-sm inline-block min-w-[140px]">
                        Akademik
                    </div>
                </div>
                <div class="w-[45%] shrink-0 font-bold text-[#102a4e] text-base">
                    Mengurusi surat izin dan cuti
                </div>
                <div class="w-[30%] shrink-0 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition active:scale-95 text-sm">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5 bg-white rounded-full p-0.5">
                        <span>Hubungi Kami</span>
                   </button>
                </div>
            </div>

            <!-- Row 2 -->
            <div class="bg-[#f3f4f6] rounded-[20px] px-8 py-5 flex items-center justify-between min-w-[900px] gap-4">
                <div class="w-[25%] shrink-0">
                    <div class="bg-white rounded-xl px-8 py-2.5 text-[#102a4e] font-bold text-center shadow-sm inline-block min-w-[140px]">
                        Akademik
                    </div>
                </div>
                <div class="w-[45%] shrink-0 font-bold text-[#102a4e] text-base">
                    Konsultasi seleksi
                </div>
                <div class="w-[30%] shrink-0 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-sm transition active:scale-95 text-sm">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5 bg-white rounded-full p-0.5">
                        <span>Hubungi Kami</span>
                   </button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
