@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- TOP HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-[#173A67] tracking-tight">Daftar Siswa</h1>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Manajemen Data Siswa & Kelas</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.siswa.create') }}" 
               class="bg-[#22C55E] text-white px-6 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 shadow-lg shadow-green-100 hover:translate-y-[-2px] hover:shadow-green-200 transition-all active:scale-95">
                <i data-lucide="plus-circle" class="w-4 h-4"></i>
                Tambah Siswa
            </a>
            <button class="bg-white text-[#173A67] border border-gray-200 px-6 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 shadow-sm hover:bg-gray-50 transition-all active:scale-95">
                <i data-lucide="download" class="w-4 h-4"></i>
                Export
            </button>
        </div>
    </div>

    <!-- SEARCH & FILTER BAR -->
    <form method="GET" action="{{ route('admin.datakelas') }}" class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <!-- Search Input -->
            <div class="relative flex-1 w-full">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email siswa..." 
                       class="w-full bg-[#F8FAFC] border-none rounded-2xl pl-11 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-[#173A67]/20 transition-all">
            </div>

            <!-- Status Filter -->
            <div class="relative w-full md:w-48">
                <select name="status" onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
            </div>

            <!-- Class Filter -->
            <div class="relative w-full md:w-48">
                <select name="kelas_id" onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                    <option value="">Semua Kelas</option>
                    <option value="unassigned" {{ request('kelas_id') == 'unassigned' ? 'selected' : '' }}>Belum Dikelas</option>
                    @foreach($kelases as $kelas)
                        <option value="{{ $kelas->id }}" {{ request('kelas_id') == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }} ({{ $kelas->users_count }}/{{ $kelas->kapasitas }})
                        </option>
                    @endforeach
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
            </div>

            <!-- Reset Button -->
            @if(request()->hasAny(['status', 'kelas_id', 'search']))
            <a href="{{ route('admin.datakelas') }}" 
               class="bg-gray-100 text-gray-600 px-5 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 hover:bg-gray-200 transition-all whitespace-nowrap">
                <i data-lucide="x" class="w-4 h-4"></i>
                Reset
            </a>
            @endif

            <div class="h-8 w-[1px] bg-gray-100 mx-2 hidden md:block"></div>
            <span class="text-xs font-bold text-gray-400 whitespace-nowrap hidden md:block">Total: {{ $students->total() }} Siswa</span>
        </div>
    </form>

    <!-- MESSAGES -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-[#22C55E] text-green-700 p-4 rounded-2xl shadow-sm flex items-center justify-between">
        <p class="text-xs font-bold">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-[#D85B63] text-red-700 p-4 rounded-2xl shadow-sm">
        @foreach($errors->all() as $error)
            <p class="text-xs font-bold">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- STUDENT LIST -->
    <div class="space-y-4">
        @forelse ($students as $student)
        <div class="group bg-white rounded-3xl p-5 flex flex-col lg:flex-row lg:items-center justify-between gap-6 shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-100 transition-all duration-300">
            <!-- Left: Info -->
            <div class="flex items-center gap-5">
                <div class="w-12 h-12 rounded-2xl bg-[#173A67]/5 flex items-center justify-center text-[#173A67] font-bold text-lg">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div>
                    <h4 class="text-[#173A67] font-extrabold text-base">{{ $student->name }}</h4>
                    <p class="text-xs text-gray-400 font-bold mt-0.5">{{ $student->email }}</p>
                </div>
            </div>

            <!-- Center: Class Assignment or Approval -->
            <div class="flex-1 max-w-xs">
                @if($student->status == 'approved')
                    <form action="{{ route('admin.siswa.assign_class', $student->id) }}" method="POST">
                        @csrf
                        <div class="relative">
                            <select name="kelas_id" onchange="this.form.submit()" 
                                    class="w-full bg-[#F8FAFC] border border-gray-100 rounded-2xl px-5 py-2.5 text-[13px] font-extrabold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 focus:border-[#173A67]/20 appearance-none transition-all cursor-pointer">
                                <option value="" disabled {{ is_null($student->kelas_id) ? 'selected' : '' }}>Pilih Kelas</option>
                                @foreach($kelases as $kelas)
                                    <option value="{{ $kelas->id }}" {{ $student->kelas_id == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }} ({{ $kelas->users_count }}/{{ $kelas->kapasitas }})
                                    </option>
                                @endforeach
                            </select>
                            <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
                        </div>
                    </form>
                @else
                    <div class="flex items-center gap-3">
                        <form action="{{ route('admin.siswa.approve', $student->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-[#22C55E] text-white py-2.5 rounded-2xl text-[11px] font-extrabold shadow-sm hover:translate-y-[-2px] hover:shadow-md transition-all active:scale-95 uppercase tracking-widest">
                                Setujui Siswa
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex items-center gap-2 lg:justify-end">
                <button class="bg-gray-50 text-gray-400 p-2.5 rounded-xl hover:bg-[#173A67] hover:text-white transition-all shadow-sm" title="Pesan WhatsApp">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                </button>
                <button class="bg-gray-50 text-gray-400 p-2.5 rounded-xl hover:bg-[#D85B63] hover:text-white transition-all shadow-sm" title="Detail Siswa">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </button>
                <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa ini? Ini akan menghapus akun siswa secara permanen.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-gray-50 text-gray-400 p-2.5 rounded-xl hover:bg-[#D85B63] hover:text-white transition-all shadow-sm" title="Hapus Siswa">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </form>
                <div class="h-6 w-[1px] bg-gray-100 mx-1"></div>
                @if($student->status == 'approved')
                    <button class="bg-[#22C55E]/10 text-[#22C55E] px-4 py-2.5 rounded-xl text-[11px] font-extrabold hover:bg-[#22C55E] hover:text-white transition-all uppercase">
                        Aktif
                    </button>
                @else
                    <button class="bg-yellow-100/50 text-yellow-600 px-4 py-2.5 rounded-xl text-[11px] font-extrabold cursor-default uppercase">
                        Pending
                    </button>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="users" class="w-8 h-8 text-gray-300"></i>
            </div>
            <h5 class="text-gray-500 font-bold">Belum ada siswa yang disetujui.</h5>
            <p class="text-xs text-gray-400 mt-1">Cek pengajuan siswa baru untuk menambah daftar ini.</p>
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between pt-6">
        <div class="text-[13px] font-bold text-gray-400">
            Menampilkan <span class="text-[#173A67]">{{ $students->count() }}</span> dari <span class="text-[#173A67]">{{ $students->total() }}</span> siswa
        </div>
        {{ $students->links('pagination::tailwind') }}
    </div>
</div>
@endsection
