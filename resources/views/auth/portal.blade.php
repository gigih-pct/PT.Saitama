<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saitama Portal | Pilih Akses Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .glass-card:hover {
            transform: translateY(-10px);
            background: white;
            box-shadow: 0 25px 50px -12px rgba(16, 42, 78, 0.15);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex items-center justify-center p-6 relative overflow-x-hidden">
    
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-blue-100 rounded-full blur-[120px] -z-10 opacity-60 translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-indigo-100 rounded-full blur-[120px] -z-10 opacity-60 -translate-x-1/2 translate-y-1/2"></div>

    <div class="max-w-5xl w-full">
        
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="flex justify-center mb-6">
                <div class="w-20 h-20 bg-[#102a4e] rounded-3xl flex items-center justify-center shadow-xl rotate-12 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ asset('images/logo-saitama.png') }}" class="w-12 h-12 brightness-0 invert" alt="Saitama Logo">
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#102a4e] mb-4 tracking-tight">Selamat Datang di Saitama</h1>
            <p class="text-slate-500 text-lg md:text-xl font-medium max-w-2xl mx-auto">Silakan pilih akses masuk sesuai dengan peran Anda untuk melanjutkan ke dashboard.</p>
        </div>

        <!-- Portal Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- 1. Sensei -->
            <a href="{{ route('sensei.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center mb-6 group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="graduation-cap" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">Sensei</h3>
                <p class="text-slate-400 text-sm font-medium">Akses mengajar & penilaian</p>
            </a>

            <!-- 2. Admin -->
            <a href="{{ route('admin.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center mb-6 group-hover:bg-red-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="shield-check" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">Administrator</h3>
                <p class="text-slate-400 text-sm font-medium">Manajemen sistem & data</p>
            </a>

            <!-- 3. CRM -->
            <a href="{{ route('crm.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="users" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">CRM</h3>
                <p class="text-slate-400 text-sm font-medium">Hubungan & layanan siswa</p>
            </a>

            <!-- 4. Siswa -->
            <a href="{{ route('siswa.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="book-open" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">Siswa</h3>
                <p class="text-slate-400 text-sm font-medium">Dashboard belajar & progres</p>
            </a>

            <!-- 5. Orang Tua -->
            <a href="{{ route('orangtua.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-purple-100 text-purple-600 flex items-center justify-center mb-6 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="heart" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">Orang Tua</h3>
                <p class="text-slate-400 text-sm font-medium">Pantau perkembangan anak</p>
            </a>

            <!-- 6. Keuangan -->
            <a href="{{ route('keuangan.login') }}" class="glass-card group p-8 rounded-[2.5rem] flex flex-col items-center text-center">
                <div class="w-20 h-20 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                    <i data-lucide="wallet" class="w-10 h-10"></i>
                </div>
                <h3 class="text-xl font-bold text-[#102a4e] mb-2">Keuangan</h3>
                <p class="text-slate-400 text-sm font-medium">Pembayaran & laporan biaya</p>
            </a>

        </div>

        <!-- Footer Info -->
        <div class="text-center mt-20 text-slate-400 text-sm font-medium">
            <p>&copy; 2025 PT Saitama Juara Dunia. Seluruh hak cipta dilindungi.</p>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
