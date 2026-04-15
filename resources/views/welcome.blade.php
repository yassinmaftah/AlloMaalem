<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Allo Maalem - The Architectural Concierge</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "surface-bright": "#f7f9fb",
                        "surface": "#f7f9fb",
                        "on-tertiary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-primary-fixed": "#001453",
                        "tertiary-container": "#872d00",
                        "on-tertiary-fixed": "#380d00",
                        "on-surface": "#191c1e",
                        "secondary": "#515f74",
                        "secondary-fixed": "#d5e3fc",
                        "inverse-on-surface": "#eff1f3",
                        "tertiary-fixed": "#ffdbce",
                        "surface-container": "#eceef0",
                        "inverse-surface": "#2d3133",
                        "on-error-container": "#93000a",
                        "primary-container": "#1e40af",
                        "surface-variant": "#e0e3e5",
                        "on-primary-fixed-variant": "#173bab",
                        "outline-variant": "#c4c5d5",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dde1ff",
                        "on-surface-variant": "#444653",
                        "background": "#f7f9fb",
                        "secondary-container": "#d5e3fc",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#611e00",
                        "primary-fixed-dim": "#b8c4ff",
                        "primary": "#00288e",
                        "on-tertiary-container": "#ffa583",
                        "surface-tint": "#3755c3",
                        "on-background": "#191c1e",
                        "outline": "#757684",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-high": "#e6e8ea",
                        "on-secondary-container": "#57657a",
                        "surface-container-highest": "#e0e3e5",
                        "on-error": "#ffffff",
                        "inverse-primary": "#b8c4ff",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-secondary-fixed-variant": "#3a485b",
                        "surface-dim": "#d8dadc",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-secondary": "#ffffff"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
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
        .tonal-shift {
            background-color: #f7f9fb;
        }
        .glass-header {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">
 
    <header class="sticky top-0 w-full z-50 glass-header shadow-sm dark:shadow-none">
        <div class="flex justify-between items-center px-8 py-4 max-w-7xl mx-auto">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-blue-800 dark:text-blue-400 text-3xl" data-icon="architecture">architecture</span>
                <span class="font-manrope font-extrabold text-blue-900 dark:text-blue-100 tracking-tighter text-2xl">Allo Maalem</span>
            </div>
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-blue-800 dark:text-blue-300 font-bold border-b-2 border-blue-800 py-1 transition-colors" href="#"></a>
            </nav>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 font-bold text-on-primary bg-primary bg-gradient-to-br from-primary to-primary-container rounded-xl shadow-md hover:scale-95 duration-200 transition-transform">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2 font-medium text-primary outline outline-1 outline-blue-800/40 rounded-lg hover:bg-surface-container-low transition-all">Login</a>
                    <a href="{{ route('register') }}" class="px-6 py-2.5 font-bold text-on-primary bg-primary bg-gradient-to-br from-primary to-primary-container rounded-xl shadow-md hover:scale-95 duration-200 transition-transform">Sign Up</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        <section class="relative overflow-hidden pt-16 pb-24 md:pt-24 md:pb-32 px-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="z-10">
                    <h1 class="font-headline font-extrabold text-5xl md:text-6xl lg:text-7xl text-on-surface tracking-tight leading-[1.1] mb-6">
                        Find the Best Local <span class="text-primary">Professionals</span> for Any Job
                    </h1>
                    <p class="text-lg md:text-xl text-secondary mb-10 max-w-xl leading-relaxed">
                        The architectural concierge for your home. Connect with vetted craftsmen, track your projects, and experience premium service tailored to your needs.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-primary text-on-primary font-bold rounded-xl shadow-lg hover:bg-blue-700 transition-all text-center">Hire a Maalem</a>
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-surface-container-lowest text-primary font-bold rounded-xl outline outline-2 outline-primary/10 hover:bg-surface-container-low transition-all text-center">Become a Maalem</a>
                    </div>
                </div>
                <div class="relative hidden lg:block">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl rotate-2 hover:rotate-0 transition-transform duration-500 bg-gray-200">
                        <img alt="Professional working" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1581141849291-1125c7b692b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"/>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-surface-container-lowest p-6 rounded-2xl shadow-xl max-w-xs hidden md:block">
                        <div class="flex items-center gap-4 mb-2">
                            <span class="material-symbols-outlined text-green-600" data-icon="verified" style="font-variation-settings: 'FILL' 1;">verified</span>
                            <span class="font-bold text-on-surface">Vetted Expertise</span>
                        </div>
                        <p class="text-sm text-secondary">Every professional on our platform undergoes a rigorous 5-step verification process.</p>
                    </div>
                </div>
            </div>
            <div class="absolute top-0 right-0 -z-10 w-1/2 h-full bg-gradient-to-l from-primary-fixed/30 to-transparent opacity-50 blur-3xl"></div>
        </section>

        <section class="py-24 bg-surface-container-low px-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-16">
                    <h2 class="font-headline font-bold text-3xl md:text-4xl text-on-surface mb-4">How It Works</h2>
                    <div class="h-1.5 w-20 bg-primary rounded-full"></div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="group">
                        <div class="w-16 h-16 bg-surface-container-lowest rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="material-symbols-outlined text-primary text-3xl" data-icon="post_add">post_add</span>
                        </div>
                        <h3 class="font-headline font-bold text-xl mb-3">1. Post a Job</h3>
                        <p class="text-secondary leading-relaxed">Tell us what you need. From plumbing to full renovations, describe your project and set your budget.</p>
                    </div>
                    <div class="group">
                        <div class="w-16 h-16 bg-surface-container-lowest rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="material-symbols-outlined text-primary text-3xl" data-icon="compare_arrows">compare_arrows</span>
                        </div>
                        <h3 class="font-headline font-bold text-xl mb-3">2. Compare Offers</h3>
                        <p class="text-secondary leading-relaxed">Receive quotes from qualified local professionals. Review their portfolios, ratings, and choose the best fit.</p>
                    </div>
                    <div class="group">
                        <div class="w-16 h-16 bg-surface-container-lowest rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:shadow-md transition-shadow">
                            <span class="material-symbols-outlined text-primary text-3xl" data-icon="task_alt">task_alt</span>
                        </div>
                        <h3 class="font-headline font-bold text-xl mb-3">3. Get it Done</h3>
                        <p class="text-secondary leading-relaxed">Hire your pro with confidence. Pay securely through our platform only when the job is completed.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 px-8">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                <div>
                    <h2 class="font-headline font-bold text-3xl md:text-4xl text-on-surface mb-4">Popular Categories</h2>
                    <p class="text-secondary">Discover our most requested specialized services.</p>
                </div>
            </div>
            <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="group bg-surface-container-lowest p-8 rounded-2xl border border-transparent hover:border-blue-200 transition-all cursor-pointer shadow-sm hover:shadow-xl">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl" data-icon="plumbing">plumbing</span>
                    </div>
                    <h4 class="font-headline font-bold text-xl mb-2">Plumber</h4>
                    <p class="text-sm text-secondary mb-4">Leaking pipes, installations, and emergency repairs.</p>
                </div>
                <div class="group bg-surface-container-lowest p-8 rounded-2xl border border-transparent hover:border-blue-200 transition-all cursor-pointer shadow-sm hover:shadow-xl">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl" data-icon="electrical_services">electrical_services</span>
                    </div>
                    <h4 class="font-headline font-bold text-xl mb-2">Electrician</h4>
                    <p class="text-sm text-secondary mb-4">Wiring, lighting, and circuit board maintenance.</p>
                </div>
                <div class="group bg-surface-container-lowest p-8 rounded-2xl border border-transparent hover:border-blue-200 transition-all cursor-pointer shadow-sm hover:shadow-xl">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl" data-icon="carpenter">carpenter</span>
                    </div>
                    <h4 class="font-headline font-bold text-xl mb-2">Carpenter</h4>
                    <p class="text-sm text-secondary mb-4">Custom furniture, flooring, and structural woodwork.</p>
                </div>
                <div class="group bg-surface-container-lowest p-8 rounded-2xl border border-transparent hover:border-blue-200 transition-all cursor-pointer shadow-sm hover:shadow-xl">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mb-6 text-primary group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-2xl" data-icon="format_paint">format_paint</span>
                    </div>
                    <h4 class="font-headline font-bold text-xl mb-2">Painter</h4>
                    <p class="text-sm text-secondary mb-4">Interior, exterior painting and decorative finishes.</p>
                </div>
            </div>
        </section>

        <section class="py-24 px-8">
            <div class="max-w-7xl mx-auto bg-primary rounded-[2rem] p-12 md:p-20 relative overflow-hidden text-center md:text-left">
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 items-center gap-12">
                    <div>
                        <h2 class="font-headline font-bold text-4xl md:text-5xl text-on-primary mb-6 leading-tight">Ready to start your next home project?</h2>
                        <p class="text-on-primary/80 text-lg mb-10 max-w-lg">Join thousands of homeowners who trust Allo Maalem for their architectural and maintenance needs.</p>
                        <a href="{{ route('register') }}" class="inline-block px-10 py-5 bg-on-primary text-primary font-extrabold rounded-2xl shadow-2xl hover:scale-105 transition-transform">Book a Maalem Now</a>
                    </div>
                </div>
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-container/20 rounded-full translate-y-1/2 -translate-x-1/2 blur-3xl"></div>
            </div>
        </section>
    </main>

    <footer class="bg-slate-950 w-full py-12 px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center max-w-7xl mx-auto">
            <div>
                <div class="font-manrope font-black text-white text-xl uppercase tracking-widest mb-4">Allo Maalem</div>
                <p class="text-slate-400 font-inter text-sm tracking-wide max-w-xs">
                    Elevating service standards through architectural precision and professional integrity.
                </p>
            </div>
            <div class="md:col-span-2 pt-12 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-400 font-inter text-sm tracking-wide">© {{ date('Y') }} Allo Maalem. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
