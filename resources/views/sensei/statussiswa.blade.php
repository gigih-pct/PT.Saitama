@extends('layouts.header_dashboard_sensei')

@section('title', 'Status siswa')

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm p-4 min-h-[80vh] flex flex-col">

    <!-- Header Section -->
    <div class="bg-[#102a4e] rounded-xl p-4 flex items-center justify-between mb-6 shadow-md">
        <div class="flex items-center gap-4">
            <h1 class="text-white font-bold text-lg">Status Siswa</h1>
            <span class="bg-[#db5d5d] text-white text-xs font-bold px-2 py-1 rounded-md">A2</span>
        </div>

        <div class="flex items-center gap-4 flex-1 justify-end">
            <!-- Search Bar -->
            <div class="relative w-full max-w-md">
                <input type="text" placeholder="Cari siswa" class="w-full bg-white rounded-full py-1.5 pl-4 pr-10 text-sm focus:outline-none text-[#102a4e]">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#102a4e]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
            </div>
            
            <!-- Filter Icon -->
            <button class="text-white hover:bg-white/10 p-2 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
            </button>
        </div>
    </div>

    <!-- Student List Table -->
    <div class="flex-1 overflow-x-auto">
        <table class="w-full border-separate border-spacing-y-4">
            <thead>
                <tr class="text-left hidden">
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Kontak</th>
                    <th>Tanggal</th>
                    <th>Status 1</th>
                    <th>Status 2</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1 -->
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
