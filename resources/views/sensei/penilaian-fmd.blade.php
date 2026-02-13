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
                <button id="reset-fmd" class="px-6 py-2.5 bg-white text-red-500 border-2 border-red-100 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all flex items-center gap-2">
                    <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset
                </button>
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
                            <th rowspan="2" class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest sticky left-16 bg-[#173A67] z-30 min-w-[250px] border-r border-blue-800 shadow-xl">Nama Siswa</th>
                            @foreach($weeks as $week)
                            <th colspan="3" class="px-4 py-2 font-bold text-[10px] text-center uppercase tracking-wider border-r border-blue-800 bg-[#1e4b85]">
                                Minggu {{ $week }}
                            </th>
                            @endforeach
                            <th rowspan="2" class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center bg-[#173A67] border-l border-blue-800 sticky right-0 z-30">Total</th>
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
                            @php $saved = $savedScores[$user->id] ?? []; @endphp
                            <tr class="group hover:bg-blue-50/30 transition-colors student-row" data-id="{{ $user->id }}">
                                <td class="px-4 py-5 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white z-10 border-r border-gray-100">
                                    {{ $idx + 1 }}
                                </td>
                                <td class="px-6 py-5 sticky left-16 bg-white z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)] min-w-[250px]">
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
                                           data-week="{{ $week }}" placeholder="-" value="{{ $saved['week'.$week.'_val'] ?? '' }}">
                                </td>
                                <td class="px-2 py-4 border-r border-gray-100 text-center">
                                    <select class="w-full bg-gray-100 border border-gray-200 rounded-lg text-[10px] font-extrabold py-1.5 focus:ring-0 cursor-not-allowed ket-input appearance-none" data-week="{{ $week }}" disabled>
                                        <option value="TH">TH</option>
                                        <option value="LULUS">LULUS</option>
                                        <option value="TIDAK LULUS">TIDAK LULUS</option>
                                    </select>
                                </td>
                                <td class="px-2 py-4 border-r border-gray-100 text-center bg-gray-50/50">
                                     <span class="text-xs font-black text-gray-400 score-display" data-week="{{ $week }}">{{ $saved['week'.$week.'_score'] ?? 0 }}</span>
                                </td>
                                @endforeach
                                
                                <td class="px-4 py-4 text-center font-black text-blue-600 bg-blue-50 sticky right-0">
                                    <span class="total-score">{{ $saved['total_score'] ?? 0 }}</span>
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
                                <th class="px-2 py-3 font-bold border-r border-gray-200 text-center">4 Minggu</th>
                                <th class="px-2 py-3 font-bold text-center">5 Minggu</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-600 font-bold text-center">
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50">Jumlah</td>
                                <td class="px-2 py-2.5 border-r border-gray-200" id="stat-jumlah-4">-</td>
                                <td class="px-2 py-2.5" id="stat-jumlah-5">-</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-2.5 text-left border-r border-gray-200 bg-gray-50/50 text-top font-bold">Presentase</td>
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
            
            // Sum based on score-display (1 or 0) derived from Ket
            tr.querySelectorAll('.score-display').forEach(scoreEl => {
                const score = parseFloat(scoreEl.textContent);
                const week = parseInt(scoreEl.dataset.week);
                
                if (!isNaN(score)) {
                    if (week <= 4) { totalVal4 += score; count4++; }
                    totalVal5 += score; count5++;
                    rowTotal += score;
                    rowCount++;
                }
            });
            
            // Update row total display if needed
            const totalEl = tr.querySelector('.total-score');
            if (totalEl) totalEl.textContent = rowTotal || '0';
        });

        const safeAvg = (sum, count) => count > 0 ? (sum / count).toFixed(2) : '-';
        const safeSumByStudent = (sum, students) => students > 0 ? (sum / students).toFixed(2) : '-';

        document.getElementById('stat-jumlah-4').textContent = totalVal4 || '0';
        document.getElementById('stat-jumlah-5').textContent = totalVal5 || '0';
        
        // Percent: (Total Passes / Total Possible Weeks For All Students) * 100
        // Total Possible Weeks For All Students (Week 1-4) = studentsCount * 4
        // Total Possible Weeks For All Students (Week 1-5) = studentsCount * 5
        
        const totalPossible4 = studentsCount * 4;
        const totalPossible5 = studentsCount * 5;
        
        const percent4 = totalPossible4 > 0 ? ((totalVal4 / totalPossible4) * 100).toFixed(0) + '%' : '0%';
        const percent5 = totalPossible5 > 0 ? ((totalVal5 / totalPossible5) * 100).toFixed(0) + '%' : '0%';
        
        document.getElementById('stat-percent-4').textContent = percent4;
        document.getElementById('stat-percent-5').textContent = percent5;
    }

    // Bind inputs
    // Logic Keterangan FMD
    function updateKet(valInput) {
        const row = valInput.closest('tr');
        const week = valInput.dataset.week;
        const ketSelect = row.querySelector(`.ket-input[data-week="${week}"]`);
        
        if (!ketSelect) return;

        let val = valInput.value.trim();
        
        // =IF(kolom="-","TH",IF(kolom>=37,"L","TL"))
        if (val === '' || val === '-') {
            ketSelect.value = 'TH';
        } else {
            const num = parseFloat(val.replace(',', '.'));
            if (!isNaN(num)) {
                if (num >= 37) {
                    ketSelect.value = 'LULUS';
                } else {
                    ketSelect.value = 'TIDAK LULUS';
                }
            } else {
                // Determine behavior for non-numeric other than "-"
                // For now, if it's not a number and not "-", default to TH or keep as is?
                // Based on strict formula reading: IF(kolom="-","TH", ...) -> checks specific string
                // But usually we handle empty as well.
                // User input might be just text. Let's assume treat as TH if invalid number, or TL? 
                // Let's stick to: if it parses as number, check >= 37. If not number, check if "-".
                 ketSelect.value = 'TH';
            }
        }
        
        // Update Score Display based on Ket
        // =IF(kolommtk="LULUS","1","0")
        const scoreDisplay = row.querySelector(`.score-display[data-week="${week}"]`);
        if (scoreDisplay) {
            scoreDisplay.textContent = (ketSelect.value === 'LULUS') ? '1' : '0';
        }
    }

    // Bind inputs
    document.querySelectorAll('.val-input').forEach(inp => {
        inp.addEventListener('input', () => {
            updateKet(inp);
            updateSummary();
        });
        
    });

    // Initial calc
    document.querySelectorAll('.val-input').forEach(inp => {
        updateKet(inp);
    });

    // Initial calc
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

    // Save logic
    document.getElementById('save-fmd').addEventListener('click', async () => {
        const payload = [];
        document.querySelectorAll('.student-row').forEach(tr => {
            const id = tr.dataset.id;
            const data = { id: id };
            for(let w=1; w<=5; w++) {
                data['week'+w+'_val'] = tr.querySelector(`.val-input[data-week="${w}"]`).value;
                data['week'+w+'_ket'] = tr.querySelector(`.ket-input[data-week="${w}"]`).value;
                data['week'+w+'_score'] = tr.querySelector(`.score-display[data-week="${w}"]`).textContent;
            }
            payload.push(data);
        });

        const btn = document.getElementById('save-fmd');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menyimpan...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const res = await fetch('{{ route('sensei.penilaian.fmd.save') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ mode: '{{ $mode }}', students: payload })
            });
            const data = await res.json();
            if(data.success) {
                showToast('Berhasil menyimpan data FMD');
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
    
    // Reset logic
    document.getElementById('reset-fmd').addEventListener('click', async () => {
        const confirmed = await showConfirm('Reset semua data FMD ({{ strtoupper($mode) }})?');
        if(!confirmed) return;
        
        const btn = document.getElementById('reset-fmd');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Reset...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const res = await fetch('{{ route('sensei.penilaian.fmd.reset') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ mode: '{{ $mode }}' })
            });
            const data = await res.json();
            if(data.success) {
                showToast('Berhasil reset data FMD', 'success');
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
