@extends('layouts.header_dashboard_orangtua')

@section('title', 'Berkas')

@section('content')
<div class="space-y-6">

    <!-- PROFILE HEADER (Reused) -->
    <div class="bg-white rounded-3xl shadow-sm p-8 flex items-center justify-center gap-12 text-center md:text-left">
        <!-- Avatar -->
        <div class="relative shrink-0">
            <div class="w-40 h-40 rounded-full border-4 border-[#0ea5e9] p-1 mx-auto">
                <img src="{{ asset('images/avatar.jpg') }}" class="w-full h-full rounded-full object-cover">
            </div>
        </div>

        <!-- Info -->
        <div class="space-y-4">
            <div class="space-y-1">
                <p class="text-[#102a4e] text-lg"><span class="font-bold">Nama :</span> <span class="font-medium">Gigih</span></p>
                <p class="text-[#102a4e] text-lg"><span class="font-bold">NIM :</span> <span class="font-medium">23.12.2865</span></p>
                <p class="text-[#102a4e] text-lg"><span class="font-bold">Tgl Lahir :</span> <span class="font-medium">18 Mei 2001</span></p>
            </div>
            
            <button class="bg-[#d95d5d] hover:bg-red-700 text-white font-bold px-6 py-2.5 rounded-xl flex items-center gap-2 shadow-lg transition active:scale-95 text-base mx-auto md:mx-0">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-6 h-6 bg-white rounded-full p-0.5">
                    <span>Hubungi Kami</span>
            </button>
        </div>
    </div>

    <!-- BERKAS CARD -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-5">
            <h2 class="text-white font-bold text-lg">Berkas Pendaftaran</h2>
        </div>

        <!-- List Content -->
        <div class="p-8 space-y-4">

            @php
                $berkas = [
                    'Fotocopy KTP',
                    'Fotocopy KTP Orang Tua/Wali',
                    'Fotocopy Ijasah SD',
                    'Fotocopy Ijasah SMP',
                    'Fotocopy Ijasah SMA',
                    'Fotocopy Akte Kelahiran',
                ];
            @endphp

            @foreach($berkas as $item)
            <div class="bg-[#f3f4f6] rounded-2xl px-8 py-4 flex items-center justify-between">
                <!-- Name -->
                <div class="w-1/4 font-bold text-[#102a4e] text-sm pr-4">
                    {{ $item }}
                </div>

                <!-- Keterangan -->
                <div class="bg-white rounded-xl px-6 py-3 w-1/4 text-center">
                    <span class="text-gray-300 font-bold text-sm">Keterangan</span>
                </div>

                <!-- Dates -->
                <div class="flex items-center gap-8 w-1/2 justify-end">
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-[#102a4e] text-sm">Pengumpulan</span>
                        <div class="bg-[#d95d5d] text-white font-bold px-6 py-1.5 rounded-full text-xs shadow-md">
                            17/05/25
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <span class="font-bold text-[#102a4e] text-sm">Pengambilan</span>
                        <div class="bg-[#d95d5d] text-white font-bold px-6 py-1.5 rounded-full text-xs shadow-md">
                            17/05/25
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</div>
@endsection
