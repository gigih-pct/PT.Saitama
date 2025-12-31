<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | PT Saitama Juara Dunia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- TOP HEADER -->
    <header class="fixed top-0 left-0 right-0 h-14 bg-[#173A67] flex items-center justify-between px-6 z-50 text-white shadow-sm">
        <!-- Logo Left -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-8 w-auto" alt="Logo">
            <div class="leading-tight">
                <p class="font-bold text-xs tracking-wide">PT SAITAMA</p>
                <p class="text-[8px] opacity-80 uppercase tracking-widest">Juara Mendunia</p>
            </div>
        </div>

        <!-- User Profile Right -->
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <span class="font-medium text-sm">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">
                    {{ substr(Auth::guard('admin')->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
            
            <!-- Logout Button -->
            <form method="POST" action="{{ route('admin.logout') }}" class="flex items-center border-l border-white/20 pl-4 h-6">
                @csrf
                <button type="submit" class="text-white hover:text-red-300 transition-colors" title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </header>

    <!-- SIDEBAR -->
    <aside class="fixed top-14 left-0 bottom-0 w-64 bg-white border-r border-gray-200 z-40 flex flex-col">
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="{{ route('admin.dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.datakelas') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.datakelas') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="users" class="w-5 h-5"></i>
                <span>Data Siswa</span>
            </a>

            <a href="{{ route('admin.kelas.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.kelas.*') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="school" class="w-5 h-5"></i>
                <span>Pengaturan Kelas</span>
            </a>

            <a href="{{ route('admin.berkaspendaftaran') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.berkaspendaftaran') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                <span>Berkas Pendaftaran</span>
            </a>

            <a href="{{ route('admin.berkasseleksi') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.berkasseleksi') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                <span>Berkas Seleksi</span>
            </a>
        </nav>

        <!-- Bottom Logo -->
        <div class="px-6 py-6 border-t border-gray-100">
            <div class="flex items-center justify-center opacity-30">
                <img src="{{ asset('images/logo-saitama.png') }}" class="h-8 w-auto grayscale">
            </div>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="ml-64 mt-14 p-6 bg-gray-50 min-h-[calc(100vh-56px)]">
        @yield('content')
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
