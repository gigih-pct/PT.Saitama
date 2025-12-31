<!-- resources/views/guru/dashboard.blade.php -->
@extends('layouts.header_dashboard_sensei')

@section('content')
<div class="grid grid-cols-12 gap-6">

    <!-- PROFILE CARD -->
    <div class="col-span-12 lg:col-span-8 bg-white rounded-xl p-6 flex items-center justify-between">
        <div class="flex items-center gap-6">
            <img src="{{ asset('images/avatar.jpg') }}" class="w-24 h-24 rounded-full object-cover" />
            <div class="space-y-1">
                <p class="text-sm text-gray-500">Nama : <span class="text-gray-800 font-semibold">Maharani</span></p>
                <p class="text-sm text-gray-500">NIS : <span class="text-gray-800 font-semibold">23.2865</span></p>
                <p class="text-sm text-gray-500">Tgl Lahir : <span class="text-gray-800 font-semibold">10 Agustus 2004</span></p>
                <div class="flex items-center gap-2 mt-2">
                    <a href="{{ route('sensei.pengajaran') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-1.5 rounded-full text-sm">Pengajaran</a>
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1.5 rounded-full text-sm">Presensi</button>
                </div>
            </div>
        </div>
        <button class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-full flex items-center gap-2">
            ✏️ Edit
        </button>
    </div>

    <!-- KEHADIRAN -->
    <div class="col-span-12 lg:col-span-4 bg-white rounded-xl p-6 text-center">
        <p class="text-sm text-gray-600">Kehadiran</p>
        <span class="inline-block bg-green-500 text-white text-xs px-3 py-1 rounded-full mt-1">Baik</span>
        <p class="text-4xl font-bold text-blue-900 mt-6">75%</p>
    </div>

    <!-- JADWAL -->
    <div class="col-span-12 lg:col-span-4 bg-white rounded-xl p-4">
        <div class="bg-blue-900 text-white rounded-lg px-4 py-2 flex justify-between items-center">
            <span>Jadwal</span>
            <span class="bg-red-400 px-3 py-1 text-xs rounded-full">Minggu I</span>
        </div>
        <ul class="mt-4 space-y-2">
            <li class="bg-gray-100 rounded-lg p-3 flex justify-between">
                <span>Kanji</span><span>Selasa 13.00 - 15.00</span>
            </li>
            <li class="bg-gray-100 rounded-lg p-3 flex justify-between">
                <span>Kotoba</span><span>Selasa 13.00 - 15.00</span>
            </li>
        </ul>
    </div>

    <!-- NILAI BAHASA -->
    <div class="col-span-12 lg:col-span-4 bg-white rounded-xl p-4">
        <div class="bg-blue-900 text-white rounded-lg px-4 py-2">Bahasa</div>
        <ul class="mt-4 space-y-2">
            <li class="flex justify-between bg-gray-100 p-3 rounded-lg">
                <span>Kanji</span><span class="bg-red-400 text-white px-3 rounded-full">7.7</span>
            </li>
            <li class="flex justify-between bg-gray-100 p-3 rounded-lg">
                <span>Kotoba</span><span class="bg-blue-900 text-white px-3 rounded-full">8.7</span>
            </li>
        </ul>
    </div>

    <!-- DAFTAR SISWA -->
    <div class="col-span-12 lg:col-span-4 bg-white rounded-xl p-4">
        <div class="bg-blue-900 text-white rounded-lg px-4 py-2">Daftar Siswa</div>
        <ul class="mt-4 space-y-2">
            <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg">
                <span>Pucet</span>
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Tidak Lolos</span>
            </li>
            <li class="flex justify-between items-center bg-gray-100 p-3 rounded-lg">
                <span>Pucet</span>
                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">Tidak Lolos</span>
            </li>
        </ul>
    </div>

    <!-- GRAFIK -->
    <div class="col-span-12 bg-white rounded-xl p-6">
        <div class="bg-blue-900 text-white rounded-lg px-4 py-2 mb-4">Grafik Performa Kelas</div>
        <canvas id="chartGuru"></canvas>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartGuru');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Minggu 2','Minggu 4','Minggu 6','Minggu 8','Minggu 10','Minggu 12','Minggu 14','Minggu 16'],
        datasets: [
            { label: 'Bahasa', data: [30,28,75,55,60,70,65,85], borderWidth: 2 },
            { label: 'Fisik & Mental', data: [95,45,50,75,35,20,15,35], borderWidth: 2 }
        ]
    }
});
</script>
@endpush