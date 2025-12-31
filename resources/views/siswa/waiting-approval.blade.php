<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Persetujuan | PT Saitama Juara Dunia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-50 rounded-full blur-[120px] -z-10 opacity-60 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-50 rounded-full blur-[120px] -z-10 opacity-60 -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-md w-full animate-in fade-in zoom-in duration-500">
        <div class="bg-white rounded-[2.5rem] p-12 shadow-2xl border border-white text-center">
            <div class="w-20 h-20 bg-[#173A67] rounded-3xl flex items-center justify-center shadow-xl mx-auto mb-8 rotate-3 hover:rotate-0 transition-transform duration-500">
                <i data-lucide="clock" class="w-10 h-10 text-white"></i>
            </div>

            <h1 class="text-2xl font-extrabold text-[#173A67] mb-4 tracking-tight">Menunggu Persetujuan</h1>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-8">
                Terima kasih telah mendaftar di <strong>LPK Saitama</strong>. Akun Anda saat ini sedang dalam proses verifikasi oleh administrator.
            </p>

            <div class="bg-blue-50/50 rounded-2xl p-6 mb-8 border border-blue-100/50">
                <div class="flex items-center gap-4 text-left">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                        <i data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-extrabold text-blue-600 uppercase tracking-widest">Informasi</p>
                        <p class="text-xs text-slate-500 font-bold mt-0.5">Kami akan memberitahu Anda segera setelah akun Anda aktif.</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('siswa.logout') }}" method="POST">
                @csrf
                <button type="submit" 
                   class="inline-flex items-center gap-2 text-[#173A67] font-extrabold text-xs uppercase tracking-widest hover:text-blue-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Keluar & Kembali
                </button>
            </form>
        </div>
        
        <p class="text-center text-slate-400 text-[10px] font-bold mt-8 uppercase tracking-widest leading-loose">
            Copyright &copy; 2025 PT Saitama Juara Dunia.<br>Semoga Berhasil!
        </p>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
