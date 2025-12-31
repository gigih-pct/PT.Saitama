@extends('layouts.header_dashboard_sensei')

@section('content')
@php
    $selectedBab = intval(request()->query('bab', 1));
    $questionsMap = [1 => 15, 2 => 12, 3 => 18, 4 => 25];
    $questionsCount = $questionsMap[$selectedBab] ?? 10;
    $saved = session('penilaian_kanji_bab_' . $selectedBab) ?? null;
    if(is_array($saved) && count($saved)) { $rows = $saved; }
    else { $rows = array_fill(0, 20, ['name'=>'','correct'=>'','score'=>0,'date'=>'']); }
    $summary = session('penilaian_kanji_summary_bab_' . $selectedBab, ['total'=>0,'lulus'=>0,'percent'=>0]);
@endphp

<div class="grid grid-cols-12 gap-6">

    <!-- HEADER FILTER -->
    <div class="col-span-12">
        <div class="bg-[#173A67] rounded-full px-6 py-3 flex items-center justify-between text-white">
            <div class="flex items-center gap-4">
                <span class="font-semibold">Penilaian Kelas</span>
                <div class="flex items-center gap-2 ml-2">
                   <select name="kelas-select" class="bg-white text-black rounded-full px-3 py-1 text-sm border">
                        <option>A1</option>
                        <option>A2</option>
                        <option>A3</option>
                    </select>
                    <div class="relative">
                        <select name="penilaian-select" onchange="if(this.value) window.location.href=this.value" class="bg-green-500 text-white rounded-full px-4 py-1 text-sm border-0">
                            <option value="{{ route('sensei.penilaian.presensi') }}" {{ Route::currentRouteName() === 'sensei.penilaian.presensi' ? 'selected' : '' }}>Penilaian : Presensi Siswa</option>
                            <option value="{{ route('sensei.penilaian.bunpou') }}" {{ Route::currentRouteName() === 'sensei.penilaian.bunpou' ? 'selected' : '' }}>Penilaian : Bunpou</option>
                            <option value="{{ route('sensei.penilaian.kanji') }}" {{ Route::currentRouteName() === 'sensei.penilaian.kanji' ? 'selected' : '' }}>Penilaian : Kanji</option>
                            <option value="{{ route('sensei.penilaian.kotoba') }}" {{ Route::currentRouteName() === 'sensei.penilaian.kotoba' ? 'selected' : '' }}>Penilaian : Kotoba</option>
                            <option value="{{ route('sensei.penilaian.fmd') }}" {{ Route::currentRouteName() === 'sensei.penilaian.fmd' ? 'selected' : '' }}>Penilaian : FMD</option>
                            <option value="{{ route('sensei.penilaian.wawancara') }}" {{ Route::currentRouteName() === 'sensei.penilaian.wawancara' ? 'selected' : '' }}>Penilaian : Wawancara</option>
                            <option value="{{ route('sensei.penilaian.nilai-akhir') }}" {{ Route::currentRouteName() === 'sensei.penilaian.nilai-akhir' ? 'selected' : '' }}>Penilaian : Nilai Akhir</option>
                        </select>
                        <svg class="w-3 h-3 absolute right-2 top-2 text-white pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8l4 4 4-4"/></svg>
                    </div>
                </div>
            </div>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5h18M6 12h12M10 19h4"/></svg>
        </div>

        <!-- SUB HEADER -->
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <span class="font-semibold text-lg">Penilaian Kanji : Kelas A2</span>
            <div class="flex items-center gap-2 flex-wrap">
                <div class="relative">
                    <select id="kanji-bab-select" class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm border-0 cursor-pointer">
                        @for($b=1;$b<=30;$b++)
                            <option value="{{ $b }}" {{ $selectedBab === $b ? 'selected' : '' }}>BAB {{ $b }}</option>
                        @endfor
                    </select>
                    <svg class="w-3 h-3 absolute right-2 top-2 text-white pointer-events-none" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8l4 4 4-4"/></svg>
                </div>
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm whitespace-nowrap">Jumlah soal: <strong id="questions-count">{{ $questionsCount }}</strong></span>
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <div class="col-span-12 lg:col-span-9">
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <!-- TOOLBAR -->
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <button id="save-kanji" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-kanji" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="kanji-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500">20 Siswa</div>
            </div>

            <!-- INSTRUCTION -->
            <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Isi nama siswa dan jumlah jawaban yang benar. Nilai akan otomatis dihitung. ✓ Hijau (≥75%), ✗ Merah (<75%)</p>
            </div>

            <!-- TABLE CONTAINER -->
            <div class="border rounded-lg overflow-hidden">
                <div class="overflow-x-auto max-h-[680px] overflow-y-auto scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-blue-600 text-white sticky top-0 z-20">
                            <tr>
                                <th class="border border-gray-400 px-3 py-2 text-center w-12 font-semibold">No</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[300px]">Nama Siswa</th>
                                <th class="border border-gray-400 px-3 py-2 text-center w-32 font-semibold">Jawaban Benar</th>
                                <th class="border border-gray-400 px-3 py-2 text-center w-24 font-semibold">Nilai (%)</th>
                                <th class="border border-gray-400 px-3 py-2 text-center w-32 font-semibold">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $idx => $r)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border px-3 py-2 text-center text-gray-600">{{ $idx + 1 }}</td>
                                <td class="border px-3 py-2">
                                    <input 
                                        type="text" 
                                        class="w-full name-input border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                        placeholder="Ketik nama siswa..." 
                                        value="{{ $r['name'] ?? '' }}" 
                                        data-row="{{ $idx }}"
                                    />
                                </td>
                                <td class="border px-3 py-2">
                                    <input 
                                        type="number" 
                                        min="0"
                                        max="{{ $questionsCount }}"
                                        class="w-full correct-input border rounded px-2 py-1 text-sm text-center focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                        placeholder="0"
                                        value="{{ $r['correct'] ?? '' }}" 
                                        data-row="{{ $idx }}"
                                    />
                                </td>
                                <td class="border px-3 py-2 text-center">
                                    <span class="score-display font-bold text-lg" data-row="{{ $idx }}">{{ isset($r['score']) ? $r['score'] : '-' }}</span>
                                </td>
                                <td class="border px-3 py-2">
                                    <input 
                                        type="date" 
                                        class="w-full date-input border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                        value="{{ $r['date'] ?? '' }}" 
                                        data-row="{{ $idx }}"
                                    />
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SUMMARY PANEL -->
    <div class="col-span-12 lg:col-span-3">
        <div class="bg-white rounded-xl p-4 shadow-sm sticky top-6">
            <h3 class="font-bold text-lg mb-4">📊 Ringkasan</h3>
            
            <div class="space-y-3">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-500">
                    <p class="text-gray-600 text-sm">Total Siswa</p>
                    <p class="text-2xl font-bold text-blue-600" id="kanji-total">{{ $summary['total'] }}</p>
                </div>

                <div class="bg-green-50 p-3 rounded border-l-4 border-green-500">
                    <p class="text-gray-600 text-sm">Siswa Lolos (≥75%)</p>
                    <p class="text-2xl font-bold text-green-600" id="kanji-lulus">{{ $summary['lulus'] }}</p>
                </div>

                <div class="bg-yellow-50 p-3 rounded border-l-4 border-yellow-500">
                    <p class="text-gray-600 text-sm">Persentase Kelulusan</p>
                    <p class="text-2xl font-bold text-yellow-600" id="kanji-percent">{{ $summary['percent'] }}%</p>
                </div>

                <div class="bg-red-50 p-3 rounded border-l-4 border-red-500">
                    <p class="text-gray-600 text-sm">Siswa Tidak Lolos (<75%)</p>
                    <p class="text-2xl font-bold text-red-600" id="kanji-tidak-lulus">{{ ($summary['total'] ?? 0) - ($summary['lulus'] ?? 0) }}</p>
                </div>
            </div>

            <div class="mt-4 p-3 bg-gray-50 rounded text-xs text-gray-600">
                <p><strong>💡 Catatan:</strong></p>
                <ul class="list-disc list-inside mt-2 space-y-1">
                    <li>Data otomatis tersimpan</li>
                    <li>Nilai ≥75% hijau</li>
                    <li>Nilai &lt;75% merah</li>
                </ul>
            </div>
        </div>
    </div>

