@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian Kanji')

@section('content')
@php
    // Data from Controller: $students, $selectedBab, $questionsCount, $savedScores, $summary
    $bab = $selectedBab ?? 1;
    $maxScore = $questionsCount ?? 10;
    $users = $students ?? [];
    $rows = $savedScores ?? [];
    $stats = $summary ?? ['total'=>0, 'lulus'=>0, 'percent'=>0];
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian Kanji
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
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Input nilai dan evaluasi kemampuan Kanji siswa</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">

            <!-- Bab Selector -->
            <div class="relative">
                <select id="bab-select" class="pl-4 pr-10 py-3 rounded-2xl bg-blue-50 text-blue-800 text-sm font-bold border-2 border-blue-100 focus:border-blue-500 cursor-pointer appearance-none transition-all hover:bg-white text-center">
                    @foreach($questionsMap as $bName => $qCount)
                        <option value="{{ $bName }}" {{ $bab == $bName ? 'selected' : '' }}>BAB {{ $bName }} ({{ $qCount }} Soal)</option>
                    @endforeach
                </select>
                 <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                     <i data-lucide="chevron-down" class="w-4 h-4 text-blue-800"></i>
                </div>
            </div>
            <!-- Navigation Dropdown -->
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

    <div class="grid grid-cols-12 gap-8 flex-1">
        <!-- LEFT: TABLE -->
        <div class="col-span-12 lg:col-span-9 flex flex-col gap-6">
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100">
                <div class="flex items-center gap-3">
                     <button id="btn-save" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan Nilai
                    </button>
                    <button id="btn-reset" class="px-6 py-2.5 bg-white text-red-500 border-2 border-red-100 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset
                    </button>
                </div>
                <div class="px-4 py-2 bg-white rounded-xl border border-gray-100 text-xs font-bold text-gray-500 shadow-sm">
                    Max Score: {{ $maxScore }}
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden flex-1 shadow-sm relative">
                <div class="overflow-x-auto max-h-[600px] overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                    <table class="w-max min-w-full text-left border-collapse">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest w-16 text-center sticky left-0 bg-[#173A67] z-30 border-r border-blue-800">No</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest w-[250px] sticky left-16 bg-[#173A67] z-30 border-r border-blue-800 shadow-xl">Nama Siswa</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-32">Benar</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-32">Nilai</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-40">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($users as $idx => $user)
                                @php
                                    // Match student data using ID
                                    $saved = $rows[$user->id] ?? null;
                                    $savedScore = $saved['score'] ?? '-';
                                    $savedCorrect = $saved['correct'] ?? '';
                                @endphp
                                <tr class="group hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100">
                                        {{ $idx + 1 }}
                                    </td>
                                    <td class="px-6 py-4 w-[250px] sticky left-16 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)]">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-xs">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <!-- Readonly name input for logic compatibility -->
                                            <span class="text-sm font-bold text-[#173A67] whitespace-nowrap" title="{{ $user->name }}">
                                                {{ $user->name }}
                                            </span>
                                            <input type="hidden" class="name-input" value="{{ $user->name }}" data-row="{{ $idx }}" data-id="{{ $user->id }}">
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <input type="number" min="0" max="{{ $maxScore }}"
                                               class="w-20 text-center bg-gray-50 border-2 border-gray-100 rounded-xl py-2 text-sm font-bold text-[#173A67] focus:border-blue-500 focus:ring-0 transition-all correct-input"
                                               value="{{ $savedCorrect }}" placeholder="0" data-row="{{ $idx }}">
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex w-16 h-10 items-center justify-center rounded-xl bg-gray-100 text-gray-400 font-black text-sm score-display transition-all" data-row="{{ $idx }}">
                                            {{ $savedScore }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                         <input type="date" 
                                               class="w-full text-center bg-transparent border-none text-xs font-bold text-gray-400 focus:ring-0 date-input"
                                               value="{{ $saved['date'] ?? '' }}" data-row="{{ $idx }}">
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 font-bold">
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
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
                    <i data-lucide="pie-chart" class="w-32 h-32"></i>
                </div>
                <h3 class="font-bold text-lg mb-6 relative z-10">Ringkasan Nilai</h3>
                
                <div class="space-y-4 relative z-10">
                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm border border-white/10">
                        <p class="text-xs font-bold text-blue-200 uppercase tracking-widest mb-1">Total Siswa</p>
                        <p class="text-3xl font-black" id="summary-total">{{ $stats['total'] }}</p>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-green-500/20 rounded-2xl p-4 backdrop-blur-sm border border-green-400/20">
                            <p class="text-[10px] font-bold text-green-300 uppercase tracking-widest mb-1">Lulus</p>
                            <p class="text-2xl font-black text-green-300" id="summary-lulus">{{ $stats['lulus'] }}</p>
                        </div>
                        <div class="bg-red-500/20 rounded-2xl p-4 backdrop-blur-sm border border-red-400/20">
                            <p class="text-[10px] font-bold text-red-300 uppercase tracking-widest mb-1">Remidial</p>
                            <p class="text-2xl font-black text-red-300" id="summary-gagal">{{ ($stats['total'] - $stats['lulus']) }}</p>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4 flex items-center justify-between backdrop-blur-sm">
                        <span class="text-xs font-bold">Presentase</span>
                        <span class="text-xl font-black text-yellow-300" id="summary-percent">{{ $stats['percent'] }}%</span>
                    </div>
                </div>
            </div>

            <!-- Guidelines -->
            <div class="bg-yellow-50 rounded-[2rem] p-6 border-2 border-yellow-100">
                <h4 class="font-bold text-[#173A67] mb-3 flex items-center gap-2">
                    <i data-lucide="info" class="w-5 h-5 text-yellow-600"></i>
                    Panduan
                </h4>
                <ul class="text-xs font-semibold text-gray-500 space-y-2 list-disc pl-4">
                    <li>Isi jumlah jawaban benar pada kolom input.</li>
                    <li>Nilai otomatis dihitung (Skala 100).</li>
                    <li><span class="text-green-600">Hijau</span> menandakan lulus (≥75).</li>
                    <li><span class="text-red-500">Merah</span> menandakan remidial.</li>
                    <li>Klik <span class="text-blue-600">Simpan Nilai</span> untuk menyimpan data.</li>
                </ul>
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
</style>

<script>
    const CONFIG = {
        maxScore: {{ $maxScore }},
        bab: "{{ $bab }}",
        saveRoute: "{{ route('sensei.penilaian.kanji.save') }}", // Uses existing route
        resetRoute: "{{ route('sensei.penilaian.kanji.reset') }}",
        csrf: "{{ csrf_token() }}"
    };

    // Calculate Score Logic
    function calculateScore(correct) {
        if(!CONFIG.maxScore) return 0;
        return Math.min(100, Math.round((correct / CONFIG.maxScore) * 100 * 100) / 100);
    }

    // UI Updates
    function updateRowUI(rowIdx, correct) {
        const scoreEl = document.querySelector(`.score-display[data-row="${rowIdx}"]`);
        if(!scoreEl) return;

        correct = parseInt(correct);
        if(isNaN(correct)) {
            scoreEl.textContent = '-';
            scoreEl.className = 'inline-flex w-16 h-10 items-center justify-center rounded-xl bg-gray-100 text-gray-400 font-black text-sm score-display transition-all';
            return;
        }

        const score = calculateScore(correct);
        scoreEl.textContent = score;

        // Color logic
        scoreEl.classList.remove('bg-gray-100', 'text-gray-400', 'bg-green-100', 'text-green-600', 'bg-red-100', 'text-red-500');
        if(score >= 75) {
            scoreEl.classList.add('bg-green-100', 'text-green-600');
        } else {
            scoreEl.classList.add('bg-red-100', 'text-red-500');
        }
    }

    // Collect Data
    function getPayload() {
        const payload = [];
        document.querySelectorAll('tr.group').forEach((tr, idx) => {
            const nameInput = tr.querySelector('.name-input');
            const name = nameInput.value;
            const id = nameInput.dataset.id;
             const correctVal = tr.querySelector('.correct-input').value;
             const date = tr.querySelector('.date-input').value;
             
             if(correctVal !== '') {
                 payload.push({
                     user_id: id,
                     name: name,
                     correct: correctVal,
                     date: date,
                     row: idx // Legacy compat
                 });
             }
        });
        return payload;
    }

    // Sync Stats
    function updateStats(summary) {
        if(!summary) return;
        document.getElementById('summary-total').textContent = summary.total;
        document.getElementById('summary-lulus').textContent = summary.lulus;
        document.getElementById('summary-gagal').textContent = (summary.total - summary.lulus);
        document.getElementById('summary-percent').textContent = summary.percent + '%';
    }

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
            
            // Trigger animation
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
        
        // Auto remove
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.5s ease-in';
            setTimeout(() => toast.remove(), 500);
        }, 3000);
    }

    async function saveData() {
        const btn = document.getElementById('btn-save');
        const payload = getPayload();

        if(!payload.length) {
            showToast('Tidak ada data untuk disimpan', 'error');
            return;
        }

        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menyimpan...';
        btn.disabled = true;
        lucide.createIcons();

        try {
            const res = await fetch(CONFIG.saveRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CONFIG.csrf
                },
                body: JSON.stringify({
                    bab: CONFIG.bab,
                    students: payload
                })
            });
            const data = await res.json();
            if(data.success) {
                showToast(`Berhasil menyimpan nilai BAB ${CONFIG.bab}`);
                updateStats(data.summary);
            } else {
                showToast(data.message || 'Gagal menyimpan data', 'error');
            }
        } catch(e) {
            console.error(e);
            showToast('Terjadi kesalahan server', 'error');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            lucide.createIcons();
        }
    }

    // Event Listeners
    document.addEventListener('DOMContentLoaded', () => {
        // Initial Color Calculation
        document.querySelectorAll('.correct-input').forEach(input => {
             updateRowUI(input.dataset.row, input.value);
             
             input.addEventListener('input', function() {
                 let val = parseInt(this.value);
                 if(val > CONFIG.maxScore) { val = CONFIG.maxScore; this.value = val; }
                 if(val < 0) { val = 0; this.value = val; }
                 
                 updateRowUI(this.dataset.row, this.value);
             });
        });

        // Bab Change
        document.getElementById('bab-select').addEventListener('change', function() {
            window.location.search = '?bab=' + this.value;
        });

        // Manual Save
        document.getElementById('btn-save').addEventListener('click', saveData);

        // Reset
        document.getElementById('btn-reset').addEventListener('click', async () => {
            const confirmed = await showConfirm(`Reset nilai BAB ${CONFIG.bab}?`);
            if(!confirmed) return;
            
            const btn = document.getElementById('btn-reset');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Reset...';
            btn.disabled = true;
            lucide.createIcons();
            
            try {
                const res = await fetch(CONFIG.resetRoute, {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': CONFIG.csrf},
                    body: JSON.stringify({bab: CONFIG.bab})
                });
                const data = await res.json();
                
                if(data.success || res.ok) {
                    showToast(`Berhasil reset nilai BAB ${CONFIG.bab}`, 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    showToast('Gagal reset data', 'error');
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                    lucide.createIcons();
                }
            } catch(e) {
                console.error(e);
                showToast('Terjadi kesalahan saat reset', 'error');
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                lucide.createIcons();
            }
        });
    });
</script>
@endsection
