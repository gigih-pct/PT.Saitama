@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian FMD')

@section('content')
@php
    $users = $students ?? [];
    $mode = request('mode', 'mtk'); // mtk, lari, pushup
    $weeks = range(1, 5);
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">

    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian FMD
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
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Fisik, Mental, dan Disiplin</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
             <!-- Mode Tabs -->
             <div class="bg-gray-100 p-1 rounded-2xl flex items-center shadow-inner">
                <a href="{{ route('sensei.penilaian.fmd', ['mode'=>'mtk']) }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all {{ $mode === 'mtk' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">MTK</a>
                <a href="{{ route('sensei.penilaian.fmd', ['mode'=>'lari']) }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all {{ $mode === 'lari' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">Lari</a>
                <a href="{{ route('sensei.penilaian.fmd', ['mode'=>'pushup']) }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all {{ $mode === 'pushup' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">Push Up</a>
             </div>
             
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
        
        <!-- LEFT: TABLE & CONTENT -->
        <div class="col-span-12 lg:col-span-9 flex flex-col gap-6">
        
        <!-- Toolbar -->
        <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100">
            <div class="flex items-center gap-3">
                 <button id="save-fmd" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2">
                    <i data-lucide="save" class="w-4 h-4"></i> Simpan ({{ strtoupper($mode) }})
                </button>
                 <span id="fmd-save-msg" class="text-sm font-bold ml-2"></span>
            </div>
            <div class="flex items-center gap-3 text-xs font-bold text-gray-500">
                <span class="flex items-center gap-2 px-3 py-1.5 bg-white rounded-lg border border-gray-200"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Input Nilai</span>
                <span class="flex items-center gap-2 px-3 py-1.5 bg-white rounded-lg border border-gray-200"><span class="w-2 h-2 rounded-full bg-green-500"></span> Hitung Skor</span>
            </div>
        </div>

        <!-- FMD TABLE -->
        <div class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden shadow-sm relative z-0">
            <div class="fmd-scroll overflow-auto max-h-[600px]">
                <table class="w-max text-left border-collapse">
                    <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                        <tr>
                            <th rowspan="2" class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest text-center sticky left-0 bg-[#173A67] z-30 w-16 border-r border-blue-800">No</th>
                            <th rowspan="2" class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest sticky left-16 bg-[#173A67] z-30 min-w-[200px] border-r border-blue-800 shadow-xl">Nama Siswa</th>
                            @foreach($weeks as $week)
                            <th colspan="3" class="px-4 py-2 font-bold text-[10px] text-center uppercase tracking-wider border-r border-blue-800 bg-[#1e4b85]">
                                Minggu {{ $week }}
                            </th>
                            @endforeach
                            <th rowspan="2" class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center bg-[#173A67] border-l border-blue-800">Total</th>
                        </tr>
                        <tr>
                            @foreach($weeks as $week)
                            <th class="px-3 py-2 font-bold text-[10px] text-center w-24 bg-[#173A67] border-r border-blue-800/30 uppercase">{{ $mode }}</th>
                            <th class="px-3 py-2 font-bold text-[10px] text-center w-24 bg-[#173A67] border-r border-blue-800/30 uppercase">Ket</th>
                            <th class="px-3 py-2 font-bold text-[10px] text-center w-16 bg-[#173A67] border-r border-blue-800 uppercase">Skor</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                         @forelse($users as $idx => $user)
                            <tr class="group hover:bg-blue-50/30 transition-colors student-row">
                                <td class="px-4 py-5 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100">
                                    {{ $idx + 1 }}
                                </td>
                                <td class="px-6 py-5 sticky left-16 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)]">
                                    <div class="flex items-center gap-3">
                                        <div class="w-6 h-6 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-[10px]">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <input type="text" class="bg-transparent border-none p-0 text-xs font-bold text-[#173A67] w-full focus:ring-0 cursor-default name-input truncate" 
                                               value="{{ $user->name }}" readonly title="{{ $user->name }}">
                                    </div>
                                </td>
                                
                                @foreach($weeks as $week)
                                <td class="px-2 py-4 border-r border-gray-100 text-center">
                                    <input type="text" class="w-full text-center bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold focus:ring-2 focus:ring-blue-500 py-1.5 val-input" 
                                           data-week="{{ $week }}" placeholder="-">
                                </td>
                                <td class="px-2 py-4 border-r border-gray-100 text-center">
                                    <select class="w-full bg-white border border-gray-200 rounded-lg text-xs font-medium py-1.5 focus:ring-2 focus:ring-blue-500 ket-input" data-week="{{ $week }}">
                                        <option value="">-</option>
                                        <option value="H">Hadir</option>
                                        <option value="TL">Terlambat</option>
                                        <option value="A">Alfa</option>
                                    </select>
                                </td>
                                <td class="px-2 py-4 border-r border-gray-100 text-center bg-gray-50/50">
                                     <span class="text-xs font-black text-gray-400 score-display" data-week="{{ $week }}">0</span>
                                </td>
                                @endforeach
                                
                                <td class="px-4 py-4 text-center font-black text-blue-600 bg-blue-50/50 sticky right-0">
                                    <span class="total-score">0</span>
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
            
            <!-- Table Keterangan FMD -->
            <div class="bg-gray-100 rounded-[2rem] p-6 border border-gray-200 shadow-sm">
                <h4 class="font-bold text-[#173A67] mb-4 text-sm uppercase tracking-widest">Tabel Keterangan</h4>
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
                    <table class="w-full text-[10px] border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-[#173A67] border-b border-gray-200">
                                <th class="px-2 py-3 font-bold border-r border-gray-200 text-left uppercase tracking-wider">Keterangan</th>
                                <th class="px-1 py-3 font-bold border-r border-gray-200 text-center w-4 text-transparent">~</th>
                                <th class="px-2 py-3 font-bold border-r border-gray-200 text-center">4 Minggu</th>
                                <th class="px-2 py-3 font-bold text-center">5 Minggu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600 font-bold text-center">
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50">Jumlah</td>
                                <td class="px-1 py-2.5 border-r border-gray-200 bg-gray-50/50 text-transparent">~</td>
                                <td class="px-2 py-2.5 border-r border-gray-200" id="stat-jumlah-4">-</td>
                                <td class="px-2 py-2.5" id="stat-jumlah-5">-</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50">Rata Rata Siswa</td>
                                <td class="px-1 py-2.5 border-r border-gray-200 bg-gray-50/50 text-transparent">~</td>
                                <td class="px-2 py-2.5 border-r border-gray-200" id="stat-avg-siswa-4">-</td>
                                <td class="px-2 py-2.5" id="stat-avg-siswa-5">-</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50">Rata Rata Kelas</td>
                                <td class="px-1 py-2.5 border-r border-gray-200 bg-gray-50/50 text-transparent">~</td>
                                <td class="px-2 py-2.5 border-r border-gray-200" id="stat-avg-kelas-4">-</td>
                                <td class="px-2 py-2.5" id="stat-avg-kelas-5">-</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50 text-top font-bold">Presentase</td>
                                <td class="px-1 py-2.5 border-r border-gray-200 bg-gray-50/50 text-transparent">~</td>
                                <td class="px-2 py-2.5 border-r border-gray-200 font-black text-[#173A67]" id="stat-percent-4">-</td>
                                <td class="px-2 py-2.5 font-black text-[#173A67]" id="stat-percent-5">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Additional Detail Card -->
            <div class="bg-[#173A67] rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 p-8 opacity-10 group-hover:opacity-20 transition-opacity">
                    <i data-lucide="info" class="w-24 h-24"></i>
                </div>
                <h3 class="font-bold text-sm mb-4 relative z-10 uppercase tracking-widest">Informasi Penilaian</h3>
                <div class="relative z-10 space-y-3">
                    <p class="text-[10px] text-blue-200 leading-relaxed font-medium">Input nilai berdasarkan performa fisik (MTK, Lari, Pushup). Skor otomatis dihitung dari hasil mingguan.</p>
                    <div class="flex items-center gap-2 text-[10px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                        <span>Update setiap minggu</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
/* FMD Scrollbar Standardized - Excel Style Always Visible */
.fmd-scroll { 
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
.fmd-scroll::-webkit-scrollbar { 
    height: 18px !important; 
    width: 18px !important; 
    display: block !important;
    background-color: #f1f5f9 !important;
    -webkit-appearance: none !important;
}

.fmd-scroll::-webkit-scrollbar:window-inactive {
    display: block !important;
}

.fmd-scroll::-webkit-scrollbar-track { 
    background: #f1f5f9 !important; 
    border: 1px solid #e2e8f0 !important;
}

.fmd-scroll::-webkit-scrollbar-thumb { 
    background-color: #94a3b8 !important;
    border-radius: 0px !important;
    border: 3px solid #f1f5f9 !important;
    min-height: 40px !important;
}

.fmd-scroll::-webkit-scrollbar-thumb:hover { 
    background-color: #64748b !important; 
}

.fmd-scroll::-webkit-scrollbar-corner {
    background-color: #f1f5f9 !important;
}

.table-fixed { table-layout: fixed; }
</style>

<script>
    // Helper functions for summary
    function updateSummary() {
        const rows = document.querySelectorAll('.student-row');
        let totalVal4 = 0, count4 = 0;
        let totalVal5 = 0, count5 = 0;
        let studentsCount = rows.length;

        rows.forEach(tr => {
            let rowTotal = 0;
            let rowCount = 0;
            
            tr.querySelectorAll('.val-input').forEach(inp => {
                const val = parseFloat(inp.value);
                const week = parseInt(inp.dataset.week);
                if (!isNaN(val)) {
                    if (week <= 4) { totalVal4 += val; count4++; }
                    totalVal5 += val; count5++;
                    rowTotal += val;
                    rowCount++;
                }
            });
            
            // Update row total display if needed
            const totalEl = tr.querySelector('.total-score');
            if (totalEl) totalEl.textContent = rowTotal || '-';
        });

        const safeAvg = (sum, count) => count > 0 ? (sum / count).toFixed(2) : '-';
        const safeSumByStudent = (sum, students) => students > 0 ? (sum / students).toFixed(2) : '-';

        document.getElementById('stat-jumlah-4').textContent = totalVal4 || '-';
        document.getElementById('stat-jumlah-5').textContent = totalVal5 || '-';
        
        document.getElementById('stat-avg-siswa-4').textContent = safeSumByStudent(totalVal4, studentsCount);
        document.getElementById('stat-avg-siswa-5').textContent = safeSumByStudent(totalVal5, studentsCount);
        
        document.getElementById('stat-avg-kelas-4').textContent = safeAvg(totalVal4, count4);
        document.getElementById('stat-avg-kelas-5').textContent = safeAvg(totalVal5, count5);
        
        // Mock percentage for now
        document.getElementById('stat-percent-4').textContent = totalVal4 ? '100%' : '-';
        document.getElementById('stat-percent-5').textContent = totalVal5 ? '100%' : '-';
    }

    // Bind inputs
    document.querySelectorAll('.val-input').forEach(inp => {
        inp.addEventListener('input', () => updateSummary());
    });

    // Initial calc
    updateSummary();

    // Save logic
    document.getElementById('save-fmd').addEventListener('click', async () => {
        const msg = document.getElementById('fmd-save-msg');
        msg.textContent = 'Menyimpan...'; msg.className = 'text-xs font-bold text-gray-400 ml-2';
        
        // Mock save
        setTimeout(() => {
            msg.textContent = 'Tersimpan'; msg.className = 'text-xs font-bold text-green-500 ml-2';
            setTimeout(() => msg.textContent='', 2000);
        }, 800);
    });
</script>
@endsection
