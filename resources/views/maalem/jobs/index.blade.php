<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Jobs - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Available Jobs</h1>

        <div class="bg-white p-4 rounded-lg shadow mb-8 border border-gray-200">
            <form method="GET" action="{{ route('maalem.jobs.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
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

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">Filter</button>
                    <a href="{{ route('maalem.jobs.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg transition text-center">Clear</a>
                </div>
            </form>
        </div>
        
        @if($jobs->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                No open jobs available right now.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    <div class="bg-white rounded-lg shadow p-6 flex flex-col justify-between border-t-4 border-green-500">
                        <div>
                            <h2 class="text-xl font-bold text-gray-800 mb-3">{{ $job->title }}</h2>
                            <div class="space-y-1 text-sm text-gray-600 mb-4">
                                <p><span class="font-semibold">Category:</span> {{ $job->category->name }}</p>
                                <p><span class="font-semibold">City:</span> {{ $job->city->name }}</p>
                                <p><span class="font-semibold">Budget:</span> {{ number_format($job->budget, 2) }} DH</p>
                                <p><span class="font-semibold">Posted by:</span> {{ $job->user->name }}</p>
                            </div>
                        </div>
                        <a href="{{ route('maalem.jobs.show', $job->id) }}"
                           class="mt-2 block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                            View Details
                        </a>
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
