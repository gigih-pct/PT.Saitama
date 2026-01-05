@extends('layouts.header_dashboard_sensei')

@section('content')
@php
    $studentsList = $students ?? [];
    $totalSiswa = count($studentsList);
    // Mocking some stats for the branding look
    $siapSeleksi = 0; // In a real scenario, this would come from a model field or logic
    foreach($studentsList as $s) {
        if(($s->evalStatus ?? 'Siap Seleksi') === 'Siap Seleksi') $siapSeleksi++;
    }
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans" x-data="evaluasi">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Evaluasi Siswa
                <!-- Class Selector -->
                <div class="relative group inline-block">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="users" class="w-3 h-3 text-white"></i>
                    </div>
                    <select x-model="selectedClass" class="pl-8 pr-8 py-1.5 rounded-xl bg-blue-600 text-white text-[10px] font-extrabold border-none ring-0 focus:ring-4 focus:ring-blue-100 cursor-pointer shadow-lg hover:bg-blue-700 transition-all appearance-none uppercase tracking-widest">
                        <option value="">Semua Kelas</option>
                        @foreach($kelases as $k)
                            <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none">
                         <i data-lucide="chevron-down" class="w-3 h-3 text-white"></i>
                    </div>
                </div>
            </h1>
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Monitoring Perkembangan & Penilaian Siswa</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
            <!-- Search Bar -->
            <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                </div>
                <input type="text" x-model="searchSiswa" placeholder="Cari Siswa..." class="pl-11 pr-4 py-3 rounded-2xl bg-gray-50 border-2 border-gray-100 text-sm font-bold text-[#173A67] focus:bg-white focus:border-[#173A67] focus:ring-4 focus:ring-blue-50 transition-all w-64 placeholder:text-gray-400">
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 flex-1">
        <!-- LEFT: TABLE -->
        <div class="col-span-12 lg:col-span-9 flex flex-col gap-6">
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="px-5 py-2 bg-white rounded-xl border border-gray-100 text-[10px] font-black text-[#173A67] shadow-sm uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="list" class="w-3 h-3 text-blue-500"></i>
                        Daftar Siswa
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest mr-2">Tampilkan:</span>
                    <select x-model="perPage" class="bg-white border-2 border-gray-100 rounded-xl px-3 py-1.5 text-[10px] font-black text-[#173A67] cursor-pointer focus:border-[#173A67] transition-all">
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden flex-1 shadow-sm relative">
                <div class="overflow-x-auto max-h-[600px] overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;" x-init="$watch('searchSiswa', () => $nextTick(() => lucide.createIcons())); $watch('selectedClass', () => $nextTick(() => lucide.createIcons())); $watch('perPage', () => $nextTick(() => lucide.createIcons())); lucide.createIcons();">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest w-16 text-center">No</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest">Nama Siswa</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-40">Kelas</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center">Status Evaluasi</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-24">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <template x-for="(student, index) in filteredStudents()" :key="student.id">
                                <tr class="group hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-5 text-center font-bold text-gray-400 text-xs" x-text="index + 1"></td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-2xl bg-blue-100 text-[#173A67] flex items-center justify-center font-black text-sm shadow-sm group-hover:bg-[#173A67] group-hover:text-white transition-all transform group-hover:rotate-6" x-text="student.name.charAt(0)"></div>
                                            <span class="text-sm font-black text-[#173A67]" x-text="student.name"></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <span class="px-4 py-1.5 rounded-xl bg-gray-50 text-gray-500 text-[10px] font-black uppercase tracking-widest border border-gray-100 group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all" x-text="student.angkatan"></span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex flex-col gap-2">
                                            <div class="flex items-center justify-between text-[10px] font-black uppercase tracking-widest">
                                                <span class="text-green-600" x-text="student.evalStatus"></span>
                                                <span class="text-gray-400" x-text="student.evalProgress + '%'"></span>
                                            </div>
                                            <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden border border-gray-50">
                                                <div class="h-full bg-green-500 rounded-full shadow-[0_0_10px_rgba(34,197,94,0.3)] transition-all duration-1000" :style="'width: ' + student.evalProgress + '%'"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a :href="'/sensei/evaluasi/siswa/' + student.id" class="w-12 h-12 rounded-2xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 hover:rotate-12 transition-all shadow-lg shadow-blue-900/10 active:scale-90">
                                            <i data-lucide="eye" class="w-6 h-6"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT: SUMMARY -->
        <div class="col-span-12 lg:col-span-3 space-y-6">
            <!-- Stats Card -->
            <div class="bg-[#173A67] rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="trending-up" class="w-32 h-32"></i>
                </div>
                <h3 class="font-bold text-lg mb-6 relative z-10">Ringkasan Evaluasi</h3>
                
                <div class="space-y-4 relative z-10">
                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/10">
                        <p class="text-xs font-bold text-blue-200 uppercase tracking-widest mb-1">Total Siswa</p>
                        <p class="text-3xl font-black">{{ $totalSiswa }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-500/20 rounded-2xl p-4 backdrop-blur-sm border border-green-400/20">
                            <p class="text-[10px] font-bold text-green-300 uppercase tracking-widest mb-1">Siap</p>
                            <p class="text-2xl font-black text-green-300">{{ $siapSeleksi }}</p>
                        </div>
                        <div class="bg-yellow-500/20 rounded-2xl p-4 backdrop-blur-sm border border-yellow-400/20">
                            <p class="text-[10px] font-bold text-yellow-300 uppercase tracking-widest mb-1">Review</p>
                            <p class="text-2xl font-black text-yellow-300">{{ $totalSiswa - $siapSeleksi }}</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4 flex items-center justify-between backdrop-blur-sm">
                        <span class="text-xs font-bold uppercase tracking-widest">Kelulusan</span>
                        <span class="text-xl font-black text-yellow-300">{{ $totalSiswa > 0 ? round(($siapSeleksi/$totalSiswa)*100) : 0 }}%</span>
                    </div>
                </div>
            </div>

            <!-- Guidelines -->
            <div class="bg-blue-50 rounded-[2rem] p-6 border-2 border-blue-100">
                <h4 class="font-bold text-[#173A67] mb-3 flex items-center gap-2">
                    <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                    Informasi
                </h4>
                <div class="space-y-4">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest leading-relaxed">
                        Evaluasi siswa didasarkan pada akumulasi nilai dari:
                    </p>
                    <ul class="text-[11px] font-black text-[#173A67] space-y-2 list-none uppercase tracking-wider">
                        <li class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                            Bunpou & Kanji
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                            Wawancara
                        </li>
                        <li class="flex items-center gap-2">
                            <div class="w-1.5 h-1.5 rounded-full bg-blue-500"></div>
                            FMD & Kedisiplinan
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('evaluasi', () => ({
            searchSiswa: '',
            selectedClass: '',
            perPage: 20,
            students: @js($students).map(s => ({
                id: s.id,
                name: s.name,
                angkatan: s.kelas ? s.kelas.nama_kelas : 'Umum',
                evalStatus: 'Siap Seleksi',
                evalProgress: Math.floor(Math.random() * (100 - 60 + 1)) + 60 // Mock progress for branding
            })),
            filteredStudents() {
                let filtered = this.students.filter(s => {
                    const matchesSearch = !this.searchSiswa || 
                        s.name.toLowerCase().includes(this.searchSiswa.toLowerCase()) ||
                        (s.angkatan && s.angkatan.toLowerCase().includes(this.searchSiswa.toLowerCase()));
                    
                    const matchesClass = !this.selectedClass || 
                        s.angkatan === this.selectedClass;
                    
                    return matchesSearch && matchesClass;
                });
                
                return filtered.slice(0, parseInt(this.perPage));
            }
        }));
    });
</script>
@endpush
@endsection