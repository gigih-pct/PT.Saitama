@extends('layouts.header_dashboard_sensei')

@section('content')
<div class="bg-gray-100 min-h-screen rounded-lg p-6 space-y-6 font-sans">
    
    <!-- HEADER CARD - PROFIL SISWA -->
    <div class="bg-white rounded-3xl shadow-sm p-8 pb-10">
        <div class="flex items-start justify-between">
            <!-- BACK BUTTON -->
            <div class="w-1/6">
                <button onclick="window.history.back()" class="group flex items-center gap-2 text-gray-800 hover:text-red-500 transition font-bold text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-red-500 transform group-hover:-translate-x-1 transition" viewBox="0 0 24 24" fill="currentColor">
                         <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    <span>Kembali</span>
                </button>
            </div>

            <!-- CENTER - PROFILE -->
            <div class="flex-1 flex justify-center items-center gap-10">
                <!-- PHOTO -->
                <div class="relative shrink-0">
                    <div class="w-48 h-48 rounded-full bg-blue-500 border-4 border-blue-600 flex items-center justify-center">
                        <span class="text-6xl font-bold text-white">G</span>
                    </div>
                </div>
                
                <!-- DATA -->
                <div class="space-y-3 min-w-[200px]">
                    <p class="text-base text-gray-800">
                        <span class="font-bold text-[#1e293b]">Nama :</span> 
                        <span class="font-bold text-gray-500">Gigih</span>
                    </p>
                    <p class="text-base text-gray-800">
                        <span class="font-bold text-[#1e293b]">NIM :</span> 
                        <span class="font-bold text-gray-500">23.12.2865</span>
                    </p>
                    <p class="text-base text-gray-800">
                        <span class="font-bold text-[#1e293b]">Tgl Lahir :</span> 
                        <span class="font-bold text-gray-500">18 Mei 2001</span>
                    </p>
                    
                    <div class="pt-1">
                        <span class="inline-block bg-gray-200 text-gray-800 text-sm font-bold px-4 py-1.5 rounded-full">
                            Kesempatan: 5/5
                        </span>
                    </div>

                    <div class="pt-2">
                         <button class="bg-[#00902f] hover:bg-green-700 text-white font-bold px-12 py-2.5 rounded-lg transition shadow-sm w-full">
                            Aktif
                        </button>
                    </div>
                </div>
            </div>

            <!-- RIGHT - PRINT BUTTON -->
            <div class="w-1/6 flex justify-end">
                <button class="text-red-400 hover:text-red-600 transition" title="Print">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19 8h-1V3H6v5H5c-1.66 0-3 1.34-3 3v6h4v4h12v-4h4v-6c0-1.66-1.34-3-3-3zM8 5h8v3H8V5zm8 12v2H8v-4h8v2zm2-2v-2H6v2H4v-4c0-.55.45-1 1-1h14c.55 0 1 .45 1 1v4h-2z"/>
                        <circle cx="18" cy="11.5" r="1"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- MIDDLE SECTION -->
    <div class="space-y-4">
        <!-- HEADER BAR -->
        <div class="bg-[#102a4e] rounded-xl px-6 py-4 flex items-center justify-between shadow-md">
             <h2 class="text-white font-bold text-lg">Nilai Kanji</h2>
        </div>

        <!-- LIST SECTION -->
        <div class="space-y-3">
            <!-- ROW 1 -->
            <div class="bg-gray-100 rounded-full py-3 px-8 flex items-center justify-between shadow-sm hover:bg-gray-200 transition">
                <div class="w-1/4 font-bold text-[#1e293b]">Nilai 1</div>
                
                <div class="flex-1 flex items-center justify-between max-w-2xl mx-auto">
                    <span class="font-bold text-[#1e293b]">Penilaian</span>
                    
                    <!-- Date Pill -->
                    <div class="bg-[#d95d5d] text-white px-6 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium">
                        <span>17/05/25</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                           <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>

                    <!-- Score Circle (Red) -->
                    <div class="bg-[#d95d5d] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        7.7
                    </div>
                </div>

                <!-- Edit Button -->
                 <div class="w-1/4 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white p-2.5 rounded-full transition shadow-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </button>
                 </div>
            </div>

            <!-- ROW 2 -->
            <div class="bg-gray-100 rounded-full py-3 px-8 flex items-center justify-between shadow-sm hover:bg-gray-200 transition">
                <div class="w-1/4 font-bold text-[#1e293b]">Nilai 2</div>
                
                <div class="flex-1 flex items-center justify-between max-w-2xl mx-auto">
                    <span class="font-bold text-[#1e293b]">Penilaian</span>
                    
                    <!-- Date Pill -->
                    <div class="bg-[#d95d5d] text-white px-6 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium">
                        <span>17/05/25</span>
                       <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                           <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>

                    <!-- Score Circle (Blue) -->
                    <div class="bg-[#102a4e] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        8.7
                    </div>
                </div>

                <!-- Edit Button -->
                 <div class="w-1/4 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white p-2.5 rounded-full transition shadow-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </button>
                 </div>
            </div>

            <!-- ROW 3 -->
            <div class="bg-gray-100 rounded-full py-3 px-8 flex items-center justify-between shadow-sm hover:bg-gray-200 transition">
                <div class="w-1/4 font-bold text-[#1e293b]">Nilai 3</div>
                
                <div class="flex-1 flex items-center justify-between max-w-2xl mx-auto">
                    <span class="font-bold text-[#1e293b]">Penilaian</span>
                    
                    <!-- Date Pill -->
                    <div class="bg-[#d95d5d] text-white px-6 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium">
                        <span>17/05/25</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                           <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>

                    <!-- Score Circle (Red) -->
                    <div class="bg-[#d95d5d] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        7.7
                    </div>
                </div>

                <!-- Edit Button -->
                 <div class="w-1/4 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white p-2.5 rounded-full transition shadow-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </button>
                 </div>
            </div>

            <!-- ROW 4 -->
            <div class="bg-gray-100 rounded-full py-3 px-8 flex items-center justify-between shadow-sm hover:bg-gray-200 transition">
                <div class="w-1/4 font-bold text-[#1e293b]">Nilai 4</div>
                
                <div class="flex-1 flex items-center justify-between max-w-2xl mx-auto">
                    <span class="font-bold text-[#1e293b]">Penilaian</span>
                    
                    <!-- Date Pill -->
                    <div class="bg-[#d95d5d] text-white px-6 py-1.5 rounded-full flex items-center gap-2 text-sm font-medium">
                        <span>17/05/25</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                           <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </div>

                    <!-- Score Circle (Blue) -->
                    <div class="bg-[#102a4e] w-10 h-10 rounded-full flex items-center justify-center text-white font-bold shadow-md">
                        8.7
                    </div>
                </div>

                <!-- Edit Button -->
                 <div class="w-1/4 flex justify-end">
                    <button class="bg-[#d95d5d] hover:bg-red-600 text-white p-2.5 rounded-full transition shadow-sm" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                    </button>
                 </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('button[title="Edit"]').forEach(button => {
        button.addEventListener('click', function() {
            console.log('Edit clicked');
        });
    });
</script>
@endpush
@endsection
