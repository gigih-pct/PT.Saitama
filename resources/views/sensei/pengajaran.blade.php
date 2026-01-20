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
                    <button onclick="document.getElementById('filterSection').classList.toggle('hidden')" class="px-4 py-2 bg-gray-50 text-[#173A67] rounded-xl text-[10px] font-black uppercase tracking-widest border border-gray-100 hover:bg-gray-100 transition-all flex items-center gap-2">
                        <i data-lucide="filter" class="w-3 h-3"></i> Filter
                    </button>
                    <button onclick="document.getElementById('modalTambahMateri').classList.remove('hidden')" class="px-4 py-2 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/10 hover:bg-blue-900 transition-all flex items-center gap-2">
                        <i data-lucide="plus" class="w-3 h-3"></i> Tambah Materi
                    </button>
                </div>
            </div>

            <!-- FILTER SECTION -->
            <div id="filterSection" class="{{ request()->anyFilled(['subject', 'kelas_id']) ? '' : 'hidden' }} mb-6 p-6 bg-gray-50 rounded-3xl border border-gray-100 animate-fade-in-down">
                <form action="{{ route('sensei.pengajaran') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Mata Pelajaran</label>
                        <select name="subject" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-[11px] font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/5 transition-all">
                            <option value="">Semua Pelajaran</option>
                            <option value="Kanji" {{ request('subject') == 'Kanji' ? 'selected' : '' }}>Kanji</option>
                            <option value="Kotoba" {{ request('subject') == 'Kotoba' ? 'selected' : '' }}>Kotoba</option>
                            <option value="Bunpou" {{ request('subject') == 'Bunpou' ? 'selected' : '' }}>Bunpou</option>
                            <option value="Choukai" {{ request('subject') == 'Choukai' ? 'selected' : '' }}>Choukai</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest ml-1">Kelas</label>
                        <select name="kelas_id" class="w-full px-4 py-2.5 bg-white border border-gray-100 rounded-xl text-[11px] font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/5 transition-all">
                            <option value="">Semua Kelas</option>
                            @foreach($kelases ?? [] as $kelas)
                                <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 py-2.5 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-blue-900 transition-all">Terapkan</button>
                        <a href="{{ route('sensei.pengajaran') }}" class="px-4 py-2.5 bg-white border border-gray-100 text-gray-400 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-50 transition-all flex items-center justify-center">
                            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </form>
            </div>

            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-600 rounded-2xl text-[10px] font-black uppercase tracking-widest animate-fade-in-down">
                <div class="flex items-center gap-2 mb-2">
                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                    Ada kesalahan input:
                </div>
                <ul class="list-disc list-inside ml-6 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-100 text-green-600 rounded-2xl text-[10px] font-black uppercase tracking-widest flex items-center justify-between animate-fade-in-down">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                    {{ session('success') }}
                </div>
                <button onclick="this.parentElement.remove()" class="hover:scale-110 transition-transform">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            @endif

            <div class="space-y-4 z-10 relative">
                @forelse($materials ?? [] as $materi)
                <div class="bg-gray-50 rounded-3xl p-5 flex items-center justify-between hover:bg-white hover:shadow-md transition-all border border-transparent hover:border-gray-100 group">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#173A67] flex items-center justify-center font-black">
                            {{ mb_substr($materi->title, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-0.5">{{ $materi->subject }} • {{ $materi->kelas->nama_kelas ?? 'Umum' }}</div>
                            <div class="font-black text-[#173A67]">{{ $materi->title }}</div>
                            <div class="text-[10px] font-bold text-gray-400 uppercase tracking-tight">{{ $materi->level }} • {{ $materi->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('sensei.material.download', $materi) }}" class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-red-500/20 hover:scale-105 active:scale-95 transition-all">
                            <i data-lucide="download" class="w-4 h-4"></i>
                        </a>
                        <button onclick="viewDetail({
                            title: '{{ $materi->title }}',
                            subject: '{{ $materi->subject }}',
                            level: '{{ $materi->level }}',
                            kelas: '{{ $materi->kelas->nama_kelas ?? 'Umum' }}',
                            date: '{{ $materi->created_at->format('d M Y') }}',
                            download_url: '{{ route('sensei.material.download', $materi) }}'
                        })" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all">
                            Detail
                        </button>
                    </div>
                </div>
                @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-2xl flex items-center justify-center mb-4">
                        <i data-lucide="book-open" class="w-8 h-8 text-gray-300"></i>
                    </div>
                    <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Belum ada materi</p>
                    <p class="text-[10px] text-gray-400 mt-1">Klik tombol Tambah Materi untuk mengunggah pengajaran Anda</p>
                </div>
                @endforelse
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
                        <div class="flex items-center gap-2">
                            <div class="font-black text-[#173A67] text-base">Kanji</div>
                            <span class="px-2 py-0.5 bg-blue-100 text-[#173A67] text-[9px] font-black rounded-lg uppercase tracking-widest">Kelas A1</span>
                        </div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2 mt-0.5">
                            <i data-lucide="clock" class="w-3 h-3"></i> Rabu • 15.00 - 16.00
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="viewClassDetail({
                        name: 'Kelas A1',
                        sensei: '{{ auth()->user()->name }}',
                        subject: 'Kanji',
                        students_count: 24,
                        room: 'Lantai 2 - R.201'
                    })" class="w-10 h-10 bg-white border border-gray-100 text-[#173A67] rounded-xl flex items-center justify-center hover:bg-[#173A67] hover:text-white transition-all shadow-sm">
                        <i data-lucide="info" class="w-4 h-4"></i>
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
                        <div class="flex items-center gap-2">
                            <div class="font-black text-[#173A67] text-base">Kotoba</div>
                            <span class="px-2 py-0.5 bg-orange-100 text-orange-600 text-[9px] font-black rounded-lg uppercase tracking-widest">Kelas A2</span>
                        </div>
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-widest flex items-center gap-2 mt-0.5">
                            <i data-lucide="clock" class="w-3 h-3"></i> Selasa • 15.00 - 16.00
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="viewClassDetail({
                        name: 'Kelas A2',
                        sensei: '{{ auth()->user()->name }}',
                        subject: 'Kotoba',
                        students_count: 18,
                        room: 'Lantai 1 - R.105'
                    })" class="w-10 h-10 bg-white border border-gray-100 text-orange-600 rounded-xl flex items-center justify-center hover:bg-orange-500 hover:text-white transition-all shadow-sm">
                        <i data-lucide="info" class="w-4 h-4"></i>
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

