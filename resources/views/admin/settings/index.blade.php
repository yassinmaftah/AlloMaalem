<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>System Settings | Allo Maalem Admin</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "secondary-container": "#d5e3fc",
                        "inverse-surface": "#2d3133",
                        "primary-fixed-dim": "#b8c4ff",
                        "primary-container": "#1e40af",
                        "on-primary-fixed-variant": "#173bab",
                        "surface-dim": "#d8dadc",
                        "tertiary-fixed-dim": "#ffb59a",
                        "on-primary": "#ffffff",
                        "on-tertiary-fixed-variant": "#802a00",
                        "surface-container-high": "#e6e8ea",
                        "error-container": "#ffdad6",
                        "tertiary-container": "#872d00",
                        "primary-fixed": "#dde1ff",
                        "on-error-container": "#93000a",
                        "surface-bright": "#f7f9fb",
                        "background": "#f7f9fb",
                        "error": "#ba1a1a",
                        "outline": "#757684",
                        "on-primary-container": "#a8b8ff",
                        "surface-container": "#eceef0",
                        "secondary": "#515f74",
                        "on-secondary-container": "#57657a",
                        "outline-variant": "#c4c5d5",
                        "on-surface": "#191c1e",
                        "tertiary": "#611e00",
                        "surface-tint": "#3755c3",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-primary-fixed": "#001453",
                        "on-secondary": "#ffffff",
                        "on-tertiary-fixed": "#380d00",
                        "tertiary-fixed": "#ffdbce",
                        "surface": "#f7f9fb",
                        "secondary-fixed": "#d5e3fc",
                        "inverse-on-surface": "#eff1f3",
                        "surface-container-lowest": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "primary": "#00288e",
                        "on-secondary-fixed-variant": "#3a485b",
                        "on-surface-variant": "#444653",
                        "on-tertiary-container": "#ffa583",
                        "surface-container-low": "#f2f4f6",
                        "surface-variant": "#e0e3e5",
                        "on-secondary-fixed": "#0d1c2e",
                        "secondary-fixed-dim": "#b9c7df",
                        "on-background": "#191c1e",
                        "inverse-primary": "#b8c4ff"
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
            vertical-align: middle;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Manrope', sans-serif; }
        body {
            min-height: max(884px, 100dvh);
        }
    </style>
