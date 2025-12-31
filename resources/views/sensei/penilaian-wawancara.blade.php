@extends('layouts.header_dashboard_sensei')

@section('content')
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
            <span class="font-semibold text-lg">Penilaian Wawancara : Kelas A2</span>
            <select id="penilaian-wawancara-select" class="bg-white text-black rounded-full px-3 py-1 text-sm border">
                <option value="materi">Penilaian (Materi)</option>
                <option value="sikap">Penilaian (Sikap)</option>
            </select>
        </div>
    </div>

    <!-- Main content: table + summary -->
    <div class="col-span-12 lg:col-span-9">
        <!-- TAB CONTENT: MATERI -->
        <div id="content-materi" class="bg-white rounded-xl p-4 shadow-sm transition-all duration-300 ease-in-out">
            <!-- TOOLBAR -->
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap sticky top-0 z-20 bg-white pb-2">
                <div class="flex items-center gap-2">
                    <button id="save-materi" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-materi" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="materi-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500 font-medium">15 Siswa</div>
            </div>

            <!-- INSTRUCTION -->
            <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Isi nama siswa dan penilaian materi wawancara. Nilai akan otomatis dihitung berdasarkan kriteria. ✓ Hijau (≥75%), ✗ Merah (<75%)</p>
            </div>

            <!-- TABLE CONTAINER -->
            <div class="border rounded-lg overflow-hidden">
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-blue-600 text-white sticky top-0 z-20">
                            <tr>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-12">No</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[300px] sticky left-12 z-10 bg-blue-600">Nama Siswa</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Program</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Umum</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Jepang</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Indo</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-20">Jumlah</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-24">Persen</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-32">Keterangan</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[250px]">Catatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=1;$i<=15;$i++)
                            <tr>
                                <td class="border px-3 py-2 text-center">{{ $i }}</td>
                                <td class="border px-3 py-2"><input type="text" class="w-full text-sm border rounded px-2 py-1 materi-name" data-row="{{ $i-1 }}" placeholder="Nama Siswa"/></td>

                                @for($j=1;$j<=4;$j++)
                                <td class="border px-3 py-2 text-center">
                                    <select class="border rounded px-2 py-1 text-xs materi-select" data-col="{{ $j }}" data-row="{{ $i-1 }}">
                                        <option value=""></option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                                @endfor

                                <td class="border px-3 py-2 text-center"><span class="materi-sum font-semibold" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2 text-center"><span class="materi-percent font-semibold" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2 text-center"><span class="materi-keterangan font-semibold text-sm" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2"><input type="text" class="w-full text-sm border rounded px-2 py-1 materi-note" data-row="{{ $i-1 }}"/></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- TAB CONTENT: SIKAP -->
        <div id="content-sikap" class="bg-white rounded-xl p-4 shadow-sm hidden transition-all duration-300 ease-in-out">
            <!-- TOOLBAR -->
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap sticky top-0 z-20 bg-white pb-2">
                <div class="flex items-center gap-2">
                    <button id="save-sikap" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-sikap" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="sikap-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500 font-medium">15 Siswa</div>
            </div>

            <!-- INSTRUCTION -->
            <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Isi nama siswa dan penilaian sikap wawancara. Nilai akan otomatis dihitung berdasarkan kriteria. ✓ Hijau (≥75%), ✗ Merah (<75%)</p>
            </div>

            <!-- TABLE CONTAINER -->
            <div class="border rounded-lg overflow-hidden">
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-blue-600 text-white sticky top-0 z-20">
                            <tr>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-12">No</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[300px] sticky left-12 z-10 bg-blue-600">Nama Siswa</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Cara Duduk</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Suara</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">Fokus</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-20">Jumlah</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-24">Persen</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-32">Keterangan</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[250px]">Catatan</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=1;$i<=15;$i++)
                            <tr>
                                <td class="border px-3 py-2 text-center">{{ $i }}</td>
                                <td class="border px-3 py-2"><input type="text" class="w-full text-sm border rounded px-2 py-1 sikap-name" data-row="{{ $i-1 }}" placeholder="Nama Siswa"/></td>

                                @for($j=1;$j<=3;$j++)
                                <td class="border px-3 py-2 text-center">
                                    <select class="border rounded px-2 py-1 text-xs sikap-select" data-col="{{ $j }}" data-row="{{ $i-1 }}">
                                        <option value=""></option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </td>
                                @endfor

                                <td class="border px-3 py-2 text-center"><span class="sikap-sum font-semibold" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2 text-center"><span class="sikap-percent font-semibold" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2 text-center"><span class="sikap-keterangan font-semibold text-sm" data-row="{{ $i-1 }}"></span></td>
                                <td class="border px-3 py-2"><input type="text" class="w-full text-sm border rounded px-2 py-1 sikap-note" data-row="{{ $i-1 }}"/></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            
    </div>
    
