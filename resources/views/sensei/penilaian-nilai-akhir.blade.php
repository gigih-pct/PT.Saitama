@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian Nilai Akhir')

@section('content')
@php
    $users = $students ?? [];
    // Subject configuration for easy iteration
    $subjects = [
        ['key'=>'hiragana', 'label'=>'Hiragana', 'color'=>'blue'],
        ['key'=>'katakana', 'label'=>'Katakana', 'color'=>'blue'],
        ['key'=>'bunpou', 'label'=>'Bunpou', 'color'=>'indigo'],
        ['key'=>'kerja', 'label'=>'Kerja', 'color'=>'indigo'],
        ['key'=>'sifat', 'label'=>'Sifat', 'color'=>'indigo'],
        ['key'=>'benda', 'label'=>'Benda', 'color'=>'indigo'],
        ['key'=>'terjemah', 'label'=>'Terjemah', 'color'=>'purple'],
        ['key'=>'dengar', 'label'=>'Dengar', 'color'=>'purple'],
        ['key'=>'bicara', 'label'=>'Bicara', 'color'=>'purple'], 
    ];
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">

    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian Nilai Akhir
                <!-- Class Selector -->
                <div class="relative group inline-block">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i data-lucide="users" class="w-3 h-3 text-white"></i>
                    </div>
                    <select onchange="window.location.href='?kelas_id='+this.value" class="pl-8 pr-8 py-1.5 rounded-xl bg-blue-600 text-white text-[10px] font-extrabold border-none ring-0 focus:ring-4 focus:ring-blue-100 cursor-pointer shadow-lg hover:bg-blue-700 transition-all appearance-none uppercase tracking-widest">
                        @foreach($kelases as $k)
                            <option value="{{ $k->id }}" {{ $selectedKelasId == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-2 flex items-center pointer-events-none">
                         <i data-lucide="chevron-down" class="w-3 h-3 text-white"></i>
                    </div>
                </div>
            </h1>
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Rekapitulasi Nilai & Kelulusan</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
             <!-- Page Selector -->
             <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i data-lucide="layout-grid" class="w-4 h-4 text-white"></i>
                </div>
                <select onchange="if(this.value) window.location.href=this.value" class="pl-10 pr-10 py-3 rounded-2xl bg-[#173A67] text-white text-sm font-bold border-none ring-0 focus:ring-4 focus:ring-blue-100 cursor-pointer shadow-lg hover:bg-blue-900 transition-all appearance-none">
                    <option value="{{ route('sensei.penilaian.presensi') }}" {{ $type === 'presensi' ? 'selected' : '' }}>Presensi</option>
                    <option value="{{ route('sensei.penilaian.bunpou') }}" {{ $type === 'bunpou' ? 'selected' : '' }}>Bunpou</option>
                    <option value="{{ route('sensei.penilaian.kanji') }}" {{ $type === 'kanji' ? 'selected' : '' }}>Kanji</option>
                    <option value="{{ route('sensei.penilaian.kotoba') }}" {{ $type === 'kotoba' ? 'selected' : '' }}>Kotoba</option>
                    <option value="{{ route('sensei.penilaian.fmd') }}" {{ $type === 'fmd' ? 'selected' : '' }}>FMD</option>
                    <option value="{{ route('sensei.penilaian.wawancara') }}" {{ $type === 'wawancara' ? 'selected' : '' }}>Wawancara</option>
                    <option value="{{ route('sensei.penilaian.nilai-akhir') }}" {{ $type === 'nilai-akhir' ? 'selected' : '' }}>Nilai Akhir</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                     <i data-lucide="chevron-down" class="w-4 h-4 text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-12 gap-8 flex-1">
        
        <!-- LEFT CONTENT -->
        <div class="col-span-12 lg:col-span-9 flex flex-col gap-6">
            <!-- TOOLBAR -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100 sticky top-0 z-30">
            <div class="flex items-center gap-3">
                 <button id="save-final" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan Nilai Akhir
                </button>
                 <button id="export-excel" class="px-6 py-2.5 bg-green-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-green-900/20 hover:bg-green-700 active:scale-95 transition-all flex items-center gap-2">
                    <i data-lucide="file-spreadsheet" class="w-4 h-4"></i> Export Excel
                </button>
                <button id="reset-final" class="px-6 py-2.5 bg-white text-red-500 border-2 border-red-100 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all flex items-center gap-2">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset
                </button>
            </div>
            
             <div class="flex items-center gap-4 text-xs font-bold text-gray-500">
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Input 0-100</span>
                <span class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-orange-500"></span> Grade Auto</span>
            </div>
        </div>

        <!-- TABLE CONTAINER -->
        <div class="col-span-12 bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden shadow-sm relative z-0">
            <div class="final-scroll overflow-auto max-h-[600px]">
                <table class="w-max text-left border-collapse">
                    <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                        <tr>
                            <th rowspan="2" class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-16 sticky left-0 bg-[#173A67] z-30 border-r border-blue-800">No</th>
                            <th rowspan="2" class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest w-[250px] sticky left-16 bg-[#173A67] z-30 shadow-xl border-r border-blue-800">Nama Siswa</th>
                            
                            @foreach($subjects as $subj)
                            <th colspan="2" class="px-2 py-3 font-bold text-[10px] text-center uppercase tracking-wider border-r border-blue-800 bg-[#1e4b85]">
                                {{ $subj['label'] }}
                            </th>
                            @endforeach
                            
                            <th rowspan="2" class="px-2 py-2 font-bold text-[10px] text-center w-16 border-r border-blue-800 uppercase bg-[#173A67]">Sikap</th>
                            <th rowspan="2" class="px-2 py-2 font-bold text-[10px] text-center w-16 border-r border-blue-800 uppercase bg-[#173A67]">Hadir</th>
                            <th rowspan="2" class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest text-center sticky right-20 bg-[#173A67] z-30 border-l border-blue-800 shadow-xl">Rata-Rata</th>
                            <th rowspan="2" class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest text-center sticky right-0 bg-[#173A67] z-30 border-l border-blue-800 w-20">Grade</th>
                        </tr>
                        <tr>
                            @foreach($subjects as $subj)
                            <th class="px-1 py-1 font-bold text-[9px] text-center w-14 bg-[#173A67] border-r border-blue-800/30 text-blue-200">Nilai</th>
                            <th class="px-1 py-1 font-bold text-[9px] text-center w-10 bg-[#173A67] border-r border-blue-800 text-yellow-400">G</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse($users as $idx => $user)
                        @php $saved = $savedScores[$user->id] ?? []; @endphp
                        <tr class="group hover:bg-blue-50/30 transition-colors student-row" data-id="{{ $user->id }}" data-row="{{ $idx }}">
                            <td class="px-4 py-3 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100">
                                {{ $idx + 1 }}
                            </td>
                            <td class="px-6 py-3 sticky left-16 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)] w-[250px]">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-[10px]">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="text-xs font-bold text-[#173A67] whitespace-nowrap" title="{{ $user->name }}">
                                        {{ $user->name }}
                                    </span>
                                    <input type="hidden" class="name-input" value="{{ $user->name }}">
                                </div>
                            </td>

                            @foreach($subjects as $subj)
                            <td class="px-1 py-2 border-r border-gray-50 text-center">
                                <input type="number" min="0" max="100" class="w-12 text-center bg-gray-50 border border-gray-200 rounded text-xs font-bold focus:ring-1 focus:ring-blue-500 py-1 score-input" 
                                       data-key="{{ $subj['key'] }}" data-row="{{ $idx }}" placeholder="-" value="{{ $saved[$subj['key']] ?? '' }}">
                            </td>
                            <td class="px-1 py-2 border-r border-gray-100 text-center bg-gray-50/30">
                                <span class="text-[10px] font-black text-gray-400 grade-display" data-key="{{ $subj['key'] }}" data-row="{{ $idx }}">-</span>
                            </td>
                            @endforeach

                            <td class="px-1 py-2 border-r border-gray-100 text-center">
                                <input type="text" maxlength="2" class="w-12 text-center bg-white border border-gray-200 rounded text-xs font-bold focus:ring-1 focus:ring-blue-500 py-1 uppercase sikap-input" placeholder="-"
                                value="{{ $saved['sikap'] ?? '' }}">
                            </td>
                            
                             <td class="px-1 py-2 border-r border-gray-100 text-center">
                                <div class="relative inline-block">
                                    <input type="number" min="0" max="100" class="w-14 text-center bg-white border border-gray-200 rounded text-xs font-bold focus:ring-1 focus:ring-blue-500 py-1 hadir-input" 
                                           value="{{ round(($saved['kehadiran'] ?? 1) * 100) }}">
                                    <span class="absolute right-1 top-1.5 text-[10px] text-gray-400 font-bold pointer-events-none">%</span>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-center font-black text-[#173A67] bg-white group-hover:bg-blue-50/30 sticky right-20 z-10 border-l border-gray-100 shadow-[-4px_0_12px_-4px_rgba(0,0,0,0.05)]">
                                <span class="final-avg" data-row="{{ $idx }}">{{ $saved['rata_rata'] ?? '-' }}</span>
                            </td>
                            <td class="px-4 py-3 text-center font-black bg-white group-hover:bg-blue-50/30 sticky right-0 z-10 border-l border-gray-100 text-white w-20">
                                <span class="px-2 py-1 rounded-lg bg-gray-400 text-[10px] final-grade" data-row="{{ $idx }}">{{ $saved['grade'] ?? '-' }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="30" class="p-8 text-center text-gray-400 font-bold">Belum ada data siswa.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        <!-- RIGHT SIDEBAR: SUMMARY TABLES -->
        <div class="col-span-12 lg:col-span-3 space-y-6">
            
            <!-- Table Kesimpulan 1 (Grading Scale) -->
            <div class="bg-gray-100 rounded-[2rem] p-6 border border-gray-200 shadow-sm">
                <h4 class="font-bold text-[#173A67] mb-4 text-sm uppercase tracking-widest text-center">Standar Nilai</h4>
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
                    <table class="w-full text-[11px] border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-[#173A67] border-b border-gray-200">
                                <th class="px-2 py-3 font-bold border-r border-gray-200 text-center uppercase">Range Nilai</th>
                                <th class="px-2 py-3 font-bold text-center uppercase">Grade</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700 font-bold">
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">>= 90</td>
                                <td class="px-2 py-2.5 text-center text-green-600">A</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">>= 85</td>
                                <td class="px-2 py-2.5 text-center text-blue-600">B+</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">>= 80</td>
                                <td class="px-2 py-2.5 text-center text-blue-500">B</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">>= 75</td>
                                <td class="px-2 py-2.5 text-center text-yellow-600">C+</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">>= 10</td>
                                <td class="px-2 py-2.5 text-center text-orange-600">C</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">< 10</td>
                                <td class="px-2 py-2.5 text-center text-red-600">TU</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Table Kesimpulan 2 (Lolos/Success) -->
            <div class="bg-gray-100 rounded-[2rem] p-6 border border-gray-200 shadow-sm">
                <h4 class="font-bold text-[#173A67] mb-4 text-sm uppercase tracking-widest">Tabel Kesimpulan</h4>
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
                    <table class="w-full text-xs border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-[#173A67] border-b border-gray-200">
                                <th class="px-3 py-3 font-bold border-r border-gray-200 text-center uppercase tracking-wider">Keterangan</th>
                                <th class="px-3 py-3 font-bold text-center uppercase tracking-wider">Hasil</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600 font-bold">
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200">Lolos</td>
                                <td class="px-3 py-2.5 text-center" id="stat-lolos">20</td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200">Presentase</td>
                                <td class="px-3 py-2.5 text-center" id="stat-percent">100%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Additional Legend -->
            <div class="bg-[#173A67] rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="award" class="w-24 h-24"></i>
                </div>
                <h3 class="font-bold text-sm mb-4 relative z-10 uppercase tracking-widest">Target Kelulusan</h3>
                <div class="relative z-10 space-y-3">
                    <div class="flex justify-between items-center text-xs">
                        <span class="text-blue-200">Minimal Rata-rata</span>
                        <span class="font-black">75.00</span>
                    </div>
                    <div class="w-full bg-white/10 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-blue-400 h-full w-[75%]"></div>
                    </div>
                    <p class="text-[10px] text-blue-300 italic">* Nilai di bawah 75 dianggap Tidak Lulus (TU)</p>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Toast Notification -->
<div id="toast-container" class="fixed top-20 right-8 z-[100] flex flex-col gap-3 pointer-events-none"></div>

<!-- Confirmation Modal -->
<div id="confirm-modal" class="fixed inset-0 z-[200] hidden items-center justify-center bg-black/50 backdrop-blur-sm">
    <div class="bg-white rounded-3xl p-8 shadow-2xl max-w-md w-full mx-4 transform transition-all scale-95 opacity-0" id="confirm-modal-content">
        <div class="flex items-start gap-4 mb-6">
            <div class="w-12 h-12 rounded-2xl bg-red-100 flex items-center justify-center flex-shrink-0">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="text-xl font-black text-[#173A67] mb-2">Konfirmasi Reset</h3>
                <p class="text-sm text-gray-600 font-medium" id="confirm-message">Apakah Anda yakin ingin mereset data ini?</p>
            </div>
        </div>
        <div class="flex gap-3 justify-end">
            <button id="confirm-cancel" class="px-6 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-bold hover:bg-gray-200 active:scale-95 transition-all">
                Batal
            </button>
            <button id="confirm-ok" class="px-6 py-2.5 bg-red-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-red-600/30 hover:bg-red-700 active:scale-95 transition-all flex items-center gap-2">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                Ya, Reset
            </button>
        </div>
    </div>
</div>

<style>
    /* Toast Animation */
    @keyframes toast-in {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .toast-item {
        animation: toast-in 0.3s ease-out forwards;
    }
    
    /* Modal Animation */
    @keyframes modal-in {
        from { transform: scale(0.95); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    #confirm-modal.show #confirm-modal-content {
        animation: modal-in 0.3s ease-out forwards;
    }

<style>
/* Nilai Akhir Scrollbar Standardized - Excel Style Always Visible */
.final-scroll { 
    max-height: 600px;
    overflow-x: scroll !important; 
    overflow-y: scroll !important; 
    display: block !important;
    scrollbar-gutter: stable both-edges; 
    -webkit-overflow-scrolling: touch; 
    scrollbar-width: auto !important; 
    scrollbar-color: #64748b #f1f5f9 !important; 
}

/* Chrome, Safari, Edge */
.final-scroll::-webkit-scrollbar { 
    height: 18px !important; 
    width: 18px !important; 
    display: block !important;
    background-color: #f1f5f9 !important;
    -webkit-appearance: none !important;
}

.final-scroll::-webkit-scrollbar:window-inactive {
    display: block !important;
}

.final-scroll::-webkit-scrollbar-track { 
    background: #f1f5f9 !important; 
    border: 1px solid #e2e8f0 !important;
}

.final-scroll::-webkit-scrollbar-thumb { 
    background-color: #94a3b8 !important;
    border-radius: 0px !important;
    border: 3px solid #f1f5f9 !important;
    min-height: 40px !important;
}

.final-scroll::-webkit-scrollbar-thumb:hover { 
    background-color: #64748b !important; 
}

.final-scroll::-webkit-scrollbar-corner {
    background-color: #f1f5f9 !important;
}

.table-fixed { table-layout: fixed; }
</style>

<script>
    // Grading Logic
    function getGrade(score) {
        if(!score && score!==0) return '-';
        score = parseInt(score);
        if(score >= 90) return 'A';
        if(score >= 85) return 'B+';
        if(score >= 80) return 'B';
        if(score >= 75) return 'C+';
        if(score >= 10) return 'C';
        return 'TU';
    }

    function updateRow(rowIdx) {
        const inputs = document.querySelectorAll(`.score-input[data-row="${rowIdx}"]`);
        let sum = 0;
        let count = 0;
        
        inputs.forEach(inp => {
            const val = inp.value;
            const key = inp.dataset.key;
            const gradeEl = document.querySelector(`.grade-display[data-key="${key}"][data-row="${rowIdx}"]`);
            
            if(val) {
                const num = parseInt(val);
                sum += num;
                count++;
                
                // Update per subject grade
                const g = getGrade(num);
                gradeEl.textContent = g;

                // Colorize
                let colorClass = 'text-gray-400';
                if(g === 'A') colorClass = 'text-green-600';
                else if(g === 'B+' || g === 'B') colorClass = 'text-blue-600';
                else if(g === 'C+' || g === 'C') colorClass = 'text-yellow-600';
                else if(g === 'TU') colorClass = 'text-red-600';
                
                gradeEl.className = 'text-[10px] font-black grade-display ' + colorClass;
            } else {
                gradeEl.textContent = '-';
                gradeEl.className = 'text-[10px] font-black text-gray-400 grade-display';
            }
        });

        const avgEl = document.querySelector(`.final-avg[data-row="${rowIdx}"]`);
        const gradeEl = document.querySelector(`.final-grade[data-row="${rowIdx}"]`);

        if(count > 0) {
            const avg = Math.round(sum / count);
            avgEl.textContent = avg;
            
            const finalG = getGrade(avg);
            gradeEl.textContent = finalG;
            
            let bgClass = 'bg-gray-400';
            if(finalG === 'A') bgClass = 'bg-green-500';
            else if(finalG === 'B+' || finalG === 'B') bgClass = 'bg-blue-500';
            else if(finalG === 'C+' || finalG === 'C') bgClass = 'bg-yellow-500';
            else bgClass = 'bg-red-500';
            
            gradeEl.className = `px-2 py-1 rounded-lg text-[10px] final-grade ${bgClass} text-white shadow-md`;
        } else {
            avgEl.textContent = '-';
            gradeEl.textContent = '-';
            gradeEl.className = 'px-2 py-1 rounded-lg bg-gray-200 text-gray-400 text-[10px] final-grade';
        }
    }

    function updateSummary() {
        const rows = document.querySelectorAll('.student-row');
        let total = rows.length;
        let lolos = 0;
        
        rows.forEach(tr => {
            const avgEl = tr.querySelector('.final-avg');
            if (avgEl) { // Ensure the element exists
                const avg = avgEl.textContent;
                if (avg !== '-' && parseInt(avg) >= 75) {
                    lolos++;
                }
            }
        });
        
        const percent = total > 0 ? Math.round((lolos / total) * 100) : 0;
        
        const statLolos = document.getElementById('stat-lolos');
        const statPercent = document.getElementById('stat-percent');
        
        if (statLolos) statLolos.textContent = lolos;
        if (statPercent) statPercent.textContent = percent + '%';
    }

    // Bind inputs
    document.querySelectorAll('.score-input').forEach(inp => {
        inp.addEventListener('input', function() {
            let val = parseInt(this.value);
            if(val > 100) this.value = 100;
            updateRow(this.dataset.row);
            updateSummary(); // Update sidebar stats
        });
    });

    // Initial calc
    document.querySelectorAll('.student-row').forEach(tr => {
        updateRow(tr.dataset.row);
    });
    updateSummary();

    // Custom Confirm Modal
    function showConfirm(message) {
        return new Promise((resolve) => {
            const modal = document.getElementById('confirm-modal');
            const content = document.getElementById('confirm-modal-content');
            const messageEl = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok');
            const cancelBtn = document.getElementById('confirm-cancel');
            
            messageEl.textContent = message;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            setTimeout(() => modal.classList.add('show'), 10);
            lucide.createIcons();
            
            const cleanup = () => {
                modal.classList.remove('show');
                setTimeout(() => {
                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                }, 300);
            };
            
            const handleOk = () => {
                cleanup();
                resolve(true);
            };
            
            const handleCancel = () => {
                cleanup();
                resolve(false);
            };
            
            okBtn.onclick = handleOk;
            cancelBtn.onclick = handleCancel;
            modal.onclick = (e) => {
                if (e.target === modal) handleCancel();
            };
        });
    }

    // Toast Notification System
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-[#173A67]' : 'bg-red-600';
        const icon = type === 'success' ? 'check-circle' : 'alert-circle';
        
        toast.className = `toast-item flex items-center gap-3 ${bgColor} text-white px-6 py-4 rounded-2xl shadow-2xl min-w-[300px] pointer-events-auto`;
        toast.innerHTML = `
            <i data-lucide="${icon}" class="w-5 h-5 text-blue-200"></i>
            <div class="flex-1">
                <p class="text-xs font-black uppercase tracking-widest opacity-70">${type === 'success' ? 'Berhasil' : 'Error'}</p>
                <p class="text-sm font-bold">${message}</p>
            </div>
            <button class="opacity-50 hover:opacity-100 transition-opacity" onclick="this.parentElement.remove()">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        `;
        
        container.appendChild(toast);
        lucide.createIcons();
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.5s ease-in';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    // Save
    document.getElementById('save-final').addEventListener('click', async () => {
        const payload = [];
        document.querySelectorAll('.student-row').forEach(tr => {
            const id = tr.dataset.id;
            const data = { id: id };
            tr.querySelectorAll('.score-input').forEach(inp => {
                data[inp.dataset.key] = inp.value;
            });
            data.sikap = tr.querySelector('.sikap-input').value;
            // Kehadiran taken from editable input
            const hadirVal = tr.querySelector('.hadir-input').value || 0;
            data.kehadiran = parseFloat(hadirVal) / 100;
            payload.push(data);
        });

        const btn = document.getElementById('save-final');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menyimpan...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const res = await fetch('{{ route('sensei.penilaian.nilai-akhir.save') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ students: payload })
            });
            const data = await res.json();
            if(data.success) {
                showToast('Berhasil menyimpan nilai akhir');
            } else {
                showToast(data.message || 'Gagal menyimpan', 'error');
            }
        } catch(e) {
            console.error(e);
            showToast('Terjadi kesalahan server', 'error');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            lucide.createIcons();
        }
    });
    
    // Reset
    document.getElementById('reset-final').addEventListener('click', async () => {
        const confirmed = await showConfirm('Reset semua data nilai akhir?');
        if(!confirmed) return;
        
        const btn = document.getElementById('reset-final');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Reset...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const res = await fetch('{{ route('sensei.penilaian.nilai-akhir.reset') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            });
            const data = await res.json();
            if(data.success) {
                showToast('Berhasil reset nilai akhir', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast('Gagal reset', 'error');
            }
        } catch(e) {
            console.error(e);
            showToast('Terjadi kesalahan', 'error');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            lucide.createIcons();
        }
    });
</script>
@endsection