</head>
<body class="bg-surface text-on-surface min-h-screen">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-6 py-12 md:px-12 lg:py-16">

        <header class="mb-10">
            <h1 class="text-4xl font-extrabold text-primary tracking-tight mb-2">System Settings</h1>
            <p class="text-secondary font-medium">Manage platform categories and locations.</p>
        </header>

        <x-alert />

        <nav class="flex gap-8 mb-12 border-b border-outline-variant/30">
            <button onclick="switchTab('categories')" id="btn-categories" class="tab-btn pb-4 text-primary font-bold border-b-2 border-primary transition-colors">
                Manage Categories
            </button>
            <button onclick="switchTab('cities')" id="btn-cities" class="tab-btn pb-4 text-secondary font-medium border-transparent hover:text-primary transition-colors">
                Manage Cities
            </button>
        </nav>

        <div id="tab-categories" class="tab-content grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <section class="lg:col-span-1">
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10">
                    <h2 class="text-xl font-bold text-on-surface mb-6">Add Category</h2>
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-secondary mb-2 uppercase tracking-wider" for="category-name">Category Name</label>
                            <input class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 focus:bg-surface-container-lowest focus:ring-0 focus:border-b-2 focus:border-primary transition-all placeholder:text-outline"
                                   id="category-name" name="name" placeholder="e.g. Plumber" type="text" />
                        </div>
                        <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container active:scale-95 transition-all duration-200" type="submit">
                            Save Category
                        </button>
                    </form>
                </div>
            </section>

            <section class="lg:col-span-2">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-secondary">
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Category Name</th>
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @forelse($categories as $category)
                                <tr class="hover:bg-surface-container-low transition-colors group">
                                    <td class="px-6 py-5 font-mono text-sm text-secondary">#{{ $category->id }}</td>
                                    <td class="px-6 py-5 font-semibold text-on-surface">{{ $category->name }}</td>
                                    <td class="px-6 py-5 text-right">
                                        <button type="button" onclick="openPopup('{{ route('admin.categories.destroy', $category->id) }}', 'Category')" class="inline-flex items-center gap-2 px-4 py-2 text-error border border-error/40 rounded-lg hover:bg-error-container hover:border-error transition-all group-active:scale-95">

                                            <span class="text-sm font-bold">Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-secondary font-medium">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        <div id="tab-cities" class="tab-content hidden grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <section class="lg:col-span-1">
                <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10">
                    <h2 class="text-xl font-bold text-on-surface mb-6">Add City</h2>
                    <form method="POST" action="{{ route('admin.cities.store') }}" class="space-y-6">
                        @csrf
                        <div>
                            <label class="block text-sm font-semibold text-secondary mb-2 uppercase tracking-wider" for="city-name">City Name</label>
                            <input class="w-full bg-surface-container-highest border-none rounded-lg px-4 py-3 focus:bg-surface-container-lowest focus:ring-0 focus:border-b-2 focus:border-primary transition-all placeholder:text-outline"
                                   id="city-name" name="name" placeholder="e.g. Casablanca" type="text" />
                        </div>
                        <button class="w-full py-4 bg-primary text-on-primary font-bold rounded-lg hover:bg-primary-container active:scale-95 transition-all duration-200" type="submit">
                            Save City
                        </button>
                    </form>
                </div>
            </section>

            <section class="lg:col-span-2">
                <div class="bg-surface-container-lowest rounded-xl shadow-[0_20px_40px_rgba(25,28,30,0.06)] border border-outline-variant/10 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface-container-low text-secondary">
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">ID</th>
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">City Name</th>
                                <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-surface-container">
                            @forelse($cities as $city)
                                <tr class="hover:bg-surface-container-low transition-colors group">
                                    <td class="px-6 py-5 font-mono text-sm text-secondary">#{{ $city->id }}</td>
                                    <td class="px-6 py-5 font-semibold text-on-surface">{{ $city->name }}</td>
                                    <td class="px-6 py-5 text-right">
                                        <button type="button" onclick="openPopup('{{ route('admin.cities.destroy', $city->id) }}', 'City')" class="inline-flex items-center gap-2 px-4 py-2 text-error border border-error/40 rounded-lg hover:bg-error-container hover:border-error transition-all group-active:scale-95">
                                            <span class="text-sm font-bold">Delete</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-8 text-center text-secondary font-medium">No cities found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

    </main>

    <div id="deleteModal" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm hidden">
        <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-2xl overflow-hidden border border-outline-variant/20">
            <div class="p-8">
                <div class="flex items-center gap-3 mb-4 text-error">
                    <h3 class="text-2xl font-extrabold tracking-tight">Delete <span id="deleteType"></span>?</h3>
                </div>

                <div class="p-4 bg-error-container/30 border border-error/10 rounded-xl mb-8">
                    <p class="text-on-error-container text-sm leading-relaxed font-medium">
                        Warning: Deleting this will also permanently delete all jobs attached to it. This action cannot be undone.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="button" onclick="closePopup()" class="flex-1 py-3 px-6 bg-surface-container-high text-secondary font-bold rounded-xl hover:bg-surface-container-highest transition-colors active:scale-98">
                        Cancel
                    </button>

                    <form id="deleteForm" method="POST" action="" class="flex-1 flex">
                        @csrf
                        <button type="submit" class="w-full py-3 px-6 bg-error text-on-error font-bold rounded-xl hover:opacity-90 transition-opacity shadow-lg shadow-error/20 active:scale-98">
                            Yes, Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('text-primary', 'font-bold', 'border-primary', 'border-b-2');
                el.classList.add('text-secondary', 'font-medium', 'border-transparent');
            });

            // Show selected content
            document.getElementById('tab-' + tabName).classList.remove('hidden');

            // Set active style to selected tab
            let activeBtn = document.getElementById('btn-' + tabName);
            activeBtn.classList.remove('text-secondary', 'font-medium', 'border-transparent');
            activeBtn.classList.add('text-primary', 'font-bold', 'border-primary', 'border-b-2');
        }

        // Initialize active tab from Session or default to categories
        let activeTab = "{{ session('active_tab', 'categories') }}";
        switchTab(activeTab);

        // Modal Logic
        function openPopup(url, type) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteType').innerText = type;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>
</html>
