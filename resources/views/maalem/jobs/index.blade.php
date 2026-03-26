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
