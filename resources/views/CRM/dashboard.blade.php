@extends('layouts.header_dashboard_crm')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6" x-data="{ 
    showContactModal: false, 
    contactTitle: '', 
    contactNumbers: [],
    showClassModal: false,
    selectedClass: 'A2',
    showBatchModal: false,
    showStatusModal: false,
    editingStudentIndex: null,
    editingStatusIndex: null, // null for class/status, maybe 0 for response if needed
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
            response: 'Respon', 
            responseColor: 'bg-[#00902f] text-white',
            class: 'Jepang',
            classColor: 'bg-[#00902f] text-white',
            contacts: { siswa: ['0812-3456-7890', '0857-1234-5678'], ortu: ['0812-9988-7766', '0821-1122-3344'] }
        },
        { 
            name: 'Novi A...', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            response: 'No Respon', 
            responseColor: 'bg-[#ef4444] text-white',
            class: 'ulang kelas',
            classColor: 'bg-[#efefef] text-[#102a4e]',
            contacts: { siswa: ['0813-8877-6655', '0858-5544-3322'], ortu: ['0811-2233-4455', '0812-3344-5566'] }
        },
        { 
            name: 'Andi B..', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            response: 'Invalid', 
            responseColor: 'bg-white text-[#102a4e]',
            class: 'BLK',
            classColor: 'bg-[#fbbf24] text-[#102a4e]',
            contacts: { siswa: ['0899-1122-3344', '0877-5566-7788'], ortu: ['0821-4455-6677', '0819-3322-1100'] }
        },
        { 
            name: 'Yanto', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            response: 'Invalid', 
            responseColor: 'bg-white text-[#102a4e]',
            class: 'keluar',
            classColor: 'bg-[#ff0000] text-white',
            contacts: { siswa: ['0852-1111-2222', '0853-3333-4444'], ortu: ['0812-0000-9999', '0813-8888-7777'] }
        },
        { 
            name: 'Budi', 
            angkatan: 'Angkatan IV', 
            fuDate: '12/08/2025', 
            response: 'Invalid', 
            responseColor: 'bg-white text-[#102a4e]',
            class: 'keluar',
            classColor: 'bg-[#ff0000] text-white',
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
            this.students[this.editingStudentIndex].class = option.label;
            this.students[this.editingStudentIndex].classColor = option.color;
            this.showStatusModal = false;
        }
    }
}">

    <!-- TOP SECTION -->
    <div class="grid grid-cols-12 gap-6">
        
        <!-- CARD 1: PROFILE info -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-3xl shadow-sm p-8 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <!-- Avatar -->
                <div class="relative shrink-0">
                    <div class="w-32 h-32 rounded-full overflow-hidden">
                        <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Info -->
                <div class="space-y-1">
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">Nama :</span> Maharani</p>
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">NIS :</span> 23.2865</p>
                    <p class="text-[#102a4e] font-medium"><span class="font-bold">Tgl Lahir :</span> 10 Agustus 2004</p>
                    
                    <button class="bg-[#fbbf24] hover:bg-yellow-500 text-[#102a4e] font-bold px-6 py-1.5 rounded-full shadow-md text-sm mt-2 transition">
                        Presensi
                    </button>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="self-start">
                 <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2 rounded-xl flex items-center gap-2 shadow-md transition text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    <span>Edit</span>
                </button>
            </div>
        </div>

        <!-- CARD 2: KEHADIRAN -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-3xl shadow-sm p-8 flex flex-col items-center justify-center text-center">
             <div class="flex items-center gap-2 mb-4">
                 <span class="font-bold text-[#102a4e]">Kehadiran</span>
                 <span class="bg-[#00902f] text-white text-xs font-bold px-3 py-1 rounded-full">Baik</span>
             </div>
             <h2 class="text-[#102a4e] font-bold text-5xl">75%</h2>
        </div>
    </div>

    <!-- STUDENT LIST SECTION -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-white font-bold text-lg">Daftar Siswa</span>
                <button @click="showClassModal = true" class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full hover:bg-red-700 transition" x-text="selectedClass"></button>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search -->
                <div class="relative">
                    <input type="text" placeholder="Cari siswa" class="pl-4 pr-10 py-1.5 rounded-full text-sm focus:outline-none w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 absolute right-3 top-1/2 -translate-y-1/2 text-gray-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <!-- Filter Icon -->
                <button class="text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
                </button>
            </div>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-6 space-y-3">
            
            <template x-for="(student, index) in students" :key="index">
                <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
                    <div class="w-32 font-bold text-[#102a4e] text-sm truncate" x-text="student.name"></div>
                    
                    <button @click="openBatchModal(index)" class="bg-white px-3 py-1 rounded-full font-bold text-xs text-[#102a4e] hover:bg-gray-100 transition whitespace-nowrap">
                        <span x-text="student.angkatan"></span>
                    </button>
                    
                    <div class="flex gap-2">
                        <button @click="showContactModal = true; contactTitle = 'Kontak Siswa'; contactNumbers = student.contacts.siswa" class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 hover:bg-red-700 transition">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Siswa
                        </button>
                        <button @click="showContactModal = true; contactTitle = 'Kontak Orang Tua'; contactNumbers = student.contacts.ortu" class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1 hover:bg-red-700 transition">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3 h-3 bg-white rounded-full"> Orang Tua
                        </button>
                    </div>

                    <div class="flex items-center gap-2 bg-white px-3 py-1 rounded-full text-xs font-bold text-[#102a4e]">
                        <span>Follow Up 1 :</span>
                        <span x-text="student.fuDate"></span>
                        <button class="text-[#d95d5d]"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></button>
                    </div>

                    <button :class="student.responseColor + ' text-white text-xs font-bold px-6 py-1.5 rounded-full w-24'" x-text="student.response"></button>
                    <button @click="openStatusModal(index)" :class="student.classColor + ' text-xs font-bold px-6 py-1.5 rounded-full w-28 hover:opacity-80 transition capitalize'" x-text="student.class"></button>
                    
                    <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </template>

        </div>

    </div>

    <!-- PAGINATION (Visual) -->
    <div class="flex items-center justify-between mt-4 text-[#102a4e]">
        <div class="flex items-center gap-2">
            <span class="text-sm cursor-pointer hover:font-bold">← Previous</span>
            <div class="flex gap-1">
                <span class="bg-[#102a4e] text-white w-8 h-8 flex items-center justify-center rounded-lg text-sm font-bold">1</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">2</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">3</span>
                 <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm">...</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">67</span>
                <span class="w-8 h-8 flex items-center justify-center rounded-lg text-sm hover:bg-gray-200 cursor-pointer">68</span>
            </div>
            <span class="text-sm cursor-pointer hover:font-bold">Next →</span>
        </div>
        <div class="font-bold">50 / Halaman</div>
    </div>

    <!-- WHATSAPP CONTACT MODAL -->
    <div x-show="showContactModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center bg-black/50"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="bg-white rounded-[2rem] p-10 w-[500px] shadow-2xl transform transition-all"
             @click.away="showContactModal = false">
            <div class="text-center">
                <h3 class="text-xl font-extrabold text-[#102a4e] mb-8" x-text="contactTitle"></h3>
                <div class="space-y-4">
                    <template x-for="number in contactNumbers" :key="number">
                        <a :href="'https://wa.me/' + number.replace(/-/g, '')" target="_blank" class="bg-[#d85b63] text-white px-8 py-4 rounded-full font-bold flex items-center justify-center gap-4 hover:bg-red-700 transition shadow-md w-full">
                            <div class="bg-white rounded-full p-1 flex items-center justify-center">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6">
                            </div>
                            <span class="text-lg tracking-wide" x-text="number"></span>
                        </a>
                    </template>
                </div>
            </div>
        </div>
    </div>

    <!-- CLASS SELECTION MODAL -->
    <div x-show="showClassModal" 
         class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
        <div class="bg-white rounded-[2rem] p-8 w-[400px] shadow-2xl transform transition-all"
             @click.away="showClassModal = false">
            <div class="flex flex-col items-center gap-6">
                <!-- Dropdown simulated UI -->
                <div class="w-full relative">
                    <select x-model="selectedClass" class="w-full bg-[#EFEFEF] rounded-full px-6 py-4 text-[#102a4e] font-extrabold appearance-none focus:outline-none cursor-pointer text-center">
                        <option value="A1">A1</option>
                        <option value="A2">A2</option>
                        <option value="A3">A3</option>
                        <option value="A4">A4</option>
                        <option value="A5">A5</option>
                    </select>
                    <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none">
                        <svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 12L0.0717964 0.750001L13.9282 0.75L7 12Z" fill="#D85B63"/>
                        </svg>
                    </div>
                </div>

                <!-- Terapkan Button -->
                <button @click="showClassModal = false" class="bg-[#D85B63] text-white px-10 py-3 rounded-full font-bold text-lg hover:bg-red-700 transition shadow-md">
                    Terapkan
                </button>
            </div>
        </div>
    </div>

    <!-- BATCH SELECTION MODAL -->
    <div x-show="showBatchModal" 
         class="fixed inset-0 z-[110] flex items-center justify-center bg-black/50"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
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
         class="fixed inset-0 z-[120] flex items-center justify-center bg-black/50"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100">
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
