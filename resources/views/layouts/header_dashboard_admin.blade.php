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

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity"></div>

    <!-- TOP HEADER -->
    <header class="fixed top-0 left-0 right-0 h-14 bg-[#173A67] flex items-center justify-between px-4 lg:px-6 z-[1000] text-white shadow-sm">
        <!-- Logo Left -->
        <div class="flex items-center gap-3">
            <button id="mobile-menu-toggle" class="lg:hidden p-2 rounded-xl bg-white/10 hover:bg-white/20 transition-all">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-8 w-auto" alt="Logo">
            <div class="leading-tight hidden sm:block">
                <p class="font-bold text-xs tracking-wide">PT SAITAMA</p>
                <p class="text-[8px] opacity-80 uppercase tracking-widest">Juara Mendunia</p>
            </div>
        </div>

        <!-- User Profile Right -->
        <x-header-profile />
    </header>

    <!-- SIDEBAR -->
    <aside class="fixed top-14 left-0 bottom-0 w-64 bg-white border-r border-gray-200 z-50 flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0">
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
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

            <a href="{{ route('admin.pengajuansiswa') }}" 
                class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('admin.pengajuansiswa') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
                <div class="flex items-center gap-3">
                    <i data-lucide="user-plus" class="w-5 h-5"></i>
                    <span>Pengajuan Siswa</span>
                </div>
                @php
                    $pendingCount = \App\Models\User::where('role', 'siswa')->where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="flex items-center justify-center min-w-[20px] h-5 px-1.5 rounded-full bg-red-500 text-white text-[10px] font-bold">
                        {{ $pendingCount }}
                    </span>
                @endif
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
    <main class="lg:ml-64 mt-14 p-4 lg:p-6 bg-gray-50 min-h-[calc(100vh-56px)] transition-all duration-300">
        @yield('content')
    </main>

    <script>
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {
            const toggle = document.getElementById('mobile-menu-toggle');
            const sidebar = document.querySelector('aside');
            const overlay = document.getElementById('sidebar-overlay');

            if (toggle && sidebar) {
                toggle.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    if (overlay) overlay.classList.toggle('hidden');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
