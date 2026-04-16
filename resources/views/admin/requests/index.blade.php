<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Pending Requests | Allo Maalem Admin</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "primary-fixed": "#dde1ff",
                        "on-surface-variant": "#444653",
                        "inverse-surface": "#2d3133",
                        "surface-container-highest": "#e0e3e5",
                        "background": "#f7f9fb",
                        "surface-dim": "#d8dadc",
                        "surface-container-high": "#e6e8ea",
                        "on-error": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "error": "#ba1a1a",
                        "on-tertiary": "#ffffff",
                        "surface-bright": "#f7f9fb",
                        "primary": "#00288e",
                        "on-secondary-fixed": "#0d1c2e",
                        "primary-container": "#1e40af",
                        "on-primary-fixed": "#001453",
                        "surface-variant": "#e0e3e5",
                        "secondary": "#515f74",
                        "on-primary-fixed-variant": "#173bab",
                        "on-error-container": "#93000a",
                        "on-primary-container": "#a8b8ff",
                        "outline": "#757684",
                        "on-secondary-container": "#57657a",
                        "surface-container": "#eceef0",
                        "primary-fixed-dim": "#b8c4ff",
                        "outline-variant": "#c4c5d5",
                        "inverse-on-surface": "#eff1f3",
                        "tertiary-container": "#872d00",
                        "on-tertiary-container": "#ffa583",
                        "surface": "#f7f9fb",
                        "surface-tint": "#3755c3",
                        "on-tertiary-fixed-variant": "#802a00",
                        "error-container": "#ffdad6",
                        "secondary-fixed": "#d5e3fc",
                        "surface-container-low": "#f2f4f6",
                        "on-tertiary-fixed": "#380d00",
                        "on-secondary-fixed-variant": "#3a485b",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-primary": "#ffffff",
                        "tertiary": "#611e00",
                        "inverse-primary": "#b8c4ff",
                        "on-surface": "#191c1e",
                        "on-secondary": "#ffffff",
                        "tertiary-fixed-dim": "#ffb59a",
                        "secondary-container": "#d5e3fc",
                        "on-background": "#191c1e",
                        "tertiary-fixed": "#ffdbce"
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
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-background text-on-background min-h-screen">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-12">

        <header class="mb-10 mt-6">
            <h1 class="text-4xl md:text-5xl font-extrabold text-on-surface tracking-tight mb-2">Premium Account Requests</h1>
            <p class="text-lg text-secondary font-body">Review and manage professional verification applications.</p>
        </header>

        @if(session('success'))
            <div class="mb-8 flex items-center gap-4 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-sm animate-in fade-in slide-in-from-top-4 duration-500">
                <span class="material-symbols-outlined text-emerald-600" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <p class="text-emerald-800 font-medium font-body">{{ session('success') }}</p>
            </div>
        @endif

        @if($users->isEmpty())
            <div class="mt-10 flex flex-col items-center justify-center py-20 px-6 bg-surface-container-low rounded-2xl border-2 border-dashed border-outline-variant/30">
         
                <h3 class="text-2xl font-headline font-bold text-on-surface mb-2">There are no pending requests right now.</h3>
                <p class="text-secondary font-body text-center max-w-sm">All verification applications have been processed. New requests will appear here as they are submitted.</p>
            </div>
        @else
            <div class="bg-surface-container-lowest rounded-xl overflow-hidden shadow-[0_20px_40px_rgba(25,28,30,0.06)] mb-12">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant/10">
                                <th class="px-6 py-4 font-headline text-sm font-bold text-on-surface-variant uppercase tracking-wider">Name</th>
                                <th class="px-6 py-4 font-headline text-sm font-bold text-on-surface-variant uppercase tracking-wider">Email</th>
                                <th class="px-6 py-4 font-headline text-sm font-bold text-on-surface-variant uppercase tracking-wider">Role</th>
                                <th class="px-6 py-4 font-headline text-sm font-bold text-on-surface-variant uppercase tracking-wider text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/10">
                            @foreach($users as $user)
                                <tr class="hover:bg-surface-container-low/50 transition-colors">
                                    <td class="px-6 py-4 font-body text-on-surface font-medium">{{ $user->name }}</td>
                                    <td class="px-6 py-4 font-body text-secondary">{{ $user->email }}</td>
                                    <td class="px-6 py-4">
                                        @if(strtolower($user->role) === 'maalem')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-primary/10 text-primary uppercase tracking-tight">Maalem</span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-200 text-slate-700 uppercase tracking-tight">Client</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right flex justify-end gap-3">
                                        <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-bold text-xs hover:bg-emerald-700 transition-colors active:scale-95 shadow-sm">Approve</button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.users.reject', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="px-4 py-2 border-2 border-error text-error rounded-lg font-bold text-xs hover:bg-error/5 transition-colors active:scale-95">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </main>

</body>
</html>