</div>
<script>
// ============ CONFIGURATION ============
const CONFIG = {
    questionsMap: JSON.parse('{"1":15,"2":12,"3":18,"4":25}'),
    selectedBab: parseInt('{{ $selectedBab }}'),
    autoSaveDelay: 1200,
    successMessageDuration: 2000
};

let questionsCount = parseInt('{{ $questionsCount }}') || (CONFIG.questionsMap[CONFIG.selectedBab] || 10);
let autoSaveTimer = null;
let autoSaveInFlight = false;

// ============ UTILITY FUNCTIONS ============
function computeScore(correct) {
    correct = Number(correct) || 0;
    if (!questionsCount) return 0;
    return Number(((correct / questionsCount) * 100).toFixed(2));
}

function updateRowScore(rowIdx) {
    const correctEl = document.querySelector(`.correct-input[data-row="${rowIdx}"]`);
    const scoreEl = document.querySelector(`.score-display[data-row="${rowIdx}"]`);
    
    if (!correctEl || !scoreEl) return;
    
    let c = Number(correctEl.value) || 0;
    c = Math.max(0, Math.min(c, questionsCount));
    correctEl.value = c;
    
    const score = computeScore(c);
    scoreEl.textContent = score;
    scoreEl.classList.remove('text-green-600', 'text-red-500', 'text-gray-400');
    
    if (c === 0) {
        scoreEl.textContent = '-';
        scoreEl.classList.add('text-gray-400');
    } else if (score >= 75) {
        scoreEl.classList.add('text-green-600');
    } else {
        scoreEl.classList.add('text-red-500');
    }
}

