@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-6">
    <!-- TOP CARDS ROW -->
    <div class="grid grid-cols-12 gap-6">
        <!-- PROFILE CARD (Left - Larger) -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-2xl p-8 shadow-sm border border-gray-50">
            <div class="flex items-center gap-10">
                <!-- Avatar -->
                <div class="relative">
                    <div class="w-32 h-32 rounded-full bg-[#173A67] flex items-center justify-center text-4xl font-extrabold text-white shadow-lg border-4 border-white">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div>
                </div>
                
                <!-- Info Section -->
                <div class="flex-1 relative pb-2">
                    <!-- Edit Button Top Right -->
                    <div class="absolute -top-4 right-0">
                        <button onclick="document.getElementById('editProfileModal').classList.remove('hidden')" 
                                style="background-color: #D85B63;" 
                                class="text-white px-5 py-2 rounded-2xl flex items-center gap-2 text-xs font-bold hover:opacity-90 transition-opacity">
                            <i data-lucide="pencil" class="w-3 h-3"></i>
                            Edit Profil
                        </button>
                    </div>

                    <div class="space-y-2 mt-4">
                        <h2 class="text-2xl font-extrabold text-[#173A67]">{{ Auth::guard('admin')->user()->name }}</h2>
                        <div class="space-y-1">
                            <p class="text-[13px] flex items-center gap-2 text-gray-500">
                                <i data-lucide="mail" class="w-4 h-4 text-[#173A67]"></i>
                                {{ Auth::guard('admin')->user()->email }}
                            </p>
                            <p class="text-[13px] flex items-center gap-2 text-gray-500">
                                <i data-lucide="shield" class="w-4 h-4 text-[#173A67]"></i>
                                Administrator
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATS CARD (Right - Summary) -->
        <div class="col-span-12 lg:col-span-5 grid grid-cols-2 gap-4">
            <!-- Stat 1: Siswa -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50 flex flex-col justify-between group hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Siswa</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 text-[#173A67] flex items-center justify-center">
                        <i data-lucide="users" class="w-4 h-4"></i>
                    </div>
                </div>
                <p class="text-3xl font-extrabold text-[#173A67] mt-2 group-hover:scale-105 transition-transform origin-left">{{ $stats['total_siswa'] }}</p>
            </div>

            <!-- Stat 2: Kelas -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50 flex flex-col justify-between group hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Total Kelas</span>
                    <div class="w-8 h-8 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center">
                        <i data-lucide="school" class="w-4 h-4"></i>
                    </div>
                </div>
                <p class="text-3xl font-extrabold text-[#173A67] mt-2 group-hover:scale-105 transition-transform origin-left">{{ $stats['total_kelas'] }}</p>
            </div>

            <!-- Stat 3: Berkas Pendaftaran Pending -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50 flex flex-col justify-between group hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Pendaftaran</span>
                    <div class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-end gap-2 mt-2">
                    <p class="text-3xl font-extrabold text-[#173A67] group-hover:scale-105 transition-transform origin-left">{{ $stats['berkas_pendaftaran'] }}</p>
                    <span class="text-xs text-red-500 font-bold mb-1">Pending</span>
                </div>
            </div>

            <!-- Stat 4: Berkas Seleksi Pending -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-50 flex flex-col justify-between group hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Seleksi</span>
                    <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i data-lucide="clipboard-check" class="w-4 h-4"></i>
                    </div>
                </div>
                <div class="flex items-end gap-2 mt-2">
                    <p class="text-3xl font-extrabold text-[#173A67] group-hover:scale-105 transition-transform origin-left">{{ $stats['berkas_seleksi'] }}</p>
                    <span class="text-xs text-purple-500 font-bold mb-1">Pending</span>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-2xl shadow-sm flex items-center justify-between animate-in fade-in slide-in-from-top-4 duration-300">
        <div class="flex items-center gap-3">
            <div class="w-6 h-6 rounded-full bg-green-200 flex items-center justify-center">
                <i data-lucide="check" class="w-4 h-4 text-green-700"></i>
            </div>
            <p class="text-sm font-bold">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700 transition">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
    </div>
    @endif
</div>

<!-- EDIT PROFILE MODAL -->
<div id="editProfileModal" class="hidden fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
         onclick="document.getElementById('editProfileModal').classList.add('hidden')"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
            
            <!-- Modal Header -->
            <div class="bg-[#173A67] px-8 py-6">
                <h3 class="text-xl font-extrabold text-white" id="modal-title">Edit Profil Admin</h3>
                <p class="text-blue-100 text-xs mt-1">Perbarui informasi akun administrator Anda.</p>
                <button onclick="document.getElementById('editProfileModal').classList.add('hidden')" 
                        class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors">
                    <i data-lucide="x" class="w-6 h-6"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('admin.profile.update') }}" method="POST" class="p-8 space-y-5">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Nama Lengkap</label>
                    <div class="relative group">
                        <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}" required
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all placeholder:text-gray-300">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Email</label>
                    <div class="relative group">
                        <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input type="email" name="email" value="{{ Auth::guard('admin')->user()->email }}" required
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all placeholder:text-gray-300">
                    </div>
                </div>

                <div class="border-t border-gray-100 my-4 pt-4">
                    <p class="text-xs text-orange-500 font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="lock" class="w-3 h-3"></i>
                        Kosongkan jika tidak ingin mengubah password
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Password Baru</label>
                            <input type="password" name="password" placeholder="********"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[11px] font-extrabold text-[#173A67]/60 uppercase tracking-widest ml-1">Konfirmasi</label>
                            <input type="password" name="password_confirmation" placeholder="********"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 text-sm font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/10 focus:border-[#173A67] transition-all">
                        </div>
                    </div>
                </div>

                <div class="pt-4 flex gap-3">
                    <button type="button" onclick="document.getElementById('editProfileModal').classList.add('hidden')"
                            class="flex-1 bg-gray-100 text-gray-600 py-3.5 rounded-xl font-bold text-sm hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-[#173A67] text-white py-3.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-900/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
