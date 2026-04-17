<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Maalem Dashboard - Allo Maalem</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-primary-fixed": "#001453",
                        "secondary-fixed": "#d5e3fc",
                        "primary": "#00288e",
                        "on-tertiary-fixed": "#380d00",
                        "on-secondary-fixed": "#0d1c2e",
                        "tertiary-fixed": "#ffdbce",
                        "primary-fixed": "#dde1ff",
                        "error-container": "#ffdad6",
                        "surface-container-highest": "#e0e3e5",
                        "secondary-container": "#d5e3fc",
                        "surface-bright": "#f7f9fb",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-primary-container": "#a8b8ff",
                        "secondary": "#515f74",
                        "on-surface": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "surface-dim": "#d8dadc",
                        "on-secondary": "#ffffff",
                        "on-surface-variant": "#444653",
                        "primary-container": "#1e40af",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "surface-variant": "#e0e3e5",
                        "surface": "#f7f9fb",
                        "surface-tint": "#3755c3",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-container": "#ffa583",
                        "inverse-primary": "#b8c4ff",
                        "secondary-fixed-dim": "#b9c7df",
                        "tertiary-container": "#872d00",
                        "on-primary-fixed-variant": "#173bab",
                        "outline-variant": "#c4c5d5",
                        "surface-container-low": "#f2f4f6",
                        "inverse-surface": "#2d3133",
                        "background": "#f7f9fb",
                        "outline": "#757684",
                        "on-tertiary": "#ffffff",
                        "on-background": "#191c1e",
                        "on-secondary-container": "#57657a",
                        "surface-container-lowest": "#ffffff",
                        "surface-container": "#eceef0",
                        "primary-fixed-dim": "#b8c4ff",
                        "tertiary": "#611e00",
                        "on-error": "#ffffff"
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
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-6 py-12 md:py-16 space-y-12">

        <section class="relative overflow-hidden rounded-3xl bg-primary-container p-8 md:p-12 shadow-[0_20px_40px_rgba(25,28,30,0.06)]">
            <div class="absolute inset-0 opacity-20 pointer-events-none bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/40 via-transparent to-transparent"></div>
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-blue-400/20 blur-3xl rounded-full"></div>
            <div class="absolute -left-10 -bottom-10 w-60 h-60 bg-blue-900/40 blur-3xl rounded-full"></div>

            <div class="relative z-10">
                <h1 class="font-headline font-extrabold text-4xl md:text-5xl text-on-primary tracking-tighter mb-4">
                    Hello Maalem, {{ Auth::user()->name }}!
                </h1>
                <p class="font-body text-on-primary/80 text-lg md:text-xl max-w-xl font-light">
                    Here is what is happening with your business today. Your professional expertise is in high demand.
                </p>
            </div>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-surface-container-lowest rounded-2xl p-8 border border-outline-variant/10 shadow-[0_10px_30px_rgba(0,0,0,0.03)] flex flex-col items-start transition-all duration-300 hover:shadow-[0_20px_40px_rgba(25,28,30,0.06)] group">
                <p class="font-label text-sm text-secondary font-medium mb-1">Pending Applications</p>
                <h2 class="font-headline font-extrabold text-4xl text-on-surface">{{ $pendingApplications }}</h2>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl p-8 border border-outline-variant/10 shadow-[0_10px_30px_rgba(0,0,0,0.03)] flex flex-col items-start transition-all duration-300 hover:shadow-[0_20px_40px_rgba(25,28,30,0.06)] group">
                <p class="font-label text-sm text-secondary font-medium mb-1">Active Jobs</p>
                <h2 class="font-headline font-extrabold text-4xl text-on-surface">{{ $activeJobs }}</h2>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl p-8 border border-outline-variant/10 shadow-[0_10px_30px_rgba(0,0,0,0.03)] flex flex-col items-start transition-all duration-300 hover:shadow-[0_20px_40px_rgba(25,28,30,0.06)] group">

                <p class="font-label text-sm text-secondary font-medium mb-1">Average Rating</p>
                <div class="flex items-baseline gap-2">
                    <h2 class="font-headline font-extrabold text-4xl text-on-surface">{{ $averageRating ? number_format($averageRating, 1) : 'empty' }}</h2>
                    @if($averageRating)
                        <span class="text-secondary/60 font-medium">/ 5.0</span>
                    @endif
                </div>
            </div>

        </section>

    </main>
</body>
</html>
