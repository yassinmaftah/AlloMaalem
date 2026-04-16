<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Client Dashboard - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "error-container": "#ffdad6",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "tertiary-fixed": "#ffdbce",
                        "inverse-surface": "#2d3133",
                        "on-tertiary-fixed-variant": "#802a00",
                        "tertiary-container": "#872d00",
                        "primary-fixed-dim": "#b8c4ff",
                        "inverse-primary": "#b8c4ff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-primary-fixed": "#001453",
                        "surface-bright": "#f7f9fb",
                        "surface-variant": "#e0e3e5",
                        "outline": "#757684",
                        "on-tertiary-container": "#ffa583",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container-high": "#e6e8ea",
                        "inverse-on-surface": "#eff1f3",
                        "surface-dim": "#d8dadc",
                        "on-surface-variant": "#444653",
                        "surface-container": "#eceef0",
                        "background": "#f7f9fb",
                        "outline-variant": "#c4c5d5",
                        "on-surface": "#191c1e",
                        "secondary": "#515f74",
                        "on-secondary-fixed": "#0d1c2e",
                        "surface-container-low": "#f2f4f6",
                        "on-background": "#191c1e",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-tertiary-fixed": "#380d00",
                        "secondary-container": "#d5e3fc",
                        "on-secondary-container": "#57657a",
                        "secondary-fixed": "#d5e3fc",
                        "on-primary": "#ffffff",
                        "primary-fixed": "#dde1ff",
                        "surface-container-highest": "#e0e3e5",
                        "surface": "#f7f9fb",
                        "on-primary-fixed-variant": "#173bab",
                        "surface-tint": "#3755c3",
                        "surface-container-lowest": "#ffffff",
                        "on-primary-container": "#a8b8ff",
                        "primary": "#00288e",
                        "secondary-fixed-dim": "#b9c7df",
                        "primary-container": "#1e40af",
                        "tertiary": "#611e00",
                        "on-error": "#ffffff"
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "2xl": "1rem",
                        "3xl": "1.5rem",
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
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .bg-abstract-pattern {
            background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
            background-size: 24px 24px;
        }
        body { min-height: max(884px, 100dvh); }
    </style>
