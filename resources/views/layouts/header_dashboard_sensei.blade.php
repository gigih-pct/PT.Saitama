<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                @if(Auth::guard('admin')->check())
                    <span class="font-medium text-sm">{{ Auth::guard('admin')->user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">
                        {{ substr(Auth::guard('admin')->user()->name, 0, 1) }}
                    </div>
                @elseif(Auth::check())
                    <span class="font-medium text-sm">{{ Auth::user()->name }}</span>
                    <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                @else
                    <span class="font-medium text-sm">Sensei</span>
                @endif
            </div>
            
            <!-- Logout Button -->
            <form method="POST" action="{{ route('sensei.logout') }}" class="flex items-center border-l border-white/20 pl-4 h-6">
                @csrf
                <button type="submit" class="text-white hover:text-red-300 transition-colors" title="Logout">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
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

</body>
</html>