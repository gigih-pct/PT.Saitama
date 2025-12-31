@extends('layouts.header_dashboard_sensei')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- MAIN: MATERI + JADWAL -->
    <div class="col-span-12 lg:col-span-8 bg-white rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold">Pengajaran</h2>
                <p class="text-sm text-gray-500">Ringkasan materi dan jadwal pengajaran Anda</p>
            </div>
            <div class="flex items-center gap-2">
                <button class="bg-gray-100 px-3 py-1 rounded-full text-sm">Filter</button>
                <button class="bg-blue-900 text-white px-3 py-1 rounded-full text-sm">Tambah Materi</button>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-1 gap-4">
            <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500">Materi</div>
                    <div class="font-semibold text-lg">Kanji - Pengenalan</div>
                    <div class="text-xs text-gray-400">A2 • Hari ini</div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="bg-red-500 text-white rounded-full w-10 h-10">⬇</button>
                    <button class="bg-blue-900 text-white px-3 py-1 rounded-full">Detail</button>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500">Materi</div>
                    <div class="font-semibold text-lg">Kotoba - Percakapan</div>
                    <div class="text-xs text-gray-400">A2 • Hari ini</div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="bg-red-500 text-white rounded-full w-10 h-10">⬇</button>
                    <button class="bg-blue-900 text-white px-3 py-1 rounded-full">Detail</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SIDEBAR: PROFILE + AKSI -->
    <div class="col-span-12 lg:col-span-4 bg-white rounded-xl p-6 text-center">
        <img src="{{ asset('images/avatar.jpg') }}" class="w-32 h-32 rounded-full object-cover">
        <div class="mt-4 text-sm space-y-1">
            <p><span class="font-semibold">Nama :</span> Maharani</p>
            <p><span class="font-semibold">NIM :</span> 2312.2865</p>
            <p><span class="font-semibold">Tgl Lahir :</span> 10 Agustus 2004</p>
        </div>
        <button class="mt-4 bg-yellow-400 px-6 py-2 rounded-full font-semibold">Presensi</button>
    </div>
</div>

<div class="bg-white rounded-xl p-4 mt-6">
    <div class="flex items-center justify-between bg-blue-900 text-white rounded-lg px-4 py-2">
        <span>Jadwal</span>
        <span class="bg-red-400 px-3 py-1 text-xs rounded-full">Minggu I</span>
    </div>

    <div class="mt-4 space-y-3">
        <div class="flex items-center justify-between bg-gray-100 rounded-lg px-4 py-3">
            <div>
                <div class="font-medium">Kanji</div>
                <div class="text-xs text-gray-500">Rabu • 15.00 - 16.00</div>
            </div>
            <div class="flex gap-2">
                <button class="bg-red-400 text-white rounded-full w-9 h-9">✎</button>
                <button class="bg-red-500 text-white px-4 py-1 rounded-full">Presensi</button>
            </div>
        </div>
        <div class="flex items-center justify-between bg-gray-100 rounded-lg px-4 py-3">
            <div>
                <div class="font-medium">Kotoba</div>
                <div class="text-xs text-gray-500">Selasa • 15.00 - 16.00</div>
            </div>
            <div class="flex gap-2">
                <button class="bg-red-400 text-white rounded-full w-9 h-9">✎</button>
                <button class="bg-red-500 text-white px-4 py-1 rounded-full">Presensi</button>
            </div>
        </div>
    </div>
</div>

<!-- EVALUASI / EVENTS -->
<div class="col-span-12 mt-6 bg-white rounded-xl p-6">
    <div class="flex items-center justify-between">
        <h3 class="font-semibold">Evaluasi & Event</h3>
        <a href="#" class="text-sm text-blue-900">Lihat semua</a>
    </div>
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold">Bunpou - Seleksi I</div>
                    <div class="text-xs text-gray-400">Senin, 25 Agustus 2025 • 15.00 - 16.00</div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-red-400 text-white rounded-full w-9 h-9">✎</button>
                    <button class="bg-red-500 text-white px-4 py-1 rounded-full">Presensi</button>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 rounded-lg p-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="font-semibold">Kotoba - Seleksi I</div>
                    <div class="text-xs text-gray-400">Selasa, 26 Agustus 2025 • 15.00 - 16.00</div>
                </div>
                <div class="flex gap-2">
                    <button class="bg-red-400 text-white rounded-full w-9 h-9">✎</button>
                    <button class="bg-red-500 text-white px-4 py-1 rounded-full">Presensi</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection