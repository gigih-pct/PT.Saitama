<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saitama Portal | Pilih Akses Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --brand-navy: #0F172A;
            --brand-navy-accent: #1E293B;
            --brand-blue: #3B82F6;
            --brand-indigo: #6366F1;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--brand-navy);
            color: #ffffff;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Ambient Background */
        .ambient-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: radial-gradient(circle at 0% 0%, #1e293b 0%, #0f172a 100%);
        }

        .blob {
            position: absolute;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            filter: blur(80px);
            animation: move 20s infinite alternate ease-in-out;
        }

        .blob-2 {
            top: 40%;
            right: -200px;
            background: radial-gradient(circle, rgba(99, 102, 241, 0.1) 0%, transparent 70%);
            animation-duration: 25s;
            animation-delay: -5s;
        }

        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(100px, 100px) scale(1.1); }
        }

        /* Glass Card */
        .premium-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .premium-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.05), transparent);
            transition: 0.5s;
        }

        .premium-card:hover::before {
            left: 100%;
        }

        .premium-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.06);
            border-color: var(--brand-blue);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5), 0 0 20px rgba(59, 130, 246, 0.1);
        }

        .icon-box {
            position: relative;
            transition: all 0.4s;
        }

        .premium-card:hover .icon-box {
            transform: scale(1.1);
            filter: drop-shadow(0 0 10px currentColor);
        }

        /* Text Effects */
        .title-gradient {
            background: linear-gradient(to bottom, #FFFFFF 30%, #94A3B8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .role-desc {
            letter-spacing: 0.1em;
            font-size: 0.7rem;
            opacity: 0.6;
            font-weight: 700;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--brand-navy); }
        ::-webkit-scrollbar-thumb { 
            background: #334155; 
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: #475569; }
    </style>
</head>
<body class="flex items-center justify-center py-12 px-4 selection:bg-blue-500/30">
    
    <!-- Immersive Background -->
    <div class="ambient-bg">
        <div class="blob"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="max-w-7xl w-full mx-auto relative z-10">
        
        <!-- Header Section -->
        <header class="text-center mb-20">
            <div class="inline-flex items-center justify-center p-4 bg-white/5 rounded-3xl mb-8 border border-white/10 backdrop-blur-sm animate-bounce-slow">
                <img src="{{ asset('images/logo-saitama.png') }}" class="w-12 h-12 brightness-0 invert opacity-90" alt="Logo">
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tighter title-gradient mb-6">
                SAITAMA PORTAL
            </h1>
            <p class="text-slate-400 text-lg md:text-xl font-medium max-w-xl mx-auto leading-relaxed">
                Pilih akses portal Anda untuk mengelola sistem pendidikan mandiri yang terintegrasi.
            </p>
        </header>

        <!-- Dynamic Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
            
            @php
                $roles = [
                    [
                        'route' => 'sensei.login', 
                        'name' => 'Sensei', 
                        'desc' => 'PENILAIAN & MATERI', 
                        'icon' => 'graduation-cap', 
                        'color' => 'from-orange-500 to-amber-500',
                        'text_color' => 'text-orange-400'
                    ],
                    [
                        'route' => 'admin.login', 
                        'name' => 'Administrator', 
                        'desc' => 'SYSTEM COMMANDER', 
                        'icon' => 'shield-check', 
                        'color' => 'from-red-500 to-rose-600',
                        'text_color' => 'text-red-400'
                    ],
                    [
                        'route' => 'crm.login', 
                        'name' => 'CRM', 
                        'desc' => 'RELASI & PENDAFTARAN', 
                        'icon' => 'users-round', 
                        'color' => 'from-indigo-500 to-blue-600',
                        'text_color' => 'text-indigo-400'
                    ],
                    [
                        'route' => 'siswa.login', 
                        'name' => 'Siswa', 
                        'desc' => 'PORTAL PEMBELAJARAN', 
                        'icon' => 'book-open-check', 
                        'color' => 'from-emerald-500 to-teal-600',
                        'text_color' => 'text-emerald-400'
                    ],
                    [
                        'route' => 'orangtua.login', 
                        'name' => 'Orang Tua', 
                        'desc' => 'MONITORING SISWA', 
                        'icon' => 'heart-handshake', 
                        'color' => 'from-purple-500 to-pink-600',
                        'text_color' => 'text-purple-400'
                    ],
                    [
                        'route' => 'keuangan.login', 
                        'name' => 'Keuangan', 
                        'desc' => 'SISTEM PEMBAYARAN', 
                        'icon' => 'banknote', 
                        'color' => 'from-amber-500 to-yellow-600',
                        'text_color' => 'text-amber-400'
                    ],
                ];
            @endphp

            @foreach($roles as $role)
            <a href="{{ route($role['route']) }}" class="premium-card group p-10 rounded-[2.5rem] flex flex-col items-center">
                <div class="icon-box w-20 h-20 rounded-3xl bg-gradient-to-br {{ $role['color'] }} flex items-center justify-center mb-8 shadow-2xl">
                    <i data-lucide="{{ $role['icon'] }}" class="w-10 h-10 text-white"></i>
                </div>

                <h3 class="text-2xl font-bold text-white mb-2">{{ $role['name'] }}</h3>
                <p class="role-desc uppercase {{ $role['text_color'] }}">{{ $role['desc'] }}</p>
                
                <div class="mt-8 flex items-center gap-2 text-white/40 group-hover:text-blue-400 transition-colors text-xs font-bold uppercase tracking-wider">
                    Buka Akses <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </div>
            </a>
            @endforeach

        </div>

        <!-- Footer -->
        <footer class="mt-24 pt-12 border-t border-white/5 text-center">
            <p class="text-slate-500 text-xs font-semibold tracking-widest uppercase">
                &copy; {{ date('Y') }} PT SAITAMA JUARA DUNIA &bull; INTEGRATED MANAGEMENT SYSTEM
            </p>
        </footer>

    </div>

    <script>
        // Init Lucide
        lucide.createIcons();
    </script>
</body>
</html>
