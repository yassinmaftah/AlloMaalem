<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Post a Job - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-error": "#ffffff",
                        "surface-container": "#eceef0",
                        "primary-container": "#1e40af",
                        "inverse-primary": "#b8c4ff",
                        "surface-tint": "#3755c3",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-dim": "#d8dadc",
                        "on-background": "#191c1e",
                        "primary-fixed": "#dde1ff",
                        "secondary-fixed-dim": "#b9c7df",
                        "surface-container-highest": "#e0e3e5",
                        "error": "#ba1a1a",
                        "tertiary-fixed-dim": "#ffb59a",
                        "secondary-container": "#d5e3fc",
                        "inverse-on-surface": "#eff1f3",
                        "surface": "#f7f9fb",
                        "outline": "#757684",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-low": "#f2f4f6",
                        "on-secondary-fixed": "#0d1c2e",
                        "inverse-surface": "#2d3133",
                        "on-tertiary-container": "#ffa583",
                        "on-secondary-fixed-variant": "#3a485b",
                        "tertiary-fixed": "#ffdbce",
                        "on-surface": "#191c1e",
                        "on-primary-fixed": "#001453",
                        "outline-variant": "#c4c5d5",
                        "surface-container-high": "#e6e8ea",
                        "primary": "#00288e",
                        "on-error-container": "#93000a",
                        "on-primary-fixed-variant": "#173bab",
                        "surface-container-lowest": "#ffffff",
                        "secondary-fixed": "#d5e3fc",
                        "secondary": "#515f74",
                        "tertiary": "#611e00",
                        "surface-bright": "#f7f9fb",
                        "on-surface-variant": "#444653",
                        "on-secondary-container": "#57657a",
                        "tertiary-container": "#872d00",
                        "surface-variant": "#e0e3e5",
                        "primary-fixed-dim": "#b8c4ff",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed": "#380d00",
                        "background": "#f7f9fb",
                        "on-secondary": "#ffffff"
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
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
            line-height: 1;
        }
        body {
            background-color: #f7f9fb;
            font-family: 'Inter', sans-serif;
            min-height: max(884px, 100dvh);
        }
        h1, h2, h3, h4 { font-family: 'Manrope', sans-serif; }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased">

    @include('navbars.clientnav')

    <main class="max-w-3xl mx-auto px-6 py-12 mb-20">

        <header class="text-center mb-10">
            <h1 class="font-headline font-bold text-3xl md:text-4xl text-[#1E40AF] tracking-tight mb-3">Post a New Job</h1>
            <p class="font-body text-on-secondary-container text-lg max-w-lg mx-auto">
                Describe your project to get proposals from professional Maalems.
            </p>
        </header>

        @if(session('error'))
            <div class="mb-8 p-4 bg-error-container border border-error/20 rounded-xl flex items-center gap-3 shadow-sm">
                <span class="material-symbols-outlined text-error">warning</span>
                <div class="flex-1">
                    <h3 class="font-bold text-on-error-container text-sm">{{ session('error') }}</h3>
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-8 p-4 bg-error-container/50 border border-error/10 rounded-xl flex items-start gap-3 shadow-sm">
                <span class="material-symbols-outlined text-error mt-0.5">warning</span>
                <div class="flex-1">
                    <h3 class="font-bold text-on-error-container text-sm mb-1">Please correct the following errors:</h3>
                    <ul class="text-error text-xs list-disc list-inside space-y-1 opacity-90 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/15 overflow-hidden">
            <form method="POST" action="{{ route('client.jobs.store') }}" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf

                <div class="space-y-2">
                    <label class="font-headline font-bold text-sm text-on-surface flex items-center gap-2">Job Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="w-full bg-surface-container-highest rounded-xl py-4 px-5 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant @error('title') border-error border-2 @else border-none @enderror"
                           placeholder="e.g., Fix leaking kitchen pipe or Install outdoor lighting"/>
                </div>

                <div class="space-y-2">
                    <label class="font-headline font-bold text-sm text-on-surface">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full bg-surface-container-highest rounded-xl py-4 px-5 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all placeholder:text-outline-variant resize-none @error('description') border-error border-2 @else border-none @enderror"
                              placeholder="Detail the scope of work, materials required, and any specific preferences...">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 relative">
                        <label class="font-headline font-bold text-sm text-on-surface">Category</label>
                        <div class="relative">
                            <select name="category_id" class="w-full appearance-none bg-surface-container-highest rounded-xl py-4 px-5 pr-12 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all cursor-pointer @error('category_id') border-error border-2 @else border-none @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2 relative">
                        <label class="font-headline font-bold text-sm text-on-surface">City</label>
                        <div class="relative">
                            <select name="city_id" class="w-full appearance-none bg-surface-container-highest rounded-xl py-4 px-5 pr-12 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all cursor-pointer @error('city_id') border-error border-2 @else border-none @enderror">
                                <option value="">Select City</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="space-y-2">
                        <label class="font-headline font-bold text-sm text-on-surface">Estimated Budget</label>
                        <div class="relative">
                            <input type="number" name="budget" value="{{ old('budget') }}" min="0" step="0.01"
                                   class="w-full bg-surface-container-highest rounded-xl py-4 pl-5 pr-16 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all @error('budget') border-error border-2 @else border-none @enderror"
                                   placeholder="0.00"/>
                            <span class="absolute right-5 top-1/2 -translate-y-1/2 font-bold text-[#1E40AF] text-sm">MAD</span>
                        </div>
                    </div>

                    <div class="h-[60px] flex items-center">
                        <label for="is_urgent" class="flex items-center gap-3 p-4 w-full cursor-pointer bg-error-container/20 rounded-xl border border-error/20 group hover:bg-error-container/30 transition-colors">
                            <input type="checkbox" name="is_urgent" id="is_urgent" value="1" {{ old('is_urgent') ? 'checked' : '' }}
                                   class="w-5 h-5 rounded border-error text-error focus:ring-error cursor-pointer"/>
                            <span class="flex items-center gap-2 text-error font-semibold text-sm">
                                Mark as Urgent
                            </span>
                        </label>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="font-headline font-bold text-sm text-on-surface">Reference Image <span class="text-outline font-normal">(Optional)</span></label>
                    <div class="border-2 border-dashed border-outline-variant/30 rounded-2xl p-6 text-center bg-surface-container-low transition-colors hover:bg-surface-container-highest">
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-sm text-secondary file:mr-4 file:py-3 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#1E40AF]/10 file:text-[#1E40AF] hover:file:bg-[#1E40AF]/20 transition-colors cursor-pointer">
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#1E40AF] text-on-primary py-5 rounded-xl font-headline font-extrabold text-lg flex items-center justify-center gap-3 shadow-xl shadow-primary/20 hover:bg-primary-container hover:scale-[1.01] active:scale-[0.98] transition-all group">
                        Post Job Now
                        <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
