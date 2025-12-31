@extends('layouts.header_dashboard_crm')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">

    <!-- TOP SECTION -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- CARD 1: PROFILE info -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl shadow-sm p-8 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <div class="w-32 h-32 rounded-full overflow-hidden">
                        <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Info -->
                <div class="space-y-1">
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">Nama :</span> Maharani</p>
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">NIS :</span> 23.2865</p>
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">Tgl Lahir :</span> 10 Agustus 2004</p>
                    
                    <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] font-bold px-6 py-1.5 rounded-full shadow-md text-sm mt-2 transition">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="self-start">
                 <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl flex items-center gap-2 shadow-md transition text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    <span>Edit</span>
                </button>
            </div>
        </div>

        <!-- CARD 2: KEHADIRAN -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-3xl shadow-sm p-8 flex flex-col items-center justify-center text-center">
             <div class="flex items-center gap-2 mb-4">
                 <span class="font-bold text-[#102a4e]">Kehadiran</span>
                 <span class="bg-[#00902f] text-white text-xs font-bold px-3 py-1 rounded-full">Baik</span>
             </div>
             <h2 class="text-[#102a4e] font-bold text-5xl">75%</h2>
        </div>
    </div>

    <!-- STUDENT LIST SECTION -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-white font-bold text-lg">Daftar Siswa</span>
                <span class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full">A2</span>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search -->
                <div class="relative">
                    <input type="text" placeholder="Cari siswa" class="pl-4 pr-10 py-1.5 rounded-full text-sm focus:outline-none w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <!-- Filter Icon -->
                <button class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>
            </div>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-6 space-y-3">
            
            <!-- ROW 1 -->
            <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budi A ..</div>
                
                <div class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e]">Angkatan: IV</div>
                
                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                    </button>
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                    </button>
                </div>

                <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                    <span>Follow Up 1 :</span>
                    <span>12/08/2025</span>
                    <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                </div>

                <button class="bg-[#00902f] text-white text-xs font-bold px-6 py-1.5 rounded-full w-24">Respon</button>
                <button class="bg-[#00902f] text-white text-xs font-bold px-6 py-1.5 rounded-full w-24">Jepang</button>
                
                <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

            <!-- ROW 2 -->
             <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Novi A...</div>
                
                <div class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e]">Angkatan: IV</div>
                
                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                    </button>
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                    </button>
                </div>

                <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                    <span>Follow Up 1 :</span>
                    <span>12/08/2025</span>
                    <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                </div>

                <button class="bg-[#ef4444] text-white text-xs font-bold px-6 py-1.5 rounded-full w-24">No Respon</button>
                <button class="bg-[#fbbf24] text-[#102a4e] text-xs font-bold px-6 py-1.5 rounded-full w-24">Ulang Kelas</button>
                
                <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

            <!-- ROW 3 -->
             <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Andi B..</div>
                
                <div class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e]">Angkatan: IV</div>
                
                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                    </button>
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                    </button>
                </div>

                <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                    <span>Follow Up 1 :</span>
                    <span>12/08/2025</span>
                    <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                </div>

                <button class="bg-white text-[#102a4e] text-xs font-bold px-6 py-1.5 rounded-full w-24">Invalid</button>
                <button class="bg-[#fbbf24] text-[#102a4e] text-xs font-bold px-6 py-1.5 rounded-full w-24">BLK</button>
                
                <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

             <!-- ROW 4 -->
             <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Yanto</div>
                
                <div class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e]">Angkatan: IV</div>
                
                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                    </button>
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                    </button>
                </div>

                <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                    <span>Follow Up 1 :</span>
                    <span>12/08/2025</span>
                    <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                </div>

                <button class="bg-white text-[#102a4e] text-xs font-bold px-6 py-1.5 rounded-full w-24">Invalid</button>
                <button class="bg-[#ef4444] text-white text-xs font-bold px-6 py-1.5 rounded-full w-24">Keluar</button>
                
                <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

            <!-- ROW 5 -->
             <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budi</div>
                
                <div class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e]">Angkatan: IV</div>
                
                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                    </button>
                    <button class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                    </button>
                </div>

                <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                    <span>Follow Up 1 :</span>
                    <span>12/08/2025</span>
                    <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                </div>

                <button class="bg-white text-[#102a4e] text-xs font-bold px-6 py-1.5 rounded-full w-24">Invalid</button>
                <button class="bg-[#ef4444] text-white text-xs font-bold px-6 py-1.5 rounded-full w-24">Keluar</button>
                
                <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>

        </div>

    </div>

    <!-- PAGINATION (Visual) -->
    <div class="flex items-center justify-between mt-4 text-[#102a4e]">
        <div class="flex items-center gap-2">
            <span class="text-sm cursor-pointer hover:font-bold">← Previous</span>
            <div class="flex gap-1">
                <span class="bg-[#102a4e] text-white w-8 h-8 flex items-center justify-center rounded-lg text-sm font-bold">1</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">2</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">3</span>
                 <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm">...</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">67</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">68</span>
            </div>
            <span class="text-sm cursor-pointer hover:font-bold">Next →</span>
        </div>
        <div class="font-bold">50 / Halaman</div>
    </div>

</div>
@endsection
