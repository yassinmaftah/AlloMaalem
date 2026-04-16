<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Edit Job - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700;800&family=Inter:wght@400;500;600&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "surface-container-lowest": "#ffffff",
                        "on-background": "#191c1e",
                        "inverse-primary": "#b8c4ff",
                        "inverse-on-surface": "#eff1f3",
                        "primary-fixed-dim": "#b8c4ff",
                        "outline": "#757684",
                        "on-primary-fixed-variant": "#173bab",
                        "primary-fixed": "#dde1ff",
                        "background": "#f7f9fb",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-tertiary": "#ffffff",
                        "tertiary": "#611e00",
                        "on-tertiary-fixed": "#380d00",
                        "on-primary-container": "#a8b8ff",
                        "surface-container-high": "#e6e8ea",
                        "surface-container-highest": "#e0e3e5",
                        "on-tertiary-container": "#ffa583",
                        "surface-dim": "#d8dadc",
                        "secondary-container": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "outline-variant": "#c4c5d5",
                        "surface-variant": "#e0e3e5",
                        "surface": "#f7f9fb",
                        "primary-container": "#1e40af",
                        "on-primary-fixed": "#001453",
                        "tertiary-fixed": "#ffdbce",
                        "on-secondary-container": "#57657a",
                        "on-surface": "#191c1e",
                        "tertiary-container": "#872d00",
                        "secondary-fixed-dim": "#b9c7df",
                        "secondary": "#515f74",
                        "on-tertiary-fixed-variant": "#802a00",
                        "on-secondary-fixed": "#0d1c2e",
                        "on-error-container": "#93000a",
                        "on-secondary": "#ffffff",
                        "surface-tint": "#3755c3",
                        "surface-bright": "#f7f9fb",
                        "surface-container": "#eceef0",
                        "primary": "#00288e",
                        "error": "#ba1a1a",
                        "secondary-fixed": "#d5e3fc",
                        "on-primary": "#ffffff",
                        "surface-container-low": "#f2f4f6",
                        "error-container": "#ffdad6",
                        "on-surface-variant": "#444653",
                        "on-error": "#ffffff",
                        "on-secondary-fixed-variant": "#3a485b"
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
            display: inline-block;
            vertical-align: middle;
        }
        body {
            background-color: #f7f9fb;
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface antialiased">

    @include('navbars.clientnav')

    <main class="max-w-3xl mx-auto px-6 py-12 mb-20">

        <nav class="mb-8">
            <a href="{{ route('client.jobs.show', $job->id) }}" class="inline-flex items-center text-[#1E40AF] font-semibold hover:opacity-80 transition-opacity">
                <-- Back to Job Details
            </a>
        </nav>

        <section class="text-center mb-10">
            <h1 class="font-headline font-extrabold text-3xl md:text-4xl text-on-surface tracking-tight mb-3">Update Job Details</h1>
            <p class="text-secondary text-lg">Modify your project requirements or update the budget.</p>
        </section>

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

        <form method="POST" action="{{ route('client.jobs.update', $job->id) }}" enctype="multipart/form-data" class="bg-surface-container-lowest rounded-2xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] p-8 md:p-12 border border-outline-variant/10">
            @csrf
            @method('PATCH')

            <div class="space-y-8">

                <div class="space-y-2">
                    <label class="block font-semibold text-on-surface text-sm">Job Title</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}"
                           class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all duration-200 text-on-surface placeholder:text-outline-variant @error('title') ring-2 ring-error @enderror"/>
                </div>

                <div class="space-y-2">
                    <label class="block font-semibold text-on-surface text-sm">Description</label>
                    <textarea name="description" rows="5"
                              class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all duration-200 text-on-surface resize-none placeholder:text-outline-variant @error('description') ring-2 ring-error @enderror">{{ old('description', $job->description) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2 relative">
                        <label class="block font-semibold text-on-surface text-sm">Category</label>
                        <select name="category_id" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3.5 pr-12 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all duration-200 text-on-surface appearance-none cursor-pointer @error('category_id') ring-2 ring-error @enderror">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2 relative">
                        <label class="block font-semibold text-on-surface text-sm">City</label>
                        <select name="city_id" class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3.5 pr-12 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all duration-200 text-on-surface appearance-none cursor-pointer @error('city_id') ring-2 ring-error @enderror">
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" {{ old('city_id', $job->city_id) == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                    <div class="space-y-2">
                        <label class="block font-semibold text-on-surface text-sm">Estimated Budget (MAD)</label>
                        <div class="relative">
                            <input type="number" name="budget" value="{{ old('budget', $job->budget) }}" min="0" step="0.01"
                                   class="w-full bg-surface-container-highest/40 border-none rounded-xl px-4 py-3.5 focus:ring-2 focus:ring-[#1E40AF] focus:bg-surface-container-lowest transition-all duration-200 text-on-surface pr-16 @error('budget') ring-2 ring-error @enderror"/>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-secondary font-bold text-sm">MAD</span>
                        </div>
                    </div>

                    <div class="flex items-center h-[52px] px-4 bg-error-container/20 rounded-xl border border-error-container/30 transition-colors hover:bg-error-container/30">
                        <input type="checkbox" name="is_urgent" id="is_urgent" value="1" {{ old('is_urgent', $job->is_urgent) ? 'checked' : '' }}
                               class="w-5 h-5 text-error rounded border-error-container bg-surface-container-lowest focus:ring-error transition-all duration-200 cursor-pointer"/>
                        <label class="ml-3 font-bold text-error text-sm cursor-pointer select-none flex-1 flex items-center gap-1" for="is_urgent">
                            Mark as Urgent
                        </label>
                    </div>
                </div>

                <div class="space-y-4 pt-6 border-t border-outline-variant/10">
                    <label class="block font-semibold text-on-surface text-sm">Reference Image <span class="text-outline font-normal">(Optional)</span></label>

                    <div class="flex flex-col sm:flex-row items-start gap-6">
                        @if ($job->image)
                            <div class="relative group shrink-0">
                                <p class="text-xs font-semibold text-secondary mb-2 uppercase tracking-wider">Current</p>
                                <img src="{{ Storage::url($job->image) }}" class="w-32 h-32 rounded-2xl object-cover border border-outline-variant/20 shadow-sm" alt="Current Image"/>
                            </div>
                        @endif

                        <div class="flex-1 w-full">
                            @if ($job->image)
                                <p class="text-xs font-semibold text-secondary mb-2 uppercase tracking-wider">Upload New</p>
                            @endif
                            <div class="border-2 border-dashed border-outline-variant/40 rounded-2xl p-6 text-center hover:border-primary/40 transition-all bg-surface-container-low">
                                <input type="file" name="image" accept="image/*"
                                       class="w-full text-sm text-secondary file:mr-4 file:py-2.5 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#1E40AF]/10 file:text-[#1E40AF] hover:file:bg-[#1E40AF]/20 transition-colors cursor-pointer">
                                <p class="text-xs text-secondary mt-3">Uploading a new image will replace the current one.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" class="w-full sm:flex-1 py-4 bg-[#1E40AF] text-white font-headline font-extrabold text-lg rounded-xl shadow-lg shadow-[#1E40AF]/20 hover:scale-[1.01] active:scale-95 transition-all duration-200">
                        Save Changes
                    </button>
                    <a href="{{ route('client.jobs.show', $job->id) }}" class="w-full sm:w-1/3 py-4 bg-surface-container-high text-on-surface-variant font-headline font-extrabold text-lg rounded-xl hover:bg-surface-dim transition-all duration-200 text-center flex items-center justify-center">
                        Cancel
                    </a>
                </div>

            </div>
        </form>

    </main>
</body>
</html>
