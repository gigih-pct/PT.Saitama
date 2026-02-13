<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden lg:hidden transition-opacity"></div>

<!-- Elegant & Simple Sidebar for CRM -->
<aside class="fixed left-0 top-16 w-64 h-[calc(100vh-64px)] bg-white border-r border-gray-200 z-40 flex flex-col transition-transform duration-300 -translate-x-full lg:translate-x-0">
    
    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1">
        
        <a href="{{ route('crm.dashboard') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('crm.dashboard') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('crm.kesiswaan') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ (request()->routeIs('crm.kesiswaan') || request()->routeIs('crm.detailkesiswaan')) ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="users" class="w-5 h-5"></i>
            <span>Kesiswaan</span>
        </a>

        <a href="{{ route('crm.pengajuansiswa') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('crm.pengajuansiswa') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="file-text" class="w-5 h-5"></i>
            <span>Pengajuan Siswa</span>
        </a>

        <a href="{{ route('crm.datakelas') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('crm.datakelas') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="book" class="w-5 h-5"></i>
            <span>Data Kelas</span>
        </a>

        <a href="{{ route('crm.testimoni') }}" 
            class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all {{ request()->routeIs('crm.testimoni') ? 'bg-[#173A67] text-white shadow-sm' : 'text-gray-700 hover:bg-gray-50' }}">
            <i data-lucide="message-square" class="w-5 h-5"></i>
            <span>Testimoni Siswa</span>
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
