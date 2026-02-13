<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard CRM') | PT Saitama</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <!-- HEADER -->
    <header class="fixed top-0 left-0 w-full h-16 bg-[#173A67] flex items-center justify-between px-6 z-[1000] shadow-sm text-white">
        <!-- Logo -->
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

        <!-- User Profile -->
        <x-header-profile />
    </header>

    <!-- WRAPPER -->
    <div class="flex pt-16 min-h-screen">
        
        <!-- SIDEBAR -->
        @include('components.sidebar-crm')

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-4 lg:p-8 lg:ml-64 transition-all duration-300">
            @yield('content')
        </main>

    </div>

    <script>
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

    @stack('scripts')
</body>
</html>
