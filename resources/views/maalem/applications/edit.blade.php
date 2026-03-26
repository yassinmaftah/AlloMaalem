<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Application - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.maalemnav')

    <main class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <a href="{{ route('maalem.applications.index') }}" class="text-green-600 hover:text-green-800 font-medium mb-6 inline-block">
            &larr; Back to My Applications
        </a>

        <div class="bg-white shadow-md rounded-lg p-6 border-t-4 border-green-500">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Edit Application</h1>
            <p class="text-gray-500 text-sm mb-6">Job: <span class="font-semibold text-gray-700">{{ $application->job->title }}</span></p>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('maalem.applications.update', $application->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Proposed Price (DH)</label>
                    <input type="number" name="proposed_price" step="0.01" min="0"
                           value="{{ old('proposed_price', $application->proposed_price) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">
                    @error('proposed_price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Message</label>
                    <textarea name="message" rows="4"
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400">{{ old('message', $application->message) }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition">
                    Update Application
                </button>
            </form>
        </div>

    </main>

</body>
</html>
