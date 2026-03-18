<nav class="bg-green-600 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center text-white">

            <a href="{{ route('maalem.dashboard') }}" class="text-xl font-bold tracking-wider">🛠️ Allo Maalem</a>

            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('maalem.dashboard') }}" class="hover:text-green-200 font-medium transition">Find Work</a>
                <a href="#" class="hover:text-green-200 font-medium transition">My Applications</a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=15803d&color=fff' }}"
                         class="w-8 h-8 rounded-full object-cover border-2 border-white" alt="avatar">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-md text-sm font-bold transition">Logout</button>
                </form>
            </div>

            <div class="md:hidden flex items-center">
                <button id="mobile-btn-maalem" class="text-white focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu-maalem" class="hidden md:hidden bg-green-700 px-4 pt-2 pb-4 space-y-2 shadow-inner">
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 pb-2 border-b border-green-500">
            <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&background=15803d&color=fff' }}"
                 class="w-8 h-8 rounded-full object-cover border-2 border-white" alt="avatar">
            <span class="text-green-200 font-medium">{{ Auth::user()->name }}</span>
        </a>
        <a href="{{ route('profile.edit') }}" class="block text-white hover:bg-green-500 px-3 py-2 rounded-md font-medium">Profile</a>
        <a href="{{ route('maalem.dashboard') }}" class="block text-white hover:bg-green-500 px-3 py-2 rounded-md font-medium">Find Work</a>
        <a href="#" class="block text-white hover:bg-green-500 px-3 py-2 rounded-md font-medium">My Applications</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="w-full text-left bg-red-500 hover:bg-red-600 px-3 py-2 rounded-md text-white font-bold">Logout</button>
        </form>
    </div>
</nav>

<script>
    document.getElementById('mobile-btn-maalem').addEventListener('click', function() {
        document.getElementById('mobile-menu-maalem').classList.toggle('hidden');
    });
</script>
