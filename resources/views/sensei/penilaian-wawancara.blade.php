@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian Wawancara')

@section('content')
@php
    $users = $students ?? [];
    $activeTab = request('tab', 'materi'); // materi, sikap
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">

    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian Wawancara
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
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Evaluasi Lisan & Sikap</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
             <!-- Tab Switcher -->
             <div class="bg-gray-100 p-1 rounded-2xl flex items-center shadow-inner">
                 <button type="button" onclick="switchTab('materi')" id="btn-materi" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all {{ $activeTab === 'materi' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">
                     Materi
                 </button>
                 <button type="button" onclick="switchTab('sikap')" id="btn-sikap" class="px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all {{ $activeTab === 'sikap' ? 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200' }}">
                     Sikap
                 </button>
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
        
        <!-- LEFT: TABLE CONTENT -->
        <div class="col-span-12 lg:col-span-9 flex flex-col gap-6">
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                     <button id="save-btn" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan
                    </button>
                    <button id="reset-btn" class="px-6 py-2.5 bg-white text-red-500 border-2 border-red-100 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset
                    </button>
                </div>
                <div class="text-xs font-bold text-gray-400 uppercase tracking-wider">
                     <span id="label-active-tab">Penilaian Materi</span>
                </div>
            </div>

            <!-- TABLE MATERI -->
            <div id="content-materi" class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden flex-1 shadow-sm relative z-0 {{ $activeTab === 'materi' ? '' : 'hidden' }}">
                <div class="wawancara-scroll overflow-auto max-h-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center w-16 sticky left-0 bg-[#173A67] z-30">No</th>
                                <th class="px-6 py-5 font-extrabold text-xs uppercase tracking-widest min-w-[200px] sticky left-16 bg-[#173A67] z-30 shadow-xl border-r border-blue-800">Nama Siswa</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Program</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Umum</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Jepang</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Indo</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Jumlah</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Persen</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Ket</th>
                                <th class="px-6 py-5 font-extrabold text-xs uppercase tracking-widest min-w-[200px]">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($students as $idx => $user)
                            @php
                                $saved = $savedScores[$user->id] ?? null;
                            @endphp
                            <tr class="group hover:bg-blue-50/30 transition-colors student-row-materi" data-id="{{ $user->id }}">
                                <td class="px-4 py-4 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100">
                                    {{ $idx + 1 }}
                                </td>
                                <td class="px-6 py-4 sticky left-16 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)]">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <input type="text" class="bg-transparent border-none p-0 text-sm font-bold text-[#173A67] w-full focus:ring-0 cursor-default name-input" 
                                               value="{{ $user->name }}" readonly>
                                    </div>
                                </td>
                                @php
                                    $materiFields = ['program', 'umum', 'jepang', 'indo'];
                                @endphp
                                @foreach($materiFields as $field)
                                <td class="px-2 py-4 text-center">
                                    <select class="w-16 bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold py-2 focus:ring-2 focus:ring-blue-500 text-center materi-select" data-id="{{ $user->id }}" data-field="{{ $field }}">
                                        <option value=""></option>
                                        <option value="3" {{ ($saved[$field] ?? '') == 3 ? 'selected' : '' }}>3</option>
                                        <option value="2" {{ ($saved[$field] ?? '') == 2 ? 'selected' : '' }}>2</option>
                                        <option value="1" {{ ($saved[$field] ?? '') == 1 ? 'selected' : '' }}>1</option>
                                    </select>
                                </td>
                                @endforeach
                                <td class="px-4 py-4 text-center font-black text-[#173A67] bg-blue-50/50">
                                    <span class="materi-sum" data-id="{{ $user->id }}">{{ $saved['sum'] ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-center font-black text-blue-600 bg-blue-50/50">
                                    <span class="materi-percent" data-id="{{ $user->id }}">{{ isset($saved['percent']) ? round($saved['percent']) . '%' : '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-center text-xs font-bold bg-blue-50/50">
                                    @php
                                        $p = $saved['percent'] ?? 0;
                                        $ket = '-'; $cls = 'bg-gray-200 text-gray-500';
                                        if($p >= 90) { $ket = 'Sangat Menguasai'; $cls = 'bg-green-100 text-green-700'; }
                                        elseif($p >= 80) { $ket = 'Menguasai'; $cls = 'bg-blue-100 text-blue-700'; }
                                        elseif($p >= 70) { $ket = 'Cukup'; $cls = 'bg-yellow-100 text-yellow-700'; }
                                        elseif($p > 0) { $ket = 'Kurang'; $cls = 'bg-red-100 text-red-700'; }
                                    @endphp
                                    <span class="px-3 py-1 rounded-full font-bold materi-ket {{ $cls }}" data-id="{{ $user->id }}">{{ $ket }}</span>
                                </td>
                                <td class="px-4 py-4">
                                     <input type="text" class="w-full bg-transparent border-b border-dashed border-gray-300 focus:border-blue-500 focus:ring-0 text-xs py-1 text-gray-600 materi-note" data-id="{{ $user->id }}" placeholder="Tulis catatan..." value="{{ $saved['note'] ?? '' }}">
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" class="p-8 text-center text-gray-400 font-bold">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TABLE SIKAP -->
            <div id="content-sikap" class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden flex-1 shadow-sm relative z-0 {{ $activeTab === 'sikap' ? '' : 'hidden' }}">
                <div class="wawancara-scroll overflow-auto max-h-[600px]">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center w-16 sticky left-0 bg-[#173A67] z-30">No</th>
                                <th class="px-6 py-5 font-extrabold text-xs uppercase tracking-widest min-w-[200px] sticky left-16 bg-[#173A67] z-30 shadow-xl border-r border-blue-800">Nama Siswa</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Cara Duduk</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Suara</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center">Fokus</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Jumlah</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Persen</th>
                                <th class="px-4 py-5 font-extrabold text-xs uppercase tracking-widest text-center bg-blue-800">Ket</th>
                                <th class="px-6 py-5 font-extrabold text-xs uppercase tracking-widest min-w-[200px]">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($students as $idx => $user)
                            @php
                                $saved = $savedScores[$user->id] ?? null;
                            @endphp
                            <tr class="group hover:bg-blue-50/30 transition-colors student-row-sikap" data-id="{{ $user->id }}">
                                <td class="px-4 py-4 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100">
                                    {{ $idx + 1 }}
                                </td>
                                <td class="px-6 py-4 sticky left-16 bg-white group-hover:bg-blue-50/30 z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)]">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <input type="text" class="bg-transparent border-none p-0 text-sm font-bold text-[#173A67] w-full focus:ring-0 cursor-default name-input" 
                                               value="{{ $user->name }}" readonly>
                                    </div>
                                </td>
                                @php
                                    $sikapFields = ['cara_duduk', 'suara', 'fokus'];
                                @endphp
                                @foreach($sikapFields as $field)
                                <td class="px-2 py-4 text-center">
                                    <select class="w-16 bg-gray-50 border border-gray-200 rounded-lg text-xs font-bold py-2 focus:ring-2 focus:ring-blue-500 text-center sikap-select" data-id="{{ $user->id }}" data-field="{{ $field }}">
                                        <option value=""></option>
                                        <option value="3" {{ ($saved[$field] ?? '') == 3 ? 'selected' : '' }}>3</option>
                                        <option value="2" {{ ($saved[$field] ?? '') == 2 ? 'selected' : '' }}>2</option>
                                        <option value="1" {{ ($saved[$field] ?? '') == 1 ? 'selected' : '' }}>1</option>
                                    </select>
                                </td>
                                @endforeach
                                <td class="px-4 py-4 text-center font-black text-[#173A67] bg-blue-50/50">
                                    <span class="sikap-sum" data-id="{{ $user->id }}">{{ $saved['sum_sikap'] ?? '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-center font-black text-blue-600 bg-blue-50/50">
                                    <span class="sikap-percent" data-id="{{ $user->id }}">{{ isset($saved['percent_sikap']) ? round($saved['percent_sikap']) . '%' : '-' }}</span>
                                </td>
                                <td class="px-4 py-4 text-center text-xs font-bold bg-blue-50/50">
                                    @php
                                        $p = $saved['percent_sikap'] ?? 0;
                                        $ket = '-'; $cls = 'bg-gray-200 text-gray-500';
                                        if($p >= 90) { $ket = 'Sangat Menguasai'; $cls = 'bg-green-100 text-green-700'; }
                                        elseif($p >= 80) { $ket = 'Menguasai'; $cls = 'bg-blue-100 text-blue-700'; }
                                        elseif($p >= 70) { $ket = 'Cukup'; $cls = 'bg-yellow-100 text-yellow-700'; }
                                        elseif($p > 0) { $ket = 'Kurang'; $cls = 'bg-red-100 text-red-700'; }
                                    @endphp
                                    <span class="px-3 py-1 rounded-full font-bold sikap-ket {{ $cls }}" data-id="{{ $user->id }}">{{ $ket }}</span>
                                </td>
                                <td class="px-4 py-4">
                                     <input type="text" class="w-full bg-transparent border-b border-dashed border-gray-300 focus:border-blue-500 focus:ring-0 text-xs py-1 text-gray-600 sikap-note" data-id="{{ $user->id }}" placeholder="Tulis catatan..." value="{{ $saved['note_sikap'] ?? '' }}">
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="10" class="p-8 text-center text-gray-400 font-bold">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- RIGHT: SUMMARY -->
        <div class="col-span-12 lg:col-span-3 space-y-6">
            <!-- Guidelines Card -->
            <div class="bg-white rounded-[2rem] p-6 border border-gray-100 shadow-sm">
                <h4 class="font-bold text-[#173A67] mb-4 text-sm uppercase tracking-widest flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i> Pedoman Skor
                </h4>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl">
                        <span class="text-xs font-bold text-gray-600">Baik / Menguasai</span>
                        <span class="text-lg font-black text-green-600">3</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-xl">
                        <span class="text-xs font-bold text-gray-600">Cukup</span>
                        <span class="text-lg font-black text-yellow-600">2</span>
                    </div>
                    <div class="flex items-center justify-between p-3 bg-red-50 rounded-xl">
                        <span class="text-xs font-bold text-gray-600">Kurang</span>
                        <span class="text-lg font-black text-red-600">1</span>
                    </div>
                </div>
            </div>

             <div class="bg-[#173A67] rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden">
                <h4 class="font-bold mb-4 text-sm uppercase tracking-widest relative z-10">Kriteria Kelulusan</h4>
                <div class="space-y-3 relative z-10 text-xs font-medium text-blue-100">
                    <div class="flex justify-between items-center border-b border-blue-800 pb-2">
                        <span>Sangat Menguasai</span>
                        <span class="text-green-400 font-bold">90-100%</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-blue-800 pb-2">
                        <span>Menguasai</span>
                        <span class="text-blue-400 font-bold">80-89%</span>
                    </div>
                    <div class="flex justify-between items-center border-b border-blue-800 pb-2">
                        <span>Cukup</span>
                        <span class="text-yellow-400 font-bold">70-79%</span>
                    </div>
                     <div class="flex justify-between items-center text-red-300">
                        <span>Kurang / Sangat Kurang</span>
                        <span class="font-bold">< 69%</span>
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
/* Custom scrollbar styling - Forced Visibility */
.wawancara-scroll {
    overflow: auto;
    scrollbar-width: auto;
    scrollbar-color: #cbd5e1 #f1f5f9;
}
.wawancara-scroll::-webkit-scrollbar { 
    height: 16px; width: 16px; 
    -webkit-appearance: none; display: block;
}
.wawancara-scroll::-webkit-scrollbar-track { 
    background-color: #f1f5f9; border-radius: 8px; 
}
.wawancara-scroll::-webkit-scrollbar-thumb { 
    background-color: #94a3b8; border-radius: 8px; border: 4px solid #f1f5f9; 
}
.wawancara-scroll::-webkit-scrollbar-thumb:hover { 
    background-color: #64748b; 
}
</style>

<script>
    let activeMode = '{{ $activeTab }}';

    function switchTab(mode) {
        activeMode = mode;
        
        // Buttons
        document.getElementById('btn-materi').className = mode === 'materi' ? 
            'px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all bg-blue-600 text-white shadow-lg shadow-blue-500/30' :
            'px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all text-gray-500 hover:text-gray-700 hover:bg-gray-200';
        
        document.getElementById('btn-sikap').className = mode === 'sikap' ? 
            'px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all bg-blue-600 text-white shadow-lg shadow-blue-500/30' :
            'px-6 py-2 rounded-xl text-xs font-black uppercase tracking-wide transition-all text-gray-500 hover:text-gray-700 hover:bg-gray-200';

        // Content
        document.getElementById('content-materi').classList.toggle('hidden', mode !== 'materi');
        document.getElementById('content-sikap').classList.toggle('hidden', mode !== 'sikap');
        
        // Label
        document.getElementById('label-active-tab').textContent = mode === 'materi' ? 'Penilaian Materi' : 'Penilaian Sikap';
    }

    // Logic perhitungan otomatis
    function updateRowWawancara(id, type = 'materi') {
        const selector = type === 'materi' ? '.materi-select' : '.sikap-select';
        const inputs = document.querySelectorAll(`${selector}[data-id="${id}"]`);
        let sum = 0;
        let count = 0;
        
        inputs.forEach(inp => {
            if(inp.value) {
                sum += parseInt(inp.value);
                count++;
            }
        });

        const maxScore = type === 'materi' ? 12 : 9;
        const percent = count > 0 ? Math.round((sum / maxScore) * 100) : 0;

        if(count === 0) {
             document.querySelector(`.${type}-sum[data-id="${id}"]`).textContent = '-';
             document.querySelector(`.${type}-percent[data-id="${id}"]`).textContent = '-';
             document.querySelector(`.${type}-ket[data-id="${id}"]`).textContent = '-';
             document.querySelector(`.${type}-ket[data-id="${id}"]`).className = `px-3 py-1 rounded-full bg-gray-200 text-gray-500 font-bold ${type}-ket`;
             return;
        }

        document.querySelector(`.${type}-sum[data-id="${id}"]`).textContent = sum;
        
        const pctEl = document.querySelector(`.${type}-percent[data-id="${id}"]`);
        pctEl.textContent = percent + '%';
        
        // Keterangan Style
        const ketEl = document.querySelector(`.${type}-ket[data-id="${id}"]`);
        if(percent >= 90) {
            ketEl.textContent = 'Sangat Menguasai';
            ketEl.className = `px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold ${type}-ket`;
        } else if(percent >= 80) {
             ketEl.textContent = 'Menguasai';
             ketEl.className = `px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-bold ${type}-ket`;
        } else if(percent >= 70) {
             ketEl.textContent = 'Cukup';
             ketEl.className = `px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-bold ${type}-ket`;
        } else {
             ketEl.textContent = 'Kurang';
             ketEl.className = `px-3 py-1 rounded-full bg-red-100 text-red-700 font-bold ${type}-ket`;
        }
    }

    // Bind events
    document.querySelectorAll('.materi-select').forEach(sel => {
        sel.addEventListener('change', function() {
            const id = this.dataset.id;
            updateRowWawancara(id, 'materi');
        });
    });

    document.querySelectorAll('.sikap-select').forEach(sel => {
        sel.addEventListener('change', function() {
            const id = this.dataset.id;
            updateRowWawancara(id, 'sikap');
        });
    });

    // getPayload
    function getPayload() {
        const payload = [];
        const studentIds = [...new Set([...document.querySelectorAll('.student-row-materi'), ...document.querySelectorAll('.student-row-sikap')].map(r => r.dataset.id))];
        
        studentIds.forEach(id => {
            const materiRow = document.querySelector(`.student-row-materi[data-id="${id}"]`);
            const sikapRow = document.querySelector(`.student-row-sikap[data-id="${id}"]`);
            
            const program = materiRow.querySelector('.materi-select[data-field="program"]').value;
            const umum = materiRow.querySelector('.materi-select[data-field="umum"]').value;
            const jepang = materiRow.querySelector('.materi-select[data-field="jepang"]').value;
            const indo = materiRow.querySelector('.materi-select[data-field="indo"]').value;
            const note = materiRow.querySelector('.materi-note').value;

            const cara_duduk = sikapRow.querySelector('.sikap-select[data-field="cara_duduk"]').value;
            const suara = sikapRow.querySelector('.sikap-select[data-field="suara"]').value;
            const fokus = sikapRow.querySelector('.sikap-select[data-field="fokus"]').value;
            const note_sikap = sikapRow.querySelector('.sikap-note').value;

            if (program || umum || jepang || indo || note || cara_duduk || suara || fokus || note_sikap) {
                payload.push({
                    id: id,
                    program: program || 0,
                    umum: umum || 0,
                    jepang: jepang || 0,
                    indo: indo || 0,
                    note: note,
                    cara_duduk: cara_duduk || 0,
                    suara: suara || 0,
                    fokus: fokus || 0,
                    note_sikap: note_sikap
                });
            }
        });
        return payload;
    }

    // Custom Confirm Modal
    function showConfirm(message) {
        return new Promise((resolve) => {
            const modal = document.getElementById('confirm-modal');
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
    document.getElementById('save-btn').addEventListener('click', async () => {
        const students = getPayload();
        if (students.length === 0) {
            showToast('Tidak ada data untuk disimpan', 'error');
            return;
        }

        const btn = document.getElementById('save-btn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menyimpan...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const response = await fetch("{{ route('sensei.penilaian.wawancara.save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ students })
            });
            const res = await response.json();
            if (res.success) {
                showToast('Berhasil menyimpan penilaian wawancara');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast(res.message || 'Gagal menyimpan', 'error');
            }
        } catch (e) {
            showToast('Terjadi kesalahan server', 'error');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            lucide.createIcons();
        }
    });
    
    // Reset
    document.getElementById('reset-btn').addEventListener('click', async () => {
        const confirmed = await showConfirm('Reset semua data penilaian wawancara di kelas ini?');
        if(!confirmed) return;
        
        const btn = document.getElementById('reset-btn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Reset...';
        btn.disabled = true;
        lucide.createIcons();
        
        try {
            const response = await fetch("{{ route('sensei.penilaian.wawancara.reset') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const res = await response.json();
            if (res.success) {
                showToast('Berhasil reset data wawancara', 'success');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                showToast(res.message || 'Gagal reset', 'error');
            }
        } catch (e) {
            showToast('Terjadi kesalahan server', 'error');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
            lucide.createIcons();
        }
    });

</script>
@endsection
