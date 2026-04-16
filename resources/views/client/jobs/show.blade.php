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
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; min-height: max(884px, 100dvh); }
        h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 mb-20">

        @if(session('success'))
            <div class="bg-[#e8f5e9] border border-[#c8e6c9] text-[#2e7d32] px-4 py-4 rounded-xl mb-8 flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined">check_circle</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-error-container border border-error/20 text-on-error-container px-4 py-4 rounded-xl mb-8 flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined">error</span>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
            <a href="{{ route('client.jobs.index') }}" class="flex items-center gap-2 group cursor-pointer w-max">
                <span class="font-headline font-bold text-primary"><- Back to My Jobs</span>
            </a>

            <div class="flex flex-wrap items-center gap-3">
                @if ($job->status === 'open')
                    <a href="{{ route('client.jobs.edit', $job->id) }}" class="px-5 py-2.5 rounded-xl border border-outline-variant text-on-surface-variant font-semibold hover:bg-surface-container-low transition-colors text-sm md:text-base">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('client.jobs.destroy', $job->id) }}" id="delete-form" class="m-0">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete()" class="px-5 py-2.5 rounded-xl border border-error text-error font-semibold hover:bg-error-container transition-colors text-sm md:text-base">
                            Delete
                        </button>
                    </form>
                @endif
                @if ($job->status === 'in_progress')
                    <form method="POST" action="{{ route('client.jobs.complete', $job->id) }}" class="m-0">
                        @csrf
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-primary text-white font-bold shadow-md hover:bg-primary-container active:scale-95 transition-all text-sm md:text-base">
                            Mark as Completed
                        </button>
                    </form>
                @endif
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 xl:gap-12">

            <section class="lg:col-span-2 space-y-8">

                <article class="bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_20px_40px_rgba(25,28,30,0.04)] overflow-hidden border border-outline-variant/10">

                    <div class="flex flex-wrap gap-2 mb-6">
                        @php
                            $statusColors = [
                                'open'        => 'bg-green-100 text-green-800',
                                'in_progress' => 'bg-blue-100 text-blue-800',
                                'completed'   => 'bg-surface-container-high text-on-surface-variant',
                            ];
                        @endphp
                        <span class="px-3 py-1 rounded-full {{ $statusColors[$job->status] ?? 'bg-gray-100 text-gray-800' }} text-xs font-bold uppercase tracking-wider">
                            {{ str_replace('_', ' ', $job->status) }}
                        </span>
                        @if ($job->is_urgent)
                            <span class="px-3 py-1 rounded-full bg-error-container text-on-error-container text-xs font-bold uppercase tracking-wider flex items-center gap-1">
                                Urgent
                            </span>
                        @endif
                    </div>

                    <h1 class="text-3xl md:text-4xl font-headline font-extrabold text-on-surface leading-tight mb-6">{{ $job->title }}</h1>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6 mb-8">
                        <div class="flex items-center gap-2 text-on-surface-variant">
                            <span class="font-medium text-sm">City : {{ $job->city->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant">
                            <span class="font-medium text-sm">Category : {{ $job->category->name }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant">
                            <span class="font-medium text-sm">Date : {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                    </div>

                    <div class="prose prose-slate max-w-none text-on-surface-variant mb-8 leading-relaxed whitespace-pre-wrap"><h6 style="font: bold">Description : </h6>{{ $job->description }}</div>

                    <div class="bg-surface-container p-6 rounded-2xl flex items-center justify-between mb-8 border border-outline-variant/10">
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-outline uppercase tracking-widest mb-1">Estimated Budget</span>
                            <span class="text-2xl font-headline font-black text-primary">{{ number_format($job->budget, 2) }} MAD</span>
                        </div>
                    </div>

                    @if ($job->image)
                        <div class="relative rounded-2xl overflow-hidden h-64 md:h-80 w-full border border-outline-variant/10">
                            <img src="{{ Storage::url($job->image) }}" alt="{{ $job->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                        </div>
                    @endif
                </article>

                @if ($job->status === 'completed')
                    <div class="bg-surface-container-lowest rounded-3xl p-6 md:p-8 shadow-[0_20px_40px_rgba(25,28,30,0.04)] border border-outline-variant/10">
                        <h2 class="text-2xl font-headline font-bold mb-6 flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">rate_review</span>
                            Review for Maalem
                        </h2>

                        @if (!$job->review)
                            <form method="POST" action="{{ route('client.jobs.review', $job->id) }}" class="space-y-6">
                                @csrf
                                <div>
                                    <label class="block text-sm font-bold text-on-surface-variant mb-3">Service Rating</label>
                                    <select name="rating" class="w-full bg-surface-container-highest border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all text-on-surface cursor-pointer">
                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                        <option value="4">⭐⭐⭐⭐</option>
                                        <option value="3">⭐⭐⭐</option>
                                        <option value="2">⭐⭐</option>
                                        <option value="1">⭐</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-on-surface-variant mb-2">Detailed Feedback</label>
                                    <textarea name="comment" rows="4" class="w-full bg-surface-container-highest border-none rounded-xl focus:ring-2 focus:ring-primary focus:bg-surface-container-lowest transition-all p-4 text-on-surface resize-none" placeholder="How was the service? Mention the professional's punctuality and skill..."></textarea>
                                </div>
                                <button type="submit" class="px-8 py-3 w-full sm:w-auto bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 hover:bg-primary-container transition-all active:scale-95">
                                    Submit Review
                                </button>
                            </form>
                        @else
                            <div class="p-6 rounded-2xl bg-surface-container-low border border-outline-variant/10">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">person</span>
                                    </div>
                                    <div>
                                        <div class="font-bold text-on-surface">Your Feedback</div>
                                        <div class="flex text-amber-400 text-xs mt-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= $job->review->rating)
                                                    <span class="material-symbols-outlined text-[16px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                                @else
                                                    <span class="material-symbols-outlined text-[16px] text-outline-variant">star</span>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <p class="text-on-surface-variant text-sm italic mt-2">"{{ $job->review->comment }}"</p>
                            </div>
                        @endif
                    </div>
                @endif
            </section>

            <aside class="lg:col-span-1 space-y-6">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-xl font-headline font-bold text-on-surface">Applications</h2>
                    <span class="px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-black">{{ $job->applications->count() }} TOTAL</span>
                </div>

                <div class="space-y-4">
                    @if ($job->applications->isEmpty())
                        <div class="flex flex-col items-center justify-center p-12 text-center bg-surface-container/50 border-2 border-dashed border-outline-variant/30 rounded-3xl">
                            <h4 class="font-headline font-bold text-on-surface-variant">No Applications Yet</h4>
                            <p class="text-sm text-outline mt-2">Check back soon for proposals from professionals.</p>
                        </div>
                    @else
                        @foreach ($job->applications as $app)
                            @php
                                $maalem = $app->user;
                                $avg = $maalem->reviewsReceived->avg('rating') ?? 0;
                                $stars = round($avg);
                            @endphp
                            <div class="bg-surface-container-lowest p-5 rounded-3xl shadow-sm hover:shadow-md transition-all border border-outline-variant/10">
                                <div class="flex gap-4 mb-4">
                                    <img src="{{ $maalem->avatar ? Storage::url($maalem->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($maalem->name).'&background=00288e&color=fff' }}"
                                         alt="{{ $maalem->name }}"
                                         class="w-14 h-14 rounded-2xl object-cover ring-2 ring-surface shadow-sm shrink-0">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between gap-2">
                                            <h4 class="font-bold text-on-surface truncate">{{ $maalem->name }}</h4>
                                            <span class="text-sm font-black text-primary shrink-0">{{ number_format($app->proposed_price, 2) }} MAD</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-amber-400 mt-1">
                                            <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                            <span class="text-xs font-bold text-on-surface-variant">{{ number_format($avg, 1) }} <span class="text-outline font-medium">({{ $maalem->reviewsReceived->count() }})</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-surface-container-low p-3 rounded-xl mb-4">
                                    <p class="text-sm text-on-surface-variant line-clamp-3 leading-snug">"{{ $app->message }}"</p>
                                </div>

                                <div class="flex gap-2 mt-auto">
                                    @if($app->status === 'pending')
                                        <form method="POST" action="{{ route('client.offer.reject', $app->id) }}" class="flex-1 m-0">
                                            @csrf
                                            <button type="submit" class="w-full py-2.5 text-xs font-bold text-error bg-error-container/50 rounded-xl hover:bg-error-container transition-colors">Reject</button>
                                        </form>
                                        <form method="POST" action="{{ route('client.offer.accept', $app->id) }}" class="flex-1 m-0">
                                            @csrf
                                            <button type="submit" class="w-full py-2.5 text-xs font-bold text-white bg-primary rounded-xl shadow-md active:scale-95 transition-all">Accept</button>
                                        </form>
                                    @else
                                        <div class="w-full py-2 text-center text-xs font-bold uppercase tracking-wider text-outline-variant bg-surface-container-high rounded-xl">
                                            {{ $app->status }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </aside>

        </div>
    </main>

    <div id="delete-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-inverse-surface/60 backdrop-blur-sm" onclick="closeModal()"></div>
        <div class="relative bg-surface-container-lowest rounded-3xl w-full max-w-md p-8 shadow-2xl overflow-hidden transform transition-all">
            <div class="w-16 h-16 bg-error-container rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="material-symbols-outlined text-error text-3xl">delete_forever</span>
            </div>
            <h3 class="text-2xl font-headline font-extrabold text-on-surface text-center mb-3">Delete this job?</h3>
            <p class="text-on-surface-variant text-center text-sm mb-8 leading-relaxed">
                Are you sure you want to delete <span class="font-bold text-on-surface">"{{ $job->title }}"</span>? This action cannot be undone and all current applications will be permanently removed.
            </p>
            <div class="flex gap-3">
                <button type="button" onclick="closeModal()" class="flex-1 py-3 px-4 rounded-xl bg-surface-container-high text-on-surface-variant font-bold hover:bg-surface-dim transition-colors">
                    Cancel
                </button>
                <button type="button" onclick="document.getElementById('delete-form').submit()" class="flex-1 py-3 px-4 rounded-xl bg-error text-white font-bold shadow-lg shadow-error/20 hover:bg-[#ba1a1a] active:scale-95 transition-all">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
</body>
</html>
