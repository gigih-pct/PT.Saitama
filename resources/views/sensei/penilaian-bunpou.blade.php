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
                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm flex items-center gap-2">
                    <span>Bulan : Oktober</span>
                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8l4 4 4-4"/></svg>
                </span>
            </div>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5h18M6 12h12M10 19h4"/></svg>
        </div>

        <!-- SUB HEADER -->
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="font-semibold">Penilaian Bunpou : Kelas A2</span>
            </div>
        </div>
    </div>

    
    <!-- Main content: table + summary -->
    <div class="col-span-12 lg:col-span-9">
        <div class="bg-white rounded-xl p-4">
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <button id="save-bunpou" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-bunpou" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="bunpou-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500">20 Siswa</div>
            </div>
            <!-- INSTRUCTION BOX -->
    <div class="col-span-12 lg:col-span-9">
        <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
            <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Masukkan Nama dan nilai Evaluasi 1/2 secara manual. Nilai >=75 berwarna hijau.</p>
        </div>
    </div>


            <div class="border rounded-lg overflow-hidden">
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm">
                        <thead class="bg-blue-600 text-white sticky top-0 z-20">
                            <tr>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-12">NO</th>
                                <th class="border border-gray-400 px-3 py-2 text-left font-semibold min-w-[300px]">Nama Siswa</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-32">Evaluasi 1</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-32">Evaluasi 2</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold w-40">Tanggal</th>
                            </tr>
                        </thead>

                    <tbody>
                        @php
                            $saved = session('penilaian_bunpou');
                            if(is_array($saved) && count($saved)) {
                                $rows = $saved;
                            } else {
                                $rows = array_fill(0, 20, ['name'=>'','eval1'=>'','eval2'=>'','date'=>'']);
                            }
                        @endphp

                        @foreach($rows as $i => $r)
                        <tr class="hover:bg-blue-50 transition border-b border-gray-300">
                            <td class="border border-gray-400 px-3 py-2 text-center bg-gray-50">{{ $loop->index + 1 }}</td>
                            <td class="border px-3 py-2">
                                    <input 
                                        type="text" 
                                        class="w-full name-input border rounded px-2 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400" 
                                        placeholder="Ketik nama siswa..." 
                                        value="{{ $r['name'] ?? '' }}" 
                                        data-row="{{ $loop->index }}"
                                    />
                                </td>

                            <td class="border border-gray-400 text-center bg-blue-50">
                                <input type="number" min="0" max="100" class="eval-input eval1 border rounded px-3 py-1 text-sm text-center w-full text-center" value="{{ $r['eval1'] ?? '' }}" data-row="{{ $loop->index }}" />
                            </td>

                            <td class="border border-gray-400 text-center bg-blue-50">
                                <input type="number" min="0" max="100" class="eval-input eval2 border rounded px-3 py-1 text-sm text-center w-full text-center" value="{{ $r['eval2'] ?? '' }}" data-row="{{ $loop->index }}" />
                            </td>

                            <td class="border border-gray-400 text-center">
                                <input type="date" class="border rounded px-2 py-1 text-sm date-input w-full" value="{{ $r['date'] ?? '' }}" data-row="{{ $loop->index }}">
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
            @php
                $summary = session('penilaian_bunpou_summary') ?? ['total' => 0, 'lulus' => 0, 'percent' => 0];
            @endphp
            <div class="space-y-3">
                <div class="bg-blue-50 p-3 rounded border-l-4 border-blue-500">
                    <p class="text-gray-600 text-sm">Total Siswa</p>
                    <p class="text-2xl font-bold text-blue-600" id="bun-total">{{ $summary['total'] }}</p>
                </div>
                <div class="bg-green-50 p-3 rounded border-l-4 border-green-500">
                    <p class="text-gray-600 text-sm">Siswa Lolos (≥75%)</p>
                    <p class="text-2xl font-bold text-green-600" id="bun-lulus">{{ $summary['lulus'] }}</p>
                </div>
                <div class="bg-yellow-50 p-3 rounded border-l-4 border-yellow-500">
                    <p class="text-gray-600 text-sm">Presentase Kelolosan</p>
                    <p class="text-2xl font-bold text-yellow-600" id="bun-percent">{{ $summary['percent'] }}%</p>
                </div>
            </div>
        </div>
    </div>


