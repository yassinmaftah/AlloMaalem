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
                    <form method="POST" action="{{ route('client.jobs.destroy', $job->id) }}" id="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" onclick="confirmDelete()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg transition">Delete</button>
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

            @if ($job->image)
                <div class="mt-4">
                    <img src="{{ Storage::url($job->image) }}" class="w-full max-h-72 object-cover rounded-lg">
                </div>
            @endif
        </div>

        <div>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Applications ({{ $job->applications->count() }})</h2>

            @if ($job->applications->isEmpty())
                <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                    No applications yet. Check back later!
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($job->applications as $app)
                        @php
                            $maalem = $app->user;
                            $avg = $maalem->reviewsReceived->avg('rating');
                            $stars = round($avg);
                        @endphp
                        <div class="bg-white rounded-lg shadow p-6 border border-gray-100">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

                                <div class="flex items-center gap-4">
                                    <img src="{{ $maalem->avatar ? Storage::url($maalem->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($maalem->name).'&background=1d4ed8&color=fff' }}"
                                        class="w-16 h-16 rounded-full object-cover border-2 border-blue-200">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $maalem->name }}</h3>
                                        <div class="text-yellow-400 text-sm">
                                            @for ($i = 1; $i <= 5; $i++)
                                                {{ $i <= $stars ? '⭐' : '☆' }}
                                            @endfor
                                            <span class="text-gray-500 ml-1">
                                                ({{ $maalem->reviewsReceived->count() }} reviews)
                                            </span>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-1">{{ $app->message }}</p>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <div class="text-2xl font-bold text-gray-900 mb-1">{{ number_format($app->proposed_price, 2) }} MAD</div>
                                    <span class="text-xs text-gray-400">Proposed price</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </main>

    <div id="delete-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg shadow-xl p-8 max-w-sm w-full">
            <h2 class="text-xl font-bold text-gray-800 mb-2">Delete this job?</h2>
            <p class="text-gray-600 mb-6">This action cannot be undone. All pending applications will also be deleted.</p>
            <div class="flex gap-3 justify-end">
                <button onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-5 rounded-lg transition">Cancel</button>
                <button onclick="document.getElementById('delete-form').submit()" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-5 rounded-lg transition">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>

</body>
</html>
