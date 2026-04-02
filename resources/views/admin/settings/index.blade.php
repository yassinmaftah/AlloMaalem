<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Settings - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">System Settings</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6 font-bold">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="border-b border-gray-200 mb-6">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button onclick="switchTab('categories')" id="btn-categories" class="tab-btn border-blue-500 text-blue-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg">
                    Manage Categories
                </button>
                <button onclick="switchTab('cities')" id="btn-cities" class="tab-btn border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-lg">
                    Manage Cities
                </button>
            </nav>
        </div>

        <div id="tab-categories" class="tab-content grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Add Category</h2>
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="name" placeholder="e.g. Plumber, Electrician" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Save Category</button>
                    </form>
                </div>
            </div>
            <div class="md:col-span-2 bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Category Name</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-gray-600">#{{ $category->id }}</td>
                                <td class="py-3 px-4 font-bold text-gray-800">{{ $category->name }}</td>
                                <td class="py-3 px-4 flex justify-center">
                                    <button type="button" onclick="openPopup('{{ route('admin.categories.destroy', $category->id) }}', 'Category')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition text-sm">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-8 text-center text-gray-500 font-bold">No categories found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="tab-cities" class="tab-content hidden grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Add City</h2>
                    <form method="POST" action="{{ route('admin.cities.store') }}">
                        @csrf
                        <div class="mb-4">
                            <input type="text" name="name" placeholder="e.g. Casablanca, Rabat" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Save City</button>
                    </form>
                </div>
            </div>
            <div class="md:col-span-2 bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">City Name</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cities as $city)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 text-gray-600">#{{ $city->id }}</td>
                                <td class="py-3 px-4 font-bold text-gray-800">{{ $city->name }}</td>
                                <td class="py-3 px-4 flex justify-center">
                                    <button type="button" onclick="openPopup('{{ route('admin.cities.destroy', $city->id) }}', 'City')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition text-sm">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="py-8 text-center text-gray-500 font-bold">No cities found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center border-t-4 border-red-600">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Delete <span id="deleteType"></span>?</h2>
                <div class="bg-red-50 text-red-700 p-3 rounded mb-6 text-sm text-left border-l-4 border-red-500 font-medium">
                    <strong>Warning:</strong> Deleting this will also permanently delete all jobs attached to it.
                </div>
                <div class="flex justify-center gap-4">
                    <button onclick="closePopup()" type="button" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition">Cancel</button>
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function switchTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('border-blue-500', 'text-blue-600');
                el.classList.add('border-transparent', 'text-gray-500');
            });

            document.getElementById('tab-' + tabName).classList.remove('hidden');
            document.getElementById('btn-' + tabName).classList.add('border-blue-500', 'text-blue-600');
            document.getElementById('btn-' + tabName).classList.remove('border-blue-500', 'text-gray-500');
        }

        let activeTab = "{{ session('active_tab', 'categories') }}";
        switchTab(activeTab);

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
