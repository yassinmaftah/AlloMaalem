<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign Up | Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-variant": "#e0e3e5",
                        "surface-bright": "#f7f9fb",
                        "outline-variant": "#c4c5d5",
                        "on-tertiary-fixed-variant": "#802a00",
                        "surface-container": "#eceef0",
                        "secondary": "#515f74",
                        "on-primary-fixed": "#001453",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-secondary-container": "#57657a",
                        "tertiary": "#611e00",
                        "secondary-fixed-dim": "#b9c7df",
                        "secondary-container": "#d5e3fc",
                        "on-background": "#191c1e",
                        "on-primary": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-primary-container": "#a8b8ff",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary-fixed": "#0d1c2e",
                        "background": "#f7f9fb",
                        "on-primary-fixed-variant": "#173bab",
                        "outline": "#757684",
                        "on-error-container": "#93000a",
                        "primary": "#00288e",
                        "on-surface": "#191c1e",
                        "error": "#ba1a1a",
                        "on-tertiary-container": "#ffa583",
                        "surface": "#f7f9fb",
                        "error-container": "#ffdad6",
                        "primary-fixed-dim": "#b8c4ff",
                        "inverse-surface": "#2d3133",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-high": "#e6e8ea",
                        "secondary-fixed": "#d5e3fc",
                        "tertiary-container": "#872d00",
                        "tertiary-fixed": "#ffdbce",
                        "on-tertiary-fixed": "#380d00",
                        "tertiary-fixed-dim": "#ffb59a",
                        "surface-tint": "#3755c3",
                        "inverse-primary": "#b8c4ff",
                        "on-surface-variant": "#444653",
                        "primary-fixed": "#dde1ff",
                        "on-tertiary": "#ffffff",
                        "on-error": "#ffffff",
                        "primary-container": "#1e40af"
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
        /* Custom CSS to handle the selected state of the radio cards */
        input[type="radio"]:checked + div {
            border-color: #00288e;
            background-color: #f0f4ff;
        }
        input[type="radio"]:checked + div .icon,
        input[type="radio"]:checked + div .text {
            color: #00288e;
        }
        input[type="radio"]:checked + div .check-icon {
            opacity: 1;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">

    <main class="min-h-screen flex flex-col items-center justify-center p-6 sm:p-12 relative overflow-hidden">

        <div class="absolute top-0 left-0 w-full h-96 bg-gradient-to-b from-primary/5 to-transparent -z-10"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl -z-10"></div>

        <div class="mb-10 text-center">
            <a href="{{ url('/') }}" class="font-headline font-extrabold text-primary tracking-tighter text-4xl mb-2 block hover:opacity-80 transition">Allo Maalem</a>
            <p class="text-secondary font-medium tracking-wide uppercase text-xs">The Architectural Concierge</p>
        </div>

        <div class="w-full max-w-2xl bg-surface-container-lowest rounded-xl p-8 md:p-10 shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/15">

            <div class="mb-10 text-left">
                <h2 class="font-headline font-bold text-3xl text-on-surface tracking-tight mb-2">Create Account</h2>
                <p class="text-secondary body-lg">It takes less than a minute</p>
            </div>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="space-y-4 mb-8">
                    <span class="block text-sm font-semibold text-secondary uppercase tracking-widest">Select your profile</span>
                    <div class="grid grid-cols-2 gap-4">

                        <label class="relative cursor-pointer">
                            <input class="sr-only" name="role" type="radio" value="client" {{ old('role', 'client') == 'client' ? 'checked' : '' }}/>
                            <div class="flex flex-col items-center justify-center p-6 border-2 border-surface-container-highest rounded-xl hover:border-primary-fixed transition-all group">
                                <span class="text font-headline font-bold text-sm text-on-surface">I am a Client</span>
                                <div class="check-icon absolute top-2 right-2 opacity-0 transition-opacity">
                                    <span class="material-symbols-outlined text-primary text-xl" data-icon="check_circle" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input class="sr-only" name="role" type="radio" value="maalem" {{ old('role') == 'maalem' ? 'checked' : '' }}/>
                            <div class="flex flex-col items-center justify-center p-6 border-2 border-surface-container-highest rounded-xl hover:border-primary-fixed transition-all group">
                                <span class="text font-headline font-bold text-sm text-on-surface text-center leading-tight">I am a Maalem</span>
                                <div class="check-icon absolute top-2 right-2 opacity-0 transition-opacity">
                                    <span class="material-symbols-outlined text-primary text-xl" data-icon="check_circle" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Full Name</label>
                        <input name="name" value="{{ old('name') }}" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3.5 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all placeholder:text-outline" placeholder="Ahmed Benali" type="text" />
                        @error('name') <span class="text-red-500 text-sm ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Phone Number</label>
                        <input name="phone" value="{{ old('phone') }}" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3.5 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all placeholder:text-outline" placeholder="+212 6XX XXX XXX" type="tel" />
                        @error('phone') <span class="text-red-500 text-sm ml-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-on-surface-variant ml-1">Email Address</label>
                    <input name="email" value="{{ old('email') }}" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3.5 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all placeholder:text-outline" placeholder="email@example.com" type="email" />
                    @error('email') <span class="text-red-500 text-sm ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Password</label>
                        <input name="password" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3.5 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all placeholder:text-outline" placeholder="••••••••" type="password" />
                        @error('password') <span class="text-red-500 text-sm ml-1">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1">Confirm Password</label>
                        <input name="password_confirmation" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3.5 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all placeholder:text-outline" placeholder="••••••••" type="password" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-on-surface-variant ml-1">Profile Picture <span class="text-gray-500 font-normal">(Optional)</span></label>
                    <input type="file" name="avatar" accept="image/*" class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 text-on-surface focus:ring-0 focus:bg-surface-container-lowest focus:border-b-2 focus:border-primary transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-blue-800"/>
                    @error('avatar') <span class="text-red-500 text-sm ml-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-6">
                    <button class="w-full bg-primary hover:bg-blue-800 text-on-primary font-headline font-bold py-4 rounded-xl shadow-lg shadow-primary/20 transition-all active:scale-[0.98] transform flex items-center justify-center gap-2" type="submit">
                        Register Now
                        <span class="material-symbols-outlined text-xl" data-icon="arrow_forward">arrow_forward</span>
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-on-surface-variant text-sm">
                    Already have an account?
                    <a class="text-primary font-bold hover:underline transition-all ml-1" href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>

    </main>

</body>
</html>
