<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>My Reviews - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
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
        .star-fill {
            font-variation-settings: 'FILL' 1;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
            min-height: max(884px, 100dvh);
        }
        h1, h2, h3, h4 {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface">

    @include('navbars.maalemnav')

    <main class="pt-12 pb-32 px-6 max-w-7xl mx-auto">
        <header class="mb-12">
            <h2 class="font-headline text-4xl md:text-5xl font-extrabold text-on-surface tracking-tight mb-2">My Reviews</h2>
            <p class="font-headline text-secondary text-lg">See what clients are saying about your work.</p>
        </header>

        @if($reviews->isEmpty())
            <section class="flex flex-col items-center justify-center py-20 text-center bg-surface-container-lowest rounded-3xl border border-outline-variant/10 shadow-sm">
                <div class="w-24 h-24 bg-surface-container flex items-center justify-center rounded-full mb-6">
                    <span class="material-symbols-outlined text-outline text-5xl">star_half</span>
                </div>
                <h3 class="font-headline text-2xl font-bold text-on-surface mb-2">No reviews yet</h3>
                <p class="text-secondary max-w-sm">Complete your first service to start building your professional reputation on Allo Maalem.</p>
            </section>
        @else
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($reviews as $review)
                    <article class="bg-surface-container-lowest p-6 rounded-2xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] hover:translate-y-[-4px] transition-transform duration-300 border border-outline-variant/10 flex flex-col">

                        <div class="flex items-center gap-4 mb-6">
                            <img src="{{ $review->reviewer->avatar ? Storage::url($review->reviewer->avatar) : 'https://t3.ftcdn.net/jpg/07/24/59/76/360_F_724597608_pmo5BsVumFcFyHJKlASG2Y2KpkkfiYUU.jpg' }}"
                                 alt="Avatar"
                                 class="w-12 h-12 rounded-full object-cover ring-2 ring-primary/5"/>
                            <div>
                                <h4 class="font-bold text-on-surface">{{ $review->reviewer->name }}</h4>
                                <p class="text-secondary text-xs truncate max-w-[200px]" title="{{ $review->job->title }}">{{ $review->job->title }}</p>
                            </div>
                        </div>

                        <div class="flex gap-0.5 mb-4">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $review->rating)
                                    <span class="material-symbols-outlined star-fill text-sm text-[#ffb59a]">star</span>
                                @else
                                    <span class="material-symbols-outlined text-sm text-outline-variant">star</span>
                                @endif
                            @endfor
                        </div>

                        <div class="bg-slate-100/50 p-5 rounded-xl border border-slate-200/20 flex-grow">
                            <p class="italic text-on-surface-variant font-body leading-relaxed text-sm">
                                {{ $review->comment }}
                            </p>
                        </div>

                        <div class="mt-4 text-outline text-[10px] uppercase font-bold tracking-widest text-right">
                            {{ $review->created_at->diffForHumans() }}
                        </div>
                    </article>
                @endforeach
            </section>
        @endif
    </main>

</body>
</html>
