<div x-data="{ 
    showProfileDropdown: false, 
    showLogoutModal: false,
    showProfileModal: false,
    userName: '{{ Auth::guard('admin')->check() ? Auth::guard('admin')->user()->name : (Auth::check() ? Auth::user()->name : 'User') }}',
    userInitial: '{{ Auth::guard('admin')->check() ? substr(Auth::guard('admin')->user()->name, 0, 1) : (Auth::check() ? substr(Auth::user()->name, 0, 1) : 'U') }}',
    logoutRoute: '{{ Auth::guard('admin')->check() ? route('admin.logout') : (request()->is('crm*') ? route('crm.logout') : (request()->is('sensei*') ? route('sensei.logout') : (request()->is('siswa*') ? route('siswa.logout') : (request()->is('orangtua*') ? route('orangtua.logout') : (request()->is('keuangan*') ? route('keuangan.logout') : route('logout')))))) }}',
    user: {
        name: '{{ Auth::user()->name ?? 'N/A' }}',
        email: '{{ Auth::user()->email ?? 'N/A' }}',
        role: '{{ Auth::user()->role ?? 'N/A' }}',
        status: '{{ Auth::user()->status ?? 'N/A' }}',
        follow_up: '{{ Auth::user()->follow_up ?? 'N/A' }}',
        no_wa: '{{ Auth::user()->no_wa_pribadi ?? 'N/A' }}',
        wa_ortu: '{{ Auth::user()->wa_orang_tua ?? 'N/A' }}',
        join_date: '{{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y') : 'N/A' }}'
    }
}" class="flex items-center gap-4 relative">
    
    <!-- User Profile Trigger -->
    <div class="flex items-center gap-2 sm:gap-3 cursor-pointer group" @click="showProfileDropdown = !showProfileDropdown">
        <span class="hidden sm:block font-medium text-sm text-white group-hover:text-blue-200 transition-colors" x-text="userName"></span>
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
        <div class="bg-[#173A67] py-3 px-4 flex items-center justify-between">
            <span class="text-white font-bold text-xs uppercase tracking-widest">Menu Profil</span>
            <i data-lucide="user-cog" class="w-3.5 h-3.5 text-blue-300"></i>
        </div>

        <!-- Dropdown Items -->
        <div class="py-1">
            <button @click="showProfileModal = true; showProfileDropdown = false" class="w-full text-left px-4 py-3 text-sm font-bold text-[#173A67] hover:bg-gray-50 flex items-center gap-2 transition-colors border-b border-gray-50">
                <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                Profil Saya
            </button>
            <button @click="showLogoutModal = true; showProfileDropdown = false" class="w-full text-left px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors">
                <i data-lucide="log-out" class="w-4 h-4 text-red-400"></i>
                Logout
            </button>
        </div>
    </div>

    <div x-show="showProfileModal" 
         x-cloak
         class="fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-[#173A67]/60 backdrop-blur-md"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="bg-white rounded-[2.5rem] w-full max-w-lg shadow-2xl overflow-hidden border border-white/20 relative">
             <!-- Modal Header Background -->
             <div class="absolute top-0 left-0 w-full h-32 bg-[#173A67]"></div>
             <div class="absolute top-4 right-4 z-20">
                <button @click="showProfileModal = false" class="w-10 h-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center text-white transition-all backdrop-blur-sm">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
             </div>

             <div class="relative pt-12 pb-8 px-8 flex flex-col items-center">
                <!-- Avatar in Modal -->
                <div class="relative mb-6">
                    <div class="w-32 h-32 rounded-[2.5rem] bg-white p-1 shadow-2xl border-4 border-white">
                        <div class="w-full h-full rounded-[2.2rem] bg-[#173A67] flex items-center justify-center text-white text-5xl font-black" x-text="userInitial"></div>
                    </div>
                </div>

                <h3 class="text-2xl font-black text-[#173A67] mb-1" x-text="user.name"></h3>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-8" x-text="user.role + ' • ' + user.email"></p>

                <!-- Profile Info Grid -->
                <div class="w-full grid grid-cols-2 gap-4 mb-8">
                     <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">Status</span>
                        <span class="text-sm font-black text-[#173A67] uppercase" x-text="user.status || 'Active'"></span>
                     </div>
                     <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">Follow Up</span>
                        <span class="text-sm font-black text-[#173A67] uppercase" x-text="user.follow_up || 'None'"></span>
                     </div>
                     <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">WhatsApp</span>
                        <span class="text-sm font-black text-[#173A67]" x-text="user.no_wa"></span>
                     </div>
                     <div class="bg-gray-50 rounded-2xl p-4 border border-gray-100">
                        <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block mb-1">Join Date</span>
                        <span class="text-sm font-black text-[#173A67]" x-text="user.join_date"></span>
                     </div>
                </div>

                <div class="w-full space-y-3">
                    <div class="flex items-center justify-between py-3 border-b border-gray-100">
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">WhatsApp Orang Tua</span>
                        <span class="text-xs font-black text-[#173A67]" x-text="user.wa_ortu"></span>
                    </div>
                </div>

                <button @click="showProfileModal = false" class="mt-10 w-full py-4 bg-[#173A67] text-white rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-xl shadow-blue-100 hover:bg-blue-900 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4"></i> Tutup Profil
                </button>
             </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" 
         x-cloak
         class="fixed inset-0 z-[2000] flex items-center justify-center p-4 bg-[#173A67]/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100">
        
        <div class="bg-white rounded-[2.5rem] p-10 w-full max-w-sm shadow-2xl transform transition-all text-center border border-gray-100">
             <div class="w-20 h-20 rounded-[2rem] bg-red-50 text-red-500 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="log-out" class="w-10 h-10"></i>
             </div>
            <h3 class="text-xl font-black text-[#173A67] mb-2">Yakin ingin keluar?</h3>
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-10">Sesi Anda akan diakhiri sekarang</p>
            
            <div class="flex items-center justify-center gap-4">
                <!-- Ya Button (Logout Form) -->
                <form :action="logoutRoute" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-[#0095DA] text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-blue-600 transition shadow-xl shadow-blue-100">
                        Ya
                    </button>
                </form>
                
                <!-- Tidak Button -->
                <button @click="showLogoutModal = false" class="flex-1 bg-[#D31F1F] text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-red-700 transition">
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
