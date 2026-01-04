@extends('layouts.header_dashboard_sensei')

@section('title', 'Status Siswa')

@section('content')
<div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 min-h-[80vh] flex flex-col relative overflow-hidden">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 relative z-10">
        <div>
            <h1 class="text-[#173A67] font-black text-2xl tracking-tight flex items-center gap-3">
                Status Siswa
                <span class="bg-[#D85B63] text-white text-[10px] font-extrabold px-3 py-1.5 rounded-xl shadow-lg shadow-red-900/20">KELAS A2</span>
            </h1>
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase mt-2">Daftar siswa dan status terkini</p>
        </div>

        <div class="flex items-center gap-4">
             <!-- Search -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                </div>
                <input type="text" 
                    class="pl-11 pr-4 py-3 rounded-2xl border-2 border-gray-100 bg-gray-50 text-sm font-bold text-[#173A67] placeholder-gray-400 focus:border-[#173A67] focus:ring-0 w-64 transition-all shadow-sm"
                    placeholder="Cari Siswa...">
            </div>

            <!-- Filter -->
            <button class="w-12 h-12 rounded-2xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 transition-all shadow-lg hover:shadow-xl active:scale-95">
                <i data-lucide="sliders-horizontal" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- TABLE LIST -->
    <div class="flex-1 overflow-x-auto relative z-10">
        <table class="w-full text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="text-[10px] items-center text-gray-400 uppercase tracking-widest font-extrabold">
                    <th class="px-6 pb-2">Nama Siswa</th>
                    <th class="px-6 pb-2">Kontak</th>
                    <th class="px-6 pb-2">Status</th>
                    <th class="px-6 pb-2 text-center">Keterangan</th>
                    <th class="px-6 pb-2 text-right">Aksi</th>
                </tr>
            </thead>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            BLK
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 4 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Yanto
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Budi
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Budi A ..
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                        <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                        <button class="bg-[#00902f] hover:bg-green-700 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Jepang
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                         <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 2 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Novi A...
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            ulang kelas
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Andi B..
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            BLK
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 4 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Yanto
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Budi
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 3 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Andi B..
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            BLK
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 4 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Yanto
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

                <!-- Row 5 -->
                <tr class="group text-sm">
                    <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap">
                        Budi
                    </td>
                    <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                        Angkatan: IV
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <div class="flex gap-2">
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                            </button>
                            <button class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                            </button>
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3">
                         <button class="bg-[#ef4444] hover:bg-red-600 text-white w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap">
                            Keluar
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                        </button>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 text-center">
                        <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block">
                            Keterangan
                        </div>
                    </td>
                    <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                         <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </a>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-center gap-4 py-4 text-[#102a4e] font-medium text-sm relative mt-2">
        <button class="flex items-center gap-1 hover:text-[#db5d5d] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            Previous
        </button>
        
        <div class="flex items-center gap-2">
            <button class="w-8 h-8 bg-[#102a4e] text-white rounded-lg flex items-center justify-center shadow-md">1</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">2</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">3</button>
            <span class="px-2">...</span>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">67</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">68</button>
        </div>

        <button class="flex items-center gap-1 hover:text-[#db5d5d] transition">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        </button>
        
        <div class="absolute right-0 text-gray-500 font-normal">
            50 /Halaman
        </div>
    </div>
</div>
@endsection
