@extends('layouts.header_dashboard_sensei')

@section('title', 'Detail Evaluasi - ' . $student->name)

@section('content')
<div class="bg-white rounded-[2.5rem] p-6 lg:p-8 shadow-sm border border-gray-100 min-h-[85vh] flex flex-col relative overflow-hidden font-sans">
    
    <!-- HEADER SECTION -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-10 z-10 relative">
        <div class="flex items-center gap-6">
            <button onclick="window.history.back()" class="w-12 h-12 rounded-2xl bg-gray-50 flex items-center justify-center text-gray-400 hover:bg-[#173A67] hover:text-white hover:rotate-[-90deg] transition-all duration-500 shadow-sm border border-gray-100">
                <i data-lucide="arrow-left" class="w-6 h-6"></i>
            </button>
            <div class="space-y-1">
                <h1 class="text-[#173A67] font-black text-2xl lg:text-3xl tracking-tight">Detail Evaluasi</h1>
                <p class="text-gray-400 text-xs font-bold tracking-widest uppercase">Laporan Perkembangan Kemampuan Siswa</p>
            </div>
        </div>

        <div class="flex items-center gap-3">
             <button class="px-6 py-3 bg-[#173A67] text-white rounded-2xl text-sm font-bold shadow-lg shadow-blue-900/20 hover:bg-blue-900 active:scale-95 transition-all flex items-center gap-2" title="Print Laporan">
                <i data-lucide="printer" class="w-4 h-4"></i> Cetak Evaluasi
            </button>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 flex-1">
        <!-- LEFT: PROFILE CARD -->
        <div class="col-span-12 lg:col-span-4 lg:border-right lg:border-gray-100">
            <div class="bg-gray-50 rounded-[2.5rem] p-8 border border-gray-100 flex flex-col items-center text-center relative overflow-hidden group">
                <!-- Background Pattern -->
                <div class="absolute -top-10 -right-10 opacity-[0.03] group-hover:scale-110 transition-transform duration-700">
                    <i data-lucide="user" class="w-64 h-64"></i>
                </div>

                <!-- Avatar -->
                <div class="relative mb-6">
                    <div class="w-40 h-40 rounded-[3rem] bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center text-white text-6xl font-black shadow-2xl rotate-3 group-hover:rotate-0 transition-all duration-500 overflow-hidden">
                        {{ substr($student->name, 0, 1) }}
                    </div>
                    <div class="absolute -bottom-2 -right-2 w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-blue-600 shadow-xl border border-gray-50">
                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                    </div>
                </div>

                <!-- Basic Info -->
                <h2 class="text-2xl font-black text-[#173A67] mb-1">{{ $student->name }}</h2>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-[0.2em] mb-6">{{ $student->kelas ? $student->kelas->nama_kelas : 'Tanpa Angkatan' }}</p>

                <!-- Status Badge -->
                <div class="px-8 py-2.5 rounded-2xl bg-green-100 text-green-700 text-xs font-black uppercase tracking-widest mb-10 shadow-sm border border-green-200">
                    {{ $student->status ?? 'Aktif' }}
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-2 gap-4 w-full">
                    <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">NIM</p>
                        <p class="text-sm font-black text-[#173A67]">{{ $student->nim ?? '23.12.2865' }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-3xl border border-gray-100 shadow-sm">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">TL</p>
                        <p class="text-sm font-black text-[#173A67]">{{ $student->tanggal_lahir ?? '18/05/2001' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT: EVALUASI LIST -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            
            <!-- Toolbar -->
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-3xl border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="px-5 py-2 bg-[#173A67] rounded-xl text-[10px] font-black text-white shadow-lg uppercase tracking-widest flex items-center gap-2">
                        <i data-lucide="bar-chart-3" class="w-3 h-3 text-blue-300"></i>
                        Matrix Penilaian
                    </div>
                </div>
                <div class="flex gap-2">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Lulus</span>
                    <div class="w-3 h-3 rounded-full bg-red-500 ml-2"></div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Remidial</span>
                </div>
            </div>

            <!-- Table Container -->
            <div class="bg-white border-2 border-gray-100 rounded-[2rem] overflow-hidden shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-[#173A67] text-white">
                        <tr>
                            <th class="px-8 py-5 font-black text-xs uppercase tracking-widest">Mata Pelajaran</th>
                            @for($i=1; $i<=4; $i++)
                                <th class="px-4 py-5 font-black text-xs uppercase tracking-widest text-center">M{{ $i }}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- KANJI -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-orange-100 text-orange-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <span class="font-black text-sm">漢</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">Kanji</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Logographic System</p>
                                    </div>
                                </div>
                            </td>
                            @for($i=1; $i<=4; $i++)
                                <td class="px-4 py-6 text-center">
                                    @php $score = $kanjiAssessments[$i]->score ?? null; @endphp
                                    <div class="inline-flex items-center gap-2">
                                        <span class="w-10 h-10 flex items-center justify-center rounded-xl {{ $score !== null && $score >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-50 text-red-500' }} font-black text-xs shadow-sm border {{ $score !== null && $score >= 75 ? 'border-green-200' : 'border-red-100' }}">
                                            {{ $score ?? '-' }}
                                        </span>
                                        <a href="{{ route('sensei.evaluasi.detail.siswa.kanji', ['id' => $student->id]) }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                                        </a>
                                    </div>
                                </td>
                            @endfor
                        </tr>

                        <!-- BUNPOU -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <span class="font-black text-sm">文</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">Bunpou</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Grammar Structure</p>
                                    </div>
                                </div>
                            </td>
                            @for($i=1; $i<=4; $i++)
                                <td class="px-4 py-6 text-center">
                                    @php $field = "eval{$i}"; $score = $bunpouAssessment->$field ?? null; @endphp
                                    <div class="inline-flex items-center gap-2">
                                        <span class="w-10 h-10 flex items-center justify-center rounded-xl {{ $score !== null && $score >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-50 text-red-500' }} font-black text-xs shadow-sm border {{ $score !== null && $score >= 75 ? 'border-green-200' : 'border-red-100' }}">
                                            {{ $score ?? '-' }}
                                        </span>
                                        <a href="{{ route('sensei.penilaian.bunpou') }}?kelas_id={{ $student->kelas_id }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                                        </a>
                                    </div>
                                </td>
                            @endfor
                        </tr>

                        <!-- KOTOBA -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <span class="font-black text-sm">言</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">Kotoba</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Vocabulary Base</p>
                                    </div>
                                </div>
                            </td>
                            @for($i=1; $i<=4; $i++)
                                <td class="px-4 py-6 text-center">
                                    @php $score = $kotobaAssessments[$i]->score ?? null; @endphp
                                    <div class="inline-flex items-center gap-2">
                                        <span class="w-10 h-10 flex items-center justify-center rounded-xl {{ $score !== null && $score >= 75 ? 'bg-green-100 text-green-700' : 'bg-red-50 text-red-500' }} font-black text-xs shadow-sm border {{ $score !== null && $score >= 75 ? 'border-green-200' : 'border-red-100' }}">
                                            {{ $score ?? '-' }}
                                        </span>
                                        <a href="{{ route('sensei.penilaian.kotoba') }}?kelas_id={{ $student->kelas_id }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                            <i data-lucide="edit-3" class="w-3 h-3"></i>
                                        </a>
                                    </div>
                                </td>
                            @endfor
                        </tr>

                        <!-- FMD, WAWANCARA, PRESENSI GANG -->
                        <tr class="bg-gray-50/30">
                            <td colspan="5" class="px-8 py-3 text-[10px] font-black text-gray-400 uppercase tracking-widest">Assessment Tambahan</td>
                        </tr>

                        <!-- WAWANCARA -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i data-lucide="mic-2" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">Wawancara</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Communication Skills</p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4" class="px-4 py-6 text-right pr-12">
                                <div class="inline-flex items-center gap-4">
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Skor Akhir:</span>
                                    <span class="px-6 py-2 rounded-xl {{ $wawancaraScore >= 75 ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-50 text-red-500 border-red-100' }} border font-black text-sm">
                                        {{ $wawancaraScore }}
                                    </span>
                                    <a href="{{ route('sensei.penilaian.wawancara') }}?kelas_id={{ $student->kelas_id }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- FMD -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-rose-100 text-rose-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i data-lucide="activity" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">FMD</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Physical & Mental</p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4" class="px-4 py-6 text-right pr-12">
                                <div class="inline-flex items-center gap-4">
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Rata-rata:</span>
                                    <span class="px-6 py-2 rounded-xl {{ $fmdScore >= 75 ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-50 text-red-500 border-red-100' }} border font-black text-sm">
                                        {{ $fmdScore }}
                                    </span>
                                    <a href="{{ route('sensei.penilaian.fmd') }}?kelas_id={{ $student->kelas_id }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- PRESENSI -->
                        <tr class="group hover:bg-blue-50/50 transition-all">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black text-[#173A67]">Presensi</p>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Attendance Rate</p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4" class="px-4 py-6 text-right pr-12">
                                <div class="inline-flex items-center gap-4">
                                    <span class="text-xs font-black text-gray-400 uppercase tracking-widest">Kehadiran:</span>
                                    <span class="px-6 py-2 rounded-xl {{ $presensiScore >= 80 ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-50 text-red-500 border-red-100' }} border font-black text-sm">
                                        {{ $presensiScore }}%
                                    </span>
                                    <a href="{{ route('sensei.penilaian.presensi') }}?kelas_id={{ $student->kelas_id }}" class="text-gray-300 hover:text-[#173A67] transition-colors">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- NILAI AKHIR FOOTER -->
                        <tr class="bg-[#173A67] text-white">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-white/20 text-white flex items-center justify-center">
                                        <i data-lucide="award" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-black">Nilai Akhir</p>
                                        <p class="text-[10px] font-bold text-blue-200 uppercase tracking-widest">Final Cumulative Score</p>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4" class="px-4 py-6 text-right pr-12">
                                <div class="inline-flex items-center gap-6">
                                    <div class="flex flex-col items-end">
                                        <span class="text-[10px] font-black text-blue-200 uppercase tracking-widest">Grade Terkalkulasi</span>
                                        <span class="text-3xl font-black text-yellow-400">{{ $nilaiAkhirScore }}</span>
                                    </div>
                                    <a href="{{ route('sensei.penilaian.nilai-akhir') }}?kelas_id={{ $student->kelas_id }}" class="w-12 h-12 rounded-2xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition-all border border-white/20 shadow-lg">
                                        <i data-lucide="trending-up" class="w-6 h-6"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer Info -->
            <div class="bg-blue-50/50 rounded-[2rem] p-6 border-2 border-dashed border-blue-100 flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-sm shrink-0 border border-blue-50">
                    <i data-lucide="info" class="w-7 h-7 text-blue-500"></i>
                </div>
                <div class="space-y-1">
                    <p class="text-sm font-black text-[#173A67]">Instruksi Evaluasi</p>
                    <p class="text-xs font-bold text-gray-500/80 leading-relaxed uppercase tracking-wider italic">
                        "Nilai Akhir dihitung secara otomatis berdasarkan bobot setiap mata pelajaran. Pastikan semua penilaian harian sudah terisi."
                    </p>
                </div>
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
