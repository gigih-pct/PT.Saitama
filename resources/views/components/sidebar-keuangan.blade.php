<!-- Elegant & Simple Sidebar for Keuangan -->
<aside class="fixed left-0 top-16 w-64 h-[calc(100vh-64px)] bg-white border-r border-gray-200 z-40 flex flex-col">
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        
        <a href="{{ route('keuangan.dashboard') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('keuangan.dashboard') ? 'bg-[#102a4e] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('keuangan.pembayaran') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('keuangan.pembayaran') ? 'bg-[#102a4e] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="credit-card" class="w-5 h-5"></i>
            <span>Pembayaran</span>
        </a>

    </nav>

    <!-- Bottom Logo -->
    <div class="px-6 py-6 border-t border-gray-100">
        <div class="flex items-center justify-center opacity-30">
            <img src="{{ asset('images/logo-saitama.png') }}" class="h-8 w-auto grayscale">
        </div>
    </div>

</aside>

<script>
    lucide.createIcons();
</script>
