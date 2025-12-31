@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block px-4 py-3 bg-[#0ea5e9] text-white font-bold rounded-lg transition shadow-md'
                : 'block px-4 py-3 text-[#102a4e] font-semibold hover:bg-gray-100 rounded-lg transition';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
