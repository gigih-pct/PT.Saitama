@extends('layouts.header_dashboard_siswa')

@section('title', 'Berkas Siswa')

@section('content')
<div class="space-y-6">

    <!-- MESSAGES -->
    @if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-2xl shadow-sm flex items-center justify-between">
        <p class="text-sm font-bold">{{ session('success') }}</p>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

    <!-- CARD: BERKAS PENDAFTARAN -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-[#173A67] px-8 py-4">
            <h3 class="text-white font-bold text-lg">Berkas Pendaftaran</h3>
        </div>

        <!-- List -->
        <div class="p-8 space-y-4">
            @php
                $berkaspendaftaranList = [
                    'Fotocopy KTP', 
                    'Fotocopy KTP Orang Tua/Wali', 
                    'Fotocopy Ijasah SD', 
                    'Fotocopy Ijasah SMP', 
                    'Fotocopy Ijasah SMA', 
                    'Fotocopy Akte Kelahiran', 
                    'Fotocopy KK',
                    'Foto 3x4 (2 lembar)',
                    'Foto 2x3 (2 lembar)',
                    'Form Pendaftaran',
                    'Surat Pernyataan Siswa Baru',
                ];
            @endphp
            
            @foreach($berkaspendaftaranList as $item)
            @php
                $uploaded = $berkasPendaftaran->get($item);
            @endphp
            <div class="bg-gray-50 rounded-2xl p-5 flex flex-col lg:flex-row lg:items-center gap-4">
                <!-- Document Name -->
                <div class="flex-1">
                    <h4 class="font-bold text-[#173A67] text-sm">{{ $item }}</h4>
                    @if($uploaded)
                        <p class="text-xs text-gray-500 mt-1">Diupload: {{ $uploaded->uploaded_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>

                <!-- Status Badge -->
                <div class="flex items-center gap-3">
                    @if($uploaded)
                        @if($uploaded->status == 'approved')
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-xs font-bold">Disetujui</span>
                        @elseif($uploaded->status == 'rejected')
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-bold">Ditolak</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-xs font-bold">Pending</span>
                        @endif
                        <a href="{{ route('siswa.berkas.download', $uploaded->id) }}" 
                           class="bg-[#173A67] text-white px-4 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition">
                            <i data-lucide="download" class="w-4 h-4 inline"></i>
                        </a>
                    @else
                        <button onclick="openUploadModal('pendaftaran', '{{ $item }}')" 
                                class="bg-[#173A67] text-white px-6 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition">
                            Upload
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- CARD: BERKAS SELEKSI -->
    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">
        <!-- Header -->
        <div class="bg-[#173A67] px-8 py-4">
            <h3 class="text-white font-bold text-lg">Berkas Seleksi</h3>
        </div>

        <!-- List -->
        <div class="p-8 space-y-4">
            @php
                $berkasseleksiList = [
                    'Rapot Asli',
                    'KK Asli',
                    'Akte Asli',
                    'Ijasah SD Asli',
                    'Ijasah SMP Asli',
                    'Ijasah SMA Asli',
                    'SKCK Asli',
                    'AK 1',
                    'Foto Keluarga',
                    'Surat Rekomendasi Disnaker',
                    'Form Pernyataan Magang',
                    'Form Belum Pernah Ikut Magang',
                    'Surat Izin Orang Tua/Wali',
                    'Surat Rekomendasi RT/RW',
                ];
            @endphp
            
            @foreach($berkasseleksiList as $item)
            @php
                $uploaded = $berkasSeleksi->get($item);
            @endphp
            <div class="bg-gray-50 rounded-2xl p-5 flex flex-col lg:flex-row lg:items-center gap-4">
                <!-- Document Name -->
                <div class="flex-1">
                    <h4 class="font-bold text-[#173A67] text-sm">{{ $item }}</h4>
                    @if($uploaded)
                        <p class="text-xs text-gray-500 mt-1">Diupload: {{ $uploaded->uploaded_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>

                <!-- Status Badge -->
                <div class="flex items-center gap-3">
                    @if($uploaded)
                        @if($uploaded->status == 'approved')
                            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-xl text-xs font-bold">Disetujui</span>
                        @elseif($uploaded->status == 'rejected')
                            <span class="bg-red-100 text-red-700 px-4 py-2 rounded-xl text-xs font-bold">Ditolak</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-xl text-xs font-bold">Pending</span>
                        @endif
                        <a href="{{ route('siswa.berkas.download', $uploaded->id) }}" 
                           class="bg-[#173A67] text-white px-4 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition">
                            <i data-lucide="download" class="w-4 h-4 inline"></i>
                        </a>
                    @else
                        <button onclick="openUploadModal('seleksi', '{{ $item }}')" 
                                class="bg-[#173A67] text-white px-6 py-2 rounded-xl text-xs font-bold hover:opacity-90 transition">
                            Upload
                        </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-3xl p-8 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-[#173A67] mb-4">Upload Berkas</h3>
        <form action="{{ route('siswa.berkas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="jenis_berkas" id="jenis_berkas">
            <input type="hidden" name="nama_berkas" id="nama_berkas">
            
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Berkas</label>
                <p id="display_nama_berkas" class="text-sm text-gray-600"></p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">File (PDF, JPG, PNG - Max 2MB)</label>
                <input type="file" name="file" required accept=".pdf,.jpg,.jpeg,.png"
                       class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm">
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Keterangan (Opsional)</label>
                <textarea name="keterangan" rows="3" 
                          class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm"></textarea>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeUploadModal()" 
                        class="flex-1 bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-300 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="flex-1 bg-[#173A67] text-white px-6 py-3 rounded-xl font-bold hover:opacity-90 transition">
                    Upload
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openUploadModal(jenis, nama) {
    document.getElementById('jenis_berkas').value = jenis;
    document.getElementById('nama_berkas').value = nama;
    document.getElementById('display_nama_berkas').textContent = nama;
    document.getElementById('uploadModal').classList.remove('hidden');
    document.getElementById('uploadModal').classList.add('flex');
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.add('hidden');
    document.getElementById('uploadModal').classList.remove('flex');
}

lucide.createIcons();
</script>
@endsection
