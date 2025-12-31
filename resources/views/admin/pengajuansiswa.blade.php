@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- TOP HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-[#173A67] tracking-tight">Pengajuan Siswa</h1>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Verifikasi & Persetujuan Pendaftaran</p>
        </div>
        
        <div class="flex items-center gap-3">
            <span class="bg-[#D85B63]/10 text-[#D85B63] px-4 py-2 rounded-2xl text-[11px] font-extrabold flex items-center gap-2">
                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                {{ $submissions->total() }} Menunggu
            </span>
        </div>
    </div>

    <!-- MESSAGES -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-[#22C55E] text-green-700 p-4 rounded-2xl shadow-sm flex items-center justify-between">
        <p class="text-xs font-bold">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

    <!-- SUBMISSIONS LIST -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse ($submissions as $sub)
        <div class="group bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-100 transition-all duration-300 flex flex-col justify-between">
            <div>
                <div class="flex items-start justify-between mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-[#173A67]/5 flex items-center justify-center text-[#173A67] font-bold text-xl">
                        {{ strtoupper(substr($sub->name, 0, 1)) }}
                    </div>
                    <div class="text-right">
                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-wider block">Tgl Daftar</span>
                        <span class="text-[11px] text-[#173A67] font-extrabold">{{ $sub->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="space-y-1 mb-8">
                    <h4 class="text-[#173A67] font-extrabold text-base">{{ $sub->name }}</h4>
                    <div class="flex items-center gap-2 text-gray-400">
                        <i data-lucide="mail" class="w-3 h-3"></i>
                        <span class="text-xs font-bold">{{ $sub->email }}</span>
                    </div>
                </div>
            </div>

            <div>
                <div class="grid grid-cols-2 gap-3 mb-3">
                    <form action="{{ route('admin.siswa.approve', $sub->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-[#173A67] text-white py-3 rounded-2xl text-xs font-extrabold shadow-md hover:bg-[#1e4a7a] transition-all active:scale-95">
                            Setujui
                        </button>
                    </form>
                    <form action="{{ route('admin.siswa.reject', $sub->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-[#D85B63]/10 text-[#D85B63] py-3 rounded-2xl text-xs font-extrabold hover:bg-[#D85B63] hover:text-white transition-all active:scale-95">
                            Tolak
                        </button>
                    </form>
                </div>
                
                <button class="w-full bg-gray-50 text-gray-400 py-3 rounded-2xl text-xs font-extrabold flex items-center justify-center gap-2 hover:bg-gray-100 transition-all">
                    <i data-lucide="file-text" class="w-3.5 h-3.5"></i>
                    Lihat Berkas
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl p-16 text-center shadow-sm border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="clipboard-check" class="w-8 h-8 text-gray-300"></i>
            </div>
            <h5 class="text-gray-500 font-bold text-lg">Semua pengajuan telah diproses</h5>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest">Tidak ada antrian pendaftaran saat ini</p>
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between pt-6">
        <div class="text-[13px] font-bold text-gray-400">
            Menampilkan <span class="text-[#173A67]">{{ $submissions->count() }}</span> dari <span class="text-[#173A67]">{{ $submissions->total() }}</span> pengajuan
        </div>
        {{ $submissions->links('pagination::tailwind') }}
    </div>
</div>
@endsection