</div>
<div class="col-span-12 lg:col-span-3">
        <div class="bg-white rounded-xl p-4">
            <h3 class="font-semibold mb-3 text-base">📋 Pedoman Penilaian</h3>
            <div class="bg-gray-50 rounded p-3 text-xs text-gray-700 space-y-2">
                <div class="flex justify-between"><span>Kurang</span><span class="font-semibold">1</span></div>
                <div class="flex justify-between"><span>Cukup</span><span class="font-semibold">2</span></div>
                <div class="flex justify-between"><span>Baik</span><span class="font-semibold">3</span></div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-3">
        <div class="bg-white rounded-xl p-4 h-fit sticky" style="top: 280px;">
            <h3 class="font-semibold mb-3 text-base">📋 Tabel Keterangan</h3>
            <div class="border rounded-lg overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="border border-gray-300 px-3 py-2 text-left font-semibold">Keterangan</th>
                            <th class="border border-gray-300 px-3 py-2 text-center font-semibold">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">Sangat menguasai</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-green-600">90%-100%</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">Menguasai</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-blue-600">80%-89%</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">Cukup</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-yellow-600">70%-79%</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">Kurang</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-orange-600">50%-69%</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-3 py-2">Sangat kurang</td>
                            <td class="border border-gray-300 px-3 py-2 text-center font-semibold text-red-600">0%-49%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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

/* Smooth tab content transitions */
#content-materi,
#content-sikap {
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
}

