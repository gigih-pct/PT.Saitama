@extends('layouts.header_dashboard_sensei')

@section('title', 'Pengajaran')

@section('content')
<div class="space-y-6 font-sans">
    
    <!-- TOP SECTION: MATERI + PROFILE -->
    <div class="grid grid-cols-12 gap-6">

        <!-- MAIN: MATERI -->
        <div class="col-span-12 lg:col-span-8 bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 flex flex-col relative overflow-hidden">
            <div class="flex items-center justify-between mb-8 z-10 relative">
                <div class="space-y-1">
                    <h2 class="text-[#173A67] font-black text-2xl tracking-tight">Pengajaran</h2>
                    <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Ringkasan materi pengajaran Anda</p>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-4 py-2 bg-gray-50 text-[#173A67] rounded-xl text-[10px] font-black uppercase tracking-widest border border-gray-100 hover:bg-gray-100 transition-all">Filter</button>
                    <button class="px-4 py-2 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/10 hover:bg-blue-900 transition-all">Tambah Materi</button>
                </div>
            </div>

            <div class="space-y-4 z-10 relative">
                <!-- Materi 1 -->
                <div class="bg-gray-50 rounded-3xl p-5 flex items-center justify-between hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#173A67] flex items-center justify-center font-black">か</div>
                        <div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Materi</div>
                            <div class="font-black text-[#173A67]">Kanji - Pengenalan</div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">A2 • Hari ini</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20 hover:scale-105 active:scale-95 transition-all">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </button>
                        <button class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all">
                            Detail
                        </button>
                    </div>
                </div>

                <!-- Materi 2 -->
                <div class="bg-gray-50 rounded-3xl p-5 flex items-center justify-between hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center font-black">こ</div>
                        <div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-0.5">Materi</div>
                            <div class="font-black text-[#173A67]">Kotoba - Percakapan</div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">A2 • Hari ini</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20 hover:scale-105 active:scale-95 transition-all">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </button>
                        <button class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all">
                            Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- SIDEBAR: PROFILE -->
        <div class="col-span-12 lg:col-span-4 bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 flex flex-col items-center text-center relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -mr-16 -mt-16 transition-all duration-700 group-hover:bg-blue-50"></div>
            
            <div class="relative mb-6">
                <div class="w-32 h-32 rounded-[2.5rem] border-4 border-gray-50 p-1 group-hover:border-[#173A67] transition-all duration-500 overflow-hidden shadow-xl">
                    <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover rounded-[2.2rem]">
                </div>
                <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-green-500 border-4 border-white rounded-2xl flex items-center justify-center shadow-lg">
                    <i data-lucide="check" class="w-5 h-5 text-white"></i>
                </div>
            </div>

            <div class="space-y-3 mb-6 w-full">
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama</span>
                    <span class="text-xs font-black text-[#173A67]">{{ auth()->user()->name }}</span>
                </div>
                <div class="flex items-center justify-between py-2 border-b border-gray-50">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email</span>
                    <span class="text-xs font-black text-[#173A67]">{{ auth()->user()->email }}</span>
                </div>
                <div class="flex items-center justify-between py-2">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest uppercase">Role</span>
                    <span class="text-xs font-black text-[#173A67] uppercase">{{ auth()->user()->role }}</span>
                </div>
            </div>
            
            <button class="w-full py-4 bg-orange-400 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-orange-100 hover:bg-orange-500 transition-all active:scale-95">
                Presensi Sekarang
            </button>
        </div>
    </div>

    <!-- JADWAL SECTION (FULL WIDTH) -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between bg-[#173A67] rounded-3xl px-6 py-4 mb-6 shadow-xl shadow-blue-900/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center">
                    <i data-lucide="calendar" class="w-4 h-4 text-blue-300"></i>
                </div>
                <span class="text-white font-black text-sm tracking-tight">Jadwal Pengajaran</span>
            </div>
            <span class="bg-red-400 text-white px-5 py-1.5 text-[10px] font-black rounded-xl uppercase tracking-widest shadow-lg shadow-red-400/20">Minggu I</span>
        </div>

        <div class="space-y-3">
            <!-- Jadwal Row 1 -->
            <div class="flex items-center justify-between bg-gray-50 rounded-[2rem] px-6 py-4 hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#173A67] flex items-center justify-center font-black">K</div>
                    <div>
                        <div class="font-black text-[#173A67] text-base">Kanji</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2 mt-0.5">
                            <i data-lucide="clock" class="w-3 h-3"></i> Rabu • 15.00 - 16.00
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="w-10 h-10 bg-white border border-gray-100 text-red-400 rounded-xl flex items-center justify-center hover:bg-red-400 hover:text-white transition-all shadow-sm">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button class="px-6 py-2.5 bg-red-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-red-500/20 hover:bg-red-600 active:scale-95 transition-all">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Jadwal Row 2 -->
            <div class="flex items-center justify-between bg-gray-50 rounded-[2rem] px-6 py-4 hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100">
                <div class="flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center font-black">K</div>
                    <div>
                        <div class="font-black text-[#173A67] text-base">Kotoba</div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2 mt-0.5">
                            <i data-lucide="clock" class="w-3 h-3"></i> Selasa • 15.00 - 16.00
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button class="w-10 h-10 bg-white border border-gray-100 text-red-400 rounded-xl flex items-center justify-center hover:bg-red-400 hover:text-white transition-all shadow-sm">
                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                    </button>
                    <button class="px-6 py-2.5 bg-red-500 text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-red-500/20 hover:bg-red-600 active:scale-95 transition-all">
                        Presensi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- EVALUASI / EVENTS (FULL WIDTH) -->
    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center shadow-lg">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black text-[#173A67] tracking-tight">Evaluasi & Event</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Jadwal evaluasi siswa mendatang</p>
                </div>
            </div>
            <a href="#" class="text-[10px] font-black text-[#173A67] uppercase tracking-widest hover:underline flex items-center gap-1">
                Lihat semua <i data-lucide="chevron-right" class="w-3 h-3"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card 1 -->
            <div class="bg-gray-50 rounded-[2.5rem] p-6 flex items-center justify-between hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 group">
                <div class="flex flex-col gap-1">
                    <div class="font-black text-[#173A67] text-base">Bunpou - Seleksi I</div>
                    <div class="flex items-center gap-2 text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                        <i data-lucide="calendar" class="w-3 h-3"></i> Senin, 25 Agt 2025 • 15.00 - 16.00
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="w-9 h-9 border border-red-100 text-red-400 rounded-xl flex items-center justify-center hover:bg-red-400 hover:text-white transition-all shadow-sm">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </button>
                    <button class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-red-500/20 hover:bg-red-600 active:scale-95 transition-all">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-gray-50 rounded-[2.5rem] p-6 flex items-center justify-between hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 group">
                <div class="flex flex-col gap-1">
                    <div class="font-black text-[#173A67] text-base">Kotoba - Seleksi I</div>
                    <div class="flex items-center gap-2 text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                        <i data-lucide="calendar" class="w-3 h-3"></i> Selasa, 26 Agt 2025 • 15.00 - 16.00
                    </div>
                </div>
                <div class="flex gap-2">
                    <button class="w-9 h-9 border border-red-100 text-red-400 rounded-xl flex items-center justify-center hover:bg-red-400 hover:text-white transition-all shadow-sm">
                        <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                    </button>
                    <button class="px-5 py-2.5 bg-red-500 text-white rounded-xl text-[9px] font-black uppercase tracking-widest shadow-lg shadow-red-500/20 hover:bg-red-600 active:scale-95 transition-all">
                        Presensi
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endpush
@endsection