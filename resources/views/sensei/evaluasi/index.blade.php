@extends('layouts.header_dashboard_sensei')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- PROFIL SISWA -->
    <div class="col-span-12 lg:col-span-8">
        <div class="bg-white rounded-lg shadow p-6 flex items-start gap-6">
            <img
                src="/images/avatar.jpg"
                class="w-40 h-40 rounded-full object-cover flex-shrink-0"
                alt="Foto Siswa"
            >

            <div class="flex-1">
                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-1">Nama :</p>
                    <p class="font-semibold text-gray-800">Maharani</p>
                </div>

                <div class="mb-3">
                    <p class="text-sm text-gray-600 mb-1">NIM :</p>
                    <p class="font-semibold text-gray-800">23.12.2865</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-1">Tgl Lahir :</p>
                    <p class="font-semibold text-gray-800">10 Agustus 2004</p>
                </div>

                <button
                    class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-semibold px-6 py-2 rounded-lg transition"
                >
                    Presensi
                </button>
            </div>
        </div>
    </div>

    <!-- NILAI EVALUASI SELEKSI -->
    <div class="col-span-12 lg:col-span-4">
        <div class="bg-white rounded-lg shadow p-6">

            <div class="bg-[#1e3a5f] text-white rounded-lg px-4 py-2.5 flex items-center justify-between mb-4">
                <span class="font-semibold text-sm">Nilai Evaluasi Seleksi</span>
                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">A2</span>
            </div>

            <div class="space-y-3">
                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                    <span class="font-medium text-gray-700">Kanji</span>
                    <span class="bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full">7,7</span>
                </div>

                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                    <span class="font-medium text-gray-700">Kotuba</span>
                    <span class="bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full">7,7</span>
                </div>
            </div>

        </div>
    </div>

    <!-- PENILAIAN SISWA -->
    <div class="col-span-12">
        <div class="bg-white rounded-lg shadow overflow-hidden">

            <div class="bg-[#1e3a5f] text-white px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="font-semibold text-lg">Penilaian Siswa</span>
                    <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">A2</span>
                </div>

                <!-- ICON FILTER -->
                <button class="hover:bg-white/10 p-2 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-3">
                <!-- ROW 1 -->
                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-6 py-4">
                    <span class="font-medium text-gray-800 w-32">Agus</span>
                    <span class="flex-1 text-center">
                        <span class="bg-green-600 text-white text-sm font-semibold px-6 py-2 rounded-lg inline-block">Siap Seleksi</span>
                    </span>
                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-full transition">Nilai</button>
                </div>

                <!-- ROW 2 -->
                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-6 py-4">
                    <span class="font-medium text-gray-800 w-32">Budi</span>
                    <span class="flex-1 text-center">
                        <span class="text-gray-800 font-medium">-</span>
                    </span>
                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-full transition">Nilai</button>
                </div>

                <!-- ROW 3 -->
                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-6 py-4">
                    <span class="font-medium text-gray-800 w-32">Agus</span>
                    <span class="flex-1 text-center">
                        <span class="bg-green-600 text-white text-sm font-semibold px-6 py-2 rounded-lg inline-block">Siap Seleksi</span>
                    </span>
                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-full transition">Nilai</button>
                </div>

                <!-- ROW 4 -->
                <div class="flex items-center justify-between bg-gray-50 rounded-lg px-6 py-4">
                    <span class="font-medium text-gray-800 w-32">Yanto</span>
                    <span class="flex-1 text-center">
                        <span class="bg-green-600 text-white text-sm font-semibold px-6 py-2 rounded-lg inline-block">Siap Seleksi</span>
                    </span>
                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm font-semibold px-5 py-2 rounded-full transition">Nilai</button>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection