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
            --brand-navy: #173A67;
            --brand-navy-dark: #0A192F;
            --brand-blue: #3B82F6;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--brand-navy-dark);
            color: #ffffff;
            overflow-x: hidden;
            min-height: screen;
        }

        /* Immersive Background */
        .portal-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background: radial-gradient(circle at 50% 50%, var(--brand-navy) 0%, var(--brand-navy-dark) 100%);
            overflow: hidden;
        }

        .aurora {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0.3;
            filter: blur(100px);
            background: 
                radial-gradient(circle at 10% 10%, #3b82f6 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, #6366f1 0%, transparent 40%),
                radial-gradient(circle at 50% 10%, #1e4b85 0%, transparent 40%);
            animation: pulse 15s infinite alternate ease-in-out;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.2; }
            100% { transform: scale(1.2); opacity: 0.4; }
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            background: white;
            border-radius: 50%;
            opacity: 0.2;
            pointer-events: none;
            animation: float-up infinite linear;
        }

        @keyframes float-up {
            from { transform: translateY(100vh) scale(0); opacity: 0; }
            50% { opacity: 0.3; }
            to { transform: translateY(-100px) scale(1.5); opacity: 0; }
        }

        /* Premium Dark Card */
        .dark-glass {
            background: rgba(23, 58, 103, 0.4);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
        }

        .dark-glass::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle at center, var(--brand-blue) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s;
            z-index: -1;
            filter: blur(20px);
        }

        .dark-glass:hover {
            transform: translateY(-8px);
            background: rgba(23, 58, 103, 0.6);
            border-color: var(--brand-blue);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.2);
        }

        .dark-glass:hover::after {
            opacity: 0.3;
        }

        .role-icon {
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .dark-glass:hover .role-icon {
            transform: scale(1.1) rotate(-5deg);
            filter: drop-shadow(0 0 15px currentColor);
        }

        /* Staggered Load */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 0.8s forwards cubic-bezier(0.23, 1, 0.32, 1);
        }

        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }
        .delay-5 { animation-delay: 0.5s; }
        .delay-6 { animation-delay: 0.6s; }

        .brand-text {
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative">
    
    <!-- Immersive Background -->
    <div class="portal-bg">
        <div class="aurora"></div>
        <div id="particles-container"></div>
    </div>

    <div class="max-w-6xl w-full py-20 relative z-10">
        
        <!-- Header -->
        <div class="text-center mb-24 fade-in-up">
            <div class="flex justify-center mb-10">
                <div class="relative group">
                    <div class="absolute -inset-2 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-[2.5rem] blur opacity-40 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative w-28 h-28 bg-[#173A67] rounded-[2.5rem] flex items-center justify-center shadow-3xl border border-white/20 transition-transform duration-500 hover:scale-110">
                        <img src="{{ asset('images/logo-saitama.png') }}" class="w-16 h-16 brightness-0 invert" alt="Saitama Logo">
                    </div>
                </div>
            </div>
            <h1 class="text-6xl md:text-7xl font-black mb-6 tracking-tight brand-text">
                SAITAMA PORTAL
            </h1>
            <p class="text-slate-400 text-xl md:text-2xl font-medium max-w-2xl mx-auto leading-relaxed">
                Pintu gerbang eksklusif menuju <span class="text-blue-400">Pusat Pembelajaran</span> Juara Mendunia.
            </p>
        </div>

        <!-- Role Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-10">
            
            @php
                $roles = [
                    ['route' => 'sensei.login', 'name' => 'Sensei', 'desc' => 'Master & Penilaian', 'icon' => 'graduation-cap', 'color' => 'orange'],
                    ['route' => 'admin.login', 'name' => 'Admin', 'desc' => 'Kontrol Utama', 'icon' => 'shield-check', 'color' => 'red'],
                    ['route' => 'crm.login', 'name' => 'CRM', 'desc' => 'Relasi Siswa', 'icon' => 'users', 'color' => 'indigo'],
                    ['route' => 'siswa.login', 'name' => 'Siswa', 'desc' => 'Akses Belajar', 'icon' => 'book-open', 'color' => 'emerald'],
                    ['route' => 'orangtua.login', 'name' => 'Orang Tua', 'desc' => 'Pantau Siswa', 'icon' => 'heart', 'color' => 'purple'],
                    ['route' => 'keuangan.login', 'name' => 'Keuangan', 'desc' => 'Layanan Biaya', 'icon' => 'wallet', 'color' => 'amber'],
                ];
                $delays = ['delay-1', 'delay-2', 'delay-3', 'delay-4', 'delay-5', 'delay-6'];
            @endphp

            @foreach($roles as $idx => $role)
            <a href="{{ route($role['route']) }}" 
               class="dark-glass group p-12 rounded-[3.5rem] flex flex-col items-center text-center fade-in-up {{ $delays[$idx] }}">
                
                @php
                    $colors = [
                        'orange'  => 'bg-orange-500/10 text-orange-400',
                        'red'     => 'bg-red-500/10 text-red-400',
                        'indigo'  => 'bg-indigo-500/10 text-indigo-400',
                        'emerald' => 'bg-emerald-500/10 text-emerald-400',
                        'purple'  => 'bg-purple-500/10 text-purple-400',
                        'amber'   => 'bg-amber-500/10 text-amber-400',
                    ];
                @endphp

                <div class="role-icon w-24 h-24 rounded-[2.2rem] {{ $colors[$role['color']] }} flex items-center justify-center mb-8 border border-white/5 shadow-inner">
                    <i data-lucide="{{ $role['icon'] }}" class="w-12 h-12"></i>
                </div>

                <h3 class="text-3xl font-black text-white mb-3 tracking-tight">{{ $role['name'] }}</h3>
                <p class="text-slate-400 text-xs font-black uppercase tracking-[0.2em] mb-8">{{ $role['desc'] }}</p>
                
                <div class="mt-auto flex items-center gap-3 text-blue-400 font-black text-xs uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0">
                    Masuk Sekarang <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </div>
            </a>
            @endforeach

        </div>

        <!-- Branding Footer -->
        <div class="text-center mt-32 fade-in-up delay-6">
            <div class="flex items-center justify-center gap-4 mb-8">
                <div class="h-px w-12 bg-white/10"></div>
                <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                <div class="h-px w-12 bg-white/10"></div>
            </div>
            <p class="text-slate-500 text-xs font-bold tracking-[0.3em] uppercase">
                &copy; 2025 PT Saitama Juara Dunia. Official Portal System.
            </p>
        </div>

    </div>

    <script>
        // Lucide Icons
        lucide.createIcons();

        // Particles Generation
        const container = document.getElementById('particles-container');
        const particleCount = 20;

        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            const size = Math.random() * 4 + 1 + 'px';
            particle.style.width = size;
            particle.style.height = size;
            
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.animationDuration = Math.random() * 10 + 10 + 's';
            particle.style.animationDelay = Math.random() * 5 + 's';
            
            container.appendChild(particle);
        }
    </script>
</body>
</html>
