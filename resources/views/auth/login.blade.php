<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Sign In | Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#c4c5d5",
                        "error-container": "#ffdad6",
                        "background": "#f7f9fb",
                        "inverse-primary": "#b8c4ff",
                        "tertiary-fixed-dim": "#ffb59a",
                        "tertiary-container": "#872d00",
                        "inverse-on-surface": "#eff1f3",
                        "error": "#ba1a1a",
                        "primary-fixed": "#dde1ff",
                        "surface-container-lowest": "#ffffff",
                        "on-primary": "#ffffff",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-secondary": "#ffffff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-fixed-variant": "#802a00",
                        "secondary-fixed": "#d5e3fc",
                        "surface-container-highest": "#e0e3e5",
                        "surface-variant": "#e0e3e5",
                        "outline": "#757684",
                        "on-primary-fixed-variant": "#173bab",
                        "on-tertiary-fixed": "#380d00",
                        "primary": "#00288e",
                        "on-primary-fixed": "#001453",
                        "on-error-container": "#93000a",
                        "surface-dim": "#d8dadc",
                        "surface-container": "#eceef0",
                        "surface": "#f7f9fb",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-secondary-container": "#57657a",
                        "secondary": "#515f74",
                        "on-primary-container": "#a8b8ff",
                        "on-surface-variant": "#444653",
                        "surface-tint": "#3755c3",
                        "surface-bright": "#f7f9fb",
                        "on-tertiary": "#ffffff",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-tertiary-container": "#ffa583",
                        "tertiary-fixed": "#ffdbce",
                        "on-surface": "#191c1e",
                        "on-background": "#191c1e",
                        "inverse-surface": "#2d3133",
                        "secondary-container": "#d5e3fc",
                        "tertiary": "#611e00",
                        "primary-container": "#1e40af",
                        "on-error": "#ffffff",
                        "surface-container-low": "#f2f4f6"
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
            min-height: max(884px, 100dvh);
        }
        h1, h2, .brand-font {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>
<body class="bg-background text-on-surface min-h-screen flex flex-col">

    <main class="flex-grow flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 bg-surface-container-lowest rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] overflow-hidden">

            <div class="hidden md:flex flex-col justify-between p-12 bg-primary relative overflow-hidden">
                <div class="relative z-10">
                    <a href="{{ url('/') }}" class="text-on-primary brand-font text-2xl font-extrabold tracking-tighter mb-12 block hover:opacity-80 transition">
                        Allo Maalem
                    </a>
                    <h2 class="text-4xl font-extrabold text-on-primary leading-tight mb-6">
                        The Architectural <br/>Concierge for Your Home.
                    </h2>
                    <p class="text-primary-fixed-dim text-lg max-w-sm">
                        Connect with the finest craftsmen and professionals curated for excellence and reliability.
                    </p>
                </div>

                <div class="absolute bottom-0 right-0 w-64 h-64 bg-primary-container/30 rounded-full -mr-20 -mb-20 blur-3xl"></div>
                <div class="absolute top-0 left-0 w-48 h-48 bg-tertiary-container/10 rounded-full -ml-16 -mt-16 blur-2xl"></div>

            </div>

            <div class="p-8 md:p-16 flex flex-col justify-center bg-surface-container-lowest">

                <div class="md:hidden mb-12 flex justify-center">
                    <a href="{{ url('/') }}" class="brand-font text-2xl font-extrabold text-primary tracking-tighter">Allo Maalem</a>
                </div>

                <div class="mb-10 text-center md:text-left">
                    <h1 class="text-3xl font-extrabold text-on-surface tracking-tight mb-2">Sign In</h1>
                    <p class="text-secondary font-medium">Access your dashboard</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-on-surface-variant ml-1" for="email">Email</label>
                        <div class="relative">
                            <input class="w-full px-4 py-4 bg-surface-container-highest border-none rounded-lg focus:bg-surface-container-lowest focus:ring-0 focus:border-b-2 focus:border-primary transition-all duration-200 text-on-surface placeholder:text-outline/60"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="name@example.com"
                                type="email"
                                 />
                        </div>
                        @error('email')
                            <span class="text-red-500 text-sm ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label class="block text-sm font-semibold text-on-surface-variant" for="password">Password</label>
                            <a class="text-xs font-bold text-primary hover:text-primary-container transition-colors" href="{{ route('password.email.form') }}">Forgot Password?</a>
                        </div>
                        <div class="relative">
                            <input class="w-full px-4 py-4 bg-surface-container-highest border-none rounded-lg focus:bg-surface-container-lowest focus:ring-0 focus:border-b-2 focus:border-primary transition-all duration-200 text-on-surface placeholder:text-outline/60 pr-12"
                                id="password"
                                name="password"
                                placeholder="••••••••"
                                type="password"
                                 />
                            <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant hover:text-primary transition-colors focus:outline-none">
                                <span id="eye-icon" class="material-symbols-outlined" data-icon="visibility">visibility</span>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-sm ml-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-3 ml-1">
                        <input class="w-5 h-5 rounded border-outline-variant text-primary focus:ring-primary/20 bg-surface-container-highest"
                            id="remember"
                            name="remember"
                            type="checkbox" />
                        <label class="text-sm font-medium text-secondary cursor-pointer" for="remember">Remember me</label>
                    </div>

                    <div class="pt-4">
                        <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg hover:bg-blue-800 hover:shadow-xl active:scale-[0.98] transition-all duration-200 flex justify-center items-center gap-2" type="submit">
                            Login
                            <span class="material-symbols-outlined text-[20px]" data-icon="arrow_forward">arrow_forward</span>
                        </button>
                    </div>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-secondary text-sm">
                        New here? <a class="text-primary font-extrabold hover:underline" href="{{ route('register') }}">Create Account</a>
                    </p>
                    <p class="text-secondary text-sm">
                        <a class="text-primary font-extrabold hover:underline" href="{{ route('welcome') }}">Home</a>
                    </p>
                </div>

            </div>
        </div>
    </main>

    <footer class="bg-slate-50 w-full py-12 px-8 mt-auto border-t border-gray-200">
        <div class="flex flex-col md:flex-row justify-between items-center w-full max-w-7xl mx-auto space-y-4 md:space-y-0">
            <div class="font-manrope font-bold text-blue-900">
                Allo Maalem
            </div>
            <p class="text-secondary text-sm">
                <a class="text-primary font-extrabold hover:underline" href="{{ route('welcome') }}">Home</a>
            </p>
            <div class="font-inter text-sm text-slate-500">
                © {{ date('Y') }} Allo Maalem. The Architectural Concierge.
            </div>
        </div>
    </footer>

    <script>
        function togglePassword() {
            var input = document.getElementById('password');
            var icon = document.getElementById('eye-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.innerText = 'visibility_off';
            } else {
                input.type = 'password';
                icon.innerText = 'visibility';
            }
        }
    </script>
</body>
</html>
