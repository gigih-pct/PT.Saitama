<div x-data="{ 
    showProfileDropdown: false, 
    showLogoutModal: false,
    userName: '{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : (Auth::check() ? Auth::user()->name : 'User') }}',
    userInitial: '{{ Auth::guard('admin')->check() ? substr(Auth::guard('admin')->user()->name, 0, 1) : (Auth::check() ? substr(Auth::user()->name, 0, 1) : 'U') }}',
    logoutRoute: '{{ Auth::guard('admin')->check() ? route('admin.logout') : (request()->is('crm*') ? route('crm.logout') : (request()->is('sensei*') ? route('sensei.logout') : (request()->is('siswa*') ? route('siswa.logout') : (request()->is('orangtua*') ? route('orangtua.logout') : (request()->is('keuangan*') ? route('keuangan.logout') : route('logout')))))) }}'
}" class="flex items-center gap-4 relative">
    
    <!-- User Profile Trigger -->
    <div class="flex items-center gap-3 cursor-pointer group" @click="showProfileDropdown = !showProfileDropdown">
        <span class="font-medium text-sm text-white group-hover:text-blue-200 transition-colors" x-text="userName"></span>
        <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold text-white group-hover:bg-white/30 transition-all border border-white/10 shadow-sm" x-text="userInitial"></div>
    </div>

    <!-- Profile Dropdown -->
    <div x-show="showProfileDropdown" 
         x-cloak
         @click.away="showProfileDropdown = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         class="absolute right-0 top-full mt-2 w-48 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-[60]">
        
        <!-- Dropdown Header/Profile -->
        <div class="bg-[#0097d6] py-3 px-4">
            <span class="text-white font-bold text-sm">Profil</span>
        </div>

        <!-- Dropdown Items -->
        <div class="py-1">
            <button @click="showLogoutModal = true; showProfileDropdown = false" class="w-full text-left px-4 py-3 text-sm font-bold text-[#102a4e] hover:bg-gray-50 flex items-center gap-2 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4 text-gray-500"></i>
                Logout
            </button>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" 
         x-cloak
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="bg-white rounded-[2.5rem] p-10 w-full max-w-sm shadow-2xl transform transition-all text-center border border-gray-100">
            <h3 class="text-xl font-extrabold text-[#102a4e] mb-10">Yakin ingin keluar?</h3>
            
            <div class="flex items-center justify-center gap-4">
                <!-- Ya Button (Logout Form) -->
                <form :action="logoutRoute" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-[#0097d6] text-white px-10 py-3 rounded-2xl font-bold text-lg hover:bg-blue-600 transition shadow-lg shadow-blue-200/50 w-28">
                        Ya
                    </button>
                </form>
                
                <!-- Tidak Button -->
                <button @click="showLogoutModal = false" class="bg-[#c21414] text-white px-10 py-3 rounded-2xl font-bold text-lg hover:bg-red-700 transition shadow-lg shadow-red-200/50 w-28">
                    Tidak
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    // Re-initialize lucide icons inside component if needed
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>
