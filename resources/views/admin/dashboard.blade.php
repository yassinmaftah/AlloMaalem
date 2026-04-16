<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Admin Dashboard | Allo Maalem</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#ffdbce",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-primary-fixed-variant": "#173bab",
                        "primary-fixed": "#dde1ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-bright": "#f7f9fb",
                        "inverse-surface": "#2d3133",
                        "on-tertiary": "#ffffff",
                        "on-secondary": "#ffffff",
                        "surface-container": "#eceef0",
                        "secondary": "#515f74",
                        "surface-tint": "#3755c3",
                        "outline-variant": "#c4c5d5",
                        "on-background": "#191c1e",
                        "on-error": "#ffffff",
                        "error": "#ba1a1a",
                        "outline": "#757684",
                        "tertiary": "#611e00",
                        "surface-container-low": "#f2f4f6",
                        "tertiary-container": "#872d00",
                        "primary-container": "#1e40af",
                        "on-surface-variant": "#444653",
                        "on-tertiary-fixed-variant": "#802a00",
                        "error-container": "#ffdad6",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-fixed": "#0d1c2e",
                        "surface-variant": "#e0e3e5",
                        "surface-dim": "#d8dadc",
                        "on-primary": "#ffffff",
                        "inverse-on-surface": "#eff1f3",
                        "on-secondary-container": "#57657a",
                        "on-tertiary-container": "#ffa583",
                        "on-surface": "#191c1e",
                        "background": "#f7f9fb",
                        "secondary-container": "#d5e3fc",
                        "on-primary-fixed": "#001453",
                        "on-primary-container": "#a8b8ff",
                        "secondary-fixed": "#d5e3fc",
                        "surface": "#f7f9fb",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#b8c4ff",
                        "on-secondary-fixed-variant": "#3a485b",
                        "primary": "#00288e",
                        "tertiary-fixed-dim": "#ffb59a",
                        "surface-container-high": "#e6e8ea",
                        "on-tertiary-fixed": "#380d00"
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

    @include('navbars.adminnav')

    <main class="min-h-screen p-6 md:p-10 lg:p-12 max-w-[1600px] mx-auto">

        <header class="mb-10">
            <h1 class="font-headline text-3xl font-extrabold tracking-tight text-primary">Admin Dashboard</h1>
            <p class="text-secondary font-body mt-1 text-sm">System overview and recent activity.</p>
        </header>

        <section class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-12">
            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 flex flex-col gap-3 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider">Admins</span>
                </div>
                <div class="font-headline text-3xl font-extrabold text-on-surface">{{ $stats['total_admins'] }}</div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 flex flex-col gap-3 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider">Clients</span>
                </div>
                <div class="font-headline text-3xl font-extrabold text-on-surface">{{ $stats['total_clients'] }}</div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 flex flex-col gap-3 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider">Maalems</span>
                </div>
                <div class="font-headline text-3xl font-extrabold text-on-surface">{{ $stats['total_maalems'] }}</div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 flex flex-col gap-3 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider">Premium</span>
                </div>
                <div class="font-headline text-3xl font-extrabold text-on-surface">{{ $stats['premium_users'] }}</div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-xl border border-outline-variant/30 flex flex-col gap-3 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-semibold text-secondary uppercase tracking-wider">Open Jobs</span>
                </div>
                <div class="font-headline text-3xl font-extrabold text-on-surface">{{ $stats['open_jobs'] }}</div>
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/20 self-start">
                <div class="px-6 py-4 bg-surface-container-low flex items-center justify-between border-b border-outline-variant/20">
                    <h2 class="font-headline text-lg font-bold text-on-surface">Recent Users</h2>
                    <a href="{{ route('admin.users.index') }}" class="text-xs font-bold text-primary hover:underline">View All</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">ID</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Name</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Role</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Status</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Joined</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-highest/50">
                            @foreach($recentUsers as $user)
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-6 py-4 text-xs font-mono text-secondary">#{{ $user->id }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold truncate max-w-[120px]">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-xs text-on-surface-variant">{{ ucfirst($user->role) }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->is_baned)
                                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-error-container/20 text-error border border-error-container/30">BANNED</span>
                                        @elseif($user->verification_status == 'verified')
                                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-primary-container/10 text-primary-container border border-primary-container/20">PREMIUM</span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-outline-variant/20 text-secondary border border-outline-variant/30">NORMAL</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-xs text-secondary">{{ $user->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-sm border border-outline-variant/20 self-start">
                <div class="px-6 py-4 bg-surface-container-low flex items-center justify-between border-b border-outline-variant/20">
                    <h2 class="font-headline text-lg font-bold text-on-surface">Recent Jobs</h2>
                    <span class="material-symbols-outlined text-outline cursor-pointer hover:text-primary transition-colors" data-icon="refresh" onclick="location.reload()">refresh</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">ID</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Client</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Title</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Budget</th>
                                <th class="px-6 py-3 text-[10px] font-bold uppercase tracking-widest border-b border-secondary/10">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container-highest/50">
                            @foreach($recentJobs as $job)
                                <tr class="hover:bg-surface-container-low/30 transition-colors">
                                    <td class="px-6 py-4 text-xs font-mono text-secondary">#{{ $job->id }}</td>
                                    <td class="px-6 py-4 text-sm font-semibold truncate max-w-[100px]" title="{{ $job->user->name }}">{{ $job->user->name }}</td>
                                    <td class="px-6 py-4 text-xs text-on-surface-variant truncate max-w-[150px]" title="{{ $job->title }}">{{ $job->title }}</td>
                                    <td class="px-6 py-4 text-sm font-bold text-primary">{{ $job->budget }} MAD</td>
                                    <td class="px-6 py-4">
                                        @if(strtolower($job->status) === 'open')
                                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-green-100 text-green-700 border border-green-200">OPEN</span>
                                        @else
                                            <span class="px-2 py-1 text-[10px] font-bold rounded bg-outline-variant/20 text-secondary border border-outline-variant/30">{{ strtoupper($job->status) }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

        <footer class="mt-16 pt-8 border-t border-outline-variant/20 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-6">
                <div class="h-8 w-8 rounded-full bg-primary-container flex items-center justify-center text-white font-black text-xs">AM</div>
                <p class="text-xs text-secondary font-medium tracking-tight">© {{ date('Y') }} Allo Maalem Admin. Designed for professional excellence.</p>
            </div>
        </footer>
    </main>

</body>
</html>
