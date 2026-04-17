<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Application - Allo Maalem</title>
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
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">

    @include('navbars.maalemnav')

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <nav class="mb-8">
            <a class="inline-flex items-center text-primary font-semibold font-headline transition-transform active:scale-95 group" href="{{ route('maalem.applications.index') }}">
                <- Back to My Applications
            </a>
        </nav>

        @if(session('error'))
            <div class="bg-error-container border border-error/20 text-on-error-container px-4 py-4 rounded-xl mb-8 flex items-center gap-3 shadow-sm">
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10 overflow-hidden">
            <div class="p-8 md:p-10">

                <div class="mb-8">
                    <h1 class="text-3xl font-headline font-extrabold text-on-surface tracking-tight mb-4">Edit Proposal</h1>

                    <div class="bg-primary-fixed/40 border border-primary/10 rounded-xl p-4 flex items-start gap-3">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-widest text-primary mb-1">Applying For</p>
                            <p class="font-bold text-on-surface leading-tight">{{ $application->job->title }}</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('maalem.applications.update', $application->id) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Proposed Price (MAD)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-outline font-medium">MAD</span>
                            </div>
                            <input type="number" name="proposed_price" step="0.01" min="0"
                                   value="{{ old('proposed_price', $application->proposed_price) }}"
                                   class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all rounded-t-lg pl-14 py-4 text-on-surface font-semibold placeholder:text-outline-variant @error('proposed_price') border-error bg-error-container/10 @enderror" placeholder="0.00"/>
                        </div>
                        @error('proposed_price')
                            <p class="text-error text-xs font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-on-surface-variant mb-2">Message to Client</label>
                        <textarea name="message" rows="5"
                                  class="w-full bg-surface-container-low border-0 border-b-2 border-transparent focus:border-primary focus:ring-0 focus:bg-surface-container-lowest transition-all rounded-t-lg p-4 text-on-surface placeholder:text-outline-variant resize-none @error('message') border-error bg-error-container/10 @enderror" placeholder="Describe your experience with similar projects...">{{ old('message', $application->message) }}</textarea>
                        @error('message')
                            <p class="text-error text-xs font-medium mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full mt-4 py-4 bg-primary text-on-primary rounded-xl font-headline font-extrabold text-lg shadow-xl shadow-primary/20 hover:bg-primary-container active:scale-[0.98] transition-all flex items-center justify-center group">
                        Update Application
                    </button>
                </form>

            </div>
        </div>

    </main>

</body>
</html>
