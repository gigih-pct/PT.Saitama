@extends('layouts.header_dashboard_sensei')

@section('title', 'Detail Kanji - ' . $student->name)

@section('content')
<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10 z-10 relative">
        <div class="flex items-center gap-6">
            <button onclick="window.history.back()" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#173A67] hover:text-white hover:rotate-[-90deg] transition-all duration-500 shadow-sm border border-gray-100">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </button>
            <div class="space-y-1">
                <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight flex items-center gap-3">
                    Detail Nilai Kanji
                    <span class="px-4 py-1.5 rounded-xl bg-orange-100 text-orange-600 text-[10px] font-black uppercase tracking-widest border border-orange-200">漢 Kanji</span>
                </h1>
                <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">History Penilaian Kanji Siswa per Bab</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
             <div class="px-6 py-3 bg-gray-50 rounded-2xl border border-gray-100 flex items-center gap-4">
                <div class="flex flex-col">
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Siswa</span>
                    <span class="text-sm font-black text-[#173A67]">{{ $student->name }}</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-[#173A67] text-white flex items-center justify-center font-black">
                    {{ substr($student->name, 0, 1) }}
                </div>
             </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 flex-1">
        <!-- LEFT: LIST PENILAIAN -->
        <div class="col-span-12 flex flex-col gap-6">
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="px-5 py-2 bg-[#173A67] rounded-xl text-[10px] font-black text-white shadow-lg uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="calendar" class="w-3 h-3 text-blue-300"></i>
                        Riwayat Bab
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Lulus (≥75)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Remidial (<75)</span>
                    </div>
                </div>
            </div>

            <!-- List Mobile/Card Look -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($assessments as $item)
                    <div class="bg-white rounded-[2rem] p-6 border-2 border-gray-100 hover:border-[#173A67] transition-all group relative overflow-hidden shadow-sm">
                        <!-- Background Pattern -->
                        <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:scale-110 transition-transform duration-500 rotate-12">
                            <i data-lucide="book-open" class="w-24 h-24 text-[#173A67]"></i>
                        </div>

                        <div class="flex justify-between items-start mb-6">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Bab</p>
                                <h3 class="text-3xl font-black text-[#173A67]">{{ $item->bab }}</h3>
                            </div>
                            <div class="w-14 h-14 rounded-2xl {{ $item->score >= 75 ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-50 text-red-500 border-red-100' }} border-2 flex items-center justify-center font-black text-xl shadow-inner">
                                {{ $item->score }}
                            </div>
                        </div>

                        <div class="space-y-4 relative z-10">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Benar</span>
                                <span class="text-xs font-black text-[#173A67]">{{ $item->correct }} Soal</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal</span>
                                <span class="text-xs font-black text-[#173A67]">{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</span>
                            </div>
                            
                            <!-- Progress Micro -->
                            <div class="space-y-1.5 pt-2">
                                <div class="flex justify-between text-[8px] font-black text-gray-400 uppercase tracking-widest">
                                    <span>Skor Pencapaian</span>
                                    <span>{{ $item->score }}%</span>
                                </div>
                                <div class="h-1.5 w-full bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full {{ $item->score >= 75 ? 'bg-green-500 shadow-[0_0_8px_rgba(34,197,94,0.4)]' : 'bg-red-500 shadow-[0_0_8px_rgba(239,68,68,0.4)]' }} transition-all duration-1000" style="width: {{ $item->score }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Hover Action -->
                        <div class="mt-6 pt-4 border-t border-gray-50 flex justify-end">
                            <a href="{{ route('sensei.penilaian.kanji') }}?bab={{ $item->bab }}&kelas_id={{ $student->kelas_id }}" class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#173A67] hover:text-white transition-all shadow-sm">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 flex flex-col items-center justify-center text-center space-y-4">
                        <div class="w-24 h-24 rounded-[2rem] bg-gray-50 flex items-center justify-center text-gray-300">
                            <i data-lucide="inbox" class="w-12 h-12"></i>
                        </div>
                        <div>
                            <p class="text-lg font-black text-[#173A67]">Belum Ada Data</p>
                            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest">Siswa ini belum memiliki riwayat penilaian Kanji</p>
                        </div>
                        <a href="{{ route('sensei.penilaian.show', ['type' => 'kanji']) }}" class="mt-4 px-8 py-3 bg-[#173A67] text-white rounded-2xl text-sm font-bold shadow-lg hover:bg-blue-900 transition-all">
                            Input Nilai Sekarang
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
