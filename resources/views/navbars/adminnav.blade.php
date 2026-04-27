<nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-sm">
    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 group">
                <span class="material-symbols-outlined text-blue-800 group-hover:scale-110 transition-transform" style="font-variation-settings: 'FILL' 1;">shield_person</span>
                <span class="font-manrope text-xl font-extrabold tracking-tight text-blue-900">Allo Admin</span>
            </a>

            <div class="hidden md:flex items-center space-x-1 lg:space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded-lg font-inter text-sm font-semibold text-slate-600 hover:text-blue-800 hover:bg-blue-50 transition-colors">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="px-3 py-2 rounded-lg font-inter text-sm font-semibold text-slate-600 hover:text-blue-800 hover:bg-blue-50 transition-colors">Manage Users</a>
                <a href="{{ route('admin.settings.index') }}" class="px-3 py-2 rounded-lg font-inter text-sm font-semibold text-slate-600 hover:text-blue-800 hover:bg-blue-50 transition-colors">Settings</a>
                <a href="{{ route('admin.users.premium') }}" class="px-3 py-2 rounded-lg font-inter text-sm font-semibold text-slate-600 hover:text-blue-800 hover:bg-blue-50 transition-colors">Premium Users</a>
                <a href="{{ route('admin.payments') }}" class="px-3 py-2 rounded-lg font-inter text-sm font-semibold text-slate-600 hover:text-blue-800 hover:bg-blue-50 transition-colors">Financial Reports</a>            </div>

            <div class="hidden md:flex items-center gap-4 pl-4 border-l border-gray-200">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                    <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://png.pngtree.com/element_our/20200610/ourmid/pngtree-character-default-avatar-image_2237203.jpg' }}"
                         class="w-8 h-8 rounded-full object-cover border-2 border-blue-100 shadow-sm" alt="avatar">
                    <span class="font-inter text-sm font-bold text-slate-800">{{ Auth::user()->name }}</span>
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 px-3 py-1.5 rounded-lg text-sm font-bold transition-colors border border-red-100">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        Logout
                    </button>
                </form>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-btn-admin" class="text-slate-600 hover:text-blue-800 focus:outline-none p-2 rounded-lg hover:bg-slate-100 transition-colors">
                    <span class="material-symbols-outlined text-2xl" id="mobile-icon">menu</span>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu-admin" class="hidden md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 py-4 border-b border-gray-100 mb-2">
                <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=00288e&color=fff' }}"
                     class="w-10 h-10 rounded-full object-cover border-2 border-blue-100 shadow-sm" alt="avatar">
                <div>
                    <div class="font-inter text-sm font-bold text-slate-800">{{ Auth::user()->name }}</div>
                    <div class="font-inter text-xs font-medium text-slate-500">Administrator</div>
                </div>
            </a>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-3 rounded-lg font-inter font-semibold transition-colors">Dashboard</a>
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-3 rounded-lg font-inter font-semibold transition-colors">Manage Users</a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-3 rounded-lg font-inter font-semibold transition-colors">Settings</a>
            <a href="{{ route('admin.users.premium') }}" class="flex items-center gap-2 text-slate-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-3 rounded-lg font-inter font-semibold transition-colors">Premium Maalems</a>
            <a href="{{ route('admin.payments') }}"class="flex items-center gap-2 text-slate-600 hover:text-blue-800 hover:bg-blue-50 px-3 py-3 rounded-lg font-inter font-semibold transition-colors">Financial Reports</a>


            <form method="POST" action="{{ route('logout') }}" class="mt-4 pt-4 border-t border-gray-100">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 hover:bg-red-100 px-3 py-3 rounded-lg font-inter font-bold transition-colors border border-red-100">
                    <span class="material-symbols-outlined text-[20px]">logout</span> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-btn-admin').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu-admin');
        const icon = document.getElementById('mobile-icon');

        menu.classList.toggle('hidden');

        if (menu.classList.contains('hidden'))
            icon.innerText = 'menu';
        else
            icon.innerText = 'close';

    });
</script>