function showMessage(text, type = 'info') {
    const msgEl = document.getElementById('kanji-save-msg');
    if (!msgEl) return;
    
    msgEl.textContent = text;
    msgEl.style.color = type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#666';
}

function clearMessage() {
    const msgEl = document.getElementById('kanji-save-msg');
    if (msgEl) {
        setTimeout(() => {
            msgEl.textContent = '';
            msgEl.style.color = '#666';
        }, CONFIG.successMessageDuration);
    }
}

// ============ DATA COLLECTION ============
function collectTableData() {
    const rows = document.querySelectorAll('tbody tr');
    const payload = [];
    
    rows.forEach((row, idx) => {
        const nameEl = row.querySelector('.name-input');
        const correctEl = row.querySelector('.correct-input');
        const dateEl = row.querySelector('.date-input');
        
        const name = (nameEl?.value || '').trim();
        const correctRaw = correctEl?.value || '';
        const date = dateEl?.value || '';
        const hasCorrect = (correctRaw !== '' && !isNaN(Number(correctRaw)));
        
        // Skip empty rows
        if (!name && !hasCorrect) return;
        
        const correct = hasCorrect ? Number(correctRaw) : 0;
        payload.push({
            name,
            correct,
            date,
            row: idx
        });
    });
    
    return payload;
}

