<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manage All Users - Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f7f9fb",
                        "primary-fixed": "#dde1ff",
                        "on-surface-variant": "#444653",
                        "surface-variant": "#e0e3e5",
                        "outline-variant": "#c4c5d5",
                        "on-primary-fixed-variant": "#173bab",
                        "on-primary": "#ffffff",
                        "primary-container": "#1e40af",
                        "on-error-container": "#93000a",
                        "inverse-surface": "#2d3133",
                        "tertiary-fixed": "#ffdbce",
                        "surface-container": "#eceef0",
                        "inverse-on-surface": "#eff1f3",
                        "secondary-fixed": "#d5e3fc",
                        "secondary": "#515f74",
                        "on-tertiary-fixed": "#380d00",
                        "on-surface": "#191c1e",
                        "on-primary-fixed": "#001453",
                        "tertiary-container": "#872d00",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e",
                        "surface-bright": "#f7f9fb",
                        "surface": "#f7f9fb",
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-error": "#ffffff",
                        "tertiary-fixed-dim": "#ffb59a",
                        "surface-dim": "#d8dadc",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-secondary-fixed-variant": "#3a485b",
                        "secondary-fixed-dim": "#b9c7df",
                        "inverse-primary": "#b8c4ff",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-container": "#57657a",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-high": "#e6e8ea",
                        "outline": "#757684",
                        "surface-tint": "#3755c3",
                        "on-background": "#191c1e",
                        "primary": "#00288e",
                        "on-tertiary-container": "#ffa583",
                        "secondary-container": "#d5e3fc",
                        "tertiary": "#611e00",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#b8c4ff"
                    },
                    "fontFamily": {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .user-card-shadow {
            box-shadow: 0 20px 40px rgba(25, 28, 30, 0.04);
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-background font-body text-on-surface">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <header class="mb-10">
            <h1 class="font-headline font-extrabold text-4xl tracking-tight text-on-surface">Manage All Users</h1>
            <p class="text-secondary mt-2 font-medium">Oversee community health, moderation, and account status across the platform.</p>
        </header>

        <x-alert />

        <section class="mb-12">
            <form method="GET" action="{{ route('admin.users.index') }}" class="bg-surface-container-lowest rounded-xl p-6 user-card-shadow flex flex-col md:flex-row gap-4 items-center">
                <div class="relative flex-grow w-full">
                    <input name="search" value="{{ request('search') }}" class="w-full pl-12 pr-4 py-3 bg-surface-container-low border-none rounded-xl focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all placeholder:text-outline font-label" placeholder="Search users by name..." type="text"/>
                </div>
                <div class="flex gap-3 w-full md:w-auto">
                    <button type="submit" class="flex-1 md:flex-none px-8 py-3 bg-primary text-on-primary font-bold rounded-xl transition-all hover:bg-blue-800 active:scale-95">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.users.index') }}" class="flex items-center justify-center flex-1 md:flex-none px-6 py-3 bg-surface-container-high text-secondary font-semibold rounded-xl transition-all hover:bg-surface-container-highest active:scale-95">
                            Clear
                        </a>
                    @endif
                </div>
            </form>
        </section>

        @if($users->isEmpty())
            <section class="flex flex-col items-center justify-center py-24 text-center">
                <h2 class="font-headline font-bold text-2xl text-on-surface">No users found</h2>
                <p class="text-secondary max-w-sm mt-2">We couldn't find any accounts matching your search criteria. Try broadening your terms.</p>
                <a href="{{ route('admin.users.index') }}" class="mt-8 font-bold text-primary hover:underline">Reset Filters</a>
            </section>
        @else
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($users as $user)
                    <div class="relative bg-surface-container-lowest rounded-xl p-6 border border-outline-variant/15 user-card-shadow flex flex-col h-full">

                        <div class="absolute top-4 right-4 z-10">
                            @if($user->is_baned == 1)
                                <span class="px-3 py-1 bg-error-container text-on-error-container text-xs font-bold rounded-full tracking-wider">BANNED</span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full tracking-wider">ACTIVE</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-4 mb-6 {{ $user->is_baned == 1 ? 'grayscale opacity-80' : '' }}">
                            <div class="relative h-16 w-16">
                                <img class="h-16 w-16 rounded-full object-cover border-2 border-primary-fixed shadow-sm"
                                     src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://t3.ftcdn.net/jpg/07/24/59/76/360_F_724597608_pmo5BsVumFcFyHJKlASG2Y2KpkkfiYUU.jpg' }}"
                                     alt="Avatar">
                            </div>
                            <div>
                                <h3 class="font-headline font-bold text-xl text-on-surface">{{ $user->name }}</h3>
                                @if(strtolower($user->role) === 'maalem')
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-secondary-container text-on-secondary-container text-[10px] font-bold uppercase rounded tracking-widest">{{ $user->role }}</span>
                                @else
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-surface-container text-on-surface-variant text-[10px] font-bold uppercase rounded tracking-widest">{{ $user->role }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="bg-surface-container-low rounded-xl p-4 mb-8 flex-grow space-y-3 {{ $user->is_baned == 1 ? 'grayscale opacity-60' : '' }}">
                            @if(strtolower($user->role) === 'maalem')
                                {{-- <div class="flex justify-between items-center">
                                    <span class="text-xs text-secondary font-medium uppercase tracking-tight">Rating</span>
                                    <span class="font-bold text-sm text-yellow-600">4.5 ⭐</span>
                                </div> --}}
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-secondary font-medium uppercase tracking-tight">Completed Apps</span>
                                    <span class="font-bold text-sm">{{ $user->applications ? $user->applications->where('status', 'completed')->count() : 0 }}</span>
                                </div>
                            @elseif(strtolower($user->role) === 'client')
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-secondary font-medium uppercase tracking-tight">Jobs Posted</span>
                                    <span class="font-bold text-sm">{{ $user->jobs ? $user->jobs->count() : 0 }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-secondary font-medium uppercase tracking-tight">Completed Jobs</span>
                                    <span class="font-bold text-sm text-green-700">{{ $user->jobs ? $user->jobs->where('status', 'completed')->count() : 0 }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto">
                            @if($user->is_baned == 0)
                                <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full py-3 border-2 border-error text-error font-bold rounded-xl transition-all hover:bg-error/5 active:scale-95">
                                        Ban User
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full py-3 bg-green-600 text-white font-bold rounded-xl transition-all hover:bg-green-700 shadow-md shadow-green-200 active:scale-95">
                                        Unban User
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </section>
        @endif

    </main>
</body>
</html>
