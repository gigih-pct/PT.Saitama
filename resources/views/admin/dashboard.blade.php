@extends('layouts.header_dashboard_admin')

@section('content')
<div class="space-y-6">
    <!-- TOP CARDS ROW -->
    <div class="grid grid-cols-12 gap-6">
        <!-- PROFILE CARD (Left - Larger) -->
        <div class="col-span-12 lg:col-span-7 bg-white rounded-2xl p-8 shadow-sm border border-gray-50">
            <div class="flex items-center gap-10">
                <!-- Avatar -->
                <div class="relative">
                    <img src="{{ asset('images/avatar-placeholder.png') }}" class="w-32 h-32 rounded-full border-4 border-white shadow-lg object-cover" alt="Avatar">
                </div>
                
                <!-- Info Section -->
                <div class="flex-1 relative pb-2">
                    <!-- Edit Button Top Right -->
                    <div class="absolute -top-4 right-0">
                        <button style="background-color: #D85B63;" class="text-white px-5 py-2 rounded-2xl flex items-center gap-2 text-xs font-bold hover:opacity-90 transition-opacity">
                            <i data-lucide="pencil" class="w-3 h-3"></i>
                            Edit
                        </button>
                    </div>

                    <div class="space-y-1.5 mt-2">
                        <p class="text-[13px] flex items-center gap-1 text-[#173A67]">
                            <span class="font-extrabold w-20">Nama :</span>
                            <span class="font-medium text-gray-500">Maharani</span>
                        </p>
                        <p class="text-[13px] flex items-center gap-1 text-[#173A67]">
                            <span class="font-extrabold w-20">NIS :</span>
                            <span class="font-medium text-gray-500">23.2865</span>
                        </p>
                        <p class="text-[13px] flex items-center gap-1 text-[#173A67]">
                            <span class="font-extrabold w-20">Tgl Lahir :</span>
                            <span class="font-medium text-gray-500">10 Agustus 2004</span>
                        </p>
                    </div>

                    <!-- Presensi Button -->
                    <div class="mt-5">
                        <button style="background-color: #FFC107;" class="px-8 py-2.5 rounded-2xl text-[13px] font-extrabold text-[#173A67] shadow-md hover:opacity-90 transition-opacity">
                            Presensi
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- ATTENDANCE CARD (Right - Smaller) -->
        <div class="col-span-12 lg:col-span-5 bg-white rounded-2xl p-8 shadow-sm border border-gray-50 flex flex-col items-center justify-center relative min-h-[180px]">
            <div class="absolute top-8 right-8 flex items-center gap-2">
                <span class="font-extrabold text-[#173A67] text-[13px]">Kehadiran</span>
                <span class="bg-[#22C55E] text-white text-[10px] font-extrabold px-3 py-1 rounded-full uppercase tracking-wider shadow-sm">Baik</span>
            </div>
            
            <div class="mt-4">
                <h2 style="color: #173A67;" class="text-6xl font-[800]">75%</h2>
            </div>
        </div>
    </div>

    <!-- BERKAS PENDAFTARAN -->
    <div class="rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100">
        <div class="bg-[#173A67] px-6 py-4">
            <h3 class="text-white font-extrabold text-sm tracking-wide">Berkas Pendaftaran</h3>
        </div>
        <div class="p-5 space-y-4">
            <!-- Item 1 -->
            <div class="flex items-center bg-[#EFEFEF] px-6 py-3.5 rounded-3xl">
                <div class="w-1/6">
                    <p class="text-[#173A67] font-extrabold text-sm">Budi A ..</p>
                </div>
                <div class="flex-1 flex justify-center">
                    <div class="bg-white rounded-full px-8 py-2.5 flex items-center gap-4 shadow-sm">
                        <span class="text-[13px] font-extrabold text-[#173A67]">Nama Berkas:</span>
                        <span style="background-color: #FFC107;" class="text-[11px] font-extrabold px-5 py-1.5 rounded-full text-black shadow-sm">Fotocopy KTP</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-1/6 justify-end">
                    <button style="background-color: #D85B63;" class="text-white px-5 py-2.5 rounded-3xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                        File <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                    <a href="{{ route('admin.detailpemberkasan') }}" style="background-color: #D85B63;" class="text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:opacity-90 transition-all">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="flex items-center bg-[#EFEFEF] px-6 py-3.5 rounded-3xl">
                <div class="w-1/6">
                    <p class="text-[#173A67] font-extrabold text-sm">Tanti</p>
                </div>
                <div class="flex-1 flex justify-center">
                    <div class="bg-white rounded-full px-8 py-2.5 flex items-center gap-4 shadow-sm">
                        <span class="text-[13px] font-extrabold text-[#173A67]">Nama Berkas:</span>
                        <span style="background-color: #FFC107;" class="text-[11px] font-extrabold px-5 py-1.5 rounded-full text-black shadow-sm">Fotocopy KTP</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-1/6 justify-end">
                    <button style="background-color: #D85B63;" class="text-white px-5 py-2.5 rounded-3xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                        File <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                    <button style="background-color: #D85B63;" class="text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:opacity-90 transition-all">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- BERKAS SELEKSI -->
    <div class="rounded-2xl overflow-hidden shadow-sm bg-white border border-gray-100">
        <div class="bg-[#173A67] px-6 py-4">
            <h3 class="text-white font-extrabold text-sm tracking-wide">Berkas Seleksi</h3>
        </div>
        <div class="p-5 space-y-4">
            <!-- Item 1 -->
            <div class="flex items-center bg-[#EFEFEF] px-6 py-3.5 rounded-3xl">
                <div class="w-1/6">
                    <p class="text-[#173A67] font-extrabold text-sm">Budi A ..</p>
                </div>
                <div class="flex-1 flex justify-center">
                    <div class="bg-white rounded-full px-8 py-2.5 flex items-center gap-4 shadow-sm">
                        <span class="text-[13px] font-extrabold text-[#173A67]">Nama Berkas:</span>
                        <span style="background-color: #FFC107;" class="text-[11px] font-extrabold px-5 py-1.5 rounded-full text-black shadow-sm">Rapot Asli</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-1/6 justify-end">
                    <button style="background-color: #D85B63;" class="text-white px-5 py-2.5 rounded-3xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                        File <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                    <a href="{{ route('admin.detailpemberkasan') }}" style="background-color: #D85B63;" class="text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:opacity-90 transition-all">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="flex items-center bg-[#EFEFEF] px-6 py-3.5 rounded-3xl">
                <div class="w-1/6">
                    <p class="text-[#173A67] font-extrabold text-sm">Tanti</p>
                </div>
                <div class="flex-1 flex justify-center">
                    <div class="bg-white rounded-full px-8 py-2.5 flex items-center gap-4 shadow-sm">
                        <span class="text-[13px] font-extrabold text-[#173A67]">Nama Berkas:</span>
                        <span style="background-color: #FFC107;" class="text-[11px] font-extrabold px-5 py-1.5 rounded-full text-black shadow-sm">KK Asli</span>
                    </div>
                </div>
                <div class="flex items-center gap-3 w-1/6 justify-end">
                    <button style="background-color: #D85B63;" class="text-white px-5 py-2.5 rounded-3xl text-sm font-extrabold flex items-center gap-2 shadow-md hover:opacity-90 transition-all">
                        File <i data-lucide="download" class="w-4 h-4"></i>
                    </button>
                    <a href="{{ route('admin.detailpemberkasan') }}" style="background-color: #D85B63;" class="text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:opacity-90 transition-all">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
