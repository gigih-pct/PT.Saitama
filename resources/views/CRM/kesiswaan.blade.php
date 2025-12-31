@extends('layouts.header_dashboard_crm')

@section('title', 'Kesiswaan')

@section('content')
<div class="bg-white rounded-[2rem] shadow-sm p-4 min-h-[80vh] flex flex-col" x-cloak x-data="{
    showContactModal: false,
    contactTitle: '',
    contactNumbers: [],
    showClassModal: false,
    selectedClass: 'A2',
    showBatchModal: false,
    showStatusModal: false,
    editingStudentIndex: null,
    tempBatch: '',
    statusOptions: [
        { label: 'Jepang', color: 'bg-[#00902f] text-white' },
        { label: 'seleksi', color: 'bg-[#102a4e] text-white' },
        { label: 'mau seleksi', color: 'bg-[#efefef] text-[#102a4e]' },
        { label: 'ulang kelas', color: 'bg-[#efefef] text-[#102a4e]' },
        { label: 'BLK', color: 'bg-[#fbbf24] text-[#102a4e]' },
        { label: 'proses belajar', color: 'bg-[#efefef] text-[#102a4e]' },
        { label: 'TG', color: 'bg-[#0097d6] text-white' },
        { label: 'kerja', color: 'bg-[#efefef] text-[#102a4e]' },
        { label: 'keluar', color: 'bg-[#ff0000] text-white' },
        { label: 'cuti', color: 'bg-[#d1545d] text-white' }
    ],
    students: [
        { 
            name: 'Budi A ..', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            status1: 'Respon', 
            status1Color: 'bg-[#00902f] text-white',
            status2: 'Jepang',
            status2Color: 'bg-[#00902f] text-white',
            contacts: { siswa: ['0812-3456-7890', '0857-1234-5678'], ortu: ['0812-9988-7766', '0821-1122-3344'] }
        },
        { 
            name: 'Novi A...', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            status1: 'No Respon', 
            status1Color: 'bg-[#ef4444] text-white',
            status2: 'ulang kelas',
            status2Color: 'bg-[#efefef] text-[#102a4e]',
            contacts: { siswa: ['0813-8877-6655', '0858-5544-3322'], ortu: ['0811-2233-4455', '0812-3344-5566'] }
        },
        { 
            name: 'Andi B..', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            status1: 'Invalid', 
            status1Color: 'bg-white text-[#102a4e]',
            status2: 'BLK',
            status2Color: 'bg-[#fbbf24] text-[#102a4e]',
            contacts: { siswa: ['0899-1122-3344', '0877-5566-7788'], ortu: ['0821-4455-6677', '0819-3322-1100'] }
        },
        { 
            name: 'Yanto', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            status1: 'Invalid', 
            status1Color: 'bg-white text-[#102a4e]',
            status2: 'keluar',
            status2Color: 'bg-[#ff0000] text-white',
            contacts: { siswa: ['0852-1111-2222', '0853-3333-4444'], ortu: ['0812-0000-9999', '0813-8888-7777'] }
        },
        { 
            name: 'Budi', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            status1: 'Invalid', 
            status1Color: 'bg-white text-[#102a4e]',
            status2: 'keluar',
            status2Color: 'bg-[#ff0000] text-white',
            contacts: { siswa: ['0812-5555-6666', '0812-7777-8888'], ortu: ['0812-1234-1234', '0812-4321-4321'] }
        }
    ],
    openBatchModal(index) {
        this.editingStudentIndex = index;
        this.tempBatch = this.students[index].angkatan;
        this.showBatchModal = true;
    },
    applyBatch() {
        if (this.editingStudentIndex !== null) {
            this.students[this.editingStudentIndex].angkatan = this.tempBatch;
            this.showBatchModal = false;
        }
    },
    openStatusModal(index) {
        this.editingStudentIndex = index;
        this.showStatusModal = true;
    },
    applyStatus(option) {
        if (this.editingStudentIndex !== null) {
            this.students[this.editingStudentIndex].status2 = option.label;
            this.students[this.editingStudentIndex].status2Color = option.color;
            this.showStatusModal = false;
        }
    }
}">

    <!-- Header Section -->
    <div class="bg-[#102a4e] rounded-xl p-4 flex items-center justify-between mb-6 shadow-md">
        <div class="flex items-center gap-4">
            <h1 class="text-white font-bold text-lg">Daftar Siswa</h1>
            <span class="bg-[#db5d5d] text-white text-xs font-bold px-2 py-1 rounded-md">A2</span>
        </div>

        <div class="flex items-center gap-4 flex-1 justify-end">
            <!-- Search Bar -->
            <div class="relative w-full max-w-md">
                <input type="text" placeholder="Cari siswa" class="w-full bg-white rounded-full py-1.5 pl-4 pr-10 text-sm focus:outline-none text-[#102a4e]">
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#102a4e]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </button>
            </div>
            
            <!-- Filter Icon -->
            <button class="text-white hover:bg-white/10 p-2 rounded-full transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"/><line x1="4" y1="10" x2="4" y2="3"/><line x1="12" y1="21" x2="12" y2="12"/><line x1="12" y1="8" x2="12" y2="3"/><line x1="20" y1="21" x2="20" y2="16"/><line x1="20" y1="12" x2="20" y2="3"/><line x1="1" y1="14" x2="7" y2="14"/><line x1="9" y1="8" x2="15" y2="8"/><line x1="17" y1="16" x2="23" y2="16"/></svg>
            </button>
        </div>
    </div>

    <!-- Student List Table -->
    <div class="flex-1 overflow-x-auto">
        <table class="w-full border-separate border-spacing-y-4">
            <thead>
                <tr class="text-left hidden">
                    <th>Nama</th>
                    <th>Angkatan</th>
                    <th>Kontak</th>
                    <th>Tanggal</th>
                    <th>Status 1</th>
                    <th>Status 2</th>
                    <th>Keterangan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(student, index) in students" :key="index">
                    <tr class="group text-sm">
                        <td class="bg-[#f3f4f6] py-3 pl-6 rounded-l-full font-bold text-[#102a4e] whitespace-nowrap" x-text="student.name"></td>
                        <td class="bg-[#f3f4f6] py-3 font-bold text-[#102a4e] whitespace-nowrap">
                            <button @click="openBatchModal(index)" class="hover:text-[#db5d5d] transition" x-text="'Angkatan: ' + student.angkatan.replace('Angkatan ', '')"></button>
                        </td>
                        <td class="bg-[#f3f4f6] py-3">
                            <div class="flex gap-2">
                                <button @click="showContactModal = true; contactTitle = 'Kontak Siswa'; contactNumbers = student.contacts.siswa" class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Siswa
                                </button>
                                <button @click="showContactModal = true; contactTitle = 'Kontak Orang Tua'; contactNumbers = student.contacts.ortu" class="bg-[#db5d5d] hover:bg-red-600 text-white px-3 py-1.5 rounded-full flex items-center gap-1.5 text-xs font-medium transition shadow-sm whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg> Orang Tua
                                </button>
                            </div>
                        </td>
                        <td class="bg-[#f3f4f6] py-3">
                            <div class="bg-white px-3 py-1.5 rounded-full flex items-center gap-2 text-xs font-bold text-[#102a4e] shadow-sm w-fit whitespace-nowrap">
                                <span x-text="student.fuDate"></span>
                                <button class="text-[#db5d5d] hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                                </button>
                            </div>
                        </td>
                        <td class="bg-[#f3f4f6] py-3">
                             <button :class="student.status1Color + ' w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap hover:opacity-80 transition'">
                                <span x-text="student.status1"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                        </td>
                        <td class="bg-[#f3f4f6] py-3">
                            <button @click="openStatusModal(index)" :class="student.status2Color + ' w-28 py-1.5 rounded-full text-xs font-bold flex items-center justify-between px-3 shadow-md whitespace-nowrap hover:opacity-80 transition capitalize'">
                                <span x-text="student.status2"></span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                            </button>
                        </td>
                        <td class="bg-[#f3f4f6] py-3 text-center">
                             <div class="bg-white px-4 py-1.5 rounded-full text-xs font-bold text-[#102a4e] shadow-sm inline-block cursor-pointer hover:bg-gray-50 transition">
                                Keterangan
                            </div>
                        </td>
                        <td class="bg-[#f3f4f6] py-3 pr-6 rounded-r-full text-right">
                             <a href="{{ route('crm.detailkesiswaan') }}" class="w-8 h-8 rounded-full bg-[#db5d5d] hover:bg-red-600 inline-flex items-center justify-center text-white shadow-md transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </a>
                        </td>
                    </tr>
                </template>
            </tbody>

        </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-center gap-4 py-4 text-[#102a4e] font-medium text-sm relative mt-2">
        <button class="flex items-center gap-1 hover:text-[#db5d5d] transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="M12 19l-7-7 7-7"/></svg>
            Previous
        </button>
        
        <div class="flex items-center gap-2">
            <button class="w-8 h-8 bg-[#102a4e] text-white rounded-lg flex items-center justify-center shadow-md">1</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">2</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">3</button>
            <span class="px-2">...</span>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">67</button>
            <button class="w-8 h-8 hover:bg-gray-100 rounded-lg flex items-center justify-center transition">68</button>
        </div>

        <button class="flex items-center gap-1 hover:text-[#db5d5d] transition">
            Next
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5l7 7-7 7"/></svg>
        </button>
        
        <div class="absolute right-0 text-gray-500 font-normal">
            50 /Halaman
        </div>
    </div>
    <!-- CONTACT MODAL -->
    <div x-show="showContactModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="bg-white rounded-[2rem] p-10 w-[450px] shadow-2xl transform transition-all"
             @click.away="showContactModal = false">
            <div class="flex flex-col items-center gap-6 text-center">
                <h3 class="text-xl font-extrabold text-[#102a4e]" x-text="contactTitle"></h3>
                <div class="w-full space-y-4">
                    <template x-for="(number, idx) in contactNumbers" :key="idx">
                        <div class="flex flex-col gap-2">
                             <a :href="'https://wa.me/' + number.replace(/\D/g,'')" target="_blank" class="bg-[#25D366] text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-green-600 transition shadow-md flex items-center justify-center gap-2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                </svg>
                                <span x-text="number"></span>
                             </a>
                        </div>
                    </template>
                </div>
                <button @click="showContactModal = false" class="text-gray-400 font-bold hover:text-[#102a4e] transition mt-2">Close</button>
            </div>
        </div>
    </div>

    <!-- BATCH SELECTION MODAL -->
    <div x-show="showBatchModal" 
         x-cloak
         class="fixed inset-0 z-[110] flex items-center justify-center bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="bg-white rounded-[2rem] p-8 w-[400px] shadow-2xl transform transition-all"
             @click.away="showBatchModal = false">
            <div class="flex flex-col items-center gap-6">
                <!-- Dropdown simulated UI -->
                <div class="w-full relative">
                    <select x-model="tempBatch" class="w-full bg-[#EFEFEF] rounded-full px-6 py-4 text-[#102a4e] font-extrabold appearance-none focus:outline-none cursor-pointer text-center">
                        <option value="Angkatan I">Angkatan I</option>
                        <option value="Angkatan II">Angkatan II</option>
                        <option value="Angkatan III">Angkatan III</option>
                        <option value="Angkatan IV">Angkatan IV</option>
                        <option value="Angkatan V">Angkatan V</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 12L0.0717964 0.750001L13.9282 0.75L7 12Z" fill="#D85B63"/>
                        </svg>
                    </div>
                </div>

                <!-- Terapkan Button -->
                <button @click="applyBatch()" class="bg-[#D85B63] text-white px-10 py-3 rounded-full font-bold text-lg hover:bg-red-700 transition shadow-md">
                    Terapkan
                </button>
            </div>
        </div>
    </div>

    <!-- STUDENT STATUS MODAL -->
    <div x-show="showStatusModal" 
         x-cloak
         class="fixed inset-0 z-[120] flex items-center justify-center bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
        <div class="bg-white rounded-[2rem] p-10 w-[450px] shadow-2xl transform transition-all"
             @click.away="showStatusModal = false">
            <div class="flex flex-col items-center gap-6">
                <h3 class="text-xl font-extrabold text-[#102a4e]">Hasil</h3>
                <div class="w-full space-y-3">
                    <template x-for="option in statusOptions" :key="option.label">
                        <button @click="applyStatus(option)" 
                                :class="option.color + ' w-full py-3 rounded-full font-extrabold text-sm shadow-md hover:opacity-90 transition capitalize'"
                                x-text="option.label">
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
