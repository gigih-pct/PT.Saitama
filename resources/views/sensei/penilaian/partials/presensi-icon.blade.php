@php $s = strtoupper($status ?? ''); $student = $student ?? 0; $day = $day ?? 0; @endphp

<div class="relative inline-block attendance-cell">
    <button class="presensi-badge attendance-btn inline-flex items-center justify-center relative" title="Status: {{ $status }}" data-student="{{ $student }}" data-day="{{ $day }}" data-status="{{ $s }}" tabindex="0" role="button" aria-label="Presensi siswa">
        @if($s === 'H' || $s === '✔')
            <span class="w-7 h-7 rounded-full bg-green-500 flex items-center justify-center text-white">
                <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 10.5l3 3 8-8" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
        @elseif($s === 'A')
            <span class="w-7 h-7 rounded-full bg-red-500 flex items-center justify-center text-white">A</span>
        @elseif($s === 'S')
            <span class="w-7 h-7 rounded-full bg-yellow-400 flex items-center justify-center text-gray-800">S</span>
        @elseif($s === 'I')
            <span class="w-7 h-7 rounded-full bg-blue-500 flex items-center justify-center text-white">I</span>
        @else
            <span class="w-7 h-7 rounded-full bg-gray-100"></span>
        @endif

        <svg class="caret absolute -right-1 -bottom-1 w-3 h-3 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2" xmlns="http://www.w3.org/2000/svg"><path d="M6 8l4 4 4-4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </button>

    <select class="hidden attendance-select absolute left-1/2 -translate-x-1/2 top-8 bg-white border rounded px-2 py-1 text-sm z-50" data-student="{{ $student }}" data-day="{{ $day }}">
        <option value="">--</option>
        <option value="H">Hadir</option>
        <option value="A">Alfa</option>
        <option value="S">Sakit</option>
        <option value="I">Izin</option>
    </select>
</div>