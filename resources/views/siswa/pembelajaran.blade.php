@extends('layouts.header_dashboard_siswa')

@section('title', 'Pembelajaran Siswa')

@section('content')
<div class="space-y-6">

    <!-- TOP SECTION: MATERI & PROFILE -->
    <div class="grid grid-cols-12 gap-6">

        <!-- CARD: MATERI -->
        <div class="col-span-12 lg:col-span-8 bg-white rounded-3xl shadow-sm p-6">
            <!-- Header -->
            <div class="flex items-center justify-between bg-[#102a4e] text-white px-6 py-3 rounded-xl mb-4">
                <div class="flex items-center gap-4">
                    <span class="font-bold text-sm">Materi</span>
                    <span class="bg-white text-[#102a4e] text-xs font-bold px-4 py-0.5 rounded-full">Hari Ini</span>
                </div>
                <button class="hover:bg-white/10 p-1 rounded transition">
                     <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                </button>
            </div>

            <!-- List -->
            <div class="space-y-3">
                <!-- Item 1: View -->
                <div class="bg-[#f3f4f6] rounded-full px-6 py-3 flex items-center justify-between">
                    <span class="font-bold text-[#102a4e] text-sm md:text-base">Menulis Katakana</span>
                    
                    <div class="flex items-center gap-6">
                        <span class="text-gray-500 font-medium text-xs md:text-sm">Hari ini</span>
                        <!-- Eye Icon Button (Red) -->
                        <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-9 h-9 flex items-center justify-center rounded-full transition shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 15a3 3 0 100-6 3 3 0 000 6z" /><path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 010-1.113zM17.25 12a5.25 5.25 0 11-10.5 0 5.25 5.25 0 0110.5 0z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Item 2: Download -->
                <div class="bg-[#f3f4f6] rounded-full px-6 py-3 flex items-center justify-between">
                    <span class="font-bold text-[#102a4e] text-sm md:text-base">Soal Latihan I</span>
                    
                     <div class="flex items-center gap-6">
                        <span class="text-gray-500 font-medium text-xs md:text-sm">Hari ini</span>
                        <!-- Download Icon Button (Red) -->
                        <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-9 h-9 flex items-center justify-center rounded-full transition shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </div>

                <!-- Item 3: Download -->
                 <div class="bg-[#f3f4f6] rounded-full px-6 py-3 flex items-center justify-between">
                    <span class="font-bold text-[#102a4e] text-sm md:text-base">Membaca Hiragana</span>
                    
                     <div class="flex items-center gap-6">
                        <span class="text-gray-500 font-medium text-xs md:text-sm">Hari ini</span>
                        <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-9 h-9 flex items-center justify-center rounded-full transition shadow-md">
                           <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD: PROFILE -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-3xl shadow-sm p-8 flex flex-col items-center justify-center text-center">
             <div class="relative w-40 h-40 mb-6">
                <div class="w-full h-full rounded-full border-4 border-[#0ea5e9] p-1 overflow-hidden">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full rounded-full object-cover">
                </div>
            </div>

            <div class="space-y-1 mb-6 text-left w-full max-w-[200px]">
                <p class="text-sm"><span class="font-bold text-[#102a4e] w-20 inline-block">Nama :</span> Gigih</p>
                <p class="text-sm"><span class="font-bold text-[#102a4e] w-20 inline-block">NIM :</span> 23.12.2865</p>
                <p class="text-sm"><span class="font-bold text-[#102a4e] w-20 inline-block">Tgl Lahir :</span> 18 Mei 2001</p>
            </div>

            <button class="bg-[#d95d5d] hover:bg-red-600 text-white font-bold px-8 py-2.5 rounded-xl flex items-center gap-2 shadow-md transition w-full justify-center">
                 <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-5 h-5 bg-white rounded-full p-0.5">
                 Hubungi Kami
            </button>
        </div>

    </div>

    <!-- BOTTOM SECTION: JADWAL -->
    <div class="bg-white rounded-3xl shadow-sm p-6">
        <!-- Header -->
        <div class="flex items-center justify-between bg-[#102a4e] text-white px-6 py-3 rounded-xl mb-4">
             <div class="flex items-center gap-4">
                <span class="font-bold text-sm">Jadwal</span>
                <span class="bg-white text-[#102a4e] text-xs font-bold px-4 py-0.5 rounded-full">Minggu I</span>
                <span class="bg-white text-[#102a4e] text-xs font-bold px-4 py-0.5 rounded-full">Kelas A2</span>
            </div>
            <button class="hover:bg-white/10 p-1 rounded transition">
                 <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
            </button>
        </div>

        <!-- Schedule List -->
        <div class="space-y-3">
            <!-- Row 1: Kanji (With Presensi Button) -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Kanji</span>
                <span class="w-1/4 text-center">Senin</span>
                <span class="w-1/4 text-center">15.30 - 18.00</span>
                <div class="w-1/4 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white px-6 py-1.5 rounded-xl font-bold text-sm shadow-md transition">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Row 2: Kotoba -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Kotoba</span>
                <span class="w-1/4 text-center">Selasa</span>
                <span class="w-1/4 text-center">12.30 - 14.00</span>
                <div class="w-1/4"></div> <!-- Empty for alignment -->
            </div>

            <!-- Row 3: Bunpou -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Bunpou</span>
                <span class="w-1/4 text-center">Rabu</span>
                <span class="w-1/4 text-center">12.30 - 14.00</span>
                <div class="w-1/4"></div>
            </div>

            <!-- Row 4: Choukai -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Choukai</span>
                <span class="w-1/4 text-center">Rabu</span>
                <span class="w-1/4 text-center">12.30 - 14.00</span>
                <div class="w-1/4"></div>
            </div>

             <!-- Row 5: Kaiwa -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Kaiwa</span>
                <span class="w-1/4 text-center">Kamis</span>
                <span class="w-1/4 text-center">12.30 - 14.00</span>
                <div class="w-1/4"></div>
            </div>

             <!-- Row 6: Kaiwa -->
            <div class="bg-[#f3f4f6] rounded-full px-8 py-4 flex items-center justify-between font-bold text-[#102a4e] text-sm md:text-base">
                <span class="w-1/4">Kaiwa</span>
                <span class="w-1/4 text-center">Jumat</span>
                <span class="w-1/4 text-center">12.30 - 14.00</span>
                <div class="w-1/4"></div>
            </div>
        </div>

    </div>

</div>
@endsection
