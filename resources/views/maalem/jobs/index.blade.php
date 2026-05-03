<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Find Work - Allo Maalem</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed": "#001453",
                        "surface-container-high": "#e6e8ea",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-fixed-variant": "#802a00",
                        "outline": "#757684",
                        "on-tertiary-fixed": "#380d00",
                        "surface-tint": "#3755c3",
                        "on-tertiary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-secondary-container": "#57657a",
                        "surface-variant": "#e0e3e5",
                        "on-primary": "#ffffff",
                        "secondary-fixed-dim": "#b9c7df",
                        "primary-fixed-dim": "#b8c4ff",
                        "inverse-on-surface": "#eff1f3",
                        "surface": "#f7f9fb",
                        "on-primary-container": "#a8b8ff",
                        "tertiary-fixed-dim": "#ffb59a",
                        "background": "#f7f9fb",
                        "surface-container-lowest": "#ffffff",
                        "outline-variant": "#c4c5d5",
                        "inverse-primary": "#b8c4ff",
                        "tertiary-container": "#872d00",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-surface": "#191c1e",
                        "on-primary-fixed-variant": "#173bab",
                        "inverse-surface": "#2d3133",
                        "primary": "#00288e",
                        "surface-bright": "#f7f9fb",
                        "secondary": "#515f74",
                        "secondary-fixed": "#d5e3fc",
                        "on-background": "#191c1e",
                        "on-error-container": "#93000a",
                        "on-tertiary-container": "#ffa583",
                        "on-secondary-fixed-variant": "#3a485b",
                        "secondary-container": "#d5e3fc",
                        "tertiary": "#611e00",
                        "surface-container": "#eceef0",
                        "on-surface-variant": "#444653",
                        "on-secondary-fixed": "#0d1c2e",
                        "primary-container": "#1e40af",
                        "surface-dim": "#d8dadc",
                        "tertiary-fixed": "#ffdbce",
                        "primary-fixed": "#dde1ff",
                        "error": "#ba1a1a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "full": "9999px"
                    },
                    "fontFamily": {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                }
            }
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
<body class="bg-surface text-on-surface font-body">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-6 py-12 md:py-20">

        <header class="mb-12">
            <h1 class="text-4xl md:text-5xl font-headline font-extrabold tracking-tight text-primary mb-4">Find Work</h1>
            <p class="text-secondary text-lg md:text-xl font-medium max-w-2xl">Discover the best jobs in your city. Premium opportunities curated for top-tier professionals.</p>
        </header>

        <x-alert />

        <section class="mb-16">
            <div class="bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10">
                <form method="GET" action="{{ route('maalem.jobs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-secondary ml-1">City</label>
                        <div class="relative">
                            <select name="city_id" class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 text-on-surface focus:ring-2 focus:ring-primary appearance-none font-medium cursor-pointer">
                                <option value="">All Cities</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-secondary ml-1">Category</label>
                        <div class="relative">
                            <select name="category_id" class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 text-on-surface focus:ring-2 focus:ring-primary appearance-none font-medium cursor-pointer">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-widest text-secondary ml-1">Min Budget (MAD)</label>
                        <input name="budget" value="{{ request('budget') }}" class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 text-on-surface focus:ring-2 focus:ring-primary font-medium placeholder:text-outline-variant" placeholder="500" type="number"/>
                    </div>

                    <div class="flex flex-row gap-3">
                        <button type="submit" class="flex-1 bg-primary text-on-primary py-4 px-6 rounded-xl font-bold transition-all active:scale-95 hover:bg-primary-container shadow-lg shadow-primary/10">
                            Search
                        </button>
                        <a href="{{ route('maalem.jobs.index') }}" class="bg-surface-container-high text-on-surface-variant py-4 px-6 rounded-xl font-bold transition-all active:scale-95 hover:bg-surface-dim flex items-center justify-center">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </section>

        @if($jobs->isEmpty())
            <section class="flex flex-col items-center justify-center py-20 text-center">
                <h2 class="text-3xl font-headline font-bold text-on-surface mb-2">No jobs found</h2>
                <p class="text-secondary max-w-xs mx-auto">We couldn't find any work matching your current filters. Try adjusting your search criteria.</p>
                <a href="{{ route('maalem.jobs.index') }}" class="mt-8 text-primary font-bold hover:underline">Reset all filters</a>
            </section>
        @else
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($jobs as $job)
                    <div class="group bg-surface-container-lowest rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-[0_30px_60px_rgba(25,28,30,0.12)] border border-transparent hover:border-outline-variant/20 flex flex-col">

                        <div class="relative h-52 overflow-hidden shrink-0">
                            <img src="{{ $job->image ? Storage::url($job->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREO3tkIJnmJZcWmgLLR-z973QVHQ8zbwDGnw&s' }}"
                                 alt="{{ $job->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"/>

                            @if($job->is_urgent)
                                <div class="absolute top-4 left-4 bg-error text-on-error px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest shadow-lg">
                                    URGENT
                                </div>
                            @endif
                        </div>

                        <div class="p-6 space-y-4 flex-grow flex flex-col">
                            <h3 class="text-xl font-headline font-bold text-on-surface truncate leading-tight" title="{{ $job->title }}">{{ $job->title }}</h3>
                            <p class="text-secondary text-sm leading-relaxed line-clamp-2 flex-grow">{{ $job->description }}</p>

                            <div class="flex justify-between items-center pt-2">
                                <div class="flex items-center text-on-secondary-container gap-1.5 text-sm font-medium">
                                    {{ $job->city->name }}
                                </div>
                                <div class="text-tertiary-container font-extrabold text-lg">
                                    {{ number_format($job->budget, 2) }} MAD
                                </div>
                            </div>
                        </div>

                        <div class="px-6 pb-6 mt-auto">
                            <a href="{{ route('maalem.jobs.show', $job->id) }}" class="block w-full text-center bg-primary text-on-primary py-3.5 rounded-xl font-bold transition-all hover:bg-primary-container">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </section>

            <div class="mt-12">
                {{ $jobs->withQueryString()->links() }}
            </div>
        @endif

    </main>
</body>
</html>
