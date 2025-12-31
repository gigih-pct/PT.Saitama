@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-6">
    <!-- HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-[#173A67] tracking-tight">Berkas Seleksi</h1>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Review Berkas Seleksi Siswa</p>
        </div>
    </div>

    <!-- FILTER BAR -->
    <form method="GET" action="{{ route('admin.berkasseleksi') }}" class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <!-- Status Filter -->
            <div class="relative w-full md:w-48">
                <select name="status" onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
            </div>

            <!-- Student Filter -->
            <div class="relative w-full md:w-64">
                <select name="user_id" onchange="this.form.submit()"
                        class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                    <option value="">Semua Siswa</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
            </div>

            <!-- Reset Button -->
            @if(request()->hasAny(['status', 'user_id']))
            <a href="{{ route('admin.berkasseleksi') }}" 
               class="bg-gray-100 text-gray-600 px-5 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 hover:bg-gray-200 transition-all whitespace-nowrap">
                <i data-lucide="x" class="w-4 h-4"></i>
                Reset
            </a>
            @endif

            <div class="h-8 w-[1px] bg-gray-100 mx-2 hidden md:block"></div>
            <span class="text-xs font-bold text-gray-400 whitespace-nowrap hidden md:block">Total: {{ $berkas->total() }} Berkas</span>
        </div>
    </form>

    <!-- MESSAGES -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-2xl shadow-sm flex items-center justify-between">
        <p class="text-xs font-bold">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

    <!-- DOCUMENT LIST -->
    <div class="space-y-4">
        @forelse ($berkas as $item)
        <div class="bg-white rounded-3xl px-8 py-5 flex flex-col lg:flex-row lg:items-center gap-4 shadow-sm border border-gray-100 hover:shadow-md transition">
            <!-- Student Name -->
            <div class="lg:w-1/5">
                <h4 class="text-[#173A67] font-extrabold text-sm">{{ $item->user->name }}</h4>
                <p class="text-xs text-gray-400 mt-0.5">{{ $item->user->email }}</p>
            </div>

            <!-- Document Info -->
            <div class="flex-1">
                <div class="bg-gray-50 rounded-2xl px-6 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-extrabold text-[#173A67]">{{ $item->nama_berkas }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">Upload: {{ $item->uploaded_at->format('d/m/Y H:i') }}</p>
                    </div>
                    @if($item->status == 'approved')
                        <span class="bg-green-100 text-green-700 px-4 py-1.5 rounded-full text-xs font-bold">Disetujui</span>
                    @elseif($item->status == 'rejected')
                        <span class="bg-red-100 text-red-700 px-4 py-1.5 rounded-full text-xs font-bold">Ditolak</span>
                    @else
                        <span class="bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full text-xs font-bold">Pending</span>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2 lg:w-1/4 justify-end">
                <a href="{{ route('admin.berkas.download', $item->id) }}" 
                   class="bg-[#173A67] text-white px-5 py-2.5 rounded-xl text-xs font-extrabold flex items-center gap-2 shadow-sm hover:opacity-90 transition">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Download
                </a>
                
                @if($item->status == 'pending')
                <form action="{{ route('admin.berkas.approve', $item->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-green-500 text-white w-10 h-10 flex items-center justify-center rounded-xl shadow-sm hover:bg-green-600 transition">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </button>
                </form>
                <form action="{{ route('admin.berkas.reject', $item->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-500 text-white w-10 h-10 flex items-center justify-center rounded-xl shadow-sm hover:bg-red-600 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </form>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="file-text" class="w-8 h-8 text-gray-300"></i>
            </div>
            <h5 class="text-gray-500 font-bold">Belum ada berkas seleksi yang diupload.</h5>
            <p class="text-xs text-gray-400 mt-1">Berkas seleksi akan muncul di sini.</p>
        </div>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between pt-6">
        <div class="text-[13px] font-bold text-gray-400">
            Menampilkan <span class="text-[#173A67]">{{ $berkas->count() }}</span> dari <span class="text-[#173A67]">{{ $berkas->total() }}</span> berkas
        </div>
        {{ $berkas->links('pagination::tailwind') }}
    </div>
</div>
@endsection
