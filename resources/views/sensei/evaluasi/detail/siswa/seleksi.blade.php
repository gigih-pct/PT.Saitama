@extends('layouts.header_dashboard_sensei')

@section('title', 'Evaluasi Dashboard - ' . $student->name)

@section('content')
@php
    // Calculate Averages for Radar Chart
    $kanjiAvg = $kanjiAssessments->avg('score') ?? 0;
    
    // Bunpou Avg
    $bunpouScores = [];
    for($i=1; $i<=6; $i++) {
        $f = "eval{$i}";
        if(isset($bunpouAssessment->$f)) $bunpouScores[] = $bunpouAssessment->$f;
    }
    $bunpouAvg = count($bunpouScores) > 0 ? array_sum($bunpouScores)/count($bunpouScores) : 0;
    
    $kotobaAvg = $kotobaAssessments->avg('score') ?? 0;
    
    // Preparation for Radar Chart Data
    $chartData = [
        'labels' => ['Kanji', 'Bunpou', 'Kotoba', 'Wawancara', 'FMD', 'Presensi'],
        'scores' => [
            round($kanjiAvg),
            round($bunpouAvg),
            round($kotobaAvg),
            round($wawancaraScore ?? 0),
            round($fmdScore ?? 0),
            round($presensiScore ?? 0)
        ]
    ];
@endphp

