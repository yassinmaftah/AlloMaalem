<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a Job - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-2xl mx-auto px-4 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-blue-600">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Post a New Job</h1>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6 font-bold">
                    {{ session('error') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('client.jobs.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="e.g. Leaking pipe in the kitchen">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="Describe the problem...">{{ old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">City</label>
                    <select name="city_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                        <option value="">-- Select City --</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Budget (MAD)</label>
                    <input type="number" name="budget" value="{{ old('budget') }}" min="0" step="0.01"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400"
                        placeholder="e.g. 200">
                </div>

                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_urgent" id="is_urgent" {{ old('is_urgent') ? 'checked' : '' }}>
                    <label for="is_urgent" class="text-gray-700 font-medium">Mark as Urgent</label>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-medium mb-1">Image <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Post Job
                </button>
            </form>
        </div>
    </main>

</body>
</html>