<!-- MODAL TAMBAH MATERI -->
<div id="modalTambahMateri" class="fixed inset-0 z-[100] hidden">
    <div onclick="closeModal('modalTambahMateri')" class="absolute inset-0 bg-[#0A1D37]/40 backdrop-blur-sm transition-opacity cursor-pointer"></div>
    <div class="flex items-center justify-center min-h-screen p-4 pointer-events-none">
        <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-fade-in-up pointer-events-auto">
            <!-- Header -->
            <div class="bg-[#173A67] p-8 text-white relative">
                <div class="relative z-10">
                    <h3 class="text-xl font-black tracking-tight mb-1">Tambah Materi Baru</h3>
                    <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest opacity-80">Unggah file pengajaran Anda</p>
                </div>
                <button type="button" onclick="closeModal('modalTambahMateri')" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-20">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            </div>

            <!-- Form -->
            <form action="{{ route('sensei.material.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Judul Materi</label>
                    <input type="text" name="title" required placeholder="Contoh: Kanji Dasar N5" 
                           class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Mata Pelajaran</label>
                        <select name="subject" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/10 focus:border-[#173A67] appearance-none transition-all">
                            <option value="Kanji">Kanji</option>
                            <option value="Kotoba">Kotoba</option>
                            <option value="Bunpou">Bunpou</option>
                            <option value="Choukai">Choukai</option>
                            <option value="Dokkai">Dokkai</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Kelas</label>
                        <select name="kelas_id" class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/10 focus:border-[#173A67] appearance-none transition-all">
                            <option value="">Umum / Semua Kelas</option>
                            @foreach($kelases ?? [] as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Level</label>
                        <select name="level" required class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl text-sm font-black text-[#173A67] focus:outline-none focus:ring-2 focus:ring-[#173A67]/10 focus:border-[#173A67] appearance-none transition-all">
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="N5">N5</option>
                            <option value="N4">N4</option>
                            <option value="N3">N3</option>
                        </select>
                    </div>
                    <div class="space-y-2 pt-6">
                        <input type="file" name="file" required id="fileInput" class="hidden" onchange="updateFileName(this)">
                        <label for="fileInput" class="flex flex-col items-center justify-center w-full min-h-[58px] px-4 py-2 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer group hover:bg-blue-50/30 transition-all">
                            <div class="flex items-center gap-2">
                                <i data-lucide="upload" class="w-4 h-4 text-[#173A67] opacity-40"></i>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest truncate max-w-[120px]" id="fileName">Pilih File</p>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-5 bg-[#173A67] text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-xl shadow-blue-900/10 hover:bg-blue-900 hover:-translate-y-1 transition-all active:translate-y-0">
                        Simpan Materi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL DETAIL MATERI -->
<div id="modalDetailMateri" class="fixed inset-0 z-[100] hidden">
    <div onclick="closeModal('modalDetailMateri')" class="absolute inset-0 bg-[#0A1D37]/40 backdrop-blur-sm transition-opacity cursor-pointer"></div>
    <div class="flex items-center justify-center min-h-screen p-4 pointer-events-none">
        <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-fade-in-up pointer-events-auto">
            <!-- Header -->
            <div class="bg-[#173A67] p-8 text-white relative">
                <div class="relative z-10">
                    <h3 id="detailTitle" class="text-xl font-black tracking-tight mb-1">Detail Materi</h3>
                    <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest opacity-80 italic">Informasi lengkap pengajaran</p>
                </div>
                <button type="button" onclick="closeModal('modalDetailMateri')" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-20">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Mata Pelajaran</label>
                        <p id="detailSubject" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Kelas</label>
                        <p id="detailKelas" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Level</label>
                        <p id="detailLevel" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal Upload</label>
                        <p id="detailDate" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                </div>

                <div class="mt-8 p-6 bg-gray-50 border border-gray-100 rounded-3xl flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-[#173A67] flex items-center justify-center">
                            <i data-lucide="file-text" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">File Materi</p>
                            <p class="text-xs font-black text-[#173A67]">Lampiran Dokumen</p>
                        </div>
                    </div>
                    <a id="detailDownloadBtn" href="#" class="w-12 h-12 bg-[#173A67] text-white rounded-2xl flex items-center justify-center shadow-xl shadow-blue-900/20 hover:bg-blue-900 hover:scale-105 active:scale-95 transition-all">
                        <i data-lucide="download" class="w-5 h-5"></i>
                    </a>
                </div>

                <div class="pt-4">
                    <button type="button" onclick="closeModal('modalDetailMateri')" class="w-full py-4 bg-gray-100 text-gray-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DETAIL KELAS -->
<div id="modalDetailKelas" class="fixed inset-0 z-[100] hidden">
    <div onclick="closeModal('modalDetailKelas')" class="absolute inset-0 bg-[#0A1D37]/40 backdrop-blur-sm transition-opacity cursor-pointer"></div>
    <div class="flex items-center justify-center min-h-screen p-4 pointer-events-none">
        <div class="relative bg-white w-full max-w-lg rounded-[2.5rem] shadow-2xl overflow-hidden animate-fade-in-up pointer-events-auto">
            <!-- Header -->
            <div id="classHeaderBg" class="bg-[#173A67] p-8 text-white relative">
                <div class="relative z-10">
                    <h3 id="classDetailName" class="text-xl font-black tracking-tight mb-1">Detail Kelas</h3>
                    <p class="text-blue-200 text-[10px] font-black uppercase tracking-widest opacity-80 italic">Informasi administrasi kelas</p>
                </div>
                <button type="button" onclick="closeModal('modalDetailKelas')" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors z-20">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-16 -mt-16"></div>
            </div>

            <!-- Content -->
            <div class="p-8 space-y-6">
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Wali Kelas / Sensei</label>
                        <p id="classDetailSensei" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Mata Pelajaran</label>
                        <p id="classDetailSubject" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Jumlah Siswa</label>
                        <p id="classDetailStudents" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                    <div class="space-y-1">
                        <label class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Ruangan</label>
                        <p id="classDetailRoom" class="text-sm font-black text-[#173A67]"></p>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="button" onclick="closeModal('modalDetailKelas')" class="w-full py-4 bg-gray-100 text-gray-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-gray-200 transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-down {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up { animation: fade-in-up 0.5s ease-out forwards; }
    .animate-fade-in-down { animation: fade-in-down 0.5s ease-out forwards; }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });

    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Pilih File';
        document.getElementById('fileName').textContent = fileName;
        document.getElementById('fileName').classList.remove('text-gray-400');
        document.getElementById('fileName').classList.add('text-[#173A67]');
    }

    function viewDetail(data) {
        document.getElementById('detailTitle').textContent = data.title;
        document.getElementById('detailSubject').textContent = data.subject;
        document.getElementById('detailKelas').textContent = data.kelas;
        document.getElementById('detailLevel').textContent = data.level;
        document.getElementById('detailDate').textContent = data.date;
        document.getElementById('detailDownloadBtn').href = data.download_url;
        
        document.getElementById('modalDetailMateri').classList.remove('hidden');
    }

    function viewClassDetail(data) {
        document.getElementById('classDetailName').textContent = data.name;
        document.getElementById('classDetailSensei').textContent = data.sensei;
        document.getElementById('classDetailSubject').textContent = data.subject;
        document.getElementById('classDetailStudents').textContent = data.students_count + ' Siswa';
        document.getElementById('classDetailRoom').textContent = data.room;
        
        // Dynamic background color based on subject or class
        const header = document.getElementById('classHeaderBg');
        if (data.subject === 'Kotoba') {
            header.className = 'bg-orange-500 p-8 text-white relative';
        } else {
            header.className = 'bg-[#173A67] p-8 text-white relative';
        }

        document.getElementById('modalDetailKelas').classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endpush
@endsection