<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Manage Categories</h1>

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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Add New Category</h2>

                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Category Name</label>
                            <input type="text" name="name" placeholder="e.g. Plumber, Electrician" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
                            Save Category
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm">Category Name</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 text-gray-600">#{{ $category->id }}</td>
                                    <td class="py-3 px-4 font-bold text-gray-800">{{ $category->name }}</td>
                                    <td class="py-3 px-4 flex justify-center">
                                        <button type="button" onclick="openPopup('{{ route('admin.categories.destroy', $category->id) }}')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition text-sm">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @if($categories->isEmpty())
                                <tr>
                                    <td colspan="3" class="py-8 text-center text-gray-500 font-bold">No categories added yet.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center border-t-4 border-red-600">
                <h2 class="text-xl font-bold mb-4 text-gray-900">Delete Category?</h2>

                <div class="bg-red-50 text-red-700 p-3 rounded mb-6 text-sm text-left border-l-4 border-red-500 font-medium">
                    <strong>Warning:</strong> If you delete this category, all jobs attached to it will also be deleted forever. Are you sure?
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
</body>

        <script>
            function openPopup(url) {
                document.getElementById('deleteForm').action = url;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closePopup() {
                document.getElementById('deleteModal').classList.add('hidden');
            }
        </script>

</html>
