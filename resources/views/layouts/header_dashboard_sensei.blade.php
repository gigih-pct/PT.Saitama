<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Sensei | PT Saitama Juara Dunia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F3F4F6]">

    <!-- HEADER -->
    <header class="fixed top-0 left-0 w-full h-16 bg-[#173A67] flex items-center justify-between px-6 z-50 shadow-sm text-white">
        <!-- Logo -->
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-8 w-auto" alt="Logo">
            <div class="leading-tight">
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
        @include('components.sidebar-sensei')

        <!-- MAIN CONTENT -->
        <main class="flex-1 p-8 ml-64">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>