<!-- SCREEN ONLY DASHBOARD -->
<div class="print:hidden">
    <div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans" x-data="{ activeTab: 'nihongo' }">
    
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10 z-10 relative">
        <div class="flex items-center gap-6">
            <button onclick="window.history.back()" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#173A67] hover:text-white hover:rotate-[-90deg] transition-all duration-500 shadow-sm border border-gray-100">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </button>
            <div class="space-y-1">
                <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight">Evaluasi Dashboard</h1>
                <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Comprehensive Performance Analysis</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
             <button onclick="window.print()" class="px-6 py-3 bg-[#173A67] text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2 print:hidden" title="Print Laporan">
                <i data-lucide="printer" class="w-4 h-4"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <!-- TOP SECTION: PROFILE & RADAR -->
    <div class="grid grid-cols-12 gap-8 mb-10">
        <!-- Profile info -->
        <div class="col-span-12 lg:col-span-4">
             <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 flex flex-col items-center text-center relative overflow-hidden group h-full">
                <!-- Avatar -->
                <div class="relative mb-6">
                    <div class="w-32 h-32 rounded-[2.5rem] bg-gradient-to-br from-[#173A67] to-blue-900 flex items-center justify-center text-white text-5xl font-black shadow-2xl rotate-3 group-hover:rotate-0 transition-all duration-500 overflow-hidden">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                </div>
                <h2 class="text-2xl font-black text-[#173A67] mb-1">{{ $student->name }}</h2>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">{{ $student->kelas ? $student->kelas->nama_kelas : 'Tanpa Angkatan' }}</p>
                
                <div class="grid grid-cols-2 gap-3 w-full mt-auto">
                    <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">Status</p>
                        <p class="text-xs font-black text-green-600">{{ $student->status ?? 'Aktif' }}</p>
                    </div>
                    <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-sm">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest mb-1">NIM</p>
                        <p class="text-xs font-black text-[#173A67]">{{ $student->nim ?? '23.12.2865' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Radar Chart -->
        <div class="col-span-12 lg:col-span-5">
            <div class="bg-white rounded-[2.5rem] p-6 border-2 border-gray-50 shadow-sm h-full flex flex-col items-center justify-center relative">
                <div class="absolute top-6 left-8">
                    <h3 class="text-[#173A67] font-black text-sm uppercase tracking-widest">Performance Radar</h3>
                </div>
                <!-- Chart Canvas -->
                <div class="w-full max-w-[300px] aspect-square flex items-center justify-center">
                    <canvas id="performanceRadar"></canvas>
                </div>
            </div>
        </div>

        <!-- KPI Summary -->
        <div class="col-span-12 lg:col-span-3 flex flex-col gap-4">
            <div class="flex-1 bg-blue-600 rounded-[2rem] p-6 text-white shadow-xl flex flex-col justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Nilai Akhir</p>
                    <h4 class="text-4xl font-black mt-1">{{ $nilaiAkhirScore }}</h4>
                </div>
                <div class="flex items-center gap-2">
                    <div class="px-3 py-1 bg-white/20 rounded-lg text-[10px] font-black">GRADE A</div>
                    <i data-lucide="trending-up" class="w-5 h-5 opacity-50 ml-auto"></i>
                </div>
            </div>
            <div class="flex-1 bg-emerald-500 rounded-[2rem] p-6 text-white shadow-xl flex flex-col justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest opacity-80">Presensi</p>
                    <h4 class="text-4xl font-black mt-1">{{ $presensiScore }}%</h4>
                </div>
                <div class="flex items-center gap-2">
                    <div class="px-3 py-1 bg-white/20 rounded-lg text-[10px] font-black">VERY DISCIPLINED</div>
                    <i data-lucide="award" class="w-5 h-5 opacity-50 ml-auto"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM SECTION: TABS -->
    <div class="flex-1 flex flex-col min-h-0">
        <!-- Tab Headers -->
        <div class="flex items-center gap-4 mb-6 scrollbar-hide overflow-x-auto pb-2 print:hidden">
            <button @click="activeTab = 'nihongo'" :class="activeTab === 'nihongo' ? 'bg-[#173A67] text-white shadow-lg shadow-blue-900/20' : 'bg-gray-50 text-gray-500 hover:bg-gray-100'" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="languages" class="w-4 h-4"></i> Nihongo Matrix
            </button>
            <button @click="activeTab = 'physical'" :class="activeTab === 'physical' ? 'bg-[#173A67] text-white shadow-lg shadow-blue-900/20' : 'bg-gray-50 text-gray-500 hover:bg-gray-100'" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="activity" class="w-4 h-4"></i> FMD & Presensi
            </button>
            <button @click="activeTab = 'interview'" :class="activeTab === 'interview' ? 'bg-[#173A67] text-white shadow-lg shadow-blue-900/20' : 'bg-gray-50 text-gray-500 hover:bg-gray-100'" class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all whitespace-nowrap flex items-center gap-2">
                <i data-lucide="mic-2" class="w-4 h-4"></i> Interview & Notes
            </button>
        </div>

        @php 
            $tabContentClasses = "flex-1 space-y-6";
        @endphp

        <!-- Tab Content: NIHONGO -->
        <div x-show="activeTab === 'nihongo'" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="{{ $tabContentClasses }}">
            <div class="hidden print:block border-l-4 border-[#173A67] pl-4 mb-4">
                <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">Nihongo Matrix Analysis</h4>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Subject Cards with Weekly breakdown -->
                @php 
                    $subjects = [
                        ['name' => 'Kanji', 'icon' => '漢', 'color' => 'orange', 'assessments' => $kanjiAssessments, 'route' => 'sensei.evaluasi.detail.siswa.kanji'],
                        ['name' => 'Bunpou', 'icon' => '文', 'color' => 'blue', 'assessments' => $bunpouAssessment, 'type' => 'bunpou', 'route' => 'sensei.penilaian.bunpou'],
                        ['name' => 'Kotoba', 'icon' => '言', 'color' => 'emerald', 'assessments' => $kotobaAssessments, 'route' => 'sensei.penilaian.kotoba'],
                    ];
                @endphp

                @foreach($subjects as $sub)
                <div class="bg-gray-50 border border-gray-100 rounded-[2rem] p-6 flex flex-col group hover:bg-white hover:shadow-xl transition-all duration-500 print:bg-white print:border-gray-200">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-{{ $sub['color'] }}-100 text-{{ $sub['color'] }}-600 flex items-center justify-center font-black text-lg group-hover:rotate-12 transition-transform shadow-sm print:shadow-none">
                                {{ $sub['icon'] }}
                            </div>
                            <div>
                                <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">{{ $sub['name'] }}</h4>
                                <p class="text-[8px] font-bold text-gray-400 uppercase tracking-widest">Performance Analysis</p>
                            </div>
                        </div>
                        <a href="{{ route($sub['route'], ['id' => $student->id]) }}" class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 hover:rotate-12 transition-all shadow-lg shadow-blue-900/10 active:scale-90 print:hidden" title="Detail">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-4 gap-2 mb-6">
                        @for($i=1; $i<=4; $i++)
                            @php 
                                if(isset($sub['type']) && $sub['type'] === 'bunpou') {
                                    $field = "eval{$i}";
                                    $score = $sub['assessments']->$field ?? null;
                                } else {
                                    $score = $sub['assessments'][$i]->score ?? null;
                                }
                            @endphp
                            <div class="flex flex-col items-center gap-1.5">
                                <span class="text-[8px] font-black text-gray-400">M{{ $i }}</span>
                                <div class="w-full aspect-square rounded-xl {{ $score !== null && $score >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-50 text-red-500' }} flex items-center justify-center text-[10px] font-black border {{ $score !== null && $score >= 75 ? 'border-green-200' : 'border-red-100' }} print:bg-white">
                                    {{ $score ?? '-' }}
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Avg Score</span>
                        @php 
                            if(isset($sub['type']) && $sub['type'] === 'bunpou') { $avg = $bunpouAvg; } 
                            else { $avg = $sub['assessments']->avg('score'); }
                        @endphp
                        <span class="text-sm font-black text-[#173A67]">{{ round($avg ?? 0, 1) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Tab Content: PHYSICAL -->
        <div x-show="activeTab === 'physical'" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="{{ $tabContentClasses }}">
            <div class="hidden print:block border-l-4 border-[#173A67] pl-4 mb-4">
                <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">FMD & Attendance Statistics</h4>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- FMD Analysis -->
                <div class="col-span-12 lg:col-span-7 bg-gray-50 rounded-[2rem] p-8 border border-gray-100 print:bg-white print:border-gray-200">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center">
                                <i data-lucide="activity" class="w-6 h-6"></i>
                            </div>
                            <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">FMD Statistics</h4>
                        </div>
                        <a href="{{ route('sensei.penilaian.fmd') }}?kelas_id={{ $student->kelas_id }}" class="px-4 py-2 bg-[#173A67] text-white text-[10px] font-black uppercase tracking-widest rounded-xl shadow-lg shadow-blue-900/20 hover:bg-blue-900 transition-all print:hidden">Update Data</a>
                    </div>
                    
                    <div class="space-y-6">
                        @foreach(['MTK' => 85, 'Lari' => 3730, 'Pushup' => 45] as $metric => $val)
                        <div class="flex items-center gap-6">
                            <div class="w-24 text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ $metric }}</div>
                            <div class="flex-1 h-3 bg-white rounded-full border border-gray-100 overflow-hidden text-center relative print:border-gray-300">
                                <div class="h-full bg-rose-500 rounded-full shadow-[0_0_10px_rgba(244,63,94,0.3)]" style="width: {{ $val > 100 ? 90 : $val }}%"></div>
                            </div>
                            <div class="w-16 text-right text-xs font-black text-[#173A67]">{{ $val }}{{ $metric == 'Lari' ? 'm' : '' }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Presensi Chart-like Card -->
                <div class="col-span-12 lg:col-span-5 bg-white border-2 border-gray-50 rounded-[2rem] p-8 shadow-sm group print:border-gray-200">
                    <div class="text-center mb-6">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Month Attendance</p>
                        <div class="w-32 h-32 rounded-full border-8 border-gray-50 mx-auto flex items-center justify-center relative shadow-inner print:border-gray-100">
                            <span class="text-3xl font-black text-blue-600">{{ $presensiScore }}<span class="text-sm pb-1">%</span></span>
                            <!-- SVG Progress -->
                            <svg class="absolute inset-0 w-full h-full -rotate-90">
                                <circle cx="50%" cy="50%" r="56" fill="transparent" stroke="currentColor" stroke-width="8" class="text-blue-500 transition-all duration-1000" stroke-dasharray="351.8" :stroke-dashoffset="351.8 - (351.8 * {{ $presensiScore }} / 100)"></circle>
                            </svg>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-2xl text-center print:bg-white print:border print:border-gray-100">
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Hadir</p>
                            <p class="text-lg font-black text-[#173A67]">22 Hari</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-2xl text-center print:bg-white print:border print:border-gray-100">
                            <p class="text-[8px] font-black text-gray-400 uppercase tracking-widest">Absen</p>
                            <p class="text-lg font-black text-red-500">0 Hari</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Content: INTERVIEW -->
        <div x-show="activeTab === 'interview'" x-transition:enter="transition ease-out duration-300 transform opacity-0 scale-95" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="{{ $tabContentClasses }}">
            <div class="hidden print:block border-l-4 border-[#173A67] pl-4 mb-4">
                <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">Interview Analysis & Remarks</h4>
            </div>
            <div class="bg-gray-50 rounded-[2rem] border border-gray-100 p-8 print:bg-white print:border-gray-200">
                <div class="flex items-center justify-between mb-10">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center shadow-sm">
                            <i data-lucide="message-square" class="w-7 h-7"></i>
                        </div>
                        <div>
                            <h4 class="text-[#173A67] font-black text-sm uppercase tracking-widest">Interview Analysis</h4>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Couseur & Teacher Remarks</p>
                        </div>
                    </div>
                    <a href="{{ route('sensei.penilaian.wawancara') }}?kelas_id={{ $student->kelas_id }}" class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#173A67] text-white hover:bg-blue-900 hover:rotate-12 transition-all shadow-lg shadow-blue-900/10 active:scale-90 print:hidden">
                        <i data-lucide="edit-3" class="w-6 h-6"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Score Breakdown -->
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm relative overflow-hidden group print:border-gray-200">
                        <div class="absolute -right-4 -top-4 opacity-[0.03] group-hover:scale-110 transition-transform print:hidden">
                            <i data-lucide="check-square" class="w-32 h-32 text-purple-600"></i>
                        </div>
                        <h5 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6">Component Scores</h5>
                        <div class="space-y-4">
                            @foreach(['Program' => 3, 'Umum' => 3, 'B. Jepang' => 3, 'B. Indo' => 3] as $comp => $cv)
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-black text-[#173A67]">{{ $comp }}</span>
                                <div class="flex gap-1">
                                    @for($i=1; $i<=3; $i++)
                                        <div class="w-4 h-4 rounded {{ $i <= $cv ? 'bg-purple-500' : 'bg-gray-100 border border-gray-200' }}"></div>
                                    @endfor
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                            <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Final Interview Score</span>
                            <span class="text-2xl font-black text-purple-600">{{ $wawancaraScore }}%</span>
                        </div>
                    </div>

                    <!-- Remarks -->
                    <div class="space-y-6">
                        <div class="bg-purple-50 rounded-[2rem] p-8 border border-purple-100 relative print:bg-white print:border-purple-200">
                            <div class="absolute -top-3 left-8 px-4 py-1 bg-white rounded-full border border-purple-100 text-[8px] font-black text-purple-600 uppercase tracking-widest">Sensei Remarks</div>
                            <p class="text-xs text-purple-800 leading-relaxed font-bold italic">
                                "{{ $student->name }} menunjukkan motivasi yang sangat kuat terutama dalam pemahaman pola kalimat. Sikap disiplin di kelas sangat menonjol."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PRINT ONLY REPORT: FORMAL TABLE LAYOUT -->
<div class="printable-report font-serif text-black p-4">
    <!-- Report Header -->
    <div class="text-center border-b-4 border-black pb-6 mb-8">
        <div class="flex items-center justify-center gap-6 mb-4">
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-16 w-auto" alt="Logo">
            <div class="text-left">
                <h1 class="text-3xl font-bold">PT SAITAMA JUARA DUNIA</h1>
                <p class="text-xs tracking-[0.3em] font-semibold text-gray-600">LAPORAN EVALUASI SISWA TERPADU</p>
            </div>
        </div>
    </div>

    <!-- Student Information -->
    <div class="mb-10">
        <h2 class="text-lg font-bold uppercase mb-4 border-b border-black inline-block">Biodata Siswa</h2>
        <table class="w-full border-collapse border border-black text-sm">
            <tr>
                <td class="border border-black p-2 bg-gray-100 font-bold w-1/4">Nama Lengkap</td>
                <td class="border border-black p-2 w-1/4">{{ $student->name }}</td>
                <td class="border border-black p-2 bg-gray-100 font-bold w-1/4">Nomor Induk (NIM)</td>
                <td class="border border-black p-2 w-1/4">{{ $student->nim ?? '-' }}</td>
            </tr>
            <tr>
                <td class="border border-black p-2 bg-gray-100 font-bold">Angkatan / Kelas</td>
                <td class="border border-black p-2">{{ $student->kelas->nama_kelas ?? '-' }}</td>
                <td class="border border-black p-2 bg-gray-100 font-bold">Status Keaktifan</td>
                <td class="border border-black p-2 font-bold">{{ $student->status ?? 'AKTIF' }}</td>
            </tr>
        </table>
    </div>

    <!-- Nihongo Assessment Table -->
    <div class="mb-10">
        <h2 class="text-lg font-bold uppercase mb-4 border-b border-black inline-block">1. Nihongo Matrix (Weekly Progress)</h2>
        <table class="w-full border-collapse border border-black text-sm text-center">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-black p-2">Mata Pelajaran</th>
                    <th class="border border-black p-2">Minggu 1</th>
                    <th class="border border-black p-2">Minggu 2</th>
                    <th class="border border-black p-2">Minggu 3</th>
                    <th class="border border-black p-2">Minggu 4</th>
                    <th class="border border-black p-2 font-bold">Rata-Rata</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['name' => 'Kanji', 'data' => $kanjiAssessments, 'avg' => $kanjiAvg],
                    ['name' => 'Kotoba', 'data' => $kotobaAssessments, 'avg' => $kotobaAvg],
                    ['name' => 'Bunpou', 'data' => $bunpouAssessment, 'avg' => $bunpouAvg, 'is_bunpou' => true]
                ] as $item)
                <tr>
                    <td class="border border-black p-2 font-bold text-left">{{ $item['name'] }}</td>
                    @for($i=1; $i<=4; $i++)
                        @php
                            if(isset($item['is_bunpou'])) {
                                $f = "eval{$i}";
                                $score = $item['data']->$f ?? null;
                            } else {
                                $score = $item['data'][$i]->score ?? null;
                            }
                        @endphp
                        <td class="border border-black p-2 {{ $score && $score < 75 ? 'text-red-600 font-bold' : '' }}">
                            {{ $score ?? '-' }}
                        </td>
                    @endfor
                    <td class="border border-black p-2 font-bold bg-gray-50">{{ round($item['avg'], 1) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- FMD & Discipline Table -->
    <div class="mb-10 page-break-before">
        <h2 class="text-lg font-bold uppercase mb-4 border-b border-black inline-block">2. FMD & Kedisiplinan</h2>
        <table class="w-full border-collapse border border-black text-sm text-center">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-black p-2 text-left">Aspek Penilaian</th>
                    <th class="border border-black p-2">Hasil / Nilai</th>
                    <th class="border border-black p-2 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach([
                    ['label' => 'Matematika (MTK)', 'type' => 'mtk', 'unit' => ''],
                    ['label' => 'Lari (Fisik)', 'type' => 'lari', 'unit' => 'm'],
                    ['label' => 'Push-Up', 'type' => 'pushup', 'unit' => ' Kali']
                ] as $fmd)
                @php
                    $assessment = $fmdTableAssessments->get($fmd['type']);
                    $avgVal = 0;
                    if($assessment) {
                        $vals = [];
                        for($i=1; $i<=5; $i++) {
                            $f = "week{$i}_val";
                            if($assessment->$f) $vals[] = $assessment->$f;
                        }
                        $avgVal = count($vals) > 0 ? array_sum($vals)/count($vals) : 0;
                    }
                @endphp
                <tr>
                    <td class="border border-black p-2 text-left font-bold">{{ $fmd['label'] }}</td>
                    <td class="border border-black p-2 font-bold">{{ round($avgVal) }}{{ $fmd['unit'] }}</td>
                    <td class="border border-black p-2 text-left italic">
                        @if($fmd['type'] == 'mtk')
                            {{ $avgVal >= 75 ? 'Kemampuan logika matematika baik.' : 'Perlu bimbingan intensif pada logika dasar.' }}
                        @elseif($fmd['type'] == 'lari')
                            {{ $avgVal >= 3000 ? 'Stamina dan ketahanan fisik prima.' : 'Ketahanan fisik perlu ditingkatkan lagi.' }}
                        @else
                            {{ $avgVal >= 35 ? 'Kekuatan otot lengan sesuai standar.' : 'Latihan fisik harian perlu diperbanyak.' }}
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr class="bg-gray-50 font-bold">
                    <td class="border border-black p-2 text-left">Persentase Presensi</td>
                    <td class="border border-black p-2 text-blue-700 text-lg">{{ $presensiScore }}%</td>
                    <td class="border border-black p-2 text-left text-green-700">
                        {{ $presensiScore >= 95 ? 'Sangat Disiplin (Tanpa Alfa)' : ($presensiScore >= 80 ? 'Disiplin Baik' : 'Kehadiran perlu diperbaiki') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Interview & Remarks Table -->
    <div class="mb-10">
        <h2 class="text-lg font-bold uppercase mb-4 border-b border-black inline-block">3. Hasil Wawancara & Evaluasi Akhir</h2>
        <table class="w-full border-collapse border border-black text-sm mb-6">
            <tr class="bg-gray-100 font-bold text-center">
                <td class="border border-black p-2">Aspek Wawancara</td>
                <td class="border border-black p-2 w-1/4">Skor</td>
                <td class="border border-black p-2">Nilai Akhir (Rata-Rata)</td>
            </tr>
            <tr>
                <td class="border border-black p-2">
                    <ul class="list-disc ml-4 space-y-1">
                        <li>Kesiapan Program & Motivasi</li>
                        <li>Pengetahuan Umum & Karakter</li>
                        <li>Kemampuan Bahasa Jepang</li>
                        <li>Kemampuan Bahasa Indonesia</li>
                    </ul>
                </td>
                <td class="border border-black p-2 text-center text-xl font-bold text-purple-700">{{ $wawancaraScore }}%</td>
                <td class="border border-black p-2 text-center text-4xl font-bold bg-blue-50 text-[#173A67]">{{ $nilaiAkhirScore }}</td>
            </tr>
        </table>
        
        <div class="border-2 border-black p-4 bg-gray-50">
            <p class="text-[10px] font-bold uppercase mb-2 tracking-widest text-gray-600">Catatan Khusus Pengajar (Sensei Remarks):</p>
            <p class="text-sm italic font-semibold">
                "{{ $student->name }} menunjukkan perkembangan yang sangat signifikan terutama pada pemahaman tata bahasa (Bunpou). Disiplin harian dan semangat belajar di kelas sangat positif. Direkomendasikan untuk melanjutkan ke tahap berikutnya dengan pengawasan pada kosa kata (Kotoba)."
            </p>
        </div>
    </div>

    <!-- Signature Area -->
    <div class="mt-16 flex justify-between items-center px-12">
        <div class="text-center">
            <p class="text-xs mb-16">Mengetahui,<br>Orang Tua / Wali Siswa</p>
            <p class="text-sm font-bold border-t border-black pt-1">( ........................................ )</p>
        </div>
        <div class="text-center">
            <p class="text-xs mb-16">Semarang, {{ date('d F Y') }}<br>Sensei Pengajar</p>
            <p class="text-sm font-bold border-t border-black pt-1">( {{ Auth::user()->name ?? 'Sensei Saitama' }} )</p>
        </div>
    </div>
</div>

<style>
    /* Default: Hide printable report on screen */
    .printable-report {
        display: none;
    }

    @media print {
        /* Force display of the report */
        .printable-report {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            width: 100% !important;
        }

        /* Hide everything else */
        header, aside, .sidebar-sensei, button, .back-button, .print-hidden, .screen-only {
            display: none !important;
            visibility: hidden !important;
        }

        /* Reset layout for paper */
        body { background: white !important; margin: 0 !important; padding: 0 !important; -webkit-print-color-adjust: exact; }
        .bg-[#F3F4F6] { background: white !important; }
        
        main { 
            margin: 0 !important; 
            padding: 0 !important; 
            width: 100% !important; 
            display: block !important;
            position: static !important;
            transform: none !important;
        }
        
        /* Remove sidebar offset from layout */
        .flex.pt-16.min-h-screen {
            padding-top: 0 !important;
            display: block !important;
        }

        @page {
            margin: 1cm;
            size: A4;
        }

        .page-break-before { page-break-before: always; }
        
        /* Professional Table Styling */
        table { 
            border-collapse: collapse !important; 
            width: 100% !important;
            margin-bottom: 20px !important;
        }
        th, td { 
            border: 1.5pt solid black !important; 
            padding: 8px !important;
        }
        
        /* Colors for printing (forced) */
        .bg-gray-100 { background-color: #e5e7eb !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .bg-gray-50 { background-color: #f3f4f6 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .bg-blue-50 { background-color: #eff6ff !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        
        /* Text overrides */
        .text-blue-700 { color: #1d4ed8 !important; }
        .text-red-600 { color: #dc2626 !important; }
        .text-purple-700 { color: #7e22ce !important; }
        .text-[#173A67] { color: #173A67 !important; }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        
        // Radar Chart Implementation
        const ctx = document.getElementById('performanceRadar').getContext('2d');
        const radarChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: @js($chartData['labels']),
                datasets: [{
                    label: 'Score Percentage',
                    data: @js($chartData['scores']),
                    fill: true,
                    backgroundColor: 'rgba(23, 58, 103, 0.15)',
                    borderColor: '#173A67',
                    pointBackgroundColor: '#173A67',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#173A67',
                    borderWidth: 3
                }]
            },
            options: {
                elements: {
                    line: { tension: 0.1 }
                },
                scales: {
                    r: {
                        angleLines: { display: false },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        ticks: { display: false },
                        pointLabels: {
                            font: {
                                size: 8,
                                weight: '900',
                                family: 'sans-serif'
                            }
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
@endpush
@endsection
