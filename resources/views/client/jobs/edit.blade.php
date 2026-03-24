<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-2xl mx-auto px-4 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-yellow-400">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Job</h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('client.jobs.update', $job->id) }}">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Title</label>
                    <input type="text" name="title" value="{{ old('title', $job->title) }}"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-yellow-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Description</label>
                    <textarea name="description" rows="4"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-yellow-400">{{ old('description', $job->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Category</label>
                    <select name="category_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-yellow-400">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $job->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">City</label>
                    <select name="city_id" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-yellow-400">
                        <option value="">-- Select City --</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" {{ old('city_id', $job->city_id) == $city->id ? 'selected' : '' }}>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-1">Budget (MAD)</label>
                    <input type="number" name="budget" value="{{ old('budget', $job->budget) }}" min="0" step="0.01"
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring focus:border-yellow-400">
                </div>

                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_urgent" id="is_urgent" {{ old('is_urgent', $job->is_urgent) ? 'checked' : '' }}>
                    <label for="is_urgent" class="text-gray-700 font-medium">Mark as Urgent</label>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-6 rounded-lg transition">
                        Save Changes
                    </button>
                    <a href="{{ route('client.jobs.show', $job->id) }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-6 rounded-lg transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>
