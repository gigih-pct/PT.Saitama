@extends('layouts.header_dashboard_sensei')

@section('title', 'Detail Kanji - ' . $student->name)

@section('content')
<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8 z-10 relative">
        <div class="flex items-center gap-6">
            <button onclick="window.history.back()" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#173A67] hover:text-white hover:rotate-[-90deg] transition-all duration-500 shadow-sm border border-gray-100">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </button>
            <div class="space-y-1">
                <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                    Detail Nilai Kanji
                    <span class="px-4 py-1.5 rounded-xl bg-orange-100 text-orange-600 text-[10px] font-black uppercase tracking-widest border border-orange-200">漢 Kanji</span>
                </h1>
                <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Analytics & History Penilaian per Bab</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
             <div class="px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100 flex items-center gap-4">
                <div class="flex flex-col text-right">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa</span>
                    <span class="text-sm font-black text-[#173A67]">{{ $student->name }}</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center font-black">
                    {{ substr($student->name, 0, 1) }}
                </div>
             </div>
        </div>
    </div>

    <!-- ANALYTICS BANNER -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 relative z-10">
        <!-- Progress -->
        <div class="bg-[#173A67] rounded-3xl p-6 text-white shadow-xl shadow-blue-900/10 relative overflow-hidden group">
            <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform duration-500">
                <i data-lucide="check-circle" class="w-24 h-24"></i>
            </div>
            <p class="text-[10px] font-black text-blue-300 uppercase tracking-[0.2em] mb-4">Progress Bab</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black">{{ $stats['completed'] }}<span class="text-xl text-blue-300">/{{ $stats['total_bab'] }}</span></h3>
                <span class="text-xs font-bold bg-white/10 px-3 py-1 rounded-lg">{{ round(($stats['completed']/$stats['total_bab'])*100) }}%</span>
            </div>
            <div class="mt-4 h-1.5 w-full bg-white/10 rounded-full overflow-hidden">
                <div class="h-full bg-blue-400" style="width: {{ ($stats['completed']/$stats['total_bab'])*100 }}%"></div>
            </div>
        </div>

        <!-- Avg Score -->
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-50 shadow-sm relative overflow-hidden group">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Rata-Rata Skor</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-[#173A67]">{{ $stats['avg_score'] }}</h3>
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 mt-4">Pencapaian keseluruhan siswa</p>
        </div>

        <!-- Pass Rate -->
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-50 shadow-sm relative overflow-hidden group">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Tingkat Kelulusan</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-green-600">{{ $stats['pass_rate'] }}<span class="text-xl text-green-300">%</span></h3>
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center">
                    <i data-lucide="award" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 mt-4">{{ $stats['pass_count'] }} Bab dengan skor ≥ 75</p>
        </div>

        <!-- Target -->
        <div class="bg-white rounded-3xl p-6 border-2 border-gray-50 shadow-sm relative overflow-hidden group">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Sisa Bab</p>
            <div class="flex items-end justify-between">
                <h3 class="text-4xl font-black text-red-500">{{ $stats['total_bab'] - $stats['completed'] }}</h3>
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center">
                    <i data-lucide="clock" class="w-5 h-5"></i>
                </div>
            </div>
            <p class="text-[10px] font-bold text-gray-400 mt-4">Segera selesaikan semua bab</p>
        </div>
    </div>

    <!-- KANJI PROGRESS MATRIX -->
    <div class="bg-gray-50 rounded-[2.5rem] p-8 border-2 border-white shadow-inner mb-8 relative">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center shadow-lg">
                    <i data-lucide="grid" class="w-5 h-5"></i>
                </div>
                <div>
                    <h4 class="text-sm font-black text-[#173A67] tracking-tight">Kanji Progress Matrix</h4>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest text-xs">Peta capaian 34 Bab Kanji</p>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Lulus</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500"></div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Remidi</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-gray-200"></div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase">Kosong</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-7 sm:grid-cols-10 md:grid-cols-12 lg:grid-cols-17 gap-3">
            @foreach($matrix as $bab => $item)
                @php
                    $statusCls = 'bg-gray-200 text-gray-400 hover:bg-[#173A67] hover:text-white';
                    if($item) {
                        $statusCls = $item->score >= 75 ? 'bg-green-500 text-white shadow-lg shadow-green-500/20' : 'bg-red-500 text-white shadow-lg shadow-red-500/20';
                    }
                @endphp
                <a href="{{ $item ? '#bab-'.$bab : route('sensei.penilaian.kanji', ['bab' => $bab, 'kelas_id' => $student->kelas_id]) }}" 
                   title="{{ $item ? 'Bab '.$bab.': '.$item->score.'%' : 'Bab '.$bab.': Belum dinilai' }}"
                   class="aspect-square flex flex-col items-center justify-center rounded-xl text-xs font-black transition-all hover:scale-110 active:scale-95 {{ $statusCls }}">
                    {{ $bab }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- HISTORY TABLE -->
    <div class="flex-1 flex flex-col min-h-0">
        <div class="flex items-center justify-between mb-6">
            <h4 class="text-lg font-black text-[#173A67] tracking-tight flex items-center gap-3">
                 <i data-lucide="history" class="w-5 h-5 text-gray-400"></i>
                 Riwayat Penilaian Detail
            </h4>
        </div>

        <div class="bg-white border-2 border-gray-50 rounded-[2rem] overflow-hidden flex-1 shadow-sm overflow-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest w-24">Bab</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal Penilaian</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Benar</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Skor</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($assessments as $item)
                        <tr id="bab-{{ $item->bab }}" class="hover:bg-blue-50/30 transition-colors group">
                            <td class="px-6 py-6 text-center">
                                <span class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center font-black text-[#173A67] text-sm group-hover:bg-[#173A67] group-hover:text-white transition-all">
                                    {{ $item->bab }}
                                </span>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->date)->translatedFormat('l, d F Y') }}</span>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase">{{ \Carbon\Carbon::parse($item->date)->diffForHumans() }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="text-sm font-black text-[#173A67]">{{ $item->correct }} <span class="text-[10px] text-gray-400">Soal</span></span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="text-lg font-black {{ $item->score >= 75 ? 'text-green-600' : 'text-red-500' }}">{{ $item->score }}</span>
                            </td>
                            <td class="px-6 py-6 text-center">
                                @if($item->score >= 75)
                                    <span class="px-4 py-1.5 rounded-full bg-green-100 text-green-700 text-[10px] font-black uppercase tracking-widest border border-green-200">Lulus</span>
                                @else
                                    <span class="px-4 py-1.5 rounded-full bg-red-100 text-red-700 text-[10px] font-black uppercase tracking-widest border border-red-200">Remidi</span>
                                @endif
                            </td>
                            <td class="px-6 py-6 text-right">
                                <a href="{{ route('sensei.penilaian.kanji') }}?bab={{ $item->bab }}&kelas_id={{ $student->kelas_id }}" class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center hover:bg-blue-900 hover:rotate-12 transition-all shadow-lg shadow-blue-900/10 active:scale-90" title="Detail">
                                    <i data-lucide="edit-3" class="w-5 h-5"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center">
                                <div class="flex flex-col items-center justify-center space-y-4">
                                    <div class="w-20 h-20 rounded-[2rem] bg-gray-50 flex items-center justify-center text-gray-200">
                                        <i data-lucide="ghost" class="w-10 h-10"></i>
                                    </div>
                                    <div>
                                        <p class="text-base font-black text-[#173A67]">Belum Ada Data Penilaian</p>
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Riwayat nilai kanji belum tersedia untuk siswa ini</p>
                                    </div>
                                    <a href="{{ route('sensei.penilaian.kanji') }}?kelas_id={{ $student->kelas_id }}" class="px-6 py-2.5 bg-[#173A67] text-white rounded-xl text-[10px] font-black shadow-lg uppercase tracking-widest hover:bg-blue-900 transition-all">
                                        Input Nilai Sekarang
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
<style>
    .lg\:grid-cols-17 {
        grid-template-columns: repeat(17, minmax(0, 1fr));
    }
    @media (max-width: 1024px) {
        .lg\:grid-cols-17 {
            grid-template-columns: repeat(10, minmax(0, 1fr));
        }
    }
    @media (max-width: 640px) {
        .lg\:grid-cols-17 {
            grid-template-columns: repeat(7, minmax(0, 1fr));
        }
    }
</style>
@endpush
@endsection
