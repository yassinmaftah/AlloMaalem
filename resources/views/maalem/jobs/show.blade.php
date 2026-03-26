<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.maalemnav')

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <a href="{{ route('maalem.jobs.index') }}" class="text-green-600 hover:text-green-800 font-medium mb-6 inline-block">
            &larr; Back to Available Jobs
        </a>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 mb-8 border-l-4 border-green-500">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold text-gray-900">{{ $job->title }}</h1>
                @if($job->is_urgent)
                    <span class="bg-red-100 text-red-700 text-sm font-semibold px-3 py-1 rounded-full">🔥 Urgent</span>
                @endif
            </div>

            <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                <span>📍 {{ $job->city->name }}</span>
                <span>🧰 {{ $job->category->name }}</span>
                <span>👤 {{ $job->user->name }}</span>
            </div>

            <p class="text-gray-700 leading-relaxed mb-4">{{ $job->description }}</p>

            <div class="text-gray-800 font-semibold text-lg">💰 Budget: {{ number_format($job->budget, 2) }} DH</div>

            @if($job->image)
                <div class="mt-4">
                    <img src="{{ Storage::url($job->image) }}" class="w-full max-h-72 object-cover rounded-lg">
                </div>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Apply for this Job</h2>

            @if($alreadyApplied)
                <div class="bg-yellow-50 border border-yellow-300 text-yellow-700 p-4 rounded-lg text-center font-semibold">
                    You have already applied to this job.
                </div>
            @else
                <form method="POST" action="{{ route('maalem.jobs.apply', $job->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Your Proposed Price (DH)</label>
                        <input type="number" name="proposed_price" step="0.01" min="0"
                               value="{{ old('proposed_price') }}"
                               class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                        @error('proposed_price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Message to Client</label>
                        <textarea name="message" rows="4"
                                  class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition">
                        Submit Application
                    </button>
                </form>
            @endif
        </div>

    </main>

</body>
</html>
