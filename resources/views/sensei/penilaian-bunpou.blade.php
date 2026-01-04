@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian Bunpou')

@section('content')
@php
    $users = $students ?? [];
    $rows = $savedScores ?? [];
    $stats = $summary ?? ['total'=>0, 'lulus'=>0, 'percent'=>0];
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian Bunpou
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
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Evaluasi pemahaman tata bahasa Jepang</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
             <div class="bg-gray-100 p-1 rounded-2xl flex items-center shadow-inner overflow-x-auto max-w-[600px] no-scrollbar">
                @foreach(range(1, 6) as $i)
                <a href="{{ route('sensei.penilaian.bunpou', ['eva'=>$i]) }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wide whitespace-nowrap transition-all {{ $evaParam == (string)$i ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">Eva {{ $i }}</a>
                @endforeach
                <div class="w-px h-6 bg-gray-200 mx-2"></div>
                <a href="{{ route('sensei.penilaian.bunpou', ['eva'=>'final']) }}" class="px-5 py-2 rounded-xl text-xs font-black uppercase tracking-wide whitespace-nowrap transition-all {{ $evaParam == 'final' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">Final</a>
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
                    <span id="save-msg" class="text-sm font-bold ml-2"></span>
                </div>
                <div class="px-4 py-2 bg-white rounded-xl border border-gray-100 text-xs font-bold text-gray-500 shadow-sm">
                    Passing Grade: 75
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden flex-1 shadow-sm relative">
                <div class="overflow-x-auto max-h-[600px] overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest w-16 text-center">No</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest">Nama Siswa</th>
                                @if($evaParam === 'final')
                                    <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-32">Ujian Akhir</th>
                                    <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-32">Nilai Final</th>
                                @else
                                    <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-32 uppercase tracking-widest">Nilai</th>
                                @endif
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest text-center w-40">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($users as $idx => $user)
                                @php
                                    $saved = isset($rows[$user->id]) ? $rows[$user->id] : null;
                                @endphp
                                <tr class="group hover:bg-blue-50/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-gray-400 text-xs">
                                        {{ $idx + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-xs">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                             <input type="text" class="bg-transparent border-none p-0 text-sm font-bold text-[#173A67] w-full focus:ring-0 cursor-default name-input" 
                                                    value="{{ $user->name }}" readonly data-user-id="{{ $user->id }}">
                                        </div>
                                    </td>
                                    @if($evaParam === 'final')
                                        <td class="px-6 py-4 text-center">
                                            <input type="number" min="0" max="100"
                                                   class="w-20 text-center bg-gray-50 border-2 border-gray-100 rounded-xl py-2 text-sm font-bold text-[#173A67] focus:border-blue-500 focus:ring-0 transition-all eval-input ujian-input"
                                                   value="{{ $saved['ujian'] ?? '' }}" placeholder="0" data-user-id="{{ $user->id }}">
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <input type="number" min="0" max="100"
                                                   class="w-20 text-center bg-gray-50 border-2 border-gray-100 rounded-xl py-2 text-sm font-bold text-[#173A67] focus:border-blue-500 focus:ring-0 transition-all eval-input nilai-input"
                                                   value="{{ $saved['nilai'] ?? '' }}" placeholder="0" data-user-id="{{ $user->id }}">
                                        </td>
                                    @else
                                        <td class="px-6 py-4 text-center">
                                            <input type="number" min="0" max="100"
                                                   class="w-20 text-center bg-gray-50 border-2 border-gray-100 rounded-xl py-2 text-sm font-bold text-[#173A67] focus:border-blue-500 focus:ring-0 transition-all eval-input score-input"
                                                   value="{{ $saved['score'] ?? '' }}" placeholder="0" data-user-id="{{ $user->id }}">
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 text-center">
                                         <input type="date" 
                                                class="w-full text-center bg-transparent border-none text-xs font-bold text-gray-400 focus:ring-0 date-input"
                                                value="{{ $saved['at'] ?? '' }}" data-user-id="{{ $user->id }}">
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
                    <i data-lucide="bar-chart-3" class="w-32 h-32"></i>
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
                                     @if($evaParam === 'final')
                                        <li>Isi nilai Ujian Akhir dan Nilai Final (0-100).</li>
                                        <li>Keduanya harus <span class="text-green-600 font-bold">≥75</span> agar lulus.</li>
                                     @else
                                        <li>Isi nilai Evaluasi ke-{{ $evaParam }} (0-100).</li>
                                        <li>Nilai harus <span class="text-green-600 font-bold">≥75</span> agar lulus.</li>
                                     @endif
                                    <li>Warna hijau indikator lulus, merah belum lulus.</li>
                                    <li>Data tersimpan otomatis.</li>
                                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    const CONFIG = {
        saveRoute: "{{ route('sensei.penilaian.bunpou.save') }}",
        resetRoute: "{{ route('sensei.penilaian.bunpou.reset') }}",
        csrf: "{{ csrf_token() }}"
    };

    function updateStyle(input) {
        const val = parseInt(input.value);
        input.classList.remove('bg-gray-50', 'text-[#173A67]', 'bg-green-100', 'text-green-600', 'bg-red-100', 'text-red-500');
        
        if(isNaN(val)) {
            input.classList.add('bg-gray-50', 'text-[#173A67]');
        } else if(val >= 75) {
             input.classList.add('bg-green-100', 'text-green-600');
        } else {
             input.classList.add('bg-red-100', 'text-red-500');
        }
    }

    function getPayload() {
        const payload = [];
        document.querySelectorAll('tr.group').forEach((tr) => {
             const userId = tr.querySelector('.date-input').dataset.userId;
             const date = tr.querySelector('.date-input').value;
             
             if(userId) {
                 @if($evaParam === 'final')
                    const ujian = tr.querySelector('.ujian-input').value;
                    const nilai = tr.querySelector('.nilai-input').value;
                    payload.push({
                        user_id: userId,
                        ujian: ujian,
                        nilai: nilai,
                        at: date
                    });
                 @else
                    const score = tr.querySelector('.score-input').value;
                    payload.push({
                        user_id: userId,
                        score: score,
                        at: date
                    });
                 @endif
             }
        });
        return payload;
    }

    function updateStats(summary) {
        if(!summary) return;
        document.getElementById('summary-total').textContent = summary.total;
        document.getElementById('summary-lulus').textContent = summary.lulus;
        document.getElementById('summary-gagal').textContent = (summary.total - summary.lulus);
        document.getElementById('summary-percent').textContent = summary.percent + '%';
    }

    let saveTimer;
    function autoSave() {
        clearTimeout(saveTimer);
        saveTimer = setTimeout(saveData, 1000);
    }

    async function saveData() {
        const msg = document.getElementById('save-msg');
        const payload = getPayload();

        if(!payload.length) return;

        msg.textContent = 'Menyimpan...';
        msg.className = 'text-xs font-bold text-gray-400 ml-2';

        try {
            const res = await fetch(CONFIG.saveRoute, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CONFIG.csrf },
                body: JSON.stringify({ 
                    students: payload,
                    eva: "{{ $evaParam }}"
                })
            });
            const data = await res.json();
            if(data.success) {
                msg.textContent = 'Tersimpan';
                msg.className = 'text-xs font-bold text-green-500 ml-2';
                updateStats(data.summary);
                setTimeout(() => msg.textContent = '', 2000);
            }
        } catch(e) {
            msg.textContent = 'Error';
            msg.className = 'text-xs font-bold text-red-500 ml-2';
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.eval-input').forEach(input => {
            updateStyle(input);
            input.addEventListener('input', function() {
                let val = parseInt(this.value);
                if(val > 100) this.value = 100;
                updateStyle(this);
                autoSave();
            });
        });

        document.querySelectorAll('.date-input').forEach(i => i.addEventListener('input', autoSave));

        document.getElementById('btn-save').addEventListener('click', saveData);

        document.getElementById('btn-reset').addEventListener('click', async () => {
            if(!confirm('Reset data Bunpou untuk evaluasi ini?')) return;
            try {
                await fetch(CONFIG.resetRoute, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CONFIG.csrf
                    },
                    body: JSON.stringify({ eva: "{{ $evaParam }}" })
                });
                window.location.reload();
            } catch(e) { alert('Error reset'); }
        });
    });
</script>
@endsection
