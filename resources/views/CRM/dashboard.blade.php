@extends('layouts.header_dashboard_crm')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6" x-data="dashboard">

    <!-- TOP SECTION -->
    <div class="grid grid-cols-12 gap-6 h-[280px] shrink-0">
        
        <!-- PROFILE CARD (Left - 7 Columns) -->
        <div class="col-span-12 lg:col-span-7 h-full">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 h-full relative overflow-hidden flex items-center group">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 w-64 h-full bg-[#173A67]/5 -mr-20 -skew-x-12"></div>
                
                <div class="flex items-center gap-10 relative z-10 w-full">
                    <!-- Avatar -->
                    <div class="shrink-0">
                        <div class="w-32 h-32 rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                            <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="flex-1 space-y-3">
                        <div class="space-y-1">
                            <h2 class="text-2xl font-extrabold text-[#173A67]">Maharani</h2>
                            <p class="text-xs font-extrabold text-blue-500 uppercase tracking-widest">NIS: 23.2865 • Guru BK</p>
                        </div>
                        
                        <div class="flex flex-col gap-1 text-sm font-bold text-slate-500">
                            <p class="flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4"></i> 10 Agustus 2004</p>
                        </div>

                        <button class="bg-[#D85B63] hover:bg-[#c44f56] text-white font-extrabold px-8 py-2.5 rounded-2xl shadow-lg shadow-red-900/10 text-xs mt-2 transition-all uppercase tracking-widest active:scale-95 leading-none">
                            Presensi
                        </button>
                    </div>

                    <!-- Edit Button -->
                    <div class="self-start">
                        <button class="bg-gray-50 hover:bg-white text-[#173A67] p-3 rounded-2xl border border-gray-100 shadow-sm transition-all hover:shadow-md active:scale-90">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- CARD 2: KEHADIRAN -->
        <div class="col-span-12 lg:col-span-5 h-full">
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 h-full flex flex-col items-center justify-center text-center relative overflow-hidden group">
                 <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-green-50 rounded-full blur-3xl opacity-50 transition-all group-hover:scale-150"></div>
                 
                 <div class="flex items-center gap-2 mb-6">
                     <span class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest">Statistik Kehadiran</span>
                     <span class="bg-green-50 text-green-600 text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider">Sangat Baik</span>
                 </div>
                 
                 <div class="relative">
                    <h2 class="text-[#173A67] font-extrabold text-6xl tracking-tighter">75%</h2>
                    <div class="absolute -top-1 -right-4 w-2 h-2 bg-[#D85B63] rounded-full"></div>
                 </div>
                 
                 <p class="text-[11px] font-bold text-slate-400 mt-4 uppercase tracking-widest">Total Kehadiran Bulan Ini</p>
            </div>
        </div>
    </div>

    <!-- STUDENT LIST SECTION -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
        
        <!-- Enhanced Header -->
        <div class="bg-white px-8 py-6">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h3 class="text-[#1a1a1a] font-bold text-xl mb-0.5">Daftar Siswa</h3>
                    <p class="text-gray-400 text-[11px] font-medium uppercase tracking-wide">Manajemen Data Siswa & Kelas</p>
                </div>
                
                <div class="flex items-center gap-3">
                    <button class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-all flex items-center gap-2">
                        <i data-lucide="download" class="w-4 h-4"></i> Export
                    </button>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <!-- Search Bar -->
                <div class="relative flex-1">
                    <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" x-model="searchSiswa" placeholder="Cari nama atau email siswa..." class="w-full bg-[#F8FAFC] border-none rounded-2xl pl-11 pr-4 py-3 text-sm font-medium focus:ring-2 focus:ring-[#173A67]/20 transition-all placeholder:text-gray-400">
                </div>
                
                <!-- Filter Dropdowns -->
                <div class="relative min-w-[140px]">
                    <select x-model="selectedStatus" class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="Jepang">Jepang</option>
                        <option value="seleksi">Seleksi</option>
                        <option value="mau seleksi">Mau Seleksi</option>
                        <option value="ulang kelas">Ulang Kelas</option>
                        <option value="BLK">BLK</option>
                        <option value="proses belajar">Proses Belajar</option>
                        <option value="TG">TG</option>
                        <option value="kerja">Kerja</option>
                        <option value="keluar">Keluar</option>
                        <option value="cuti">Cuti</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
                </div>
                
                <div class="relative min-w-[140px]">
                    <select x-model="selectedClass" class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                        <option value="">Semua Kelas</option>
                        <option value="A1">Kelas A1</option>
                        <option value="A2">Kelas A2</option>
                        <option value="A3">Kelas A3</option>
                        <option value="B1">Kelas B1</option>
                        <option value="B2">Kelas B2</option>
                        <option value="B3">Kelas B3</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
                </div>
                
                <div class="relative min-w-[100px]">
                    <select x-model="perPage" class="w-full bg-[#F8FAFC] border-none rounded-2xl px-4 py-3 text-sm font-bold text-[#173A67] focus:ring-2 focus:ring-[#173A67]/20 appearance-none cursor-pointer">
                        <option value="20">20 Item</option>
                        <option value="50">50 Item</option>
                        <option value="100">100 Item</option>
                    </select>
                    <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-[#173A67] pointer-events-none opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- TABLE HEADER -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-100">
            <div class="flex items-center justify-between gap-6">
                <div class="w-48 shrink-0">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Siswa</span>
                </div>
                <div class="w-32">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Angkatan</span>
                </div>
                <div class="flex-1">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Kontak</span>
                </div>
                <div class="w-40">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Follow Up</span>
                </div>
                <div class="w-64">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Status</span>
                </div>
                <div class="w-12 text-right">
                    <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider">Aksi</span>
                </div>
            </div>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-6 space-y-3 bg-[#F8FAFC]/50">
            
            <template x-for="(student, index) in filteredStudents()" :key="index">
                <div class="bg-white border border-gray-100 rounded-2xl px-6 py-4 flex items-center justify-between gap-6 hover:shadow-md transition-all group">
                    <!-- Student Info -->
                    <div class="flex items-center gap-4 w-48 shrink-0">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-[#173A67] flex items-center justify-center text-xs font-extrabold" x-text="student.name.charAt(0)"></div>
                        <div class="font-bold text-[#173A67] text-sm truncate" x-text="student.name"></div>
                    </div>
                    
                    <!-- Batch -->
                    <button @click="openBatchModal(student)" class="bg-gray-50 px-4 py-2 rounded-xl font-extrabold text-[10px] text-gray-500 hover:bg-blue-50 hover:text-[#173A67] transition-all uppercase tracking-wider">
                        <span x-text="student.angkatan"></span>
                    </button>
                    
                    <!-- Contacts -->
                    <div class="flex gap-2">
                        <button @click="showContactModal = true; contactTitle = 'Kontak Siswa'; contactNumbers = student.contacts.siswa" class="bg-white border border-green-100 text-green-600 text-[10px] font-extrabold px-3 py-2 rounded-xl flex items-center gap-2 hover:bg-green-50 transition-all uppercase tracking-wider">
                            <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Siswa
                        </button>
                        <button @click="showContactModal = true; contactTitle = 'Kontak Orang Tua'; contactNumbers = student.contacts.ortu" class="bg-white border border-red-100 text-[#D85B63] text-[10px] font-extrabold px-3 py-2 rounded-xl flex items-center gap-2 hover:bg-red-50 transition-all uppercase tracking-wider">
                            <i data-lucide="users" class="w-3.5 h-3.5"></i> Ortu
                        </button>
                    </div>

                    <!-- Follow Up -->
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl text-[10px] font-extrabold text-slate-500 uppercase tracking-widest border border-transparent group-hover:border-blue-100 group-hover:bg-blue-50/50 transition-all">
                        <span class="opacity-50">FU 1 :</span>
                        <span class="text-[#173A67]" x-text="student.fuDate"></span>
                        <i data-lucide="check-circle" class="w-3.5 h-3.5 text-green-500"></i>
                    </div>

                    <!-- Statuses -->
                    <button @click="openFUModal(student)" :class="student.responseColor + ' text-[10px] font-extrabold px-6 py-2 rounded-xl w-32 hover:translate-y-[-2px] hover:shadow-md transition-all uppercase tracking-widest leading-none border border-transparent'" x-text="student.response"></button>
                    <button @click="openStatusModal(student)" :class="student.classColor + ' text-[10px] font-extrabold px-6 py-2 rounded-xl w-32 hover:translate-y-[-2px] hover:shadow-md transition-all uppercase tracking-widest leading-none border border-transparent'" x-text="student.class"></button>
                    
                    <!-- View Action -->
                    <button class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 transition-all shadow-lg shadow-blue-900/10 active:scale-90">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </button>
                </div>
            </template>

        </div>

    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between mt-8">
        <div class="flex items-center gap-3">
            <button class="bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-6 py-2 text-xs font-extrabold rounded-xl transition-all shadow-sm active:scale-95 flex items-center gap-2">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Sebelumnya
            </button>
            <div class="flex gap-1.5">
                <span class="bg-[#173A67] text-white w-10 h-10 flex items-center justify-center rounded-xl text-xs font-extrabold shadow-lg shadow-blue-900/10">1</span>
                <span class="bg-white border border-gray-100 text-gray-500 w-10 h-10 flex items-center justify-center rounded-xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all">2</span>
                <span class="bg-white border border-gray-100 text-gray-500 w-10 h-10 flex items-center justify-center rounded-xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all">3</span>
                <span class="w-10 h-10 flex items-center justify-center text-gray-400 font-bold">...</span>
                <span class="bg-white border border-gray-100 text-gray-500 w-10 h-10 flex items-center justify-center rounded-xl text-xs font-bold hover:bg-gray-50 cursor-pointer transition-all">68</span>
            </div>
            <button class="bg-white border border-gray-100 hover:bg-gray-50 text-[#173A67] px-6 py-2 text-xs font-extrabold rounded-xl transition-all shadow-sm active:scale-95 flex items-center gap-2">
                Selanjutnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="bg-blue-50 text-[#173A67] px-5 py-2 rounded-xl text-xs font-extrabold uppercase tracking-widest border border-blue-100">
            50 Siswa / Halaman
        </div>
    </div>

    <!-- WHATSAPP CONTACT MODAL -->
    <div x-show="showContactModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        <div class="bg-white rounded-[2.5rem] p-10 w-[480px] shadow-2xl transform transition-all border border-gray-100"
             @click.away="showContactModal = false">
            <div class="text-center relative">
                <button @click="showContactModal = false" class="absolute -top-4 -right-4 text-gray-400 hover:text-[#173A67] transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                <div class="w-16 h-16 bg-blue-50 text-[#173A67] rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="phone" class="w-8 h-8"></i>
                </div>
                <h3 class="text-2xl font-extrabold text-[#173A67] mb-8 uppercase tracking-tight" x-text="contactTitle"></h3>
                <div class="space-y-4">
                    <template x-for="number in contactNumbers" :key="number">
                        <a :href="'https://wa.me/' + number.replace(/-/g, '')" target="_blank" class="bg-white border-2 border-green-500 text-green-600 px-8 py-5 rounded-[1.5rem] font-extrabold flex items-center justify-between group hover:bg-green-500 hover:text-white transition-all shadow-lg shadow-green-900/10 w-full uppercase tracking-widest text-[13px]">
                            <div class="flex items-center gap-4">
                                <div class="bg-green-500 text-white rounded-xl p-2 group-hover:bg-white group-hover:text-green-500 transition-colors shadow-sm">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                </div>
                                <span x-text="number"></span>
                            </div>
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- CLASS SELECTION MODAL -->
    <div x-show="showClassModal" 
         class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        <div class="bg-white rounded-[2.5rem] p-10 w-[420px] shadow-2xl transform transition-all border border-gray-100"
             @click.away="showClassModal = false">
            <div class="flex flex-col items-center gap-8 relative text-center">
                <button @click="showClassModal = false" class="absolute -top-4 -right-4 text-gray-400 hover:text-[#173A67] transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                <div class="space-y-2">
                    <h3 class="text-2xl font-extrabold text-[#173A67] uppercase tracking-tight">Pilih Kelas</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Filter data siswa per kelas</p>
                </div>

                <div class="w-full relative group">
                    <select x-model="selectedClass" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-8 py-5 text-[#173A67] font-extrabold appearance-none focus:outline-none focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all cursor-pointer text-center uppercase tracking-widest text-[13px] shadow-sm">
                        <option value="Semua Kelas">Semua Kelas</option>
                        <option value="A1">Kelas A1</option>
                        <option value="A2">Kelas A2</option>
                        <option value="A3">Kelas A3</option>
                        <option value="B1">Kelas B1</option>
                        <option value="B2">Kelas B2</option>
                        <option value="B3">Kelas B3</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-[#D85B63]">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </div>
                </div>

                <button @click="showClassModal = false" class="w-full bg-[#173A67] text-white px-10 py-5 rounded-[1.5rem] font-extrabold text-[13px] hover:translate-y-[-2px] hover:shadow-xl hover:shadow-blue-900/20 active:scale-95 transition-all shadow-lg shadow-blue-900/10 uppercase tracking-[0.2em]">
                    Terapkan Filter
                </button>
            </div>
        </div>
    </div>

    <!-- BATCH SELECTION MODAL -->
    <div x-show="showBatchModal" 
         class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        <div class="bg-white rounded-[2.5rem] p-10 w-[420px] shadow-2xl transform transition-all border border-gray-100"
             @click.away="showBatchModal = false">
            <div class="flex flex-col items-center gap-8 relative text-center">
                <button @click="showBatchModal = false" class="absolute -top-4 -right-4 text-gray-400 hover:text-[#173A67] transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                <div class="space-y-2">
                    <h3 class="text-2xl font-extrabold text-[#173A67] uppercase tracking-tight">Pilih Angkatan</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Update data angkatan siswa</p>
                </div>

                <div class="w-full relative group">
                    <select x-model="tempBatch" class="w-full bg-gray-50 border border-gray-100 rounded-2xl px-8 py-5 text-[#173A67] font-extrabold appearance-none focus:outline-none focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all cursor-pointer text-center uppercase tracking-widest text-[13px] shadow-sm">
                        <option value="Angkatan I">Angkatan I</option>
                        <option value="Angkatan II">Angkatan II</option>
                        <option value="Angkatan III">Angkatan III</option>
                        <option value="Angkatan IV">Angkatan IV</option>
                        <option value="Angkatan V">Angkatan V</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-[#D85B63]">
                        <i data-lucide="chevron-down" class="w-5 h-5"></i>
                    </div>
                </div>

                <button @click="applyBatch()" class="w-full bg-[#173A67] text-white px-10 py-5 rounded-[1.5rem] font-extrabold text-[13px] hover:translate-y-[-2px] hover:shadow-xl hover:shadow-blue-900/20 active:scale-95 transition-all shadow-lg shadow-blue-900/10 uppercase tracking-[0.2em]">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    <!-- STUDENT STATUS MODAL -->
    <div x-show="showStatusModal" 
         class="fixed inset-0 z-[120] flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        <div class="bg-white rounded-[2.5rem] p-10 w-[450px] shadow-2xl transform transition-all border border-gray-100"
             @click.away="showStatusModal = false">
            <div class="flex flex-col items-center gap-8 relative">
                <button @click="showStatusModal = false" class="absolute -top-4 -right-4 text-gray-400 hover:text-[#173A67] transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-extrabold text-[#173A67] uppercase tracking-tight">Update Status</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Pilih hasil status untuk siswa</p>
                </div>
                
                <div class="w-full grid grid-cols-2 gap-3">
                    <template x-for="option in statusOptions" :key="option.label">
                        <button @click="applyStatus(option)" 
                                :class="option.color + ' w-full py-4 rounded-2xl font-extrabold text-[13px] shadow-sm hover:scale-[1.02] active:scale-95 transition-all text-center uppercase tracking-widest border border-transparent'"
                                x-text="option.label">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- FOLLOW UP STATUS MODAL -->
    <div x-show="showFUModal" 
         class="fixed inset-0 z-[120] flex items-center justify-center bg-black/50 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        <div class="bg-white rounded-[2.5rem] p-10 w-[450px] shadow-2xl transform transition-all border border-gray-100"
             @click.away="showFUModal = false">
            <div class="flex flex-col items-center gap-8 relative">
                <button @click="showFUModal = false" class="absolute -top-4 -right-4 text-gray-400 hover:text-[#173A67] transition-colors"><i data-lucide="x" class="w-6 h-6"></i></button>
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-extrabold text-[#173A67] uppercase tracking-tight">Update Follow Up</h3>
                    <p class="text-xs text-slate-400 font-bold uppercase tracking-widest">Pilih hasil follow up untuk siswa</p>
                </div>
                
                <div class="w-full grid grid-cols-1 gap-3">
                    <template x-for="option in fuOptions" :key="option.label">
                        <button @click="applyFUStatus(option)" 
                                :class="option.color + ' w-full py-4 rounded-2xl font-extrabold text-[13px] shadow-sm hover:scale-[1.02] active:scale-95 transition-all text-center uppercase tracking-widest border border-transparent'"
                                x-text="option.label">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>
@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dashboard', () => ({
            showContactModal: false, 
            contactTitle: '', 
            contactNumbers: [],
            showClassModal: false,
            selectedClass: '',
            selectedStatus: '',
            perPage: 20,
            showBatchModal: false,
            showStatusModal: false,
            showFUModal: false,
            editingStudentIndex: null,
            editingStatusIndex: null,
            tempBatch: '',
            statusOptions: [
                { label: 'Jepang', color: 'bg-emerald-50 text-emerald-600 border-emerald-100' },
                { label: 'seleksi', color: 'bg-blue-50 text-[#173A67] border-blue-100' },
                { label: 'mau seleksi', color: 'bg-indigo-50 text-indigo-600 border-indigo-100' },
                { label: 'ulang kelas', color: 'bg-amber-50 text-amber-600 border-amber-100' },
                { label: 'BLK', color: 'bg-orange-50 text-orange-600 border-orange-100' },
                { label: 'proses belajar', color: 'bg-cyan-50 text-cyan-600 border-cyan-100' },
                { label: 'TG', color: 'bg-violet-50 text-violet-600 border-violet-100' },
                { label: 'kerja', color: 'bg-sky-50 text-sky-600 border-sky-100' },
                { label: 'keluar', color: 'bg-rose-50 text-rose-600 border-rose-100' },
                { label: 'cuti', color: 'bg-slate-50 text-slate-600 border-slate-100' },
                { label: 'Respon', color: 'bg-emerald-50 text-emerald-600 border-emerald-100' },
                { label: 'No Respon', color: 'bg-rose-50 text-rose-600 border-rose-100' },
                { label: 'Invalid', color: 'bg-gray-50 text-gray-400 border-gray-100' }
            ],
            fuOptions: [
                { label: 'Respon', color: 'bg-emerald-50 text-emerald-600 border-emerald-100' },
                { label: 'No Respon', color: 'bg-rose-50 text-rose-600 border-rose-100' },
                { label: 'Invalid', color: 'bg-gray-50 text-gray-400 border-gray-100' }
            ],
            students: @js($students),
            searchSiswa: '',
            filteredStudents() {
                let filtered = this.students.filter(s => {
                    const matchesSearch = !this.searchSiswa || 
                        s.name.toLowerCase().includes(this.searchSiswa.toLowerCase()) ||
                        (s.email && s.email.toLowerCase().includes(this.searchSiswa.toLowerCase())) ||
                        s.angkatan.toLowerCase().includes(this.searchSiswa.toLowerCase());
                    
                    const matchesClass = !this.selectedClass || 
                        s.angkatan === this.selectedClass;
                    
                    const matchesStatus = !this.selectedStatus || 
                        s.class === this.selectedStatus;
                    
                    return matchesSearch && matchesClass && matchesStatus;
                });
                
                // Limit by perPage
                return filtered.slice(0, parseInt(this.perPage));
            },
            currentStudent: null,
            openBatchModal(student) {
                this.currentStudent = student;
                this.tempBatch = student.angkatan;
                this.showBatchModal = true;
            },
            async applyBatch() {
                if (!this.currentStudent) return;
                
                // Optimistic Update
                const oldBatch = this.currentStudent.angkatan;
                this.currentStudent.angkatan = this.tempBatch;
                this.showBatchModal = false;

                try {
                    const response = await fetch(`/crm/students/${this.currentStudent.id}/update-batch`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ angkatan: this.tempBatch })
                    });

                    if (!response.ok) throw new Error('Failed to update');
                } catch (error) {
                    console.error(error);
                    this.currentStudent.angkatan = oldBatch; // Revert
                    alert('Gagal mengupdate angkatan');
                }
            },
            openStatusModal(student) {
                this.currentStudent = student;
                this.showStatusModal = true;
            },
            async applyStatus(option) {
                if (!this.currentStudent) return;

                const oldStatus = this.currentStudent.class;
                const oldColor = this.currentStudent.classColor;

                // Optimistic Update
                this.currentStudent.class = option.label;
                this.currentStudent.classColor = option.color;
                this.showStatusModal = false;

                try {
                    const response = await fetch(`/crm/students/${this.currentStudent.id}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ status: option.label })
                    });

                    if (!response.ok) throw new Error('Failed to update');
                } catch (error) {
                    console.error(error);
                    this.currentStudent.class = oldStatus; // Revert
                    this.currentStudent.classColor = oldColor;
                    alert('Gagal mengupdate status');
                }
            },
            openFUModal(student) {
                this.currentStudent = student;
                this.showFUModal = true;
            },
            async applyFUStatus(option) {
                if (!this.currentStudent) return;

                const oldResponse = this.currentStudent.response;
                const oldColor = this.currentStudent.responseColor;

                // Optimistic Update
                this.currentStudent.response = option.label;
                this.currentStudent.responseColor = option.color;
                this.showFUModal = false;

                try {
                    const response = await fetch(`/crm/students/${this.currentStudent.id}/update-followup`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ follow_up: option.label })
                    });

                    if (!response.ok) throw new Error('Failed to update');
                } catch (error) {
                    console.error(error);
                    this.currentStudent.response = oldResponse; // Revert
                    this.currentStudent.responseColor = oldColor;
                    alert('Gagal mengupdate follow up');
                }
            }
        }));
    });
</script>
@endpush
@endsection
