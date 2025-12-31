@extends('layouts.header_dashboard_sensei')

@section('content')
@php
    $saved = session('penilaian_nilai_akhir') ?? null;
    if(is_array($saved) && count($saved)) { $rows = $saved; }
    else { $rows = array_fill(0, 30, ['name'=>'','hiragana'=>'','katakana'=>'','bunpou'=>'','kerja'=>'','sifat'=>'','benda'=>'','terjemah'=>'','dengar'=>'','bicara'=>'','sikap'=>'','kehadiran'=>'']); }
    $summary = session('penilaian_nilai_akhir_summary', ['total'=>0,'lulus'=>0,'percent'=>0]);
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
                        <select name="penilaian-select" onchange="if(this.value) window.location.href=this.value" class="bg-green-500 text-white rounded-full px-4 py-1 text-sm border-0">
                            <option value="{{ route('sensei.penilaian.presensi') }}" {{ Route::currentRouteName() === 'sensei.penilaian.presensi' ? 'selected' : '' }}>Penilaian : Presensi Siswa</option>
                             <option value="{{ route('sensei.penilaian.bunpou') }}" {{ Route::currentRouteName() === 'sensei.penilaian.bunpou' ? 'selected' : '' }}>Penilaian : Bunpou</option>
                            <option value="{{ route('sensei.penilaian.kanji') }}" {{ Route::currentRouteName() === 'sensei.penilaian.kanji' ? 'selected' : '' }}>Penilaian : Kanji</option>
                            <option value="{{ route('sensei.penilaian.kotoba') }}" {{ Route::currentRouteName() === 'sensei.penilaian.kotoba' ? 'selected' : '' }}>Penilaian : Kotoba</option>
                            <option value="{{ route('sensei.penilaian.fmd') }}" {{ Route::currentRouteName() === 'sensei.penilaian.fmd' ? 'selected' : '' }}>Penilaian : FMD</option>
                            <option value="{{ route('sensei.penilaian.wawancara') }}" {{ Route::currentRouteName() === 'sensei.penilaian.wawancara' ? 'selected' : '' }}>Penilaian : Wawancara</option>
                            <option value="{{ route('sensei.penilaian.nilai-akhir') }}" {{ Route::currentRouteName() === 'sensei.penilaian.nilai-akhir' ? 'selected' : '' }}>Penilaian : Nilai Akhir</option>
                        </select>
                </div>
            </div>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5h18M6 12h12M10 19h4"/></svg>
        </div>

        <!-- SUB HEADER -->
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <span class="font-semibold text-lg">Penilaian Nilai Akhir : Kelas A2</span>
        </div>
    </div>

    <!-- Main content: table + summary -->
    <div class="col-span-12 lg:col-span-9">
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <!-- TOOLBAR -->
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap sticky top-0 z-20 bg-white pb-2">
                <div class="flex items-center gap-2">
                    <button id="save-nilai-akhir" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-nilai-akhir" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="nilai-akhir-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500 font-medium">30 Siswa</div>
            </div>

            <!-- INSTRUCTION -->
            <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Isi nama siswa dan nilai setiap pelajaran. Grade akan otomatis dihitung berdasarkan formula.</p>
            </div>

            <!-- TABLE CONTAINER -->
            <div class="border rounded-lg overflow-hidden">
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm">
                        <thead>
                            <tr class="bg-blue-600 text-white sticky top-0 z-20">
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-12">No</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[400px] sticky left-12 z-10 bg-blue-600">Nama Siswa</th>
                                
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Hiragana</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Katakana</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Bunpou</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Kerja</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Sifat</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Benda</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Terjemah</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Dengar</th>
                                <th colspan="2" class="border border-gray-400 px-2 py-2 text-center font-semibold">Bicara</th>
                                
                                <th class="border border-gray-400 px-2 py-2 text-center font-semibold w-16">Sikap</th>
                                <th class="border border-gray-400 px-2 py-2 text-center font-semibold w-20">Kehadiran</th>
                                <th class="border border-gray-400 px-2 py-2 text-center font-semibold w-20">Rata-rata</th>
                                <th class="border border-gray-400 px-2 py-2 text-center font-semibold w-14">Grade</th>
                            </tr>
                            <tr class="bg-blue-100 sticky top-12 z-20">
                                <th colspan="2" class="border border-gray-300 px-2 py-1"></th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">N</th>
                                <th class="border border-gray-300 px-1 py-1 text-center text-xs font-semibold">G</th>
                                
                                <th colspan="4" class="border border-gray-300 px-1 py-1"></th>
                            </tr>
                        </thead>
                            
                        </thead>
                        <tbody>
                            @foreach($rows as $idx => $r)
                            <tr class="hover:bg-blue-50 transition border-b border-gray-300">
                                <td class="border border-gray-300 px-3 py-2 text-center text-gray-600 font-medium bg-gray-50">{{ $idx + 1 }}</td>
                                <td class="border border-gray-300 px-3 py-2 sticky left-12 z-10 bg-white hover:bg-blue-50">
                                    <input 
                                        type="text" 
                                        class="w-full name-input border border-gray-300 rounded px-2 py-1 text-xs focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                        placeholder="Nama..." 
                                        value="{{ $r['name'] ?? '' }}" 
                                        data-row="{{ $idx }}"
                                    />
                                </td>
                                
                                <!-- HIRAGANA -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['hiragana'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="hiragana"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-hiragana" data-row="{{ $idx }}">{{ $r['grade_hiragana'] ?? '-' }}</span>
                                </td>
                                
                                <!-- KATAKANA -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['katakana'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="katakana"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-katakana" data-row="{{ $idx }}">{{ $r['grade_katakana'] ?? '-' }}</span>
                                </td>
                                
                                <!-- BUNPOU -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['bunpou'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="bunpou"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-bunpou" data-row="{{ $idx }}">{{ $r['grade_bunpou'] ?? '-' }}</span>
                                </td>
                                
                                <!-- KERJA -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['kerja'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="kerja"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-kerja" data-row="{{ $idx }}">{{ $r['grade_kerja'] ?? '-' }}</span>
                                </td>
                                
                                <!-- SIFAT -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['sifat'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="sifat"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-sifat" data-row="{{ $idx }}">{{ $r['grade_sifat'] ?? '-' }}</span>
                                </td>
                                
                                <!-- BENDA -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['benda'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="benda"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-benda" data-row="{{ $idx }}">{{ $r['grade_benda'] ?? '-' }}</span>
                                </td>
                                
                                <!-- TERJEMAH -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['terjemah'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="terjemah"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-terjemah" data-row="{{ $idx }}">{{ $r['grade_terjemah'] ?? '-' }}</span>
                                </td>
                                
                                <!-- DENGAR -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['dengar'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="dengar"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-dengar" data-row="{{ $idx }}">{{ $r['grade_dengar'] ?? '-' }}</span>
                                </td>
                                
                                <!-- BICARA -->
                                <td class="border border-gray-300 px-2 py-2 min-w-[65px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="0" 
                                        value="{{ $r['bicara'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="bicara"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[50px] text-center font-semibold text-sm">
                                    <span class="grade-bicara" data-row="{{ $idx }}">{{ $r['grade_bicara'] ?? '-' }}</span>
                                </td>
                                
                                <td class="border border-gray-300 px-2 py-2 min-w-[60px]">
                                    <input 
                                        type="text" 
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="A-D" 
                                        value="{{ $r['sikap'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="sikap"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[70px]">
                                    <input 
                                        type="number" 
                                        min="0" max="100"
                                        class="w-full nilai-input border border-gray-300 rounded px-2 py-1 text-xs text-center focus:outline-none focus:ring-1 focus:ring-blue-400" 
                                        placeholder="%" 
                                        value="{{ $r['kehadiran'] ?? '' }}" 
                                        data-row="{{ $idx }}" data-col="kehadiran"
                                    />
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[70px] text-center font-bold text-sm bg-blue-50">
                                    <span class="rata-rata-display" data-row="{{ $idx }}">{{ isset($r['rata_rata']) ? number_format($r['rata_rata'], 2) : '-' }}</span>
                                </td>
                                <td class="border border-gray-300 px-2 py-2 min-w-[60px] text-center font-bold text-sm bg-blue-50">
                                    <span class="grade-display" data-row="{{ $idx }}">{{ $r['grade'] ?? '-' }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Summary column -->
    <div class="col-span-12 lg:col-span-3">
        <div class="bg-white rounded-xl p-4">
            <h3 class="font-semibold mb-4 text-base">📊 Ringkasan</h3>
            <div class="space-y-3">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-500">
                    <p class="text-gray-600 text-sm">Total Siswa</p>
                    <p class="text-2xl font-bold text-blue-600" id="nilai-akhir-total">{{ $summary['total'] }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded border-l-4 border-green-500">
                    <p class="text-gray-600 text-sm">Siswa Lolos (≥75%)</p>
                    <p class="text-2xl font-bold text-green-600" id="nilai-akhir-lulus">{{ $summary['lulus'] }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded border-l-4 border-yellow-500">
                    <p class="text-gray-600 text-sm">Presentase Kelolosan</p>
                    <p class="text-2xl font-bold text-yellow-600" id="nilai-akhir-percent">{{ $summary['percent'] }}%</p>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
// ============ CONFIG ============
const CONFIG = {
    autoSaveDelay: 1200,
    successMessageDuration: 2000
};

let autoSaveTimer = null;
let autoSaveInFlight = false;

// ============ UTILITY FUNCTIONS ============
function calculateGrade(nilai) {
    nilai = Number(nilai) || 0;
    if (nilai >= 90) return 'A';
    if (nilai >= 85) return 'B+';
    if (nilai >= 80) return 'B';
    if (nilai >= 75) return 'C+';
    if (nilai >= 10) return 'C';
    return 'TU';
}

function updateSubjectGrade(rowIdx, subject) {
    const input = document.querySelector(`.nilai-input[data-row="${rowIdx}"][data-col="${subject}"]`);
    if (!input) return;
    
    const nilai = Number(input.value) || 0;
    const grade = nilai === 0 ? '-' : calculateGrade(nilai);
    
    const displayEl = document.querySelector(`.grade-${subject}[data-row="${rowIdx}"]`);
    if (displayEl) {
        displayEl.textContent = grade;
    }
}

function calculateRataRata(rowIdx) {
    const subjects = ['hiragana', 'katakana', 'bunpou', 'kerja', 'sifat', 'benda', 'terjemah', 'dengar', 'bicara'];
    let total = 0;
    let count = 0;
    
    // Update grade untuk setiap subject dan hitung rata-rata
    subjects.forEach(subject => {
        updateSubjectGrade(rowIdx, subject);
        
        const input = document.querySelector(`.nilai-input[data-row="${rowIdx}"][data-col="${subject}"]`);
        if (input && input.value) {
            total += Number(input.value) || 0;
            count++;
        }
    });
    
    const rataRata = count > 0 ? total / count : 0;
    
    // Update display
    const displayEl = document.querySelector(`.rata-rata-display[data-row="${rowIdx}"]`);
    if (displayEl) {
        displayEl.textContent = rataRata === 0 ? '-' : rataRata.toFixed(2);
    }
    
    // Update grade akhir
    const gradeEl = document.querySelector(`.grade-display[data-row="${rowIdx}"]`);
    if (gradeEl) {
        gradeEl.textContent = rataRata === 0 ? '-' : calculateGrade(rataRata);
    }
    
    return rataRata;
}

function showMessage(text, type = 'info') {
    const msgEl = document.getElementById('nilai-akhir-save-msg');
    if (!msgEl) return;
    
    msgEl.textContent = text;
    msgEl.style.color = type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#666';
}

function clearMessage() {
    const msgEl = document.getElementById('nilai-akhir-save-msg');
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
        const name = (nameEl?.value || '').trim();
        
        const subjects = ['hiragana', 'katakana', 'bunpou', 'kerja', 'sifat', 'benda', 'terjemah', 'dengar', 'bicara', 'sikap', 'kehadiran'];
        const data = { name, row: idx };
        let hasContent = name !== '';
        
        subjects.forEach(subject => {
            const input = row.querySelector(`.nilai-input[data-col="${subject}"]`);
            const value = input?.value || '';
            data[subject] = value;
            if (value) hasContent = true;
            
            // Include grade for numeric subjects
            if (subject !== 'sikap' && subject !== 'kehadiran') {
                const gradeEl = row.querySelector(`.grade-${subject}`);
                const grade = gradeEl?.textContent || '-';
                data[`grade_${subject}`] = grade;
            }
        });
        
        if (!hasContent) return;
        payload.push(data);
    });
    
    return payload;
}

// ============ API CALLS ============
async function saveData(payload) {
    showMessage('💾 Menyimpan...');
    
    try {
        const response = await fetch('{{ route('sensei.penilaian.nilai-akhir.save') }}', {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ students: payload })
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Gagal menyimpan data');
        }

        // Update summary
        if (data.summary) {
            document.getElementById('nilai-akhir-total').textContent = data.summary.total || 0;
            document.getElementById('nilai-akhir-lulus').textContent = data.summary.lulus || 0;
            document.getElementById('nilai-akhir-percent').textContent = (data.summary.percent || 0) + '%';
        }

        return data;
    } catch (error) {
        console.error('Save error:', error);
        throw error;
    }
}

// ============ EVENT HANDLERS ============
document.addEventListener('DOMContentLoaded', function () {
    // Initialize rata-rata on load
    document.querySelectorAll('.nilai-input').forEach(inp => {
        inp.addEventListener('input', function () {
            calculateRataRata(this.dataset.row);
            scheduleAutoSave();
        });
    });

    // Bind name input to autosave
    document.querySelectorAll('.name-input').forEach(inp => {
        inp.addEventListener('input', scheduleAutoSave);
    });

    // Initialize all rows
    for (let i = 0; i < 30; i++) {
        calculateRataRata(i);
    }

    // Save button
    const saveBtn = document.getElementById('save-nilai-akhir');
    if (saveBtn) {
        saveBtn.addEventListener('click', async function () {
            const payload = collectTableData();
            
            if (payload.length === 0) {
                showMessage('⚠️ Tidak ada data untuk disimpan', 'error');
                alert('Isi setidaknya satu baris dengan nama atau nilai.');
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
    const resetBtn = document.getElementById('reset-nilai-akhir');
    if (resetBtn) {
        resetBtn.addEventListener('click', async function () {
            if (!confirm('Yakin reset semua data Nilai Akhir?')) return;

            try {
                const response = await fetch('{{ route('sensei.penilaian.nilai-akhir.reset') }}', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
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

    // Penilaian selector navigation
    const penilaianSelect = document.querySelector('select[name="penilaian-select"]');
    if (penilaianSelect) {
        penilaianSelect.addEventListener('change', function (e) {
            if (this.value) window.location.href = this.value;
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
    } finally {
        autoSaveInFlight = false;
    }
}
</script>

<style>
/* Custom scrollbar styling */
.scrollbar-visible::-webkit-scrollbar {
    height: 12px;
}

.scrollbar-visible::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 6px;
}

.scrollbar-visible::-webkit-scrollbar-thumb {
    background: #3b82f6;
    border-radius: 6px;
    border: 2px solid #f3f4f6;
}

.scrollbar-visible::-webkit-scrollbar-thumb:hover {
    background: #2563eb;
}
</style>

@endsection