</head>
<body class="bg-background font-body text-on-surface antialiased">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto space-y-10 p-6 md:p-12 mb-20">

        <section class="relative overflow-hidden bg-gradient-to-r from-[#1E40AF] to-blue-600 rounded-3xl p-8 md:p-14 text-white shadow-2xl shadow-primary/20">
            <div class="absolute inset-0 bg-abstract-pattern opacity-40"></div>
            <div class="absolute -right-20 -top-20 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-primary-container/30 rounded-full blur-2xl"></div>
            <div class="relative z-10 max-w-2xl">
                <h1 class="font-headline text-4xl md:text-5xl font-extrabold tracking-tight mb-4">
                    Welcome back, {{ Auth::user()->name }}!
                </h1>
                <p class="text-blue-100 text-lg md:text-xl font-medium leading-relaxed opacity-90">
                    Manage your projects and find the perfect Maalem for your next job. Your architectural concierge for home services is ready.
                </p>
            </div>
        </section>

        <section class="flex flex-col sm:flex-row gap-4 items-center">
            <a href="{{ route('client.jobs.create') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-primary hover:bg-primary-container text-white px-8 py-4 rounded-xl font-headline font-bold transition-all active:scale-95 shadow-lg shadow-primary/10">
                Post a New Job
            </a>
            <a href="{{ route('client.jobs.index') }}" class="w-full sm:w-auto flex items-center justify-center gap-2 bg-surface-container-high hover:bg-surface-variant text-on-surface-variant px-8 py-4 rounded-xl font-headline font-bold transition-all active:scale-95">
                View My Jobs
            </a>
        </section>

        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 flex items-center gap-5 transition-all hover:shadow-xl hover:shadow-blue-900/5 group">
                <div>
                    <p class="text-secondary font-medium text-sm tracking-wide uppercase">Total Jobs Posted</p>
                    <p class="font-headline text-3xl font-extrabold text-on-surface">{{ $totalJobs ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 flex items-center gap-5 transition-all hover:shadow-xl hover:shadow-amber-900/5 group">
                <div>
                    <p class="text-secondary font-medium text-sm tracking-wide uppercase">Active Jobs</p>
                    <p class="font-headline text-3xl font-extrabold text-on-surface">{{ $activeJobs ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/30 flex items-center gap-5 transition-all hover:shadow-xl hover:shadow-emerald-900/5 group">
                <div>
                    <p class="text-secondary font-medium text-sm tracking-wide uppercase">Completed Jobs</p>
                    <p class="font-headline text-3xl font-extrabold text-on-surface">{{ $completedJobs ?? 0 }}</p>
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="font-headline text-2xl font-bold text-primary">Ongoing Projects</h2>
                    <a href="{{ route('client.jobs.index') }}" class="text-primary font-semibold text-sm hover:underline">View all</a>
                </div>

                @if(isset($ongoingJobs) && $ongoingJobs->count() > 0)
                    @foreach($ongoingJobs as $job)
                        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/15 flex flex-col md:flex-row gap-6 items-start md:items-center hover:shadow-md transition-shadow">
                            @if($job->image)
                                <div class="w-full md:w-48 h-32 rounded-xl overflow-hidden shrink-0">
                                    <img src="{{ Storage::url($job->image) }}" class="w-full h-full object-cover" alt="{{ $job->title }}"/>
                                </div>
                            @endif
                            <div class="flex-grow w-full">
                                <div class="flex justify-between items-start mb-2 gap-2">
                                    <h3 class="font-headline text-xl font-bold text-on-surface truncate"><a href="{{ route('client.jobs.show', $job->id) }}" class="hover:text-primary transition-colors">{{ $job->title }}</a></h3>
                                    @if($job->status === 'in_progress')
                                        <span class="px-3 py-1 bg-amber-50 text-amber-700 text-[10px] font-bold rounded-full border border-amber-200 whitespace-nowrap">IN PROGRESS</span>
                                    @else
                                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-[10px] font-bold rounded-full border border-blue-200 whitespace-nowrap">OPEN</span>
                                    @endif
                                </div>
                                <p class="text-secondary text-sm mb-4 line-clamp-2">{{ $job->description }}</p>
                                <div class="flex items-center gap-4 text-xs font-semibold text-on-surface-variant">
                                    <span class="flex items-center gap-1">Date : {{ $job->created_at->format('M d, Y') }}</span>
                                    <span class="flex items-center gap-1">location on : {{ $job->city->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="bg-surface-container-lowest p-8 rounded-2xl border border-outline-variant/15 text-center">
                        <p class="text-secondary font-medium">You don't have any ongoing projects right now.</p>
                        <a href="{{ route('client.jobs.create') }}" class="text-primary font-bold hover:underline mt-2 inline-block">Post a job to get started</a>
                    </div>
                @endif
            </div>

            {{-- <div class="space-y-6">
                <h2 class="font-headline text-2xl font-bold text-primary">Top Rated Maalems</h2> --}}

                {{-- <div class="space-y-4">
                    @if(isset($topMaalems) && $topMaalems->count() > 0)
                        @foreach($topMaalems as $maalem)
                            <div class="bg-surface-container-lowest p-5 rounded-2xl border border-outline-variant/15 transition-transform hover:-translate-y-1">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-14 h-14 rounded-full overflow-hidden border-2 border-primary/20 shrink-0">
                                        <img src="{{ $maalem->avatar ? Storage::url($maalem->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($maalem->name).'&background=00288e&color=fff' }}" class="w-full h-full object-cover" alt="Maalem Portrait"/>
                                    </div>
                                    <div>
                                        <h4 class="font-headline font-bold text-on-surface truncate w-32">{{ $maalem->name }}</h4>
                                        <p class="text-xs text-secondary flex items-center gap-1 mt-0.5">
                                            <span class="material-symbols-outlined text-amber-500 text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                            {{ number_format($maalem->reviews_avg_rating ?? 0, 1) }} ({{ $maalem->reviews_count ?? 0 }} reviews)
                                        </p>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="bg-surface-container-high px-2 py-1 rounded text-[10px] font-bold text-secondary uppercase">Professional</span>
                                </div>
                                <a href="{{ route('client.jobs.create') }}" class="block text-center w-full py-2.5 rounded-lg border border-primary text-primary font-headline font-bold text-sm hover:bg-primary hover:text-white transition-colors">
                                    Invite to Job
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-outline-variant/15 text-center">
                            <p class="text-secondary text-sm">Post a job to start seeing professional Maalems in your area.</p>
                        </div>
                    @endif
                </div> --}}

                {{-- <div class="bg-tertiary-container text-white p-6 rounded-2xl flex flex-col items-center text-center shadow-lg">
                    <span class="material-symbols-outlined text-4xl mb-3" style="font-variation-settings: 'FILL' 1;">support_agent</span>
                    <h4 class="font-headline font-bold text-lg mb-1">Need help?</h4>
                    <p class="text-tertiary-fixed text-xs mb-4 leading-relaxed">Our support team is available 24/7 to assist you with your projects.</p>
                    <a href="mailto:support@allomaalem.com" class="bg-white text-tertiary px-6 py-2 rounded-lg font-bold text-sm hover:bg-gray-100 transition-colors">Contact Support</a>
                </div> --}}
            </div>

        </div>
    </main>
</body>
</html>
