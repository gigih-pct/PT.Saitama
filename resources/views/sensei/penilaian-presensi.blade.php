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
                    <span>Bulan : Agustus</span>
                    <svg class="w-3 h-3" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 8l4 4 4-4"/></svg>
                </span>
            </div>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 5h18M6 12h12M10 19h4"/></svg>
        </div>

        <!-- SUB HEADER -->
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="font-semibold">Penilaian Presensi : Kelas A2</span>
            </div>
        </div>
        <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-2 flex-wrap">
                <span class="font-semibold">Bulan : Agustus</span>
            </div>
        </div>
    </div>

    <!-- INSTRUCTION BOX -->

<div class="col-span-12 lg:col-span-9">
        <div class="bg-white rounded-xl p-4 shadow-sm">
            <!-- TOOLBAR -->
            <div class="mb-4 flex items-center justify-between gap-4 flex-wrap sticky top-0 z-20 bg-white pb-2">
                <div class="flex items-center gap-2">
                    <button id="save-presensi" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded font-medium transition">
                        💾 Simpan
                    </button>
                    <button id="reset-presensi" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded font-medium transition">
                        🔄 Reset
                    </button>
                    <span id="presensi-save-msg" class="ml-3 text-sm font-medium"></span>
                </div>
                <div class="text-xs text-gray-500 font-medium">Jumlah hari: 30</div>
            </div>

            <!-- INSTRUCTION -->
            <div class="mb-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded">
                <p class="text-sm text-gray-700">📝 <strong>Instruksi:</strong> Klik sel pada kolom presensi untuk mengganti status (Klik berulang untuk cycle)</p>
            </div>

            <!-- TABLE CONTAINER -->
                <div class="overflow-x-scroll overflow-y-auto max-h-[680px] scrollbar-visible" style="scrollbar-width: auto;">
                    <table class="min-w-full border text-sm table-fixed">
                        <thead class="bg-blue-600 text-white sticky top-0 z-20">
                        <tr>
                            <th class="border border-gray-400 px-3 py-2 w-16 col-no font-semibold">NO</th>
                            <th class="border border-gray-400 px-3 py-2 w-64 col-name font-semibold">Nama Siswa</th>
                            <th class="border border-gray-400 px-3 py-2 w-56 col-phone font-semibold">No Telp Wali Siswa</th>
                            @for ($i = 1; $i <= 30; $i++)
                                <th class="border border-gray-400 px-3 py-2 w-12 text-center font-semibold">
                                    <div class="flex items-center justify-center gap-2">
                                        <span>{{ $i }}</span>
                                        <button class="day-info-btn text-xs bg-gray-100 px-1 rounded" data-day="{{ $i - 1 }}" title="Lihat keterangan hari {{ $i }}">i</button>
                                    </div>
                                </th>
                            @endfor
                        </tr>
                    </thead>

                    <tbody>
                        {{-- CONTOH DATA --}}
                        @php
                            $days = range(1,30);

                            // Load saved data from session if available; otherwise start with empty list so user can fill manually
                            $saved = session('penilaian_presensi');
                            if(is_array($saved) && count($saved)) {
                                $students = $saved;
                            } else {
                                $students = [];
                            }

                            // ensure each student (if any) has 30 day entries
                            foreach ($students as $k => $st) {
                                if(!isset($st[2]) || !is_array($st[2])) $students[$k][2] = array_fill(0, count($days), '');
                                if(count($students[$k][2]) < count($days)) {
                                    $students[$k][2] = array_merge($students[$k][2], array_fill(0, count($days) - count($students[$k][2]), ''));
                                }
                            }
                        @endphp

                        @foreach ($students as $i => $s)
                        <tr class="student-row hover:bg-blue-50 transition border-b border-gray-300" data-student="{{ $i }}">
                            <td class="border border-gray-400 text-center col-no bg-gray-50">{{ $i+1 }}</td>
                            <td class="border border-gray-400 px-2 col-name"><input class="w-full name-input border-0 text-sm" value="{{ $s[0] }}" data-student="{{ $i }}" /></td>
                            <td class="border border-gray-400 px-2 col-phone"><input class="w-full phone-input border-0 text-sm" value="{{ $s[1] }}" data-student="{{ $i }}" /></td>

                            @foreach ($s[2] as $dayIndex => $status)
                                <td class="border border-gray-400 text-center">
                                    @include('sensei.penilaian.partials.presensi-icon', ['status' => $status, 'student' => $i, 'day' => $dayIndex])
                                </td>
                            @endforeach
                        </tr>
                        @endforeach

                        {{-- BARIS KOSONG --}}
                        @for ($i = 1; $i <= 38; $i++)
                        <tr class="student-row hover:bg-blue-50 transition border-b border-gray-300" data-student="n{{ $i }}">
                            <td class="border border-gray-400 text-center col-no bg-gray-50">{{ $i }}</td>
                            <td class="border border-gray-400 px-2 col-name"><input class="w-full name-input border-0 text-sm" value="" data-student="n{{ $i }}" /></td>
                            <td class="border border-gray-400 px-2 col-phone"><input class="w-full phone-input border-0 text-sm" value="" data-student="n{{ $i }}" /></td>
                            @for ($j = 0; $j < 30; $j++)
                                <td class="border border-gray-400 text-center">@include('sensei.penilaian.partials.presensi-icon', ['status' => '', 'student' => 'n'.$i, 'day' => $j])</td>
                            @endfor
                        </tr>
                        @endfor

                        {{-- TOTAL --}}
                        <tr class="font-semibold bg-gray-50 border-t-2 border-gray-400">
                            <td class="border border-gray-400 text-center col-no">39</td>
                            <td class="border border-gray-400 px-2 col-name">Total Siswa Masuk</td>
                            <td class="border border-gray-400 col-phone"></td>
                            <td class="border border-gray-400 text-center" colspan="30"></td>
                        </tr>
                        <tr class="font-bold bg-gray-50 border-b-2 border-gray-400">
                            <td class="border border-gray-400 text-center col-no">40</td>
                            <td class="border border-gray-400 px-2 col-name">TOTAL</td>
                            <td class="border border-gray-400 col-phone"></td>
                            <td class="border border-gray-400" colspan="30"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-3">
        <div class="bg-white rounded-xl p-4">
            <h3 class="font-semibold mb-4 text-base">📊 Ringkasan</h3>
            @php
                $counts = session('penilaian_presensi_counts') ?? ['H' => 0, 'A' => 0, 'S' => 0, 'I' => 0];
                $studentsCount = isset($students) ? count($students) : 0;
                $daysCount = isset($days) ? count($days) : 30;
                $jumlahTotal = $counts['H'] ?? 0;
                $percent = ($studentsCount && $daysCount) ? round(($jumlahTotal / ($studentsCount * $daysCount)) * 100, 2) : 0;
            @endphp
            
            <!-- Tabel Keterangan -->
            <div class="mb-6">
                <h3 class="font-semibold mb-3 text-base bg-gray-200 px-3 py-2 rounded">Tabel Keterangan</h3>
                <table class="w-full border-2 border-gray-400 text-sm">
                    <thead>
                        <tr class="bg-gray-100 border-b-2 border-gray-400">
                            <th class="border border-gray-400 px-3 py-2 text-left font-semibold">Keterangan</th>
                            <th class="border border-gray-400 px-3 py-2 text-right font-semibold">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-400">
                            <td class="border border-gray-400 px-3 py-2 text-center"><span class="w-6 h-6 rounded-full bg-green-500 inline-block"></span></td>
                            <td class="border border-gray-400 px-3 py-2 text-right font-semibold" id="count-h">{{ $counts['H'] ?? 0 }}</td>
                        </tr>
                        <tr class="border-b border-gray-400">
                            <td class="border border-gray-400 px-3 py-2 text-center"><span class="w-6 h-6 rounded-full bg-red-500 inline-block"></span></td>
                            <td class="border border-gray-400 px-3 py-2 text-right font-semibold" id="count-a">{{ $counts['A'] ?? 0 }}</td>
                        </tr>
                        <tr class="border-b border-gray-400">
                            <td class="border border-gray-400 px-3 py-2 text-center"><span class="w-6 h-6 rounded-full bg-yellow-400 inline-block"></span></td>
                            <td class="border border-gray-400 px-3 py-2 text-right font-semibold" id="count-s">{{ $counts['S'] ?? 0 }}</td>
                        </tr>
                        <tr>
                            <td class="border border-gray-400 px-3 py-2 text-center"><span class="w-6 h-6 rounded-full bg-blue-500 inline-block"></span></td>
                            <td class="border border-gray-400 px-3 py-2 text-right font-semibold" id="count-i">{{ $counts['I'] ?? 0 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tabel Kesimpulan -->
            <div>
                <h3 class="font-semibold mb-3 text-base bg-blue-500 text-white px-3 py-2 rounded">Tabel Kesimpulan</h3>
                <table class="w-full border-2 border-blue-400 text-sm">
                    <thead>
                        <tr class="bg-blue-300 border-b-2 border-blue-400">
                            <th class="border border-blue-400 px-3 py-2 text-left font-semibold">Keterangan</th>
                            <th class="border border-blue-400 px-3 py-2 text-right font-semibold">Hasil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-blue-400 hover:bg-blue-50">
                            <td class="border border-blue-400 px-3 py-2">Jumlah Total</td>
                            <td class="border border-blue-400 px-3 py-2 text-right font-semibold text-blue-600">{{ $studentsCount }}</td>
                        </tr>
                        <tr class="border-b border-blue-400 hover:bg-blue-50">
                            <td class="border border-blue-400 px-3 py-2">Rata" per siswa</td>
                            <td class="border border-blue-400 px-3 py-2 text-right font-semibold text-blue-600">-</td>
                        </tr>
                        <tr class="border-b border-blue-400 hover:bg-blue-50">
                            <td class="border border-blue-400 px-3 py-2">Rata-rata kelas</td>
                            <td class="border border-blue-400 px-3 py-2 text-right font-semibold text-blue-600">-</td>
                        </tr>
                        <tr class="hover:bg-blue-50">
                            <td class="border border-blue-400 px-3 py-2">Prosentase</td>
                            <td class="border border-blue-400 px-3 py-2 text-right font-semibold text-blue-600" id="percent">{{ $percent }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    
</div>

<!-- Day details modal -->
<div id="day-modal" class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg w-11/12 max-w-2xl p-4">
        <div class="flex justify-between items-center">
            <h3 id="day-modal-title" class="font-semibold">Keterangan Hari <span id="day-modal-day"></span></h3>
            <div class="flex items-center gap-2">
                <button id="day-modal-close" class="text-gray-600 px-2 py-1 rounded hover:bg-gray-100">Tutup</button>
            </div>
        </div>
        <div class="mt-3">
            <table class="w-full text-sm">
                <tr><td>Hadir</td><td id="modal-count-h" class="text-right font-semibold">0</td></tr>
                <tr><td>Alfa</td><td id="modal-count-a" class="text-right font-semibold">0</td></tr>
                <tr><td>Sakit</td><td id="modal-count-s" class="text-right font-semibold">0</td></tr>
                <tr><td>Izin</td><td id="modal-count-i" class="text-right font-semibold">0</td></tr>
            </table>
            <hr class="my-3" />
            <div id="modal-students-list" class="max-h-64 overflow-y-auto text-sm"></div>
        </div>
    </div>
</div>

<!-- Floating popover for quick per-day totals -->
<div id="day-popover" class="hidden absolute z-50 bg-white rounded-lg shadow-lg border p-3 w-64" role="dialog" aria-hidden="true" style="display:none;">
    <div class="flex justify-between items-center">
        <div class="font-semibold">Hari <span id="popover-day"></span></div>
        <button id="popover-close" class="text-gray-500 hover:bg-gray-100 px-1 rounded">×</button>
    </div>
    <div class="mt-2 text-sm">
        <div class="flex justify-between"><div>Hadir</div><div id="popover-count-h" class="font-semibold">0</div></div>
        <div class="flex justify-between"><div>Alfa</div><div id="popover-count-a" class="font-semibold">0</div></div>
        <div class="flex justify-between"><div>Sakit</div><div id="popover-count-s" class="font-semibold">0</div></div>
        <div class="flex justify-between"><div>Izin</div><div id="popover-count-i" class="font-semibold">0</div></div>
        <hr class="my-2" />
        <div id="popover-students-preview" class="text-xs text-gray-600 max-h-28 overflow-y-auto"></div>
        <div class="mt-2 text-right"><button id="popover-open-modal" class="text-sm text-blue-600">Lihat semua</button></div>
    </div>
</div>

<style>
/* Layout tweaks to match the design */
.presensi-wrapper { position: relative; }
/* Popover */
#day-popover { position: absolute; display: none; transform-origin: top left; transition: transform .12s ease, opacity .12s ease; }
#day-popover.show { display: block; opacity: 1; transform: translateY(0); }
#day-popover[style] { z-index: 60; }
@media (min-width: 768px) { #day-popover { min-width: 220px; } }
.presensi-scroll { overflow-x: scroll; overflow-y: scroll; scrollbar-gutter: stable both-edges; -webkit-overflow-scrolling: touch; scrollbar-width: auto; scrollbar-color: #cbd5e1 transparent; }
.presensi-scroll::-webkit-scrollbar { height: 12px; width: 12px; }
.presensi-scroll::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 8px; border: 3px solid rgba(0,0,0,0.03); }
.presensi-scroll::-webkit-scrollbar-thumb:hover { background: #94b3c7; }
.presensi-scroll::-webkit-scrollbar-track { background: transparent; }
.presensi-badge { width: 28px; height: 28px; border-radius: 9999px; display:inline-flex; align-items:center; justify-content:center; font-weight:600; }
.presensi-badge .caret { position: absolute; right: -5px; bottom: -5px; }
.table-fixed th, .table-fixed td { border: 1px solid #d1d5db; vertical-align: middle; padding: 8px; }
.table-fixed thead th { background: #8A9BB2; color: #fff; }

/* Freeze behavior: keep the first columns visible on both vertical and horizontal scroll */
.sticky-col { position: sticky; top: 56px; /* height of header area */ z-index: 55; background: #fff; }
.sticky-col-head { position: sticky; top: 0; z-index: 70; background: #8A9BB2; color: #fff; }
/* ensure day number headers stay at top */
.table-fixed thead th.sticky-top, .table-fixed thead th[style] { position: sticky; top: 0; z-index: 60; }

/* explicit column sizes for consistency */
.col-no { min-width: 64px; width: 64px; }
.col-name { min-width: 260px; width: 260px; }
.col-phone { min-width: 220px; width: 220px; }
</style>

<script>
// initial per-day counts (from session)
window.__penilaianPerDay = {!! json_encode(session('penilaian_presensi_counts_per_day') ?? []) !!};

document.addEventListener('DOMContentLoaded', function () {
    const p = document.querySelector('select[name="penilaian-select"]');
    // per-day cache used for modal details
    let perDayCounts = window.__penilaianPerDay || [];

    function fillDayModal(dayIndex) {
        const d = perDayCounts[dayIndex] || { counts: {H:0,A:0,S:0,I:0}, students: [] };
        document.getElementById('day-modal-day').textContent = (parseInt(dayIndex)+1);
        document.getElementById('modal-count-h').textContent = d.counts.H || 0;
        document.getElementById('modal-count-a').textContent = d.counts.A || 0;
        document.getElementById('modal-count-s').textContent = d.counts.S || 0;
        document.getElementById('modal-count-i').textContent = d.counts.I || 0;

        const list = document.getElementById('modal-students-list');
        list.innerHTML = '';
        if(d.students && d.students.length) {
            d.students.forEach(st => {
                const s = document.createElement('div');
                s.className = 'py-1 border-b last:border-b-0 flex items-center justify-between gap-2';
                s.innerHTML = '<div><div class="font-semibold">'+(st.name||'')+'</div><div class="text-xs text-gray-500">'+(st.phone||'')+'</div></div><div class="font-semibold">'+(st.status||'')+'</div>';
                list.appendChild(s);
            });
        } else {
            list.innerHTML = '<div class="text-sm text-gray-500">Belum ada data.</div>';
        }
        // show modal
        const modal = document.getElementById('day-modal');
        if(modal) modal.classList.remove('hidden');
        window.__currentDayModal = dayIndex;
    }

    // popover & attach day buttons
    const popover = document.getElementById('day-popover');

    function showDayPopover(btn, dayIndex) {
        if(!popover) return;
        const d = perDayCounts[dayIndex] || { counts: {H:0,A:0,S:0,I:0}, students: [] };
        document.getElementById('popover-day').textContent = (parseInt(dayIndex) + 1);
        document.getElementById('popover-count-h').textContent = d.counts.H || 0;
        document.getElementById('popover-count-a').textContent = d.counts.A || 0;
        document.getElementById('popover-count-s').textContent = d.counts.S || 0;
        document.getElementById('popover-count-i').textContent = d.counts.I || 0;

        const preview = document.getElementById('popover-students-preview');
        preview.innerHTML = '';
        if(d.students && d.students.length) {
            d.students.slice(0,6).forEach(st => {
                const div = document.createElement('div');
                div.className = 'py-1 border-b last:border-b-0 flex items-center justify-between gap-2 text-xs';
                div.innerHTML = '<div><div class="font-semibold">'+(st.name||'')+'</div><div class="text-xs text-gray-500">'+(st.phone||'')+'</div></div><div class="font-semibold">'+(st.status||'')+'</div>';
                preview.appendChild(div);
            });
        } else {
            preview.innerHTML = '<div class="text-sm text-gray-500">Belum ada data.</div>';
        }

        // position popover relative to scroll container
        const rect = btn.getBoundingClientRect();
        const container = document.querySelector('.presensi-scroll');
        const parentRect = container ? container.getBoundingClientRect() : document.body.getBoundingClientRect();
        let left = rect.left - parentRect.left + (container ? container.scrollLeft : 0);
        let top = rect.bottom - parentRect.top + (container ? container.scrollTop : 0) + 8; // offset

        // clamp horizontally
        const maxLeft = (parentRect.width || window.innerWidth) - popover.offsetWidth - 12;
        if(left > maxLeft) left = Math.max(8, maxLeft);
        if(left < 8) left = 8;

        popover.style.left = left + 'px';
        popover.style.top = top + 'px';
        popover.classList.add('show');
        popover.style.display = 'block';
        window.__currentPopoverDay = dayIndex;
    }

    function hideDayPopover() {
        if(!popover) return;
        popover.classList.remove('show');
        popover.style.display = 'none';
        window.__currentPopoverDay = undefined;
    }

    function attachDayButtons() {
        document.querySelectorAll('.day-info-btn').forEach(btn => {
            btn.removeEventListener('click', btn._dayInfoHandler);
            btn._dayInfoHandler = function (e) {
                e.preventDefault();
                const day = parseInt(btn.dataset.day || 0);
                if(window.__currentPopoverDay === day) { hideDayPopover(); return; }
                showDayPopover(btn, day);
            };
            btn.addEventListener('click', btn._dayInfoHandler);
        });
    }

    // popover close
    const popoverCloseBtn = document.getElementById('popover-close');
    if(popoverCloseBtn) popoverCloseBtn.addEventListener('click', function () { hideDayPopover(); });

    // open modal from popover
    const popoverOpenModal = document.getElementById('popover-open-modal');
    if(popoverOpenModal) popoverOpenModal.addEventListener('click', function () { hideDayPopover(); const day = window.__currentPopoverDay; if(typeof day !== 'undefined') fillDayModal(day); });

    // click outside to close popover
    document.addEventListener('click', function (e) {
        if(!popover) return;
        const isTarget = e.target.closest('.day-info-btn') || e.target.closest('#day-popover');
        if(!isTarget) hideDayPopover();
    });

    // close modal
    const dayModalClose = document.getElementById('day-modal-close');
    if(dayModalClose) dayModalClose.addEventListener('click', function () { document.getElementById('day-modal').classList.add('hidden'); window.__currentDayModal = undefined; });
    // click outside to close modal
    document.getElementById('day-modal')?.addEventListener('click', function (e) { if(e.target === this) { this.classList.add('hidden'); window.__currentDayModal = undefined; } });

    // initial attach
    attachDayButtons();

    if (p) {
        p.addEventListener('change', function (e) {
            const url = e.target.value;
            if (url) window.location.href = url;
        });
    }

    const statuses = ['', 'H', 'A', 'S', 'I'];
    const csrf = '{{ csrf_token() }}';

    function renderAttendanceButton(btn, status) {
        status = (status || '').toUpperCase();
        btn.dataset.status = status;
        const existing = btn.querySelector('span');
        let html = '';
        if(status === 'H') html = '<span class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center text-white"><svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 10.5l3 3 8-8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>';
        else if(status === 'A') html = '<span class="w-7 h-7 rounded-full bg-red-500 flex items-center justify-center text-white">A</span>';
        else if(status === 'S') html = '<span class="w-7 h-7 rounded-full bg-yellow-400 flex items-center justify-center text-gray-800">S</span>';
        else if(status === 'I') html = '<span class="w-7 h-7 rounded-full bg-blue-500 flex items-center justify-center text-white">I</span>';
        else html = '<span class="w-7 h-7 rounded-full bg-gray-100"></span>';

        if(existing) existing.outerHTML = html;
        else btn.insertAdjacentHTML('afterbegin', html);

        // also sync any select in the same cell
        const sel = btn.parentElement.querySelector('.attendance-select');
        if(sel) sel.value = status;
    }

    // Initialize attendance buttons
    document.querySelectorAll('.attendance-btn').forEach(btn => {
        renderAttendanceButton(btn, btn.dataset.status);

        const sel = btn.parentElement.querySelector('.attendance-select');
        if(sel) sel.value = (btn.dataset.status || '');

        // click cycles
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            const cur = (btn.dataset.status || '').toUpperCase();
            let idx = statuses.indexOf(cur);
            idx = (idx + 1) % statuses.length;
            const next = statuses[idx];
            renderAttendanceButton(btn, next);
            if(sel) sel.value = next;
        });

        // double click opens select for direct choice
        if(sel) {
            btn.addEventListener('dblclick', function (e) {
                e.preventDefault();
                // show select and focus
                sel.classList.remove('hidden');
                sel.focus();
            });

            sel.addEventListener('change', function () {
                const v = (sel.value || '').toUpperCase();
                renderAttendanceButton(btn, v);
                sel.classList.add('hidden');
            });

            sel.addEventListener('blur', function () { sel.classList.add('hidden'); });
        }

        // keyboard support
        btn.addEventListener('keydown', function (e) {
            const key = (e.key || '').toUpperCase();
            if(['H','A','S','I'].includes(key)) {
                e.preventDefault();
                renderAttendanceButton(btn, key);
            } else if (e.key === 'Enter') {
                if(sel) { sel.classList.remove('hidden'); sel.focus(); }
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function (e) {
        document.querySelectorAll('.attendance-select').forEach(s => {
            if(!s.classList.contains('hidden') && !s.contains(e.target) && !s.parentElement.contains(e.target)) {
                s.classList.add('hidden');
            }
        });
    });

    // Save handler (collect only rows with a name)
    const saveBtn = document.getElementById('save-presensi');
    if(saveBtn) {
        saveBtn.addEventListener('click', function () {
            const rows = document.querySelectorAll('tbody tr.student-row');
            const payload = [];
            rows.forEach(row => {
                const name = (row.querySelector('.name-input') || {value:''}).value.trim();
                if(!name) return; // skip empty rows
                const phone = (row.querySelector('.phone-input') || {value:''}).value.trim();
                const statusesArr = [];
                row.querySelectorAll('.attendance-btn').forEach(btn => {
                    statusesArr.push((btn.dataset.status || '').toUpperCase());
                });
                payload.push({ name, phone, statuses: statusesArr });
            });

            const msg = document.getElementById('presensi-save-msg');
            if(msg) msg.textContent = 'Menyimpan...';

            fetch('{{ route('sensei.penilaian.presensi.save') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                body: JSON.stringify({ students: payload })
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    // update counts in the sidebar
                    const counts = res.counts || {};
                    const elH = document.getElementById('count-h'); if(elH) elH.textContent = counts.H || 0;
                    const elA = document.getElementById('count-a'); if(elA) elA.textContent = counts.A || 0;
                    const elS = document.getElementById('count-s'); if(elS) elS.textContent = counts.S || 0;
                    const elI = document.getElementById('count-i'); if(elI) elI.textContent = counts.I || 0;

                    // update per-day cache and refresh modal/popover if open
                    perDayCounts = res.counts_per_day || perDayCounts;
                    if(typeof window.__currentDayModal !== 'undefined' && window.__currentDayModal !== undefined) {
                        fillDayModal(window.__currentDayModal);
                    }
                    if(typeof window.__currentPopoverDay !== 'undefined' && window.__currentPopoverDay !== undefined) {
                        const btn = document.querySelector('.day-info-btn[data-day="'+window.__currentPopoverDay+'"]');
                        if(btn) showDayPopover(btn, window.__currentPopoverDay);
                    }

                    // update summary calculations
                    const daysCount = {{ count($days) }} || 30;
                    const totalH = (res.counts && res.counts.H) ? res.counts.H : 0;
                    const studentsSaved = res.saved || payload.length || 0;
                    const percent = (studentsSaved && daysCount) ? ((totalH / (studentsSaved * daysCount)) * 100) : 0;

                    const elPerc = document.getElementById('percent'); if(elPerc) elPerc.textContent = percent.toFixed(2) + '%';

                    alert('Data presensi disimpan. Tersimpan: ' + (res.saved || payload.length) + ' siswa.');
                    if(msg) msg.textContent = 'Tersimpan.';
                    setTimeout(() => { if(msg) msg.textContent = ''; }, 1200);
                } else {
                    alert('Gagal menyimpan.');
                    if(msg) msg.textContent = 'Gagal menyimpan';
                }
            }).catch(err => { console.error(err); alert('Gagal menyimpan (network).'); if(msg) msg.textContent = 'Gagal (network)'; });
        });
    }

    // Reset handler
    const resetBtn = document.getElementById('reset-presensi');
    if(resetBtn) {
        resetBtn.addEventListener('click', function () {
            if(!confirm('Reset data presensi tersimpan?')) return;
            fetch('{{ route('sensei.penilaian.presensi.reset') }}', {
                method: 'POST', headers: { 'X-CSRF-TOKEN': csrf }
            }).then(r => r.json()).then(res => {
                if(res.success) {
                    ['count-h','count-a','count-s','count-i'].forEach(id => {
                        const el = document.getElementById(id); if(el) el.textContent = 0;
                    });
                    // clear per-day cache and close modal
                    perDayCounts = [];
                    const modal = document.getElementById('day-modal'); if(modal) modal.classList.add('hidden');
                    window.__currentDayModal = undefined;
                    window.__penilaianPerDay = [];
                    window.location.reload();
                }
            });
        });
    }

});
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
