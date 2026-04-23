<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>My Applications - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "on-surface-variant": "#444653",
                        "surface-dim": "#d8dadc",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-error-container": "#93000a",
                        "outline": "#757684",
                        "on-tertiary-fixed": "#380d00",
                        "on-surface": "#191c1e",
                        "background": "#f7f9fb",
                        "secondary": "#515f74",
                        "primary": "#00288e",
                        "inverse-primary": "#b8c4ff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-error": "#ffffff",
                        "surface-bright": "#f7f9fb",
                        "on-background": "#191c1e",
                        "inverse-on-surface": "#eff1f3",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#1e40af",
                        "outline-variant": "#c4c5d5",
                        "on-secondary-container": "#57657a",
                        "primary-fixed": "#dde1ff",
                        "surface": "#f7f9fb",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#872d00",
                        "surface-container-high": "#e6e8ea",
                        "surface-container": "#eceef0",
                        "error": "#ba1a1a",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#ffa583",
                        "tertiary-fixed": "#ffdbce",
                        "tertiary": "#611e00",
                        "on-primary-fixed-variant": "#173bab",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-variant": "#e0e3e5",
                        "secondary-fixed": "#d5e3fc",
                        "surface-container-lowest": "#ffffff",
                        "surface-tint": "#3755c3",
                        "on-secondary": "#ffffff",
                        "on-primary-fixed": "#001453",
                        "on-primary-container": "#a8b8ff"
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
                },
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }
        body { background-color: #f7f9fb; font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }
        body { min-height: max(884px, 100dvh); }
    </style>
</head>
<body class="bg-surface text-on-surface">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <header class="mb-10">
            <h1 class="text-4xl font-extrabold text-on-surface tracking-tight mb-2">My Applications</h1>
            <p class="text-secondary text-lg">Track and manage your job proposals.</p>
        </header>

        <div class="border-b border-outline-variant mb-10 overflow-x-auto">
            <nav aria-label="Tabs" class="flex space-x-8 min-w-max">
                <a href="{{ route('maalem.applications.index', ['tab' => 'pending']) }}" class="py-4 px-1 text-sm font-medium transition-all {{ $tab === 'pending' ? 'border-primary text-primary border-b-4 font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-outline-variant border-b-4' }}">
                    Pending
                </a>
                <a href="{{ route('maalem.applications.index', ['tab' => 'accepted']) }}" class="py-4 px-1 text-sm font-medium transition-all {{ $tab === 'accepted' ? 'border-primary text-primary border-b-4 font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-outline-variant border-b-4' }}">
                    Accepted (Active)
                </a>
                <a href="{{ route('maalem.applications.index', ['tab' => 'rejected']) }}" class="py-4 px-1 text-sm font-medium transition-all {{ $tab === 'rejected' ? 'border-primary text-primary border-b-4 font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-outline-variant border-b-4' }}">
                    Rejected
                </a>
                <a href="{{ route('maalem.applications.index', ['tab' => 'completed']) }}" class="py-4 px-1 text-sm font-medium transition-all {{ $tab === 'completed' ? 'border-primary text-primary border-b-4 font-bold' : 'border-transparent text-secondary hover:text-primary hover:border-outline-variant border-b-4' }}">
                    Completed
                </a>
            </nav>
        </div>

        <x-alert />

        @if($apps->isEmpty())
            <div class="flex flex-col items-center justify-center py-24 text-center">
                <h2 class="text-2xl font-bold text-on-surface mb-2">Nothing here right now.</h2>
                <p class="text-secondary">You haven't submitted any applications for this category yet.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($apps as $app)

                    @if($tab === 'pending')
                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-white flex flex-col justify-between">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-xl font-bold text-on-surface leading-tight line-clamp-2" title="{{ $app->job->title }}">{{ $app->job->title }}</h3>
                                    <span class="bg-surface-container text-on-surface-variant text-[10px] uppercase tracking-widest font-bold px-2 py-1 rounded ml-2 shrink-0">Pending</span>
                                </div>
                                <div class="flex items-center text-primary font-semibold text-lg mb-6">
                                    My Price: {{ number_format($app->proposed_price, 2) }} MAD
                                </div>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <a href="{{ route('maalem.applications.edit', $app->id) }}" class="flex-1 text-center border-2 border-outline-variant text-on-surface-variant font-bold py-2.5 rounded-xl hover:bg-surface-container-low transition-colors text-sm">
                                    Edit
                                </a>
                                <button type="button" onclick="openPopup('{{ route('maalem.applications.destroy', $app->id) }}')" class="flex-1 border-2 border-error/20 text-error font-bold py-2.5 rounded-xl hover:bg-error-container transition-colors text-sm">
                                    Delete
                                </button>
                            </div>
                        </div>

                    @elseif($tab === 'accepted')
                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-[0_4px_10px_rgba(1,1,1,1)] border-l-4 border-emerald-100 flex flex-col justify-between">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-on-surface leading-tight mb-4 line-clamp-2" title="{{ $app->job->title }}">{{ $app->job->title }}</h3>
                                <div class="bg-emerald-50 rounded-xl p-4 mb-4">
                                    <div class="flex items-center mb-2">
                                        <span class="text-on-surface font-bold truncate">{{ $app->job->user->name }}</span>
                                    </div>
                                    <div class="flex items-center text-emerald-700 text-sm font-medium">
                                        <a href="tel:{{ $app->job->user->phone }}" class="hover:underline">{{ $app->job->user->phone }}</a>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center text-secondary text-sm">
                                        {{ $app->job->city->name }}
                                    </div>
                                    <div class="flex items-center text-primary font-bold">
                                        Fixed Price: {{ number_format($app->proposed_price, 2) }} MAD
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto pt-4">
                                <span class="inline-flex items-center bg-emerald-100 text-emerald-700 text-[11px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                    In Progress
                                </span>
                            </div>
                        </div>

                    @elseif($tab === 'rejected')
                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-error-container flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-on-surface leading-tight mb-2 opacity-60 line-clamp-2" title="{{ $app->job->title }}">{{ $app->job->title }}</h3>
                                <div class="flex items-center text-error font-bold mb-6 text-sm">
                                    Application Rejected
                                </div>
                            </div>

                            @if($app->job->status === 'open')
                                <form method="POST" action="{{ route('maalem.applications.reapply', $app->id) }}" class="space-y-4 mt-auto pt-4 border-t border-surface-container">
                                    @csrf
                                    <div>
                                        <label class="block text-xs font-bold text-secondary mb-1 uppercase tracking-tighter">New Price (MAD)</label>
                                        <input type="number" name="price" value="{{ $app->proposed_price }}" class="w-full bg-surface-container-low border-0 focus:ring-2 focus:ring-primary rounded-xl px-4 py-3 text-on-surface font-semibold" placeholder="0.00" />
                                    </div>
                                    <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-xl hover:bg-primary-container transition-all shadow-md active:scale-[0.98]">
                                        Reapply
                                    </button>
                                </form>
                            @else
                                <div class="mt-auto pt-4">
                                    <p class="text-sm font-semibold text-secondary flex items-center">
                                         Job is closed
                                    </p>
                                </div>
                            @endif
                        </div>

                    @elseif($tab === 'completed')
                        <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-[0_10px_30px_rgba(0,0,0,0.03)] flex flex-col justify-between">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-on-surface leading-tight mb-2 line-clamp-2" title="{{ $app->job->title }}">{{ $app->job->title }}</h3>
                                <div class="text-secondary font-bold text-sm mb-4">Final Price: {{ number_format($app->proposed_price, 2) }} MAD</div>
                            </div>

                            <div class="bg-surface-container-low rounded-xl p-4 mt-auto">
                                @if($app->job->review)
                                    <div class="flex text-amber-400 mb-2">
                                        @for($i=1; $i<=5; $i++)
                                            @if($i <= $app->job->review->rating)
                                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                                            @else
                                                <span class="material-symbols-outlined text-outline-variant">star</span>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-on-surface-variant text-sm italic leading-relaxed">
                                        {{ $app->job->review->comment }}
                                    </p>
                                @else
                                    <p class="text-xs font-semibold text-secondary text-center py-2">No review from client yet.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        @endif

    </main>

    <div id="deleteModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-inverse-surface/60 backdrop-blur-sm transition-opacity" onclick="closePopup()"></div>

        <div class="relative bg-surface-container-lowest rounded-2xl max-w-sm w-full p-8 shadow-2xl z-10 transform scale-100 transition-transform">

            <h2 class="text-2xl font-headline font-black text-on-surface text-center mb-2">Delete Application</h2>
            <p class="text-secondary text-center mb-8 text-sm">Are you sure? This action cannot be undone and your proposal will be removed permanently.</p>

            <div class="flex gap-4">
                <button type="button" onclick="closePopup()" class="flex-1 py-3 px-4 bg-surface-container-high text-on-surface font-bold rounded-xl hover:bg-surface-dim transition-colors">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="" class="flex-1 flex">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-3 px-4 bg-error text-white font-bold rounded-xl hover:bg-error-container hover:text-error transition-colors shadow-lg shadow-error/20">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openPopup(url) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>
</html>
