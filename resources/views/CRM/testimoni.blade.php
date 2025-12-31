@extends('layouts.header_dashboard_crm')

@section('title', 'Testimoni Siswa')

@section('content')
<div class="bg-white rounded-3xl shadow-sm overflow-hidden">
    
    <!-- Header -->
    <div class="bg-[#102a4e] px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-white font-bold text-lg">Testimoni Siswa</span>
            <span class="bg-[#d95d5d] text-white text-xs font-bold px-3 py-1 rounded-full">Kelas A2</span>
        </div>
        
        <button class="text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>
        </button>
    </div>

    <!-- LIST CONTENT -->
    <div class="p-6 space-y-3 min-h-[500px]">
        
        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="font-bold text-[#102a4e] text-sm flex-1">Agung N</div>
            
            <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>

        <div class="bg-[#f3f4f6] rounded-xl px-4 py-3 flex items-center justify-between gap-4">
            <div class="font-bold text-[#102a4e] text-sm flex-1">Andi</div>
            
            <button class="bg-[#d95d5d] hover:bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm transition">
               <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
        </div>

    </div>

</div>
@endsection
