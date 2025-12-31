@extends('layouts.header_dashboard_keuangan')

@section('title', 'Pembayaran')

@section('content')
<div class="space-y-6">

    <!-- PEMBAYARAN SECTION -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden border border-gray-100/50">
        
        <!-- Header -->
        <div class="bg-[#102a4e] px-8 py-5 flex items-center justify-between">
            <h3 class="text-white font-bold text-lg text-rose-50/90">Pembayaran</h3>
        </div>

        <!-- LIST CONTENT -->
        <div class="p-8 space-y-4">
            
            @php
                $students = [
                    ['name' => 'Budi A ..', 'amount' => '4.000.000'],
                    ['name' => 'Andi', 'amount' => '4.000.000'],
                    ['name' => 'Yanto', 'amount' => '4.000.000'],
                    ['name' => 'Ratna', 'amount' => '4.000.000'],
                    ['name' => 'Yanti', 'amount' => '4.000.000'],
                    ['name' => 'Arjo', 'amount' => '4.000.000'],
                    ['name' => 'Stya', 'amount' => '4.000.000'],
                    ['name' => 'Adi', 'amount' => '4.000.000'],
                    ['name' => 'Andi', 'amount' => '4.000.000'],
                ];
            @endphp

            @foreach($students as $student)
            <!-- ROW ITEM -->
            <div class="bg-[#f3f4f6] rounded-2xl px-6 py-4 flex items-center justify-between gap-4 hover:shadow-md transition-all group">
                <div class="w-32 font-bold text-[#102a4e] text-sm truncate">{{ $student['name'] }}</div>
                
                <div class="flex items-center gap-2">
                    <div class="bg-white px-3 py-1.5 rounded-full font-bold text-[10px] text-[#102a4e] shadow-sm border border-gray-100 italic">Angkatan: IV</div>
                    <div class="bg-[#d95d5d] text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-sm">A2</div>
                </div>

                <div class="flex gap-2">
                    <button class="bg-[#d95d5d] text-white text-[10px] font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm hover:bg-red-700 transition">
                         <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3.5 h-3.5 bg-white rounded-full">
                         <span>Siswa</span>
                    </button>
                    <button class="bg-[#d95d5d] text-white text-[10px] font-bold px-4 py-1.5 rounded-full flex items-center gap-2 shadow-sm hover:bg-red-700 transition">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" class="w-3.5 h-3.5 bg-white rounded-full">
                        <span>Orang Tua</span>
                    </button>
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-[#102a4e] font-bold text-[11px] whitespace-nowrap">Jumlah Pembayaran:</span>
                    <span class="bg-[#fbbf24] text-[#102a4e] font-black text-xs px-4 py-1.5 rounded-full shadow-sm">Rp {{ $student['amount'] }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <button class="bg-[#d95d5d] text-white px-5 py-1.5 rounded-xl text-[10px] font-bold flex items-center gap-2 shadow-sm hover:bg-red-700 transition whitespace-nowrap">
                        <span>File</span> 
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    </button>
                    <button class="bg-[#d95d5d] text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm hover:bg-red-700 transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>
                    </button>
                </div>

                <div class="bg-[#00902f] text-white text-[10px] font-black px-5 py-2 rounded-full tracking-wide whitespace-nowrap">Biaya Pendaftaran</div>
            </div>
            @endforeach

             <!-- PAGINATION -->
             <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-100 text-[#102a4e]">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#102a4e]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                         <span class="text-xs font-bold text-gray-400 cursor-not-allowed uppercase tracking-wider">Previous</span>
                    </div>
                    
                    <div class="flex gap-2">
                        <span class="bg-[#102a4e] text-white w-8 h-8 flex items-center justify-center rounded-lg text-xs font-black shadow-md">1</span>
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold hover:bg-gray-100 cursor-pointer transition">2</span>
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold hover:bg-gray-100 cursor-pointer transition">3</span>
                         <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold">...</span>
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold hover:bg-gray-100 cursor-pointer transition">67</span>
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg text-xs font-bold hover:bg-gray-100 cursor-pointer transition">68</span>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold uppercase tracking-wider cursor-pointer hover:text-black">Next</span>
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
                    </div>
                </div>
                <div class="font-black text-xs tracking-wide">50 / Halaman</div>
            </div>

        </div>

    </div>

</div>
@endsection
