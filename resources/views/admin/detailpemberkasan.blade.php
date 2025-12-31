@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-6">
    <!-- PROFILE CARD -->
    <div class="bg-white rounded-[40px] p-12 shadow-sm border border-gray-50 flex flex-col items-center justify-center relative min-h-[320px]">
        <div class="flex items-center gap-16">
            <!-- Avatar -->
            <div class="relative">
                <img src="{{ asset('images/avatar-placeholder.png') }}" class="w-44 h-44 rounded-full border-4 border-white shadow-xl object-cover" alt="Avatar">
            </div>
            
            <!-- Info Section -->
            <div class="space-y-3">
                <p class="text-[17px] flex items-center gap-2 text-[#173A67]">
                    <span class="font-extrabold w-24">Nama :</span>
                    <span class="font-medium text-gray-500">Gigih</span>
                </p>
                <p class="text-[17px] flex items-center gap-2 text-[#173A67]">
                    <span class="font-extrabold w-24">NIM :</span>
                    <span class="font-medium text-gray-500">23.12.2865</span>
                </p>
                <p class="text-[17px] flex items-center gap-2 text-[#173A67]">
                    <span class="font-extrabold w-24">Tgl Lahir :</span>
                    <span class="font-medium text-gray-500">18 Mei 2001</span>
                </p>
                
                <!-- Download Button -->
                <div class="mt-6">
                    <button style="background-color: #D85B63;" class="text-white px-8 py-3 rounded-2xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                        Unduh <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- BERKAS PENDAFTARAN -->
    <div class="rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100">
        <div class="bg-[#173A67] px-6 py-4">
            <h3 class="text-white font-extrabold text-sm tracking-wide">Berkas Pendaftaran</h3>
        </div>
        <div class="p-6 space-y-4">
            @php
                $docs = [
                    'Fotocopy KTP',
                    'Fotocopy KTP Orang Tua/ Wali',
                    'Fotocopy Ijasah SD',
                    'Fotocopy Ijasah SMP',
                    'Fotocopy Ijasah SMA',
                    'Fotocopy Akte Kelahiran',
                ];
            @endphp

            @foreach ($docs as $doc)
            <div class="flex items-center bg-[#EFEFEF] px-8 py-4 rounded-3xl gap-4">
                <div class="w-1/4">
                    <p class="text-[#173A67] font-extrabold text-sm">{{ $doc }}</p>
                </div>
                
                <div class="flex-1 flex items-center gap-6 justify-end">
                    <!-- Keterangan -->
                    <div class="bg-white rounded-full px-5 py-2 flex items-center gap-3 shadow-sm min-w-[180px] justify-between">
                        <span class="text-[11px] font-extrabold text-gray-400">Keterangan</span>
                        <button style="background-color: #D85B63;" class="text-white w-7 h-7 flex items-center justify-center rounded-full shadow-md hover:opacity-90">
                            <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                        </button>
                    </div>

                    <!-- Pengumpulan -->
                    <div class="flex items-center gap-3">
                        <span class="text-[12px] font-extrabold text-black">Pengumpulan</span>
                        <div class="bg-white rounded-full px-5 py-2 flex items-center gap-3 shadow-sm min-w-[120px] justify-between">
                            <span class="text-[11px] font-extrabold text-white bg-[#D85B63] px-2 py-0.5 rounded-md">17/05/25</span>
                            <button style="background-color: #D85B63;" class="text-white w-7 h-7 flex items-center justify-center rounded-full shadow-md hover:opacity-90">
                                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Pengambilan -->
                    <div class="flex items-center gap-3">
                        <span class="text-[12px] font-extrabold text-black">Pengambilan</span>
                        <div class="bg-white rounded-full px-5 py-2 flex items-center gap-3 shadow-sm min-w-[120px] justify-between">
                            <span class="text-[11px] font-extrabold text-white bg-[#D85B63] px-2 py-0.5 rounded-md">17/05/25</span>
                            <button style="background-color: #D85B63;" class="text-white w-7 h-7 flex items-center justify-center rounded-full shadow-md hover:opacity-90">
                                <i data-lucide="pencil" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="ml-4">
                        <div class="w-6 h-6 border-2 border-[#D85B63] rounded flex items-center justify-center bg-white cursor-pointer">
                            <!-- Optional checkmark if needed -->
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
