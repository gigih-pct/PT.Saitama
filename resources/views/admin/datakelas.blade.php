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
    <form method="GET" action="{{ route('admin.datakelas') }}" class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 mb-6">
        <div class="flex flex-col xl:flex-row gap-4 items-center">
            <!-- Search Input -->
            <div class="relative flex-1 w-full">
                <i data-lucide="search" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email siswa..." 
                       class="w-full bg-[#F8FAFC] border-none rounded-2xl pl-11 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-[#173A67]/20 transition-all placeholder:text-gray-400">
            </div>

            <div class="flex flex-col md:flex-row gap-4 w-full xl:w-auto">
                <!-- Status Filter -->
                <div class="relative w-full md:w-40">
                    <select name="status" onchange="this.form.submit()"
                            class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Jepang" {{ request('status') == 'Jepang' ? 'selected' : '' }}>Jepang</option>
                        <option value="seleksi" {{ request('status') == 'seleksi' ? 'selected' : '' }}>Seleksi</option>
                        <option value="mau seleksi" {{ request('status') == 'mau seleksi' ? 'selected' : '' }}>Mau Seleksi</option>
                        <option value="ulang kelas" {{ request('status') == 'ulang kelas' ? 'selected' : '' }}>Ulang Kelas</option>
                        <option value="BLK" {{ request('status') == 'BLK' ? 'selected' : '' }}>BLK</option>
                        <option value="proses belajar" {{ request('status') == 'proses belajar' ? 'selected' : '' }}>Proses Belajar</option>
                        <option value="TG" {{ request('status') == 'TG' ? 'selected' : '' }}>TG</option>
                        <option value="kerja" {{ request('status') == 'kerja' ? 'selected' : '' }}>Kerja</option>
                        <option value="keluar" {{ request('status') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                        <option value="cuti" {{ request('status') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                        <option value="Respon" {{ request('status') == 'Respon' ? 'selected' : '' }}>Respon</option>
                        <option value="No Respon" {{ request('status') == 'No Respon' ? 'selected' : '' }}>No Respon</option>
                        <option value="Invalid" {{ request('status') == 'Invalid' ? 'selected' : '' }}>Invalid</option>
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

                <!-- Per Page Filter -->
                <div class="relative w-full md:w-28">
                    <select name="per_page" onchange="this.form.submit()"
                            class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 Item</option>
                        <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30 Item</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Item</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
                </div>
            </div>

            <!-- Reset Button -->
            @if(request()->hasAny(['status', 'kelas_id', 'search', 'per_page']))
            <a href="{{ route('admin.datakelas') }}" 
               class="bg-gray-100 text-gray-600 px-5 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 hover:bg-gray-200 transition-all whitespace-nowrap">
                <i data-lucide="x" class="w-4 h-4"></i>
                Reset
            </a>
            @endif
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

    <!-- STUDENT LIST TABLE -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Kontak</th>
                        <th class="px-6 py-4 text-left text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Kelas</th>
                        <th class="px-6 py-4 text-center text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($students as $student)
                    <tr class="group hover:bg-gray-50/50 transition-colors">
                        <!-- SISWA -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl bg-[#173A67]/10 text-[#173A67] flex items-center justify-center font-bold text-sm">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h4 class="text-[#173A67] font-extrabold text-sm">{{ $student->name }}</h4>
                                </div>
                            </div>
                        </td>

                        <!-- KONTAK -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="text-xs font-bold text-gray-600">{{ $student->email }}</span>
                                <span class="text-[10px] font-bold text-gray-400 mt-0.5">
                                    {{ $student->no_wa_pribadi ?? '-' }}
                                </span>
                            </div>
                        </td>

                        <!-- KELAS -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(in_array($student->status, ['approved', 'Jepang', 'seleksi', 'mau seleksi', 'ulang kelas', 'BLK', 'proses belajar', 'TG', 'kerja', 'cuti']))
                                <form action="{{ route('admin.siswa.assign_class', $student->id) }}" method="POST" class="min-w-[140px]">
                                    @csrf
                                    <div class="relative group/select">
                                        <select name="kelas_id" onchange="this.form.submit()" 
                                                class="w-full bg-transparent border-transparent rounded-lg py-1.5 pl-2 pr-8 text-xs font-bold text-[#173A67] focus:ring-0 focus:border-transparent cursor-pointer hover:bg-white hover:shadow-sm transition-all">
                                            <option value="" disabled {{ is_null($student->kelas_id) ? 'selected' : '' }}>Pilih Kelas</option>
                                            @foreach($kelases as $kelas)
                                                <option value="{{ $kelas->id }}" {{ $student->kelas_id == $kelas->id ? 'selected' : '' }}>
                                                    {{ $kelas->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i data-lucide="chevron-down" class="absolute right-2 top-1/2 -translate-y-1/2 w-3 h-3 text-gray-400 pointer-events-none"></i>
                                    </div>
                                </form>
                            @else
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-[10px] font-bold">Menunggu Persetujuan</span>
                            @endif
                        </td>

                        <!-- STATUS -->
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($student->status == 'pending')
                                <form action="{{ route('admin.siswa.approve', $student->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg text-[10px] font-extrabold bg-[#173A67] text-white hover:bg-[#1e4a7a] transition-colors shadow-sm shadow-blue-900/10">
                                        Setujui
                                    </button>
                                </form>
                            @else
                                @php
                                    $statusConfig = [
                                        'approved' => ['bg' => 'bg-green-50', 'text' => 'text-green-600', 'border' => 'border-green-100', 'dot' => 'bg-green-500', 'label' => 'AKTIF'],
                                        'Jepang' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500', 'label' => 'JEPANG'],
                                        'seleksi' => ['bg' => 'bg-blue-50', 'text' => 'text-[#173A67]', 'border' => 'border-blue-100', 'dot' => 'bg-[#173A67]', 'label' => 'SELEKSI'],
                                        'mau seleksi' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'border' => 'border-indigo-100', 'dot' => 'bg-indigo-500', 'label' => 'MAU SELEKSI'],
                                        'ulang kelas' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-600', 'border' => 'border-amber-100', 'dot' => 'bg-amber-500', 'label' => 'ULANG KELAS'],
                                        'BLK' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600', 'border' => 'border-orange-100', 'dot' => 'bg-orange-500', 'label' => 'BLK'],
                                        'proses belajar' => ['bg' => 'bg-cyan-50', 'text' => 'text-cyan-600', 'border' => 'border-cyan-100', 'dot' => 'bg-cyan-500', 'label' => 'BELAJAR'],
                                        'TG' => ['bg' => 'bg-violet-50', 'text' => 'text-violet-600', 'border' => 'border-violet-100', 'dot' => 'bg-violet-500', 'label' => 'TG'],
                                        'kerja' => ['bg' => 'bg-sky-50', 'text' => 'text-sky-600', 'border' => 'border-sky-100', 'dot' => 'bg-sky-500', 'label' => 'KERJA'],
                                        'keluar' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100', 'dot' => 'bg-rose-500', 'label' => 'KELUAR'],
                                        'cuti' => ['bg' => 'bg-slate-50', 'text' => 'text-slate-600', 'border' => 'border-slate-100', 'dot' => 'bg-slate-500', 'label' => 'CUTI'],
                                        'Respon' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-600', 'border' => 'border-emerald-100', 'dot' => 'bg-emerald-500', 'label' => 'RESPON'],
                                        'No Respon' => ['bg' => 'bg-rose-50', 'text' => 'text-rose-600', 'border' => 'border-rose-100', 'dot' => 'bg-rose-500', 'label' => 'NO RESPON'],
                                        'Invalid' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-400', 'border' => 'border-gray-100', 'dot' => 'bg-gray-400', 'label' => 'INVALID'],
                                    ];
                                    $cfg = $statusConfig[$student->status] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-400', 'border' => 'border-gray-100', 'dot' => 'bg-gray-400', 'label' => strtoupper($student->status)];
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-extrabold {{ $cfg['bg'] }} {{ $cfg['text'] }} border {{ $cfg['border'] }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $cfg['dot'] }}"></span>
                                    {{ $cfg['label'] }}
                                </span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="px-6 py-4 whitespace-nowrap text-right">
                            <div class="flex items-center justify-end gap-2">
                                <!-- WhatsApp Popup -->
                                <div class="relative" x-data="{ open: false }">
                                    <button @click="open = !open" @click.outside="open = false" 
                                            class="w-9 h-9 rounded-xl bg-green-500 text-white flex items-center justify-center hover:bg-green-600 hover:rotate-12 transition-all shadow-lg shadow-green-500/20 active:scale-90"
                                            title="WhatsApp">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    </button>

                                    <!-- Dropdown Menu -->
                                    <div x-show="open" 
                                         class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 p-2 z-50 text-left animate-in fade-in zoom-in-95 duration-200 origin-top-right"
                                         style="display: none;">
                                        <p class="px-3 py-1.5 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest border-b border-gray-50 mb-1">Pilih Kontak</p>
                                        
                                        <!-- Siswa -->
                                        @if($student->no_wa_pribadi)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', str_replace('+', '', (str_starts_with($student->no_wa_pribadi, '0') ? '62' . substr($student->no_wa_pribadi, 1) : $student->no_wa_pribadi))) }}" 
                                           target="_blank"
                                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#25D366]/10 hover:text-[#25D366] transition-all group/wa">
                                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover/wa:bg-white transition-colors">
                                                <i data-lucide="user" class="w-4 h-4 text-gray-400 group-hover/wa:text-[#25D366]"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[11px] font-bold text-gray-700">Siswa</span>
                                                <span class="text-[9px] font-bold text-gray-400">{{ $student->no_wa_pribadi }}</span>
                                            </div>
                                        </a>
                                        @else
                                        <div class="flex items-center gap-3 px-3 py-2.5 opacity-50 cursor-not-allowed grayscale">
                                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center">
                                                <i data-lucide="user" class="w-4 h-4 text-gray-300"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[11px] font-bold text-gray-400">Siswa</span>
                                                <span class="text-[9px] font-bold text-gray-300">Belum ada nomor</span>
                                            </div>
                                        </div>
                                        @endif

                                        <!-- Orang Tua -->
                                        @if($student->wa_orang_tua)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', str_replace('+', '', (str_starts_with($student->wa_orang_tua, '0') ? '62' . substr($student->wa_orang_tua, 1) : $student->wa_orang_tua))) }}" 
                                           target="_blank"
                                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#25D366]/10 hover:text-[#25D366] transition-all group/wa">
                                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center group-hover/wa:bg-white transition-colors">
                                                <i data-lucide="users" class="w-4 h-4 text-gray-400 group-hover/wa:text-[#25D366]"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[11px] font-bold text-gray-700">Orang Tua</span>
                                                <span class="text-[9px] font-bold text-gray-400">{{ $student->wa_orang_tua }}</span>
                                            </div>
                                        </a>
                                        @else
                                        <div class="flex items-center gap-3 px-3 py-2.5 opacity-50 cursor-not-allowed grayscale">
                                            <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center">
                                                <i data-lucide="users" class="w-4 h-4 text-gray-300"></i>
                                            </div>
                                            <div class="flex flex-col">
                                                <span class="text-[11px] font-bold text-gray-400">Orang Tua</span>
                                                <span class="text-[9px] font-bold text-gray-300">Belum ada nomor</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('admin.siswa.edit', $student->id) }}" 
                                   class="w-9 h-9 rounded-xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 hover:rotate-12 transition-all shadow-lg shadow-blue-900/10 active:scale-90"
                                   title="Edit Siswa">
                                    <i data-lucide="edit-2" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('admin.siswa.destroy', $student->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus data siswa ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-9 h-9 rounded-xl bg-[#D85B63] text-white flex items-center justify-center hover:bg-red-600 hover:rotate-12 transition-all shadow-lg shadow-red-600/10 active:scale-90"
                                            title="Hapus Siswa">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <i data-lucide="search-x" class="w-8 h-8 text-gray-300"></i>
                                </div>
                                <h5 class="text-gray-500 font-bold mb-1">Data tidak ditemukan</h5>
                                <p class="text-xs text-gray-400">Coba ubah filter pencarian Anda.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