// ============ API CALLS ============
async function saveData(payload) {
    showMessage('💾 Menyimpan...');
    
    try {
        const response = await fetch('{{ route('sensei.penilaian.kanji.save') }}', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ bab: CONFIG.selectedBab, students: payload })
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Gagal menyimpan data');
        }

        // Update summary
        if (data.summary) {
            const total = data.summary.total || 0;
            const lulus = data.summary.lulus || 0;
            const tidakLulus = total - lulus;
            
            document.getElementById('kanji-total').textContent = total;
            document.getElementById('kanji-lulus').textContent = lulus;
            document.getElementById('kanji-percent').textContent = (data.summary.percent || 0) + '%';
            document.getElementById('kanji-tidak-lulus').textContent = tidakLulus;
        }

        return data;
    } catch (error) {
        console.error('Save error:', error);
        throw error;
    }
}

// ============ EVENT HANDLERS ============
document.addEventListener('DOMContentLoaded', function () {
    // Initialize scores on load
    document.querySelectorAll('.correct-input').forEach(inp => {
        updateRowScore(inp.dataset.row);
        
        inp.addEventListener('input', function () {
            updateRowScore(this.dataset.row);
            scheduleAutoSave();
        });
    });

    // Bind other inputs to autosave
    document.querySelectorAll('.name-input, .date-input').forEach(inp => {
        inp.addEventListener('input', scheduleAutoSave);
    });

    // Penilaian selector navigation
    const penilaianSelect = document.querySelector('select[name="penilaian-select"]');
    if (penilaianSelect) {
        penilaianSelect.addEventListener('change', function (e) {
            if (this.value) window.location.href = this.value;
        });
    }

    // BAB selector
    const babSelect = document.getElementById('kanji-bab-select');
    if (babSelect) {
        babSelect.addEventListener('change', function () {
            window.location.href = '{{ route('sensei.penilaian.kanji') }}?bab=' + this.value;
        });
    }

    // Save button
    const saveBtn = document.getElementById('save-kanji');
    if (saveBtn) {
        saveBtn.addEventListener('click', async function () {
            const payload = collectTableData();
            
            if (payload.length === 0) {
                showMessage('⚠️ Tidak ada data untuk disimpan', 'error');
                alert('Isi setidaknya satu baris dengan nama atau jawaban benar.');
                return;
            }

            try {
                saveBtn.disabled = true;
                saveBtn.style.opacity = '0.6';
                
                await saveData(payload);
                showMessage('✅ Berhasil disimpan!', 'success');
                clearMessage();
            } catch (error) {
                showMessage('❌ Gagal: ' + error.message, 'error');
                alert('Gagal menyimpan: ' + error.message);
            } finally {
                saveBtn.disabled = false;
                saveBtn.style.opacity = '1';
            }
        });
    }

    // Reset button
    const resetBtn = document.getElementById('reset-kanji');
    if (resetBtn) {
        resetBtn.addEventListener('click', async function () {
            if (!confirm('Yakin reset data Kanji BAB ' + CONFIG.selectedBab + '?')) return;

            try {
                const response = await fetch('{{ route('sensei.penilaian.kanji.reset') }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({ bab: CONFIG.selectedBab })
                });

                const data = await response.json();
                if (data.success) {
                    showMessage('🔄 Data direset', 'success');
                    setTimeout(() => window.location.reload(), 1500);
                }
            } catch (error) {
                console.error('Reset error:', error);
                alert('Gagal reset data');
            }
        });
    }
});

// ============ AUTOSAVE ============
function scheduleAutoSave() {
    if (autoSaveTimer) clearTimeout(autoSaveTimer);
    autoSaveTimer = setTimeout(autoSaveNow, CONFIG.autoSaveDelay);
}

async function autoSaveNow() {
    if (autoSaveInFlight) return;

    const payload = collectTableData();
    if (payload.length === 0) return;

    autoSaveInFlight = true;
    showMessage('💾 Autosaving...');

    try {
        await saveData(payload);
        showMessage('✅ Tersimpan', 'success');
        clearMessage();
    } catch (error) {
        console.warn('Autosave failed:', error);
        // Silent fail - don't show error for autosave
    } finally {
        autoSaveInFlight = false;
    }
}
</script>
@endsection
