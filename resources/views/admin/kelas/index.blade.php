@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    <!-- TOP HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-[#173A67] tracking-tight">Manajemen Kelas</h1>
            <p class="text-xs text-gray-500 font-bold uppercase tracking-widest mt-1">Kelola Kapasitas & Informasi Kelas</p>
        </div>
        
        <button onclick="toggleModal('modal-tambah')" 
                class="bg-[#22C55E] text-white px-6 py-3 rounded-2xl text-xs font-extrabold flex items-center gap-2 shadow-lg shadow-green-100 hover:translate-y-[-2px] hover:shadow-green-200 transition-all active:scale-95">
            <i data-lucide="plus-circle" class="w-4 h-4"></i>
            Tambah Kelas Baru
        </button>
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

    @if($errors->any())
    <div class="bg-red-50 border-l-4 border-[#D85B63] text-red-700 p-4 rounded-2xl shadow-sm">
        @foreach($errors->all() as $error)
            <p class="text-xs font-bold">{{ $error }}</p>
        @endforeach
    </div>
    @endif

    <!-- KELAS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($kelases as $kelas)
        <div class="group bg-white rounded-3xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-100 transition-all duration-300 flex flex-col justify-between">
            <div>
                <div class="flex justify-between items-start mb-6">
                    <div class="w-12 h-12 rounded-2xl bg-[#173A67]/5 flex items-center justify-center text-[#173A67]">
                        <i data-lucide="bookmark" class="w-6 h-6"></i>
                    </div>
                    <span class="bg-gray-50 text-gray-400 text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-tighter">ID: {{ $kelas->id }}</span>
                </div>
                
                <h4 class="text-[#173A67] font-extrabold text-xl mb-6">{{ $kelas->nama_kelas }}</h4>
                
                <div class="space-y-3 mb-8">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl">
                        <div class="flex items-center gap-2">
                            <i data-lucide="users-2" class="w-4 h-4 text-gray-400"></i>
                            <span class="text-xs font-bold text-gray-500 uppercase tracking-wide">Kapasitas</span>
                        </div>
                        <span class="text-sm font-extrabold text-[#173A67]">{{ $kelas->kapasitas }} Siswa</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 {{ $kelas->users_count >= $kelas->kapasitas ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600' }} rounded-2xl">
                        <div class="flex items-center gap-2 text-current opacity-70">
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                            <span class="text-xs font-bold uppercase tracking-wide">Terisi</span>
                        </div>
                        <span class="text-sm font-extrabold">{{ $kelas->users_count }} / {{ $kelas->kapasitas }}</span>
                    </div>
                </div>

                <!-- STUDENT LIST INLINE -->
                <div class="mt-6">
                    <div class="flex items-center justify-between mb-3 px-2">
                        <span class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Daftar Siswa</span>
                        <span class="text-[10px] font-extrabold text-[#173A67]">{{ $kelas->users_count }} Terdaftar</span>
                    </div>
                    <div class="max-h-48 overflow-y-auto pr-2 space-y-2 custom-scrollbar">
                        @forelse($kelas->users as $u)
                        <div class="flex items-center justify-between p-3 bg-gray-50/50 rounded-2xl group/item hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-100 transition-all">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-[#173A67] font-bold text-[10px] border border-gray-100 shadow-sm">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div class="overflow-hidden">
                                    <p class="text-[11px] font-extrabold text-[#173A67] truncate w-24">{{ $u->name }}</p>
                                    <p class="text-[9px] text-gray-400 truncate w-24">{{ $u->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-1 opacity-0 group-hover/item:opacity-100 transition-opacity">
                                <button onclick="openEditSiswaModal({{ $u->id }}, '{{ $u->name }}', '{{ $u->email }}')" 
                                        class="p-1.5 text-gray-400 hover:text-blue-500 transition-colors">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                <form action="{{ route('admin.siswa.remove_from_class', $u->id) }}" method="POST" onsubmit="return confirm('Keluarkan {{ $u->name }} dari kelas ini?')">
                                    @csrf
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                        <i data-lucide="user-minus" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @empty
                        <div class="py-4 text-center">
                            <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest italic">Kelas masih kosong</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2 mt-2 pt-4 border-t border-gray-50">
                <button onclick="openAssignModal({{ $kelas->id }}, '{{ $kelas->nama_kelas }}', {{ $kelas->kapasitas - $kelas->users_count }})" 
                        class="flex-1 bg-[#22C55E]/10 text-[#22C55E] py-3 rounded-2xl text-xs font-extrabold hover:bg-[#22C55E] hover:text-white transition-all">
                    Tambah Siswa
                </button>
                <button onclick="editKelas({{ $kelas->id }}, '{{ $kelas->nama_kelas }}', {{ $kelas->kapasitas }})" 
                        class="flex-1 bg-[#173A67]/5 text-[#173A67] py-3 rounded-2xl text-xs font-extrabold hover:bg-[#173A67] hover:text-white transition-all">
                    Edit Data
                </button>
                <form action="{{ route('admin.kelas.destroy', $kelas->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kelas ini?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-[#D85B63]/10 text-[#D85B63] py-3 rounded-2xl text-xs font-extrabold hover:bg-[#D85B63] hover:text-white transition-all">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full bg-white rounded-3xl p-16 text-center shadow-sm border border-dashed border-gray-200">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i data-lucide="layout-grid" class="w-8 h-8 text-gray-300"></i>
            </div>
            <h5 class="text-gray-500 font-bold text-lg">Belum ada kelas yang dibuat</h5>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest">Klik tambah kelas untuk memulai</p>
        </div>
        @endforelse
    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="modal-tambah" class="fixed inset-0 bg-[#173A67]/40 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-md p-10 relative shadow-2xl animate-in zoom-in duration-300 border border-white">
        <button onclick="toggleModal('modal-tambah')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        <div class="mb-8">
            <h3 class="text-[#173A67] font-extrabold text-2xl tracking-tight">Tambah Kelas</h3>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Konfigurasi kelas baru anda</p>
        </div>

        <form action="{{ route('admin.kelas.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" required 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300" 
                       placeholder="Contoh: Dasar Bahasa Jepang A">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Kapasitas Maksimal</label>
                <input type="number" name="kapasitas" required min="1" 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300" 
                       placeholder="Jumlah siswa">
            </div>
            <button type="submit" class="w-full bg-[#22C55E] text-white py-5 rounded-[1.5rem] font-bold text-sm shadow-lg shadow-green-100 hover:translate-y-[-2px] hover:shadow-green-200 transition-all active:scale-95 mt-4">
                BUAT KELAS SEKARANG
            </button>
        </form>
    </div>
</div>

<!-- MODAL ASSIGN SISWA -->
<div id="modal-assign" class="fixed inset-0 bg-[#173A67]/40 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-lg p-10 relative shadow-2xl animate-in zoom-in duration-300 border border-white flex flex-col max-h-[90vh]">
        <button onclick="toggleModal('modal-assign')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        <div class="mb-8">
            <h3 class="text-[#173A67] font-extrabold text-2xl tracking-tight">Tambah Siswa</h3>
            <p id="assign-title" class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Pilih siswa untuk Kelas ...</p>
        </div>

        <!-- Search Siswa -->
        <div class="relative mb-6">
            <i data-lucide="search" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
            <input type="text" id="search-unassigned" onkeyup="filterUnassigned()"
                   class="w-full bg-gray-50 border-none rounded-2xl pl-12 pr-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all placeholder:text-gray-300" 
                   placeholder="Cari nama siswa...">
        </div>

        <div class="flex-1 overflow-y-auto pr-2 space-y-3 custom-scrollbar" id="unassigned-list">
            @forelse($unassignedStudents as $s)
            <div class="unassigned-item bg-gray-50 rounded-2xl p-4 flex items-center justify-between group hover:bg-[#173A67]/5 transition-all">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-[#173A67] font-bold text-sm border border-gray-100 shadow-sm">
                        {{ strtoupper(substr($s->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-extrabold text-[#173A67] unassigned-name">{{ $s->name }}</p>
                        <p class="text-[10px] text-gray-400 font-bold mt-0.5">{{ $s->email }}</p>
                    </div>
                </div>
                <form action="" method="POST" class="assign-form">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $s->id }}">
                    <button type="submit" class="bg-white text-[#173A67] text-[10px] font-extrabold px-4 py-2 rounded-xl shadow-sm border border-gray-100 hover:bg-[#173A67] hover:text-white hover:border-[#173A67] transition-all">
                        PILIH
                    </button>
                </form>
            </div>
            @empty
            <div class="text-center py-10">
                <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i data-lucide="user-minus" class="w-5 h-5 text-gray-300"></i>
                </div>
                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest">Tidak ada siswa yang tersedia</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-8 pt-6 border-t border-gray-50">
            <p class="text-center text-[10px] text-gray-400 font-bold uppercase tracking-widest">Hanya menampilkan siswa yang sudah disetujui (Approved)</p>
        </div>
    </div>
</div>

<!-- MODAL EDIT KELAS -->
<div id="modal-edit" class="fixed inset-0 bg-[#173A67]/40 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-md p-10 relative shadow-2xl animate-in zoom-in duration-300 border border-white">
        <button onclick="toggleModal('modal-edit')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        <div class="mb-8">
            <h3 class="text-[#173A67] font-extrabold text-2xl tracking-tight">Edit Kelas</h3>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Sesuaikan informasi kelas anda</p>
        </div>

        <form id="form-edit" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Nama Kelas</label>
                <input type="text" name="nama_kelas" id="edit-nama" required 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Kapasitas Maksimal</label>
                <input type="number" name="kapasitas" id="edit-kapasitas" required min="1" 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all">
            </div>
            <button type="submit" class="w-full bg-[#173A67] text-white py-5 rounded-[1.5rem] font-bold text-sm shadow-lg shadow-blue-100 hover:translate-y-[-2px] hover:shadow-blue-200 transition-all active:scale-95 mt-4 uppercase tracking-widest">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<!-- MODAL EDIT SISWA -->
<div id="modal-edit-siswa" class="fixed inset-0 bg-[#173A67]/40 backdrop-blur-sm hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-[2.5rem] w-full max-w-md p-10 relative shadow-2xl animate-in zoom-in duration-300 border border-white">
        <button onclick="toggleModal('modal-edit-siswa')" class="absolute top-8 right-8 text-gray-400 hover:text-gray-600 transition-colors">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
        
        <div class="mb-8">
            <h3 class="text-[#173A67] font-extrabold text-2xl tracking-tight">Edit Data Siswa</h3>
            <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Perbarui informasi profil siswa</p>
        </div>

        <form id="form-edit-siswa" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <input type="text" name="name" id="edit-siswa-nama" required 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all">
            </div>
            <div class="space-y-2">
                <label class="text-[10px] font-extrabold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                <input type="email" name="email" id="edit-siswa-email" required 
                       class="w-full bg-gray-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/10 transition-all">
            </div>
            <button type="submit" class="w-full bg-[#173A67] text-white py-5 rounded-[1.5rem] font-bold text-sm shadow-lg shadow-blue-100 hover:translate-y-[-2px] hover:shadow-blue-200 transition-all active:scale-95 mt-4 uppercase tracking-widest">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function editKelas(id, nama, kapasitas) {
        document.getElementById('form-edit').action = `/admin/kelas/${id}`;
        document.getElementById('edit-nama').value = nama;
        document.getElementById('edit-kapasitas').value = kapasitas;
        toggleModal('modal-edit');
    }

    function openAssignModal(id, nama, sisa) {
        document.getElementById('assign-title').innerText = `Pilih siswa untuk ${nama} (${sisa} sisa)`;
        const forms = document.querySelectorAll('.assign-form');
        forms.forEach(form => {
            form.action = `/admin/kelas/${id}/assign-student`;
        });
        toggleModal('modal-assign');
    }

    function filterUnassigned() {
        const input = document.getElementById('search-unassigned').value.toLowerCase();
        const items = document.querySelectorAll('.unassigned-item');
        
        items.forEach(item => {
            const name = item.querySelector('.unassigned-name').innerText.toLowerCase();
            if (name.includes(input)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    function openEditSiswaModal(id, name, email) {
        document.getElementById('form-edit-siswa').action = `/admin/siswa/${id}`;
        document.getElementById('edit-siswa-nama').value = name;
        document.getElementById('edit-siswa-email').value = email;
        toggleModal('modal-edit-siswa');
    }
</script>
@endsection
