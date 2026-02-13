@extends('layouts.header_dashboard_sensei')

@section('title', 'Penilaian Presensi')

@section('content')
@php
    $users = $students ?? [];
    $rows = $savedScores ?? [];
    $days = $days ?? range(1, 30);
    $daysCount = $daysCount ?? count($days);
    $counts = $summary ?? ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];
    
    $totalStudents = count($users);
    $totalH = $counts['H'] ?? 0;
    $totalEntries = $totalStudents * $daysCount;
    $percent = ($totalEntries > 0) ? round(($totalH / $totalEntries) * 100, 2) : 0;

    $monthNames = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];
@endphp

<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">

    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="space-y-2">
            <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                Penilaian Presensi
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
            <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Pencatatan kehadiran siswa (Hadir/Sakit/Izin/Alfa)</p>
        </div>

        <div class="flex items-center gap-3 flex-wrap">
            <div class="flex items-center gap-2 bg-blue-50 px-3 py-2 rounded-2xl border border-blue-100">
                <i data-lucide="calendar" class="w-4 h-4 text-blue-600"></i>
                <select id="month-select" class="bg-transparent border-none p-0 text-xs font-extrabold text-blue-600 ring-0 focus:ring-0 cursor-pointer appearance-none uppercase tracking-widest">
                    @foreach($monthNames as $mIdx => $mName)
                        <option value="{{ $mIdx }}" {{ $month == $mIdx ? 'selected' : '' }}>{{ $mName }}</option>
                    @endforeach
                </select>
                <select id="year-select" class="bg-transparent border-none p-0 text-xs font-extrabold text-blue-600 ring-0 focus:ring-0 cursor-pointer appearance-none uppercase tracking-widest ml-1">
                    @foreach(range(date('Y') - 2, date('Y') + 2) as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
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
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                     <button id="save-presensi" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i> Simpan
                    </button>
                    <button id="reset-presensi" class="px-6 py-2.5 bg-white text-red-500 border-2 border-red-100 rounded-xl text-sm font-bold hover:bg-red-50 hover:border-red-200 active:scale-95 transition-all flex items-center gap-2">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i> Reset
                    </button>
                </div>
                <div class="px-4 py-2 bg-white rounded-xl border border-gray-100 text-xs font-bold text-gray-500 shadow-sm flex items-center gap-2">
                    <i data-lucide="calendar-days" class="w-4 h-4 text-blue-500"></i>
                    {{ $daysCount }} Hari Aktif
                </div>
            </div>

            <!-- Table Container -->
            <div class="presensi-wrapper">
                <div class="bg-white border-2 border-gray-100 rounded-[2rem] flex-1 shadow-sm relative z-0 pb-6">
                    <div class="max-h-[600px] presensi-scroll pb-6">
                    <table class="border-collapse w-max text-left">
                        <thead class="bg-[#173A67] text-white sticky top-0 z-20">
                            <tr>
                                <th class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest text-center sticky left-0 bg-[#173A67] z-30 w-16 border-r border-blue-800">No</th>
                                <th class="px-6 py-4 font-extrabold text-xs uppercase tracking-widest sticky left-16 bg-[#173A67] z-30 w-[250px] border-r border-blue-800 shadow-xl">Nama Siswa</th>
                                <th class="px-4 py-4 font-extrabold text-xs uppercase tracking-widest sticky left-[314px] bg-[#173A67] z-30 min-w-[140px] border-r border-blue-800 shadow-xl">No. Telp</th>
                                @foreach($days as $day)
                                <th class="px-1 py-2 font-bold text-xs text-center w-10 border-r border-blue-800/30">
                                    <div class="flex flex-col items-center gap-1">
                                        <span>{{ $day }}</span>
                                        <button class="day-info-btn w-4 h-4 rounded-full bg-blue-500/50 hover:bg-blue-400 text-white flex items-center justify-center text-[8px]" data-day="{{ $day - 1 }}">
                                            i
                                        </button>
                                    </div>
                                </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse($users as $idx => $user)
                                @php
                                    $savedRow = $rows[$user->id] ?? [];
                                    $savedStatuses = [];
                                    $savedPhone = $user->no_wa_pribadi ?? '-';
                                    
                                    if(is_array($savedRow)) {
                                        if(isset($savedRow['statuses'])) {
                                            $savedStatuses = $savedRow['statuses'];
                                            $savedPhone = $savedRow['phone'] ?? $savedPhone;
                                        } elseif(isset($savedRow[2])) {
                                            $savedStatuses = $savedRow[2];
                                            $savedPhone = $savedRow[1] ?? $savedPhone;
                                        }
                                    }
                                    $savedStatuses = array_pad($savedStatuses, $daysCount, '');
@endphp
                                <tr class="group transition-colors student-row" data-id="{{ $user->id }}">
                                    <td class="px-4 py-3 text-center font-bold text-gray-400 text-xs sticky left-0 bg-white z-10 border-r border-gray-100">
                                        {{ $idx + 1 }}
                                    </td>
                                    <td class="px-6 py-3 sticky left-16 bg-white z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)] w-[250px]">
                                        <div class="flex items-center gap-3">
                                            <div class="w-6 h-6 rounded-full bg-blue-100 text-[#173A67] flex items-center justify-center font-bold text-[10px]">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="text-xs font-bold text-[#173A67] whitespace-nowrap" title="{{ $user->name }}">
                                                {{ $user->name }}
                                            </span>
                                            <input type="hidden" class="name-input" value="{{ $user->name }}" data-id="{{ $user->id }}">
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 sticky left-[314px] bg-white z-10 border-r border-gray-100 shadow-[4px_0_24px_-10px_rgba(0,0,0,0.1)]">
                                        <input type="text" class="bg-transparent border-none p-0 text-xs font-medium text-gray-500 w-full focus:ring-0 phone-input" 
                                               value="{{ $savedPhone }}">
                                    </td>
                                    
                                    @foreach($days as $dayIdx => $day)
                                    <td class="p-2 border-r border-gray-100 text-center relative group/cell min-w-[50px]">
                                        <button class="w-10 h-10 rounded-xl flex items-center justify-center transition-all focus:outline-none attendance-btn mx-auto shadow-sm"
                                                data-status="{{ $savedStatuses[$dayIdx] ?? '' }}"
                                                data-day="{{ $dayIdx }}">
                                            <!-- icon rendered by js -->
                                        </button>
                                        <select class="attendance-select absolute inset-0 opacity-0 w-full h-full cursor-pointer z-10 hidden">
                                            <option value="">-</option>
                                            <option value="H">Hadir</option>
                                            <option value="A">Alfa</option>
                                            <option value="S">Sakit</option>
                                            <option value="I">Izin</option>
                                        </select>
                                    </td>
                                    @endforeach
                                </tr>
                            @empty
                                <tr><td colspan="{{ count($days) + 3 }}" class="p-8 text-center text-gray-400 font-bold">Belum ada data siswa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    </div>
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
                <h3 class="font-bold text-lg mb-6 relative z-10">Statistik Kehadiran</h3>
                
                <div class="space-y-4 relative z-10">
                    <div class="grid grid-cols-2 gap-3">
                         <div class="bg-green-500/20 rounded-2xl p-3 border border-green-400/20 flex flex-col items-center">
                            <span class="text-[10px] font-bold text-green-300 uppercase">Hadir</span>
                            <span class="text-2xl font-black text-green-300" id="count-h">{{ $counts['H'] }}</span>
                        </div>
                        <div class="bg-red-500/20 rounded-2xl p-3 border border-red-400/20 flex flex-col items-center">
                            <span class="text-[10px] font-bold text-red-300 uppercase">Alfa</span>
                            <span class="text-2xl font-black text-red-300" id="count-a">{{ $counts['A'] }}</span>
                        </div>
                        <div class="bg-yellow-500/20 rounded-2xl p-3 border border-yellow-400/20 flex flex-col items-center">
                            <span class="text-[10px] font-bold text-yellow-300 uppercase">Sakit</span>
                            <span class="text-2xl font-black text-yellow-300" id="count-s">{{ $counts['S'] }}</span>
                        </div>
                        <div class="bg-blue-500/20 rounded-2xl p-3 border border-blue-400/20 flex flex-col items-center">
                            <span class="text-[10px] font-bold text-blue-300 uppercase">Izin</span>
                            <span class="text-2xl font-black text-blue-300" id="count-i">{{ $counts['I'] }}</span>
                        </div>
                    </div>

                    <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-sm mt-4">
                        <div class="flex justify-between items-end mb-2">
                             <span class="text-xs font-bold text-blue-200 uppercase">Kehadiran</span>
                             <span class="text-2xl font-black text-white" id="percent">{{ $percent }}%</span>
                        </div>
                        <div class="w-full bg-black/20 rounded-full h-2 overflow-hidden">
                            <div class="bg-green-400 h-full rounded-full transition-all duration-1000" style="width: {{ $percent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Legend (Themed like Akhir summary) -->
            <div class="bg-gray-100 rounded-[2rem] p-6 border border-gray-200 shadow-sm">
                <h4 class="font-bold text-[#173A67] mb-4 text-sm uppercase tracking-widest text-center">Keterangan Icon</h4>
                <div class="bg-white rounded-xl overflow-hidden border border-gray-200">
                    <table class="w-full text-xs border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-[#173A67] border-b border-gray-200">
                                <th class="px-3 py-3 font-bold border-r border-gray-200 text-center uppercase tracking-wider">Status</th>
                                <th class="px-3 py-3 font-bold text-center uppercase tracking-wider">Icon</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-gray-700 font-bold">
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">Hadir (H)</td>
                                <td class="px-3 py-2.5 text-center"><span class="w-6 h-6 rounded-full bg-green-500 inline-flex items-center justify-center text-white text-[10px] mx-auto">✓</span></td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">Alfa (A)</td>
                                <td class="px-3 py-2.5 text-center"><span class="w-6 h-6 rounded-full bg-red-500 inline-flex items-center justify-center text-white text-[10px] mx-auto">A</span></td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">Sakit (S)</td>
                                <td class="px-3 py-2.5 text-center"><span class="w-6 h-6 rounded-full bg-yellow-400 inline-flex items-center justify-center text-white text-[10px] mx-auto">S</span></td>
                            </tr>
                            <tr>
                                <td class="px-3 py-2.5 text-center border-r border-gray-200 bg-gray-50/30">Izin (I)</td>
                                <td class="px-3 py-2.5 text-center"><span class="w-6 h-6 rounded-full bg-blue-500 inline-flex items-center justify-center text-white text-[10px] mx-auto">I</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal & Popover -->
<div id="day-modal" class="fixed inset-0 bg-[#173A67]/50 backdrop-blur-sm hidden items-center justify-center z-[100] p-4">
    <div class="bg-white rounded-[2rem] w-full max-w-lg p-6 shadow-2xl transform transition-all scale-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="font-black text-xl text-[#173A67]">Detail Hari Ke-<span id="day-modal-day"></span></h3>
                <p class="text-xs font-bold text-gray-400 uppercase">Ringkasan kehadiran siswa</p>
            </div>
            <button id="day-modal-close" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-600 transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        
        <div class="grid grid-cols-4 gap-2 mb-6">
             <div class="bg-green-50 rounded-xl p-3 text-center"><div class="text-[10px] font-bold text-green-400 uppercase">Hadir</div><div class="font-black text-xl text-green-600" id="modal-count-h">0</div></div>
             <div class="bg-red-50 rounded-xl p-3 text-center"><div class="text-[10px] font-bold text-red-400 uppercase">Alfa</div><div class="font-black text-xl text-red-600" id="modal-count-a">0</div></div>
             <div class="bg-yellow-50 rounded-xl p-3 text-center"><div class="text-[10px] font-bold text-yellow-500 uppercase">Sakit</div><div class="font-black text-xl text-yellow-600" id="modal-count-s">0</div></div>
             <div class="bg-blue-50 rounded-xl p-3 text-center"><div class="text-[10px] font-bold text-blue-400 uppercase">Izin</div><div class="font-black text-xl text-blue-600" id="modal-count-i">0</div></div>
        </div>
        
        <div class="max-h-[300px] overflow-y-auto pr-2 space-y-2" id="modal-students-list">
            <!-- inserted by js -->
        </div>
    </div>
</div>

<div id="day-popover" class="hidden absolute bg-white rounded-2xl shadow-xl border border-gray-100 p-4 w-64">
    <div class="flex justify-between items-center mb-3">
        <div class="font-bold text-[#173A67]">Hari <span id="popover-day"></span></div>
        <button id="popover-close" class="text-gray-400 hover:text-gray-600"><i data-lucide="x" class="w-3 h-3"></i></button>
    </div>
    <div class="space-y-2 text-xs font-bold text-gray-600 mb-3">
        <div class="flex justify-between"><span>Hadir</span><span class="text-green-500" id="popover-count-h">0</span></div>
        <div class="flex justify-between"><span>Alfa</span><span class="text-red-500" id="popover-count-a">0</span></div>
        <div class="flex justify-between"><span>Sakit</span><span class="text-yellow-500" id="popover-count-s">0</span></div>
        <div class="flex justify-between"><span>Izin</span><span class="text-blue-500" id="popover-count-i">0</span></div>
    </div>
    <!-- Custom Scroll Buttons - Always Visible -->
    <button id="scroll-left" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 z-40 w-12 h-12 bg-[#173A67] rounded-full shadow-2xl flex items-center justify-center text-white hover:bg-blue-800 hover:scale-110 transition-all border-4 border-white">
        <i data-lucide="chevron-left" class="w-8 h-8"></i>
    </button>
    <button id="scroll-right" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 z-40 w-12 h-12 bg-[#173A67] rounded-full shadow-2xl flex items-center justify-center text-white hover:bg-blue-800 hover:scale-110 transition-all border-4 border-white">
        <i data-lucide="chevron-right" class="w-8 h-8"></i>
    </button>

    <div id="popover-students-preview" class="space-y-1 mb-3 max-h-32 overflow-hidden relative after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-full after:h-8 after:bg-gradient-to-t after:from-white"></div>
    <button id="popover-open-modal" class="w-full py-2 rounded-xl bg-blue-50 text-blue-600 text-xs font-bold hover:bg-blue-100 transition">Lihat Detail</button>
</div>



<style>
.presensi-wrapper { position: relative; }

/* Popover */
#day-popover { position: absolute; display: none; transform-origin: top left; transition: transform .12s ease, opacity .12s ease; z-index: 60; }
#day-popover.show { display: block; opacity: 1; transform: translateY(0); }

@media (min-width: 768px) { 
    #day-popover { min-width: 220px; } 
}

/* AGGRESSIVE FORCE: Persistent Scrollbar Visibility (Verified for macOS/Chrome/Safari) */
.presensi-scroll { 
    max-height: 600px;
    width: 100%;
    overflow-x: scroll !important; 
    overflow-y: auto !important; 
    display: block !important;
    scrollbar-gutter: stable; 
    -webkit-overflow-scrolling: touch;
    background: #ffffff;
    padding-bottom: 24px !important; /* Spacing for the persistent scrollbar */
}

/* Chrome, Safari, Edge - This combination forces visibility on most macOS systems */
.presensi-scroll::-webkit-scrollbar { 
    height: 20px !important; 
    width: 20px !important; 
    display: block !important;
    -webkit-appearance: none !important;
}

.presensi-scroll::-webkit-scrollbar-track { 
    background: #e2e8f0 !important; /* Darker track for better contrast */
    border: 1px solid #cbd5e1 !important;
    border-radius: 4px !important;
    display: block !important;
}

.presensi-scroll::-webkit-scrollbar-thumb { 
    background-color: #0f172a !important; /* Ultra-dark (Slate-900) for highest visibility */
    border-radius: 4px !important;
    border: 2px solid #e2e8f0 !important;
    min-height: 50px !important;
    display: block !important;
}

.presensi-scroll::-webkit-scrollbar-thumb:hover { 
    background-color: #000000 !important; 
}

.presensi-scroll::-webkit-scrollbar-corner {
    background-color: #e2e8f0 !important;
    display: block !important;
}

/* Prevent auto-hiding on macOS */
.presensi-scroll::-webkit-scrollbar-thumb:window-inactive,
.presensi-scroll::-webkit-scrollbar-track:window-inactive {
    background: #cbd5e1 !important;
    display: block !important;
}

.presensi-badge { 
    width: 28px; 
    height: 28px; 
    border-radius: 9999px; 
    display:inline-flex; 
    align-items:center; 
    justify-content:center; 
    font-weight:600; 
}

.presensi-badge .caret { position: absolute; right: -5px; bottom: -5px; }

.table-fixed th, .table-fixed td { border: 1px solid #d1d5db; vertical-align: middle; padding: 8px; }

.table-fixed thead th { background: #8A9BB2; color: #fff; }

/* Existing compatibility styles if any are still needed */
.sticky-column {
    position: sticky;
    background-color: white;
    z-index: 10;
}
</style>
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
        month: {{ $month }},
        year: {{ $year }},
        daysCount: {{ $daysCount }},
        csrf: '{{ csrf_token() }}',
        saveRoute: '{{ route('sensei.penilaian.presensi.save') }}',
        resetRoute: '{{ route('sensei.penilaian.presensi.reset') }}'
    };
    window.__penilaianPerDay = {!! json_encode($counts_per_day ?? []) !!};

    function renderIcon(btn, status) {
        status = (status || '').toUpperCase();
        btn.dataset.status = status;
        let html = '<span class="w-8 h-8 rounded-xl bg-gray-100/50 border border-gray-200 block transition-all"></span>'; // default clearer empty state
        
        if(status === 'H') html = '<span class="w-full h-full rounded-xl bg-green-500 shadow-md shadow-green-200 flex items-center justify-center text-white scale-110 transition-transform"><svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg></span>';
        else if(status === 'A') html = '<span class="w-full h-full rounded-xl bg-red-500 shadow-md shadow-red-200 flex items-center justify-center text-white font-black text-sm scale-110 transition-transform">A</span>';
        else if(status === 'S') html = '<span class="w-full h-full rounded-xl bg-yellow-400 shadow-md shadow-yellow-200 flex items-center justify-center text-white font-black text-sm scale-110 transition-transform">S</span>';
        else if(status === 'I') html = '<span class="w-full h-full rounded-xl bg-blue-500 shadow-md shadow-blue-200 flex items-center justify-center text-white font-black text-sm scale-110 transition-transform">I</span>';

        btn.innerHTML = html;
        // update select if needed
        const sel = btn.nextElementSibling;
        if(sel && sel.tagName === 'SELECT') sel.value = status;
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Init Icons
        document.querySelectorAll('.attendance-btn').forEach(btn => {
            renderIcon(btn, btn.dataset.status);
            
            // Click Handler
            btn.addEventListener('click', (e) => {
                const statuses = ['', 'H', 'A', 'S', 'I'];
                let cur = (btn.dataset.status || '').toUpperCase();
                let idx = statuses.indexOf(cur);
                let next = statuses[(idx + 1) % statuses.length];
                renderIcon(btn, next);
            });
        });

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
            
            // Auto remove
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(100%)';
                toast.style.transition = 'all 0.5s ease-in';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }

        // Save
        const saveBtn = document.getElementById('save-presensi');
        saveBtn.addEventListener('click', async () => {
            const payload = [];
            document.querySelectorAll('tr.student-row').forEach(tr => {
                const id = tr.dataset.id;
                const phone = tr.querySelector('.phone-input').value;
                const statuses = [];
                tr.querySelectorAll('.attendance-btn').forEach(b => statuses.push(b.dataset.status || ''));
                if(id) payload.push({ id, phone, statuses });
            });


            if(!payload.length) {
                showToast('Tidak ada data untuk disimpan', 'error');
                return;
            }

            const originalHtml = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Menyimpan...';
            saveBtn.disabled = true;
            lucide.createIcons();

            try {
                const res = await fetch(CONFIG.saveRoute, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CONFIG.csrf },
                    body: JSON.stringify({ 
                        students: payload,
                        month: CONFIG.month,
                        year: CONFIG.year
                    })
                });
                const data = await res.json();
                if(data.success) {
                    showToast('Berhasil menyimpan presensi');
                    // Update stats
                    const c = data.counts || {};
                    ['h','a','s','i'].forEach(k => {
                        const el = document.getElementById('count-'+k);
                        if(el && c[k.toUpperCase()] !== undefined) el.textContent = c[k.toUpperCase()];
                    });
                    
                    const savedCount = data.saved || payload.length; 
                    const totalEntriesAtCurrentPeriod = savedCount * CONFIG.daysCount;
                    const hCount = c.H || 0;
                    const p = totalEntriesAtCurrentPeriod > 0 ? ((hCount / totalEntriesAtCurrentPeriod) * 100).toFixed(2) : 0;
                    const elP = document.getElementById('percent');
                    if(elP) {
                         elP.textContent = p + '%';
                         const parent = elP.closest('div').nextElementSibling;
                         if(parent) {
                             const bar = parent.firstElementChild;
                             if(bar) bar.style.width = p + '%';
                         }
                    }
                    
                    window.__penilaianPerDay = data.counts_per_day || [];
                } else {
                    showToast(data.message || 'Gagal menyimpan presensi', 'error');
                }
            } catch(e) { 
                console.error(e); 
                showToast('Terjadi kesalahan server', 'error');
            } finally {
                saveBtn.innerHTML = originalHtml;
                saveBtn.disabled = false;
                lucide.createIcons();
            }
        });

        // Reset
        document.getElementById('reset-presensi').addEventListener('click', async () => {
            const confirmed = await showConfirm(`Reset semua data presensi bulan ${CONFIG.month} tahun ${CONFIG.year}?`);
            if(!confirmed) return;
            
            const btn = document.getElementById('reset-presensi');
            const originalHtml = btn.innerHTML;
            btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Reset...';
            btn.disabled = true;
            lucide.createIcons();
            
            try {
                const res = await fetch(CONFIG.resetRoute, {
                    method:'POST', 
                    headers:{
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CONFIG.csrf
                    },
                    body: JSON.stringify({
                        month: CONFIG.month,
                        year: CONFIG.year
                    })
                });
                const data = await res.json();
                
                if(data.success || res.ok) {
                    showToast('Berhasil reset data presensi', 'success');
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
        
        // Popover Logic
        let perDayCounts = window.__penilaianPerDay || [];
        const popover = document.getElementById('day-popover');
        
        document.querySelectorAll('.day-info-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const day = parseInt(btn.dataset.day);
                const dData = perDayCounts[day] || { counts: {H:0,A:0,S:0,I:0}, students:[] };
                
                document.getElementById('popover-day').textContent = day + 1;
                document.getElementById('popover-count-h').textContent = dData.counts.H || 0;
                document.getElementById('popover-count-a').textContent = dData.counts.A || 0;
                document.getElementById('popover-count-s').textContent = dData.counts.S || 0;
                document.getElementById('popover-count-i').textContent = dData.counts.I || 0;
                
                const preview = document.getElementById('popover-students-preview');
                preview.innerHTML = '';
                if(dData.students && dData.students.length) {
                    dData.students.slice(0,5).forEach(s => {
                        preview.innerHTML += `<div class="flex justify-between items-center text-[10px] text-gray-500 bg-gray-50 p-1.5 rounded-lg border border-gray-100">
                            <span class="font-bold text-[#173A67] truncate w-24">${s.name}</span>
                            <span class="font-bold">${s.status}</span>
                        </div>`;
                    });
                } else {
                    preview.innerHTML = '<span class="text-gray-400 italic">Belum ada data</span>';
                }
                
                const rect = btn.getBoundingClientRect();
                popover.style.display = 'block';
                popover.style.top = (rect.bottom + window.scrollY + 10) + 'px';
                popover.style.left = (rect.left + window.scrollX - 100) + 'px';
                popover.classList.remove('hidden');
                
                window.__currentDay = day;
            });
        });
        
        document.addEventListener('click', (e) => {
            if(!popover.contains(e.target) && !e.target.closest('.day-info-btn')) {
                popover.style.display = 'none';
            }
        });
        
        document.getElementById('popover-close').addEventListener('click', () => popover.style.display = 'none');
        
        // Modal Logic
        const modal = document.getElementById('day-modal');
        function openModal(day) {
           const dData = perDayCounts[day] || { counts: {H:0,A:0,S:0,I:0}, students:[] };
           document.getElementById('day-modal-day').textContent = (day + 1);
           document.getElementById('modal-count-h').textContent = dData.counts.H || 0;
           document.getElementById('modal-count-a').textContent = dData.counts.A || 0;
           document.getElementById('modal-count-s').textContent = dData.counts.S || 0;
           document.getElementById('modal-count-i').textContent = dData.counts.I || 0;
           
           const list = document.getElementById('modal-students-list');
           list.innerHTML = '';
           if(dData.students && dData.students.length) {
               dData.students.forEach(s => {
                   let colorClass = 'bg-gray-100 text-gray-600';
                   if(s.status == 'H') colorClass = 'bg-green-100 text-green-600';
                   if(s.status == 'A') colorClass = 'bg-red-100 text-red-600';
                   if(s.status == 'S') colorClass = 'bg-yellow-100 text-yellow-600';
                   if(s.status == 'I') colorClass = 'bg-blue-100 text-blue-600';
                   
                   list.innerHTML += `<div class="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition-colors">
                       <span class="font-bold text-[#173A67] text-sm">${s.name}</span>
                       <span class="px-2 py-1 rounded-lg text-xs font-black ${colorClass}">${s.status}</span>
                   </div>`;
               });
           } else {
               list.innerHTML = '<div class="text-center text-gray-400 py-8 font-bold text-sm">Belum ada absen pada hari ini</div>';
           }
           
           modal.classList.remove('hidden');
           modal.classList.add('flex');
        }
        
        document.getElementById('popover-open-modal').addEventListener('click', () => {
            popover.style.display = 'none';
            if(window.__currentDay !== undefined) openModal(window.__currentDay);
        });
        
        document.getElementById('day-modal-close').addEventListener('click', () => {
             modal.classList.add('hidden');
             modal.classList.remove('flex');
        });
        // Month/Year Selector Change
        const updatePeriod = () => {
            const m = document.getElementById('month-select').value;
            const y = document.getElementById('year-select').value;
            const url = new URL(window.location.href);
            url.searchParams.set('month', m);
            url.searchParams.set('year', y);
            window.location.href = url.toString();
        };

        document.getElementById('month-select').addEventListener('change', updatePeriod);
        document.getElementById('year-select').addEventListener('change', updatePeriod);
    });
</script>
@endsection
