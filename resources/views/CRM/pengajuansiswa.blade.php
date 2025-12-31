@extends('layouts.header_dashboard_crm')

@section('title', 'Pengajuan Siswa')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">
    
    <!-- Header -->
    <div class="bg-[#102a4e] px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-white font-bold text-lg">Daftar Pengajuan Siswa</span>
            <span class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full">A2</span>
        </div>
        
        <button class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        </button>
    </div>

    <!-- LIST CONTENT -->
    <div class="p-6 space-y-3">
        
        <!-- ROW 1 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Agung</div>
            
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            
            <div class="flex items-center gap-2">
                <!-- Bukti Download -->
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                
                <!-- Reject (X) -->
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>

                <!-- Accept (Check) -->
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                </button>

                <!-- View (Eye) -->
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budi</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 3 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Sita</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 4 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Yanto</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 5 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budiman</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 1 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Agung</div>
            
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            
            <div class="flex items-center gap-2">
                <!-- Bukti Download -->
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                
                <!-- Reject (X) -->
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>

                <!-- Accept (Check) -->
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                </button>

                <!-- View (Eye) -->
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
            </div>
        </div>

        <!-- ROW 2 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budi</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 3 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Sita</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 4 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Yanto</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

        <!-- ROW 5 -->
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="w-32 font-bold text-[#102a4e] text-sm truncate">Budiman</div>
            <div class="bg-white px-3 py-1.5 rounded-lg font-bold text-xs text-[#102a4e] w-48 text-center shadow-sm">Passport</div>
            <div class="flex items-center gap-2">
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white text-xs font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm transition">
                    Bukti <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                </button>
                <button class="bg-[#ff0000] hover:bg-red-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg></button>
                <button class="bg-[#00902f] hover:bg-green-700 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg></button>
                <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg></button>
            </div>
        </div>

    </div>

    <!-- PAGINATION (Visual) -->
    <div class="flex items-center justify-between p-6 text-[#102a4e]">
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
