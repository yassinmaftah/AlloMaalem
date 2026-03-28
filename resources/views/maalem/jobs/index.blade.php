<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Work - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Find Work</h1>
        <p class="text-gray-500 mb-8">Find the best jobs in your city.</p>

        <div class="bg-white p-4 rounded-lg shadow mb-8 border border-gray-200">
            <form method="GET" action="{{ route('maalem.jobs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <select name="city_id" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">All Cities</option>
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Min Budget (DH)</label>
                    <input type="number" name="budget" value="{{ request('budget') }}" class="w-full border border-gray-300 rounded-lg px-3 py-2">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">Search</button>
                    <a href="{{ route('maalem.jobs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg transition text-center">Clear</a>
                </div>
            </form>
        </div>

        @if($jobs->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                No jobs found. Try to clear filters.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition flex flex-col">
                        <div class="h-40 relative">
                            <img src="{{ $job->image ? Storage::url($job->image) : 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=200&fit=crop' }}" class="w-full h-full object-cover">
                            @if($job->is_urgent)
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">URGENT</span>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">{{ $job->title }}</h2>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $job->description }}</p>

                            <div class="flex justify-between items-center mb-4 text-sm">
                                <span class="text-gray-600">📍 {{ $job->city->name }}</span>
                                <span class="text-green-600 font-bold">{{ number_format($job->budget, 2) }} MAD</span>
                            </div>

                            <a href="{{ route('maalem.jobs.show', $job->id) }}" class="mt-auto block text-center bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $jobs->links() }}
            </div>
        @endif
    </main>
</body>
</html>