#content-materi.hidden,
#content-sikap.hidden {
    display: none;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Tab switching dengan select
    const selectPenilaian = document.getElementById('penilaian-wawancara-select');
    const contentMateri = document.getElementById('content-materi');
    const contentSikap = document.getElementById('content-sikap');

    if(selectPenilaian) {
        selectPenilaian.addEventListener('change', function() {
            if(this.value === 'materi') {
                // Show materi
                contentSikap.style.opacity = '0';
                setTimeout(() => {
                    contentSikap.classList.add('hidden');
                    contentMateri.classList.remove('hidden');
                    contentMateri.style.opacity = '0';
                    // Trigger reflow
                    void contentMateri.offsetWidth;
                    contentMateri.style.opacity = '1';
                }, 150);
            } else if(this.value === 'sikap') {
                // Show sikap
                contentMateri.style.opacity = '0';
                setTimeout(() => {
                    contentMateri.classList.add('hidden');
                    contentSikap.classList.remove('hidden');
                    contentSikap.style.opacity = '0';
                    // Trigger reflow
                    void contentSikap.offsetWidth;
                    contentSikap.style.opacity = '1';
                }, 150);
            }
        });
    }

    // Safe getter: accepts an element or a primitive and returns a number (0 if missing/invalid)
    function getVal(el) {
        if (!el) return 0;
        const raw = (typeof el === 'object' && 'value' in el) ? el.value : el;
        const v = Number(raw);
        return isNaN(v) ? 0 : v;
    }

    // Helper to calculate keterangan
    function getKeterangan(percent) {
        if(percent < 50) return { text: 'SANGAT KURANG', css: 'text-red-600' };
        if(percent < 70) return { text: 'KURANG', css: 'text-orange-600' };
        if(percent < 80) return { text: 'CUKUP', css: 'text-yellow-600' };
        if(percent < 90) return { text: 'MENGUASAI', css: 'text-blue-600' };
        return { text: 'SANGAT MENGUASAI', css: 'text-green-600' };
    }

    // MATERI computation
    const MAX_SUM_MATERI = 12; // 4 fields x max 3 each
    function computeRowMateri(rowIdx) {
        const cols = Array.from(document.querySelectorAll('.materi-select[data-row="'+rowIdx+'"]'));
        if(!cols || cols.length === 0) return { sum: 0, percent: 0 };
        const vals = cols.map(c => getVal(c));
        const sum = vals.reduce((a,b) => a+b, 0);
        const percent = MAX_SUM_MATERI ? Number(((sum / MAX_SUM_MATERI) * 100).toFixed(2)) : 0;
        
        const sumEl = document.querySelector('.materi-sum[data-row="'+rowIdx+'"]');
        const pctEl = document.querySelector('.materi-percent[data-row="'+rowIdx+'"]');
        const ketEl = document.querySelector('.materi-keterangan[data-row="'+rowIdx+'"]');
        
        if(sumEl) sumEl.textContent = sum;
        if(pctEl) {
            pctEl.textContent = percent + '%';
            pctEl.classList.remove('text-green-600','text-red-500');
            if(percent >= 75) pctEl.classList.add('text-green-600'); else pctEl.classList.add('text-red-500');
        }
        if(ketEl) {
            const ket = getKeterangan(percent);
            ketEl.textContent = ket.text;
            ketEl.classList.remove('text-red-600','text-orange-600','text-yellow-600','text-blue-600','text-green-600');
            ketEl.classList.add(ket.css);
        }
        return { sum, percent };
    }

    // SIKAP computation
    const MAX_SUM_SIKAP = 9; // 3 fields x max 3 each
    function computeRowSikap(rowIdx) {
        const cols = Array.from(document.querySelectorAll('.sikap-select[data-row="'+rowIdx+'"]'));
        if(!cols || cols.length === 0) return { sum: 0, percent: 0 };
        const vals = cols.map(c => getVal(c));
        const sum = vals.reduce((a,b) => a+b, 0);
        const percent = MAX_SUM_SIKAP ? Number(((sum / MAX_SUM_SIKAP) * 100).toFixed(2)) : 0;
        
        const sumEl = document.querySelector('.sikap-sum[data-row="'+rowIdx+'"]');
        const pctEl = document.querySelector('.sikap-percent[data-row="'+rowIdx+'"]');
        const ketEl = document.querySelector('.sikap-keterangan[data-row="'+rowIdx+'"]');
        
        if(sumEl) sumEl.textContent = sum;
        if(pctEl) {
            pctEl.textContent = percent + '%';
            pctEl.classList.remove('text-green-600','text-red-500');
            if(percent >= 75) pctEl.classList.add('text-green-600'); else pctEl.classList.add('text-red-500');
        }
        if(ketEl) {
            const ket = getKeterangan(percent);
            ketEl.textContent = ket.text;
            ketEl.classList.remove('text-red-600','text-orange-600','text-yellow-600','text-blue-600','text-green-600');
            ketEl.classList.add(ket.css);
        }
        return { sum, percent };
    }

    // Live compute for Materi
    document.querySelectorAll('.materi-select').forEach(s => {
        s.addEventListener('change', function () { computeRowMateri(Number(s.dataset.row)); });
        computeRowMateri(Number(s.dataset.row));
    });

    // Live compute for Sikap
    document.querySelectorAll('.sikap-select').forEach(s => {
        s.addEventListener('change', function () { computeRowSikap(Number(s.dataset.row)); });
        computeRowSikap(Number(s.dataset.row));
    });

    // Save Materi
    const saveMateriBtn = document.getElementById('save-materi');
    if(saveMateriBtn) {
        saveMateriBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const rows = [];
            document.querySelectorAll('#content-materi tbody tr').forEach((tr, idx) => {
                const rowIdx = Number(((tr.querySelector('.materi-select') || { dataset: { row: idx } }).dataset || {}).row || idx);
                const { sum, percent } = computeRowMateri(rowIdx);
                const name = (tr.querySelector('.materi-name') || {value:''}).value.trim();
                const program = getVal(tr.querySelector('.materi-select[data-col="1"]'));
                const umum = getVal(tr.querySelector('.materi-select[data-col="2"]'));
                const jepang = getVal(tr.querySelector('.materi-select[data-col="3"]'));
                const indo = getVal(tr.querySelector('.materi-select[data-col="4"]'));
                const note = (tr.querySelector('.materi-note') || {value:''}).value.trim();
                if(name || program || umum || jepang || indo || note) {
                    rows.push({ row: rowIdx, name, program, umum, jepang, indo, sum, percent, note });
                }
            });

            if(rows.length === 0) { alert('Tidak ada data untuk disimpan.'); return; }

            const msg = document.getElementById('materi-save-msg');
            if(msg) msg.textContent = 'Menyimpan...';
            fetch('{{ route('sensei.penilaian.wawancara.save') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ type: 'materi', students: rows })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    alert('Data Materi disimpan. Tersimpan: ' + (res.saved || 0) + ' siswa.');
                    if(msg) msg.textContent = 'Tersimpan.'; 
                    setTimeout(() => { if(msg) msg.textContent = ''; }, 1200);
                } else {
                    alert('Gagal menyimpan: ' + (res.message || 'server error'));
                    if(msg) msg.textContent = 'Gagal menyimpan';
                }
            }).catch(err => { console.error(err); alert('Gagal menyimpan (network).'); if(msg) msg.textContent = 'Gagal (network)'; });
        });
    }

    // Reset Materi
    const resetMateriBtn = document.getElementById('reset-materi');
    if(resetMateriBtn) {
        resetMateriBtn.addEventListener('click', function () {
            if(!confirm('Reset data Materi tersimpan?')) return;
            fetch('{{ route('sensei.penilaian.wawancara.reset') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ type: 'materi' })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    document.querySelectorAll('#content-materi .materi-name').forEach(n => n.value = '');
                    document.querySelectorAll('#content-materi .materi-select').forEach(s => { s.value = ''; computeRowMateri(Number(s.dataset.row)); });
                    document.querySelectorAll('#content-materi .materi-note').forEach(n => n.value = '');
                    window.location.reload();
                }
            });
        });
    }

    // Save Sikap
    const saveSikapBtn = document.getElementById('save-sikap');
    if(saveSikapBtn) {
        saveSikapBtn.addEventListener('click', function (e) {
            e.preventDefault();
            const rows = [];
            document.querySelectorAll('#content-sikap tbody tr').forEach((tr, idx) => {
                const rowIdx = Number(((tr.querySelector('.sikap-select') || { dataset: { row: idx } }).dataset || {}).row || idx);
                const { sum, percent } = computeRowSikap(rowIdx);
                const name = (tr.querySelector('.sikap-name') || {value:''}).value.trim();
                const cara_duduk = getVal(tr.querySelector('.sikap-select[data-col="1"]'));
                const suara = getVal(tr.querySelector('.sikap-select[data-col="2"]'));
                const fokus = getVal(tr.querySelector('.sikap-select[data-col="3"]'));
                const note = (tr.querySelector('.sikap-note') || {value:''}).value.trim();
                if(name || cara_duduk || suara || fokus || note) {
                    rows.push({ row: rowIdx, name, cara_duduk, suara, fokus, sum, percent, note });
                }
            });

            if(rows.length === 0) { alert('Tidak ada data untuk disimpan.'); return; }

            const msg = document.getElementById('sikap-save-msg');
            if(msg) msg.textContent = 'Menyimpan...';
            fetch('{{ route('sensei.penilaian.wawancara.save') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ type: 'sikap', students: rows })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    alert('Data Sikap disimpan. Tersimpan: ' + (res.saved || 0) + ' siswa.');
                    if(msg) msg.textContent = 'Tersimpan.'; 
                    setTimeout(() => { if(msg) msg.textContent = ''; }, 1200);
                } else {
                    alert('Gagal menyimpan: ' + (res.message || 'server error'));
                    if(msg) msg.textContent = 'Gagal menyimpan';
                }
            }).catch(err => { console.error(err); alert('Gagal menyimpan (network).'); if(msg) msg.textContent = 'Gagal (network)'; });
        });
    }

    // Reset Sikap
    const resetSikapBtn = document.getElementById('reset-sikap');
    if(resetSikapBtn) {
        resetSikapBtn.addEventListener('click', function () {
            if(!confirm('Reset data Sikap tersimpan?')) return;
            fetch('{{ route('sensei.penilaian.wawancara.reset') }}', {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'X-Requested-With': 'XMLHttpRequest' },
                body: JSON.stringify({ type: 'sikap' })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    document.querySelectorAll('#content-sikap .sikap-name').forEach(n => n.value = '');
                    document.querySelectorAll('#content-sikap .sikap-select').forEach(s => { s.value = ''; computeRowSikap(Number(s.dataset.row)); });
                    document.querySelectorAll('#content-sikap .sikap-note').forEach(n => n.value = '');
                    window.location.reload();
                }
            });
        });
    }
});
</script>
@endsection
