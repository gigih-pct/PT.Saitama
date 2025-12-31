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
            <div class="flex items-center gap-2 flex-wrap">
                <span class="font-semibold">Penilaian FMD : Kelas A2</span>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="bg-red-500 text-white px-4 py-1 rounded-full text-sm">NOTE : Isilah Hasil Pada Tabel Di Bawah Ini</span>
            </div>
        </div>

        <!-- FMD Sub-Assessment selector -->
        <div class="mt-3">
            <div id="fmd-subnav" class="flex items-center gap-2" data-mode="mtk" role="tablist" aria-label="Pilih penilaian FMD">
                <button type="button" data-mode="mtk" class="fmd-subbtn bg-blue-500 text-white px-3 py-1 rounded-full text-sm" role="tab" aria-selected="true">MTK</button>
                <button type="button" data-mode="lari" class="fmd-subbtn bg-gray-200 text-black px-3 py-1 rounded-full text-sm" role="tab" aria-selected="false">Lari</button>
                <button type="button" data-mode="pushup" class="fmd-subbtn bg-gray-200 text-black px-3 py-1 rounded-full text-sm" role="tab" aria-selected="false">Push Up</button>
            </div>

            <!-- Week selector (shown only for MTK) -->
            <div id="fmd-weeknav-container" class="mt-3">
                <div id="fmd-weeknav" class="flex items-center gap-2" role="tablist" aria-label="Pilih minggu" data-week="1">
                    <button type="button" data-week="1" class="week-btn bg-blue-500 text-white px-2 py-1 rounded text-xs" role="tab" aria-selected="true">Minggu 1</button>
                    <button type="button" data-week="2" class="week-btn bg-gray-200 text-black px-2 py-1 rounded text-xs" role="tab" aria-selected="false">Minggu 2</button>
                    <button type="button" data-week="3" class="week-btn bg-gray-200 text-black px-2 py-1 rounded text-xs" role="tab" aria-selected="false">Minggu 3</button>
                    <button type="button" data-week="4" class="week-btn bg-gray-200 text-black px-2 py-1 rounded text-xs" role="tab" aria-selected="false">Minggu 4</button>
                    <button type="button" data-week="5" class="week-btn bg-gray-200 text-black px-2 py-1 rounded text-xs" role="tab" aria-selected="false">Minggu 5</button>
                </div>
            </div>
        </div>
    </div>

    <!-- INSTRUCTION BOX -->
    <div class="col-span-12">
        <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
            <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Isilah Hasil Pada Tabel Di Bawah Ini</p>
        </div>
    </div>

    <!-- CONTENT WRAPPER - Flexbox Layout -->
    <div class="col-span-12 flex flex-col lg:flex-row gap-6 items-start">
        <!-- TABLE -->
        <div class="flex-1 w-full lg:w-auto">
            <div class="bg-white rounded-xl p-4 presensi-wrapper">
            <div id="fmdScroll" class="border rounded-lg overflow-hidden">
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="w-full border-collapse text-sm fmd-table">
                    <colgroup>
                        <col style="width:56px;">
                        <col style="width:260px;">
                    </colgroup>
                    <thead>
                        <tr class="header-main bg-blue-600 text-white sticky top-0 z-20">
                            <th rowspan="2" class="border border-gray-400 px-3 py-2 sticky-col sticky-col-1 text-left font-semibold">NO</th>
                            <th rowspan="2" class="border border-gray-400 px-3 py-2 sticky-col sticky-col-2 text-left font-semibold">NAMA</th>
                            <th rowspan="2" class="border border-gray-400 px-3 py-2 text-center font-semibold">JUMLAH<br>SISWA</th>

                            @for($m=1;$m<=5;$m++)
                                <th colspan="3" class="border border-gray-400 px-3 py-2 text-center font-semibold">MINGGU {{ $m }}</th>
                                <th rowspan="2" class="border border-gray-400 px-3 py-2 col-jumlah text-center font-semibold">JUMLAH</th>
                            @endfor
                        </tr>

                        <tr class="header-week bg-blue-600 text-white sticky top-0 z-20">
                            @for($m=1;$m<=5;$m++)
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">MTK</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">KET</th>
                                <th class="border border-gray-400 px-3 py-2 text-center font-semibold">SKOR</th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody>
                        @for($i=1;$i<=35;$i++)
                        <tr class="hover:bg-blue-50 transition border-b border-gray-300">
                            <td class="border border-gray-400 px-3 py-2 sticky-col sticky-col-1 bg-gray-50">{{ $i }}</td>
                            <td class="border border-gray-400 px-3 py-2 sticky-col sticky-col-2 text-left bg-gray-50"></td>

                            <td class="border border-gray-400 px-3 py-2 text-center bg-blue-50">
                                <select class="border text-xs w-full">
                                    <option value="TRUE">TRUE</option>
                                    <option value="FALSE">FALSE</option>
                                </select>
                            </td>

                            @for($m=1;$m<=5;$m++)
                                <td class="border border-gray-400 px-3 py-2 text-center">
                                    <select class="border text-xs w-full">
                                        <option>TL</option>
                                        <option>H</option>
                                    </select>
                                </td>
                                <td class="border border-gray-400 px-3 py-2"></td>
                                <td class="border border-gray-400 px-3 py-2 text-center">0</td>
                                <td class="border border-gray-400 px-3 py-2 col-jumlah text-center">0</td>
                            @endfor
                        </tr>
                        @endfor
                    </tbody>

                    <tfoot>
                        <tr class="header-main bg-blue-600 text-white">
                            <th colspan="2" class="border border-gray-400 px-3 py-2 font-semibold">JUMLAH</th>
                            <th class="border border-gray-400 px-3 py-2 text-center font-semibold">22</th>
                            @for($m=1;$m<=5;$m++)
                                <th colspan="3" class="border border-gray-400 px-3 py-2 text-center font-semibold">0</th>
                                <th class="border border-gray-400 px-3 py-2 col-jumlah text-center font-semibold">0</th>
                            @endfor
                        </tr>
                    </tfoot>
                </table>
            </div>

            @include('components.penilaian-scroll', ['containerId' => 'fmdScroll'])
            </div>
        </div>

        <!-- Reference table column -->
        <div class="w-full lg:w-80 flex-shrink-0">
            <div class="bg-white rounded-xl p-4 h-fit sticky" style="top: 280px;">
                <h3 class="font-semibold mb-4 text-base">📊 Tabel Keterangan</h3>
                <div class="border rounded-lg overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="border border-gray-300 px-3 py-2 text-left font-semibold">Keterangan</th>
                                <th class="border border-gray-300 px-3 py-2 text-center font-semibold">4 Minggu</th>
                                <th class="border border-gray-300 px-3 py-2 text-center font-semibold">5 Minggu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="border border-gray-300 px-3 py-2">Jumlah</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="border border-gray-300 px-3 py-2">Rata Rata Siswa</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                            </tr>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="border border-gray-300 px-3 py-2">Rata Rata Kelas</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-3 py-2">Presentase</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                                <td class="border border-gray-300 px-3 py-2 text-center">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const p = document.querySelector('select[name="penilaian-select"]');
    if (p) {
        p.addEventListener('change', function (e) {
            const url = e.target.value;
            if (url) window.location.href = url;
        });
    }
    // FMD subnav: toggle active pill and store selection on the container
    const fmdSubnav = document.getElementById('fmd-subnav');
    const fmdWeeknavContainer = document.getElementById('fmd-weeknav-container');
    const fmdWeeknav = document.getElementById('fmd-weeknav');

    function showOrHideWeeknav(mode) {
        if (!fmdWeeknavContainer) return;
        fmdWeeknavContainer.style.display = (mode === 'mtk') ? 'block' : 'none';
    }

    if (fmdSubnav) {
        // initialize visibility
        showOrHideWeeknav(fmdSubnav.dataset.mode || 'mtk');

        fmdSubnav.addEventListener('click', function (e) {
            const btn = e.target.closest('.fmd-subbtn');
            if (!btn) return;
            fmdSubnav.querySelectorAll('.fmd-subbtn').forEach(b => {
                b.classList.remove('bg-blue-500','text-white');
                b.classList.add('bg-gray-200','text-black');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.remove('bg-gray-200','text-black');
            btn.classList.add('bg-blue-500','text-white');
            btn.setAttribute('aria-selected', 'true');
            fmdSubnav.dataset.mode = btn.dataset.mode;
            showOrHideWeeknav(btn.dataset.mode);
            // future: could dispatch event to update table/content based on selection
        });
    }

    // Week nav: toggle week buttons and store selection
    if (fmdWeeknav) {
        fmdWeeknav.addEventListener('click', function (e) {
            const btn = e.target.closest('.week-btn');
            if (!btn) return;
            fmdWeeknav.querySelectorAll('.week-btn').forEach(b => {
                b.classList.remove('bg-blue-500','text-white');
                b.classList.add('bg-gray-200','text-black');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.remove('bg-gray-200','text-black');
            btn.classList.add('bg-blue-500','text-white');
            btn.setAttribute('aria-selected', 'true');
            fmdWeeknav.dataset.week = btn.dataset.week;
            // dispatch a custom event for potential listeners
            const ev = new CustomEvent('fmd:week-change', { detail: { week: btn.dataset.week } });
            fmdWeeknav.dispatchEvent(ev);
        });
    }

    // ensure initial week is set
    if (fmdWeeknav) {
        const init = fmdWeeknav.dataset.week || '1';
        fmdWeeknav.dataset.week = init;
        const initBtn = fmdWeeknav.querySelector(`[data-week="${init}"]`);
        if (initBtn) initBtn.classList.add('bg-blue-500','text-white');
    }});
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
