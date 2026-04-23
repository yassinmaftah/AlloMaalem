<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Profile Settings - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-container": "#872d00",
                        "primary": "#00288e",
                        "on-secondary-fixed-variant": "#3a485b",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-container": "#ffa583",
                        "surface-container-high": "#e6e8ea",
                        "error": "#ba1a1a",
                        "surface": "#f7f9fb",
                        "on-tertiary-fixed": "#380d00",
                        "on-background": "#191c1e",
                        "background": "#f7f9fb",
                        "on-secondary": "#ffffff",
                        "primary-container": "#1e40af",
                        "tertiary": "#611e00",
                        "secondary": "#515f74",
                        "on-surface-variant": "#444653",
                        "inverse-surface": "#2d3133",
                        "on-tertiary-fixed-variant": "#802a00",
                        "inverse-on-surface": "#eff1f3",
                        "surface-bright": "#f7f9fb",
                        "inverse-primary": "#b8c4ff",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "surface-tint": "#3755c3",
                        "on-primary-fixed-variant": "#173bab",
                        "surface-container": "#eceef0",
                        "surface-variant": "#e0e3e5",
                        "surface-dim": "#d8dadc",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-container": "#a8b8ff",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-secondary-container": "#57657a",
                        "secondary-fixed": "#d5e3fc",
                        "secondary-container": "#d5e3fc",
                        "on-surface": "#191c1e",
                        "on-error-container": "#93000a",
                        "error-container": "#ffdad6",
                        "primary-fixed": "#dde1ff",
                        "tertiary-fixed": "#ffdbce",
                        "tertiary-fixed-dim": "#ffb59a",
                        "outline-variant": "#c4c5d5",
                        "outline": "#757684",
                        "on-primary-fixed": "#001453",
                        "on-primary": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e"
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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
            color: #191c1e;
        }
        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
        }
        .premium-border {
            position: relative;
            background: #ffffff;
            border: 2px solid transparent;
            background-clip: padding-box;
        }
        .premium-border::after {
            position: absolute;
            top: -2px; bottom: -2px;
            left: -2px; right: -2px;
            background: linear-gradient(135deg, #FFD700, #FDB931);
            content: '';
            z-index: -1;
            border-radius: 0.85rem;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased pb-20">

    @if(auth()->user()->role === 'client')
        @include('navbars.clientnav')
    @elseif(auth()->user()->role === 'maalem')
        @include('navbars.maalemnav')
    @else
        @include('navbars.adminnav')
    @endif

    <main class="max-w-3xl mx-auto px-6 pt-12 space-y-10">

        <header class="space-y-2">
            <h1 class="text-3xl font-bold tracking-tight text-on-surface">Account Settings</h1>
            <p class="text-secondary text-lg">Manage your personal information and security.</p>
        </header>

        <x-alert />

        @if(auth()->user()->role !== "admin")
            <section class="space-y-6">
                @if(auth()->user()->verification_status === 'verified')
                    <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-5 flex items-center gap-4">
                        <div>
                            <p class="text-emerald-800 font-bold text-sm">You are a Premium Verified User</p>
                            <p class="text-emerald-600/80 text-xs">You have no limits on jobs or applications.</p>
                        </div>
                    </div>
                @elseif(auth()->user()->verification_status === 'pending')
                    <div class="bg-amber-50 border border-amber-100 rounded-xl p-5 flex items-center gap-4">
                        <div class="bg-amber-500 text-white p-2 rounded-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-sm" data-icon="hourglass_empty">hourglass_empty</span>
                        </div>
                        <div>
                            <p class="text-amber-800 font-bold text-sm">Your request is pending</p>
                            <p class="text-amber-700/80 text-xs">The admin is reviewing your account.</p>
                        </div>
                    </div>
                @else
                    <div class="premium-border rounded-xl p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 overflow-hidden relative">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-bold text-on-surface">Normal Account</h3>
                            </div>
                            <p class="text-secondary text-sm">Normal accounts have limits. Upgrade to Premium to remove limits for a one-time fee of $29.</p>
                        </div>
                        <form method="POST" action="{{ route('stripe.checkout') }}">
                            @csrf
                            <button type="submit" class="bg-[#FDB931] hover:bg-[#e6a82d] text-on-tertiary-fixed font-bold py-3 px-6 rounded-xl transition-all active:scale-95 shadow-md shadow-yellow-900/10 whitespace-nowrap flex items-center gap-2">
                                Pay ${{ auth()->user()->role === 'client' ? '29.99' : '15.99' }} to Upgrade
                            </button>
                        </form>
                    </div>
                @endif
            </section>
        @endif

        <section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm shadow-primary/5">
            <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                Personal Information
            </h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PATCH')

                <div class="flex flex-col sm:flex-row sm:items-center gap-6">
                    <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=00288e&color=fff' }}"
                         class="w-24 h-24 rounded-full object-cover border-4 border-surface shadow-md" alt="Avatar">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant">Change Avatar</label>
                        <input type="file" name="avatar" accept="image/*"
                               class="text-sm text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 transition-colors cursor-pointer">

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                               class="w-full bg-surface-container-highest rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant @error('name') border-error border-2 @else border-none @enderror">

                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="w-full bg-surface-container-highest rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant @error('phone') border-error border-2 @else border-none @enderror">

                    </div>
                </div>

                @if(auth()->user()->role !== "admin")
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Bio</label>
                        <textarea name="bio" rows="4"
                                  class="w-full bg-surface-container-highest rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant resize-none @error('bio') border-error border-2 @else border-none @enderror">{{ old('bio', $user->bio) }}</textarea>

                    </div>
                @endif

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-primary text-on-primary font-bold py-3 px-10 rounded-xl hover:bg-blue-800 transition-all active:scale-95 shadow-lg shadow-primary/20">
                        Save Changes
                    </button>
                </div>
            </form>
        </section>

        <section class="bg-surface-container-lowest rounded-2xl p-8 shadow-sm shadow-primary/5">
            <h2 class="text-xl font-bold mb-8 flex items-center gap-2">
                Security & Password
            </h2>

            <form method="POST" action="{{ route('profile.password') }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-on-surface-variant ml-1">Current Password</label>
                    <input type="password" name="current_password"
                           class="w-full bg-surface-container-highest rounded-xl px-4 py-3 focus:ring-2 focus:ring-error focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant @error('current_password') border-error border-2 @else border-none @enderror" placeholder="••••••••••••">

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">New Password</label>
                        <input type="password" name="password"
                               class="w-full bg-surface-container-highest rounded-xl px-4 py-3 focus:ring-2 focus:ring-error focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant @error('password') border-error border-2 @else border-none @enderror" placeholder="Enter new password">

                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                               class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-error focus:bg-surface-container-lowest transition-all text-on-surface placeholder-outline-variant" placeholder="Confirm new password">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-error text-on-error font-bold py-3 px-10 rounded-xl hover:opacity-90 transition-all active:scale-95 shadow-lg shadow-error/20">
                        Update Password
                    </button>
                </div>
            </form>
        </section>

        <footer class="text-center pt-8 opacity-40">
            <p class="text-xs font-headline uppercase tracking-widest text-secondary italic">Allo Maalem • Professional Settings</p>
        </footer>
    </main>

</body>
</html>
