<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>My Jobs - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-fixed": "#ffdbce",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-surface": "#191c1e",
                        "inverse-primary": "#b8c4ff",
                        "tertiary": "#611e00",
                        "primary-container": "#1e40af",
                        "secondary": "#515f74",
                        "surface-container": "#eceef0",
                        "surface-variant": "#e0e3e5",
                        "on-tertiary-container": "#ffa583",
                        "on-primary-fixed-variant": "#173bab",
                        "on-error": "#ffffff",
                        "secondary-fixed": "#d5e3fc",
                        "on-background": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "outline": "#757684",
                        "error-container": "#ffdad6",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-surface-variant": "#444653",
                        "on-primary-fixed": "#001453",
                        "secondary-container": "#d5e3fc",
                        "on-error-container": "#93000a",
                        "primary": "#00288e",
                        "outline-variant": "#c4c5d5",
                        "surface": "#f7f9fb",
                        "surface-bright": "#f7f9fb",
                        "surface-container-high": "#e6e8ea",
                        "on-secondary-container": "#57657a",
                        "surface-dim": "#d8dadc",
                        "primary-fixed": "#dde1ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary": "#ffffff",
                        "inverse-surface": "#2d3133",
                        "tertiary-container": "#872d00",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed": "#380d00",
                        "surface-tint": "#3755c3",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-secondary-fixed-variant": "#3a485b",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-secondary": "#ffffff",
                        "error": "#ba1a1a",
                        "on-primary-container": "#a8b8ff",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#0d1c2e",
                        "background": "#f7f9fb"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1.5rem",
                        "full": "9999px"
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; min-height: max(884px, 100dvh); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .shadow-ambient { box-shadow: 0 20px 40px rgba(25, 28, 30, 0.06); }
        /* Hide scrollbar for tabs */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="text-on-surface antialiased">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto space-y-10 px-4 sm:px-6 lg:px-8 py-10 md:py-12 mb-20">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="space-y-1">
                <h1 class="text-4xl md:text-5xl font-extrabold font-headline tracking-tight text-on-surface">My Jobs</h1>
                <p class="text-lg font-medium text-secondary">
                    You have <span class="text-primary font-bold">{{ $counts['open'] }} active</span> job postings
                </p>
            </div>
            <a href="{{ route('client.jobs.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-primary text-on-primary rounded-xl font-bold tracking-wide shadow-ambient active:scale-95 transition-all duration-150 group">
                <span> + Post a New Job</span>
            </a>
        </header>

        <nav class="w-full border-b border-outline-variant/30 flex items-end gap-8 overflow-x-auto no-scrollbar">
            @php
                $tabs = [
                    'all'         => 'All Jobs',
                    'open'        => 'Open',
                    'in_progress' => 'In Progress',
                    'completed'   => 'Completed',
                ];
            @endphp

            @foreach($tabs as $key => $label)
                <a href="{{ route('client.jobs.index', ['tab' => $key]) }}"
                   class="pb-4 flex items-center gap-2 transition-colors whitespace-nowrap border-b-4
                          {{ $tab === $key ? 'text-primary border-primary font-bold' : 'border-transparent text-secondary font-semibold hover:text-primary hover:border-outline-variant/50' }}">
                    <span>{{ $label }}</span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-bold {{ $tab === $key ? 'bg-primary-fixed text-on-primary-fixed' : 'bg-surface-container-high text-secondary' }}">
                        {{ $counts[$key] }}
                    </span>
                </a>
            @endforeach
        </nav>

        @if($jobs->isEmpty())
            <section class="flex flex-col items-center justify-center py-24 px-4 text-center space-y-6">
                <div class="max-w-xs mx-auto space-y-2">
                    <h2 class="text-2xl font-extrabold font-headline text-on-surface">No jobs found</h2>
                    <p class="text-secondary font-medium">We couldn't find any job postings in this category. Start by creating one!</p>
                </div>
                <a href="{{ route('client.jobs.create') }}" class="px-8 py-4 bg-primary text-on-primary font-bold rounded-xl shadow-ambient hover:scale-105 active:scale-95 transition-all inline-block">
                    Post a Job
                </a>
            </section>
        @else
            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($jobs as $job)
                    @php
                        $categoryImages = [
                            1  => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=400&h=200&fit=crop',
                            2  => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=200&fit=crop',
                            3  => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=400&h=200&fit=crop',
                            4  => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=400&h=200&fit=crop',
                            5  => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=400&h=200&fit=crop',
                            6  => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=200&fit=crop',
                            7  => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=200&fit=crop',
                            8  => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=200&fit=crop',
                            9  => 'https://images.unsplash.com/photo-1631545806609-3b8e0b0b0b0b?w=400&h=200&fit=crop',
                            10 => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=400&h=200&fit=crop',
                        ];
                        $headerImage = $job->image
                            ? Storage::url($job->image)
                            : 'https://www.contentviewspro.com/wp-content/uploads/2017/07/default_image.png';

                        $badgeClass = match($job->status) {
                            'open'        => 'bg-green-100 text-green-800',
                            'in_progress' => 'bg-blue-100 text-blue-800',
                            'completed'   => 'bg-surface-variant text-on-surface-variant',
                            default       => 'bg-gray-100 text-gray-800',
                        };
                        $badgeLabel = match($job->status) {
                            'open'        => 'Open',
                            'in_progress' => 'In Progress',
                            'completed'   => 'Completed',
                            default       => $job->status,
                        };
                    @endphp

                    <div class="group bg-surface-container-lowest rounded-2xl overflow-hidden shadow-ambient hover:-translate-y-2 transition-all duration-300 flex flex-col border border-transparent hover:border-outline-variant/20">

                        <div class="relative h-48 w-full overflow-hidden shrink-0">
                            <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="{{ $headerImage }}" alt="{{ $job->title }}"/>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 {{ $badgeClass }} text-[10px] font-extrabold rounded-full uppercase tracking-widest shadow-sm">
                                    {{ $badgeLabel }}
                                </span>
                            </div>

                            @if($job->is_urgent)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-error-container text-on-error-container text-[10px] font-extrabold rounded-full flex items-center gap-1 shadow-sm uppercase tracking-widest">
                                        Urgent
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="p-6 flex-grow flex flex-col space-y-4">
                            <div>
                                <h3 class="text-xl font-bold font-headline text-on-surface truncate" title="{{ $job->title }}">{{ $job->title }}</h3>
                                <p class="text-secondary text-sm mt-1 line-clamp-2">{{ $job->description }}</p>
                            </div>

                            <div class="grid grid-cols-2 gap-y-3 gap-x-2 border-t border-surface-container-low pt-4 mt-auto">
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="text-xs font-medium truncate" title="{{ $job->city->name }}">{{ $job->city->name }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="text-xs font-medium truncate" title="{{ $job->category->name }}">{{ $job->category->name }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-xs font-bold text-primary truncate">{{ number_format($job->budget, 2) }} MAD</span>
                                </div>
                                <div class="flex items-center gap-1.5 text-secondary">
                                    <span class="text-xs font-medium truncate">{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 pb-6 pt-2 flex gap-3">
                            @if($job->status === 'open' || $job->status === 'in_progress')
                                <a href="{{ route('client.jobs.show', $job->id) }}" class="flex-grow py-3 bg-primary text-on-primary font-bold rounded-xl active:scale-95 transition-all text-center flex items-center justify-center">
                                    See Applications ({{ $job->applications->count() }})
                                </a>
                                @if($job->status === 'open')
                                    <a href="{{ route('client.jobs.edit', $job->id) }}" class="w-12 h-12 flex items-center justify-center border border-outline-variant/40 text-secondary rounded-xl hover:bg-surface-container-low transition-colors shrink-0" title="Edit Job">
                                        Edite
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('client.jobs.show', $job->id) }}" class="flex-grow py-3 bg-surface-container-high text-on-surface-variant font-bold rounded-xl hover:bg-surface-dim active:scale-95 transition-all text-center flex items-center justify-center">
                                    View Job History
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </section>

            <div class="mt-12 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif

    </main>
</body>
</html>
