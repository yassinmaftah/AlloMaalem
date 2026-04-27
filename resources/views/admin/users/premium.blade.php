<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Premium Maalems - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface": "#f7f9fb",
                        "on-surface": "#191c1e",
                        "primary": "#00288e",
                        "primary-container": "#1e40af",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "surface-container-low": "#f2f4f6",
                        "outline-variant": "#c4c5d5",
                        "secondary": "#515f74",
                        "error": "#ba1a1a",
                        "error-container": "#ffdad6",
                    },
                    fontFamily: {
                        "headline": ["Manrope", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; min-height: 100vh; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-12 mb-20">

        <header class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
            <div>
                <h1 class="text-3xl md:text-4xl font-headline font-extrabold tracking-tight text-on-surface flex items-center gap-3">
                    Premium Professionals
                </h1>
                <p class="text-secondary mt-2">Manage all Maalems who have paid and verified their accounts.</p>
            </div>
        </header>

        <x-alert />

        <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant/30 overflow-hidden">
            @if($users->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                    <h3 class="text-xl font-headline font-bold text-on-surface">No Premium Users Yet</h3>
                    <p class="text-secondary mt-2">Once a Maalem pays for verification, they will appear here.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant/30 text-xs uppercase tracking-wider text-secondary font-bold">
                                <th class="px-6 py-4">Professional</th>
                                <th class="px-6 py-4">Contact Info</th>
                                <th class="px-6 py-4 text-center">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-outline-variant/20">
                            @foreach($users as $user)

                                <tr class="hover:bg-surface-container-low/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-4">
                                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://upload.wikimedia.org/wikipedia/commons/0/03/Twitter_default_profile_400x400.png' }}"
                                                 alt="{{ $user->name }}" class="w-12 h-12 rounded-full object-cover border border-outline-variant/30 shrink-0">
                                            <div>
                                                <div class="font-bold text-on-surface">{{ $user->name }}</div>
                                                <div class="text-xs text-secondary mt-0.5">Joined {{ $user->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-on-surface font-medium">{{ $user->email }}</div>
                                        <div class="text-xs text-secondary mt-1 flex items-center gap-1">
                                            {{ $user->phone }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="inline-flex items-center gap-1 bg-[#FDB931]/10 text-yellow-700 px-3 py-1 rounded-full text-xs font-black uppercase tracking-wider border border-[#FDB931]/30">
                                            Premium
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('admin.users.revoke', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="text-error hover:text-white hover:bg-error px-3 py-2 rounded-lg text-sm font-bold transition-colors border border-error/20 hover:border-error">
                                                Revoke
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </main>

</body>
</html>
