@extends('layouts.header_dashboard_admin')

@section('content')
<div class="max-w-3xl mx-auto space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-500">
    <!-- TOP HEADER -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-[#173A67] tracking-tight">Tambah Siswa Baru</h1>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Registrasi Manual Siswa Baru</p>
        </div>
        <a href="{{ route('admin.datakelas') }}" 
           class="w-12 h-12 bg-white border border-gray-100 rounded-2xl flex items-center justify-center text-gray-400 hover:text-[#D85B63] hover:shadow-md transition-all">
            <i data-lucide="x" class="w-6 h-6"></i>
        </a>
    </div>

    <!-- FORM CARD -->
    <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-50 relative overflow-hidden">
        <!-- Subtle Background Accent -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-[#173A67]/5 rounded-bl-full -mr-16 -mt-16"></div>

        <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-8 relative z-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- NAME -->
                <div class="space-y-2.5">
                    <label for="name" class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300"
                            placeholder="Nama Lengkap Siswa">
                    </div>
                    @error('name') <span class="text-[#D85B63] text-[10px] font-bold ml-1 uppercase tracking-tight">{{ $message }}</span> @enderror
                </div>

                <!-- EMAIL -->
                <div class="space-y-2.5">
                    <label for="email" class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                    <div class="relative">
                        <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}"
                            class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300"
                            placeholder="Email Aktif">
                    </div>
                    @error('email') <span class="text-[#D85B63] text-[10px] font-bold ml-1 uppercase tracking-tight">{{ $message }}</span> @enderror
                </div>

                <!-- PASSWORD -->
                <div class="space-y-2.5">
                    <label for="password" class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="password" name="password" id="password" required
                            class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300"
                            placeholder="Minimal 8 Karakter">
                    </div>
                    @error('password') <span class="text-[#D85B63] text-[10px] font-bold ml-1 uppercase tracking-tight">{{ $message }}</span> @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="space-y-2.5">
                    <label for="password_confirmation" class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Ulangi Password</label>
                    <div class="relative">
                        <i data-lucide="shield-check" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300"
                            placeholder="Konfirmasi Password">
                    </div>
                </div>
            </div>

            <!-- SUBMIT ACTION -->
            <div class="pt-6 border-t border-gray-50">
                <button type="submit" 
                        class="w-full bg-[#173A67] text-white py-5 rounded-[1.5rem] font-bold text-sm shadow-xl shadow-[#173A67]/10 hover:translate-y-[-2px] hover:shadow-[#173A67]/20 hover:bg-[#1e4a7a] transition-all active:scale-95 uppercase tracking-widest">
                    Simpan & Daftarkan Siswa
                </button>
                <p class="text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-6">Siswa yang didaftarkan akan otomatis memiliki status <span class="text-[#22C55E]">Approved</span></p>
            </div>
        </form>
    </div>
</div>
@endsection