</div>

<style>
/* bunpou input coloring */
.eval-pass { background: #10b981; color: #fff; }
.eval-fail { background: #ef4444; color: #fff; }
.eval-neutral { background: transparent; color: inherit; }

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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const p = document.querySelector('select[name="penilaian-select"]');
    if (p) {
        p.addEventListener('change', function (e) {
            const url = e.target.value;
            if (url) window.location.href = url;
        });
    }

    const csrf = '{{ csrf_token() }}';

    function updateInputColor(input) {
        const v = input.value === '' ? null : Number(input.value);
        input.classList.remove('eval-pass','eval-fail','eval-neutral');
        if(v === null || isNaN(v) || input.value === '') {
            input.classList.add('eval-neutral');
        } else if (v >= 75) {
            input.classList.add('eval-pass');
        } else {
            input.classList.add('eval-fail');
        }
    }

    // initialize colors
    document.querySelectorAll('.eval-input').forEach(inp => updateInputColor(inp));

    // live color on input
    document.querySelectorAll('.eval-input').forEach(inp => {
        inp.addEventListener('input', function () { updateInputColor(inp); });
        inp.addEventListener('blur', function () { updateInputColor(inp); });
    });

    // Save handler
    const saveBtn = document.getElementById('save-bunpou');
    if(saveBtn) {
        saveBtn.addEventListener('click', function () {
            const rows = document.querySelectorAll('tbody tr');
            const payload = [];
            rows.forEach((row, idx) => {
                const name = (row.querySelector('.name-input') || {value:''}).value.trim();
                if(!name) return; // skip empty
                const eval1 = (row.querySelector('.eval1') || {value:''}).value;
                const eval2 = (row.querySelector('.eval2') || {value:''}).value;
                const date = (row.querySelector('.date-input') || {value:''}).value;
                payload.push({ name, eval1: eval1 === '' ? null : Number(eval1), eval2: eval2 === '' ? null : Number(eval2), date });
            });

            fetch('{{ route('sensei.penilaian.bunpou.save') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify({ students: payload })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    const s = res.summary || { total:0, lulus:0, percent:0 };
                    document.getElementById('bun-total').textContent = s.total;
                    document.getElementById('bun-lulus').textContent = s.lulus;
                    document.getElementById('bun-percent').textContent = (s.percent || 0) + '%';
                    const msg = document.getElementById('bunpou-save-msg');
                    if(msg) msg.textContent = 'Tersimpan.';
                    setTimeout(() => { if(msg) msg.textContent = ''; }, 1200);
                    alert('Data Bunpou disimpan. Tersimpan: ' + (res.saved || 0) + ' siswa.');
                } else {
                    alert('Gagal menyimpan.');
                }
            }).catch(err => { console.error(err); alert('Gagal menyimpan (network).'); });
        });
    }

    // Reset
    const resetBtn = document.getElementById('reset-bunpou');
    if(resetBtn) {
        resetBtn.addEventListener('click', function () {
            if(!confirm('Reset data Bunpou tersimpan?')) return;
            fetch('{{ route('sensei.penilaian.bunpou.reset') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf } })
            .then(r => r.json()).then(res => {
                if(res.success) {
                    // clear inputs
                    document.querySelectorAll('.name-input').forEach(i => i.value = '');
                    document.querySelectorAll('.eval-input').forEach(i => { i.value = ''; updateInputColor(i); });
                    document.querySelectorAll('.date-input').forEach(i => i.value = '');
                    document.getElementById('bun-total').textContent = '0';
                    document.getElementById('bun-lulus').textContent = '0';
                    document.getElementById('bun-percent').textContent = '0%';
                    window.location.reload();
                }
            });
        });
    }

});
</script>
@endsection
