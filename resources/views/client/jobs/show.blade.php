<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-6 flex justify-between items-center">
            <a href="{{ route('client.jobs.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                &larr; Back to My Jobs
            </a>
            @if ($job->status === 'open')
                <div class="flex gap-2">
                    <a href="{{ route('client.jobs.edit', $job->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg transition">Edit</a>
                    <form method="POST" action="{{ route('client.jobs.destroy', $job->id) }}" onsubmit="return confirm('Are you sure you want to delete this job?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">Delete</button>
                    </form>
                </div>
            @endif
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">{{ session('error') }}</div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 mb-8 border-l-4 border-blue-600">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
                    <div class="flex items-center text-sm text-gray-500 mb-4 space-x-4">
                        <span>📍 {{ $job->city->name }}</span>
                        <span>🧰 {{ $job->category->name }}</span>
                        <span>📅 {{ $job->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2">
                    @php
                        $statusColors = [
                            'open'        => 'bg-green-100 text-green-800',
                            'in_progress' => 'bg-yellow-100 text-yellow-800',
                            'completed'   => 'bg-gray-100 text-gray-800',
                        ];
                    @endphp
                    <span class="{{ $statusColors[$job->status] }} text-sm font-semibold px-3 py-1 rounded-full capitalize">
                        {{ str_replace('_', ' ', $job->status) }}
                    </span>
                    @if ($job->is_urgent)
                        <span class="bg-red-100 text-red-700 text-sm font-semibold px-3 py-1 rounded-full">🔥 Urgent</span>
                    @endif
                </div>
            </div>
            <div class="border-t border-gray-200 pt-4 mt-2">
                <h3 class="text-lg font-bold text-gray-800 mb-2">Description:</h3>
                <p class="text-gray-700 leading-relaxed">{{ $job->description }}</p>
            </div>
            <div class="mt-4 text-gray-700 font-semibold">💰 Budget: {{ number_format($job->budget, 2) }} MAD</div>
        </div>

        <div>
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Applications (2)</h2>

                <div class="mt-4 md:mt-0 flex space-x-2">
                    <select class="border border-gray-300 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">Sort by Price</option>
                        <option value="low">Lowest Price First</option>
                        <option value="high">Highest Price First</option>
                    </select>
                    <select class="border border-gray-300 rounded px-3 py-2 text-sm focus:ring-blue-500 focus:border-blue-500 bg-white">
                        <option value="">Sort by Rating</option>
                        <option value="top">Top Rated First</option>
                    </select>
                </div>
            </div>

            <div class="space-y-4">

                <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row justify-between items-center border border-gray-100 hover:shadow-md transition">

                    <div class="flex items-center w-full md:w-auto mb-4 md:mb-0">
                        <img src="https://ui-avatars.com/api/?name=Hassan+M&color=7F9CF5&background=EBF4FF" alt="Avatar" class="h-16 w-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Hassan M.</h3>
                            <p class="text-sm text-gray-500 mb-1">Expert Plumber • Casablanca</p>
                            <div class="flex items-center text-yellow-500 text-sm">
                                ⭐⭐⭐⭐⭐ <span class="text-gray-600 ml-1">(4.8 - 12 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-auto flex flex-col items-end">
                        <div class="text-2xl font-bold text-gray-900 mb-2">150 DH</div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded transition">
                                Decline
                            </button>
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
                                Accept Maalem
                            </button>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow p-6 flex flex-col md:flex-row justify-between items-center border border-gray-100 hover:shadow-md transition">

                    <div class="flex items-center w-full md:w-auto mb-4 md:mb-0">
                        <img src="https://ui-avatars.com/api/?name=Karim+B&color=7F9CF5&background=EBF4FF" alt="Avatar" class="h-16 w-16 rounded-full mr-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">Karim B.</h3>
                            <p class="text-sm text-gray-500 mb-1">Plumber • Casablanca</p>
                            <div class="flex items-center text-yellow-500 text-sm">
                                ⭐⭐⭐⭐ <span class="text-gray-600 ml-1">(4.2 - 5 reviews)</span>
                            </div>
                        </div>
                    </div>

                    <div class="w-full md:w-auto flex flex-col items-end">
                        <div class="text-2xl font-bold text-gray-900 mb-2">100 DH</div>
                        <div class="flex space-x-2">
                            <button class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-2 px-4 rounded transition">
                                Decline
                            </button>
                            <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition">
                                Accept Maalem
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
