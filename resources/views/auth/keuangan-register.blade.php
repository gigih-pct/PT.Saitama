<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Keuangan | PT Saitama Juara Dunia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex bg-white overflow-hidden">

<!-- LEFT SECTION (Informasi & Carousel) -->
<div class="hidden lg:flex w-1/2 bg-[#173A67] text-white flex-col justify-between p-12 relative overflow-hidden">
    <!-- Abstract Decoration -->
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-white/5 rounded-full blur-[100px] -mr-48 -mt-48"></div>
    
    <div class="relative z-10">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-besar.png') }}" class="h-30" alt="Logo Besar">
        </div>

        <div class="mt-20">
            <p class="text-[11px] font-extrabold text-white/40 uppercase tracking-[0.3em] mb-4">Papan Informasi</p>
            
            <!-- Carousel Container -->
            <div class="relative group">
                <div class="bg-white/10 backdrop-blur-md rounded-[2.5rem] p-3 border border-white/10 shadow-2xl overflow-hidden">
                    <img src="{{ asset('images/sensei-class.jpg') }}" class="w-full h-[400px] object-cover rounded-[2rem]" alt="Saitama Info">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#173A67]/80 to-transparent flex flex-col justify-end p-10">
                        <h4 class="text-xl font-bold mb-2">Portal Keuangan Saitama</h4>
                        <p class="text-xs text-white/70 font-medium">Pengelolaan dana dan administrasi keuangan yang transparan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative z-10">
        <div class="grid grid-cols-2 gap-8 text-[11px]">
            <div>
                <p class="font-extrabold text-white/40 uppercase tracking-widest mb-3">Saitama Grup</p>
                <ul class="space-y-2 font-bold opacity-80">
                    <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3 h-3 text-[#D85B63]"></i> LPK Saitama</li>
                    <li class="flex items-center gap-2"><i data-lucide="check-circle-2" class="w-3 h-3 text-[#D85B63]"></i> Ayaka Josei Center</li>
                </ul>
            </div>
            <div>
                <p class="font-extrabold text-white/40 uppercase tracking-widest mb-3">Kontak Kami</p>
                <p class="font-medium opacity-80 leading-relaxed">
                    Jl. Pahlawan Jr. Prajenan No.9, Mertoyudan,<br>Kab. Magelang, Jawa Tengah 56172
                </p>
            </div>
        </div>
        <p class="mt-12 text-[10px] font-bold text-white/30 uppercase tracking-[0.2em]">Copyright &copy; {{ date('Y') }} PT Saitama Juara Mendunia</p>
    </div>
</div>

<!-- RIGHT SECTION (Form) -->
<div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-[#F8FAFC]">
    <div class="w-full max-w-[480px]">
        
        <div class="text-center mb-10">
            <a href="{{ route('login.portal') }}" class="inline-block mb-6">
                <img src="{{ asset('images/logo-kecil.png') }}" class="h-16 mx-auto" alt="Saitama Logo">
            </a>
            <h1 class="text-3xl font-extrabold text-[#173A67] tracking-tight mb-2">Pendaftaran Keuangan</h1>
            <p class="text-slate-400 text-sm font-medium leading-relaxed">Lengkapi formulir di bawah ini untuk mendaftarkan akun Keuangan baru.</p>
        </div>

        @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-[#D85B63] p-5 rounded-2xl text-red-700 animate-in fade-in duration-300">
                <p class="text-xs font-extrabold uppercase tracking-widest mb-2">Terjadi Kesalahan</p>
                <ul class="text-xs font-bold space-y-1 opacity-80">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('keuangan.register.store') }}" class="space-y-5">
            @csrf
            
            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <div class="relative group">
                    <i data-lucide="user" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                    <input name="name" type="text" value="{{ old('name') }}" required 
                           class="w-full bg-white border border-gray-100 rounded-2xl pl-13 pr-5 py-4.5 text-[13px] font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all placeholder:text-gray-300 shadow-sm"
                           placeholder="Masukkan nama lengkap">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Alamat Email</label>
                <div class="relative group">
                    <i data-lucide="mail" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                    <input name="email" type="email" value="{{ old('email') }}" required 
                           class="w-full bg-white border border-gray-100 rounded-2xl pl-13 pr-5 py-4.5 text-[13px] font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all placeholder:text-gray-300 shadow-sm"
                           placeholder="nama@email.com">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input name="password" type="password" required 
                               class="w-full bg-white border border-gray-100 rounded-2xl pl-13 pr-5 py-4.5 text-[13px] font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all placeholder:text-gray-300 shadow-sm"
                               placeholder="••••••••">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Konfirmasi</label>
                    <div class="relative group">
                        <i data-lucide="shield-check" class="absolute left-5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 group-focus-within:text-[#173A67] transition-colors"></i>
                        <input name="password_confirmation" type="password" required 
                               class="w-full bg-white border border-gray-100 rounded-2xl pl-13 pr-5 py-4.5 text-[13px] font-bold text-[#173A67] focus:ring-4 focus:ring-[#173A67]/5 focus:border-[#173A67]/20 transition-all placeholder:text-gray-300 shadow-sm"
                               placeholder="••••••••">
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-[11px] font-extrabold text-[#173A67]/40 uppercase tracking-widest ml-1">Verifikasi Keamanan</label>
                <div class="cf-turnstile" data-sitekey="{{ config('turnstile.site_key') }}" data-theme="light"></div>
            </div>

            <button type="submit" class="w-full bg-[#173A67] text-white py-5 rounded-[1.5rem] font-extrabold text-[13px] shadow-xl shadow-blue-900/10 hover:translate-y-[-2px] hover:shadow-blue-900/20 active:scale-95 transition-all uppercase tracking-[0.2em] mt-2">
                DAFTAR SEKARANG
            </button>
        </form>

        <div class="mt-12 pt-8 border-t border-gray-100 text-center">
            <p class="text-[13px] font-bold text-slate-400 tracking-tight">
                Sudah punya akun? 
                <a href="{{ route('keuangan.login') }}" class="text-[#D85B63] font-extrabold hover:underline ml-1">Masuk Disini</a>
            </p>
        </div>
    </div>
</div>

<script>
    lucide.createIcons();
</script>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</body>
</html>
