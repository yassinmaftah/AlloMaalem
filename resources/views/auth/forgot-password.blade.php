<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Forgot Password - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "inverse-primary": "#b8c4ff",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-error": "#ffffff",
                        "tertiary": "#611e00",
                        "surface-container": "#eceef0",
                        "surface-bright": "#f7f9fb",
                        "on-tertiary-container": "#ffa583",
                        "surface-variant": "#e0e3e5",
                        "surface": "#f7f9fb",
                        "tertiary-fixed": "#ffdbce",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "primary-fixed": "#dde1ff",
                        "primary": "#00288e",
                        "inverse-on-surface": "#eff1f3",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#872d00",
                        "surface-container-high": "#e6e8ea",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#001453",
                        "on-tertiary": "#ffffff",
                        "background": "#f7f9fb",
                        "secondary-fixed": "#d5e3fc",
                        "secondary-fixed-dim": "#b9c7df",
                        "outline-variant": "#c4c5d5",
                        "secondary": "#515f74",
                        "on-surface": "#191c1e",
                        "primary-container": "#1e40af",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-tertiary-fixed": "#380d00",
                        "surface-container-low": "#f2f4f6",
                        "on-error-container": "#93000a",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-secondary-container": "#57657a",
                        "outline": "#757684",
                        "surface-container-lowest": "#ffffff",
                        "secondary-container": "#d5e3fc",
                        "on-surface-variant": "#444653",
                        "error": "#ba1a1a",
                        "surface-dim": "#d8dadc",
                        "on-primary-fixed-variant": "#173bab",
                        "primary-fixed-dim": "#b8c4ff",
                        "surface-tint": "#3755c3",
                        "on-background": "#191c1e"
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
        }
        h1, h2, h3, .brand-font {
            font-family: 'Manrope', sans-serif;
        }
        .bg-blur-circle {
            filter: blur(80px);
            opacity: 0.15;
            position: absolute;
            z-index: 0;
            border-radius: 9999px;
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen flex items-center justify-center overflow-hidden relative">

    <div class="bg-blur-circle bg-primary w-[400px] h-[400px] -top-20 -left-20"></div>
    <div class="bg-blur-circle bg-primary-container w-[350px] h-[350px] -bottom-20 -right-20"></div>

    <main class="relative z-10 w-full max-w-md px-6">

        <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-8 h-20 bg-transparent backdrop-blur-sm">
            <a href="{{ route('welcome') }}" class="flex items-center gap-2 hover:opacity-75 transition-opacity">
                <span class="text-primary font-body text-sm font-semibold tracking-wide"> Back to Home</span>
            </a>
        </header>

        <div class="bg-surface-container-lowest rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] p-10 flex flex-col items-center border border-outline-variant/10">

            <div class="mb-10">
                <span class="brand-font text-2xl font-black text-primary tracking-tighter">Allo Maalem</span>
            </div>

            <div class="text-center mb-8">
                <h1 class="font-headline font-bold text-2xl text-on-surface mb-2">Forgot Password?</h1>
                <p class="font-body text-secondary text-sm leading-relaxed max-w-[280px] mx-auto">
                    Enter your email and we'll send you a 6-digit code.
                </p>
            </div>

            <form action="{{ route('password.send.code') }}" method="POST" class="w-full space-y-6">
                @csrf

                <x-alert />

                <div class="space-y-2">
                    <label class="font-label text-xs font-semibold text-secondary uppercase tracking-widest ml-1" for="email">Email Address</label>
                    <div class="relative group">
                        <input class="w-full px-4 py-3.5 bg-surface-container-highest rounded-xl text-on-surface placeholder:text-outline focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all duration-300 outline-none border @error('email') border-red-500 @else border-transparent @enderror"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="name@example.com"
                               type="email" />
                    </div>

                </div>

                <button type="submit" class="w-full bg-primary text-on-primary py-4 px-6 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-blue-800 shadow-lg shadow-primary/20 transition-all duration-300 active:scale-[0.98] group">
                    <span>Send Code</span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-outline-variant/10 w-full text-center">
                <p class="font-body text-sm text-secondary">
                    Remember your password?
                    <a class="text-primary font-bold hover:underline underline-offset-4 transition-all ml-1" href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>

        <footer class="mt-8 text-center">
            <p class="font-inter text-xs font-light text-slate-500">
                © {{ date('Y') }} Allo Maalem. The Architectural Concierge.
            </p>
        </footer>
    </main>

    <div class="absolute right-[5%] top-[15%] w-24 h-24 pointer-events-none opacity-20 hidden md:block">
        <div class="border-2 border-primary-fixed-dim rounded-full w-full h-full"></div>
    </div>
    <div class="absolute left-[8%] bottom-[20%] w-16 h-16 pointer-events-none opacity-20 hidden md:block">
        <div class="bg-tertiary-fixed rounded-xl rotate-45 w-full h-full"></div>
    </div>
</body>
</html>
