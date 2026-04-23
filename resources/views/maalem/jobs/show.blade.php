<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $job->title }} - Allo Maalem</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#ffa583",
                        "outline-variant": "#c4c5d5",
                        "surface-dim": "#d8dadc",
                        "secondary-container": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "surface": "#f7f9fb",
                        "primary-container": "#1e40af",
                        "on-primary-fixed": "#001453",
                        "surface-variant": "#e0e3e5",
                        "primary-fixed-dim": "#b8c4ff",
                        "outline": "#757684",
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#191c1e",
                        "inverse-primary": "#b8c4ff",
                        "inverse-on-surface": "#eff1f3",
                        "background": "#f7f9fb",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-primary-fixed-variant": "#173bab",
                        "primary-fixed": "#dde1ff",
                        "tertiary": "#611e00",
                        "on-tertiary-fixed": "#380d00",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-high": "#e6e8ea",
                        "surface-container": "#eceef0",
                        "primary": "#00288e",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#d5e3fc",
                        "error-container": "#ffdad6",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-surface-variant": "#444653",
                        "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-surface": "#191c1e",
                        "tertiary-container": "#872d00",
                        "tertiary-fixed": "#ffdbce",
                        "on-secondary-container": "#57657a",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-error-container": "#93000a",
                        "secondary-fixed-dim": "#b9c7df",
                        "secondary": "#515f74",
                        "on-tertiary-fixed-variant": "#802a00",
                        "surface-bright": "#f7f9fb",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#3755c3"
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .editorial-shadow {
            box-shadow: 0 20px 40px rgba(25, 28, 30, 0.06);
        }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <nav class="mb-8">
            <a class="inline-flex items-center text-primary font-semibold font-headline transition-transform active:scale-95 group" href="{{ route('maalem.jobs.index') }}">
                <- Back to Available Jobs
            </a>
        </nav>

        <x-alert />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-surface-container-lowest rounded-2xl editorial-shadow overflow-hidden">
                    <div class="p-8 md:p-10">

                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-headline font-extrabold text-on-surface tracking-tight mb-4">
                                    {{ $job->title }}
                                </h1>
                                <div class="flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-secondary-container text-on-secondary-fixed-variant text-xs font-bold uppercase tracking-wider">
                                        {{ $job->city->name }}
                                    </span>
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-secondary-container text-on-secondary-fixed-variant text-xs font-bold uppercase tracking-wider">
                                        {{ $job->category->name }}
                                    </span>
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-surface-container-high text-on-surface-variant text-xs font-semibold">
                                        Posted by: {{ $job->user->name }}
                                    </span>
                                </div>
                            </div>

                            @if($job->is_urgent)
                                <div class="shrink-0">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-xl bg-error-container text-error font-bold font-headline text-sm border border-error/10">
                                        URGENT
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="prose prose-slate max-w-none mb-10">
                            <h3 class="text-xl font-headline font-bold text-primary mb-4">Project Overview</h3>
                            <p class="text-on-surface-variant leading-relaxed whitespace-pre-wrap">{{ $job->description }}</p>
                        </div>

                        @if($job->image)
                            <div class="relative group mt-8">
                                <img class="w-full h-80 object-cover rounded-xl editorial-shadow" src="{{ Storage::url($job->image) }}" alt="{{ $job->title }}"/>
                                <div class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-surface-container-lowest rounded-2xl editorial-shadow overflow-hidden">
                    <div class="p-8">

                        <div class="mb-8 p-6 bg-primary-fixed rounded-xl border border-primary/10">
                            <p class="text-on-primary-fixed-variant font-headline font-bold text-sm uppercase tracking-wider mb-1">Estimated Budget</p>
                            <div class="flex items-center text-primary">
                                <span class="text-3xl font-headline font-extrabold tracking-tight">{{ number_format($job->budget, 2) }} MAD</span>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <h2 class="text-2xl font-headline font-bold text-on-surface">Apply for this Job</h2>

                            @if($job->status !== 'open')
                                <div class="bg-surface-container-high p-4 rounded-xl flex items-start border border-outline-variant/30">
                                    <p class="text-on-surface-variant font-semibold text-sm">This job is no longer accepting applications.</p>
                                </div>
                            @elseif($alreadyApplied)
                                <div class="bg-[#fefce8] border-l-4 border-yellow-400 p-4 rounded-xl flex items-start shadow-sm">
                                    <p class="text-yellow-800 font-semibold text-sm">You have already applied for this job.</p>
                                </div>
                            @else
                                <form method="POST" action="{{ route('maalem.jobs.apply', $job->id) }}" class="space-y-4">
                                    @csrf

                                    <div>
                                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Proposed Price (MAD)</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <span class="text-outline font-medium">MAD</span>
                                            </div>
                                            <input type="number" name="proposed_price" step="0.01" min="0" value="{{ old('proposed_price') }}"
                                                   class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all rounded-t-lg pl-14 py-4 text-on-surface font-semibold placeholder:text-outline-variant @error('proposed_price') border-error bg-error-container/10 @enderror" placeholder="0.00"/>
                                        </div>

                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Message to Client</label>
                                        <textarea name="message" rows="5"
                                                  class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all rounded-t-lg p-4 text-on-surface placeholder:text-outline-variant resize-none @error('message') border-error bg-error-container/10 @enderror" placeholder="Describe your experience with similar projects...">{{ old('message') }}</textarea>

                                    </div>

                                    <button type="submit" class="w-full py-4 mt-2 bg-primary text-on-primary rounded-xl font-headline font-extrabold text-lg shadow-xl shadow-primary/20 hover:bg-primary-container active:scale-[0.98] transition-all flex items-center justify-center group">
                                        Submit Application
                                    </button>
                                </form>
                            @endif

                            <div class="pt-6 mt-6 border-t border-surface-container-high">
                                <div class="flex items-start gap-3 text-on-surface-variant text-xs">
                                    <p>Your information is secured. Allo Maalem never shares your contact details before an application is accepted.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
