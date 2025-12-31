@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-6">
    <!-- HEADER BAR -->
    <div class="bg-[#173A67] rounded-xl overflow-hidden shadow-sm">
        <div class="px-6 py-4">
            <h3 class="text-white font-extrabold text-sm tracking-wide">Berkas Seleksi</h3>
        </div>
    </div>

    <!-- DOCUMENT LIST -->
    <div class="space-y-4">
        @php
            $documents = [
                ['name' => 'Budi A ..', 'file' => 'Raport Asli'],
                ['name' => 'Tanti', 'file' => 'KK Asli'],
                ['name' => 'Yanto', 'file' => 'Raport Asli'],
            ];
        @endphp

        @foreach ($documents as $doc)
        <div class="bg-[#EFEFEF] rounded-3xl px-8 py-4 flex items-center justify-between shadow-sm border border-gray-100">
            <!-- Student Name -->
            <div class="w-1/4">
                <span class="text-[#173A67] font-extrabold text-sm">{{ $doc['name'] }}</span>
            </div>

            <!-- Document Info -->
            <div class="flex-1 flex justify-center">
                <div class="bg-white rounded-full px-8 py-2.5 flex items-center gap-4 shadow-sm">
                    <span class="text-[14px] font-extrabold text-[#173A67]">Nama Berkas:</span>
                    <span style="background-color: #FFC107;" class="text-[11px] font-extrabold px-6 py-1.5 rounded-full text-black shadow-sm uppercase tracking-wider">
                        {{ $doc['file'] }}
                    </span>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-4 w-1/4 justify-end">
                <button style="background-color: #D85B63;" class="text-white px-6 py-2.5 rounded-3xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                    File <i data-lucide="download" class="w-4 h-4"></i>
                </button>
                <a href="{{ route('admin.detailpemberkasan') }}" style="background-color: #D85B63;" class="text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:opacity-90 transition-all">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="flex items-center justify-between pt-12 px-4 mt-8">
        <div class="flex items-center gap-2 text-gray-400 text-sm font-bold">
            <button class="flex items-center gap-1 hover:text-[#173A67] transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Previous
            </button>
            <div class="flex items-center gap-1 mx-4">
                <button class="w-8 h-8 rounded-lg bg-[#2B2B2B] text-white flex items-center justify-center">1</button>
                <button class="w-8 h-8 rounded-lg hover:bg-gray-200 text-gray-600 flex items-center justify-center">2</button>
                <button class="w-8 h-8 rounded-lg hover:bg-gray-200 text-gray-600 flex items-center justify-center">3</button>
                <span class="px-1 text-gray-400">...</span>
                <button class="w-8 h-8 rounded-lg hover:bg-gray-200 text-gray-600 flex items-center justify-center">67</button>
                <button class="w-8 h-8 rounded-lg hover:bg-gray-200 text-gray-600 flex items-center justify-center">68</button>
            </div>
            <button class="flex items-center gap-1 hover:text-[#173A67] transition-colors">
                Next <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="text-gray-600 text-[13px] font-bold">
            50 /Halaman
        </div>
    </div>
</div>
@endsection
