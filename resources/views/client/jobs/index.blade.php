<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Posted Jobs</h1>
            <a href="{{ route('client.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow transition">
                + Post a New Job
            </a>
        </div>

        @if ($jobs->isEmpty())
            <div class="text-center text-gray-500 py-20">
                <p class="text-xl mb-4">You haven't posted any jobs yet.</p>
                <a href="{{ route('client.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Post your first Job</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($jobs as $job)
                    @php
                        $statusColors = [
                            'open'        => 'bg-green-100 text-green-800',
                            'in_progress' => 'bg-yellow-100 text-yellow-800',
                            'completed'   => 'bg-gray-100 text-gray-800',
                        ];
                        $statusColor = $statusColors[$job->status] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden {{ $job->status === 'completed' ? 'opacity-75' : '' }}">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h2 class="text-xl font-bold text-gray-900">{{ $job->title }}</h2>
                                <div class="flex flex-col items-end gap-1">
                                    <span class="{{ $statusColor }} text-xs font-semibold px-2.5 py-0.5 rounded capitalize">
                                        {{ str_replace('_', ' ', $job->status) }}
                                    </span>
                                    @if ($job->is_urgent)
                                        <span class="bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded">🔥 Urgent</span>
                                    @endif
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $job->description }}</p>
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <span class="mr-4">📍 {{ $job->city->name }}</span>
                                <span>🧰 {{ $job->category->name }}</span>
                            </div>
                            <div class="text-sm text-gray-500">💰 {{ number_format($job->budget, 2) }} MAD</div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                            <a href="{{ route('client.jobs.show', $job->id) }}" class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold py-2 px-4 rounded transition border border-blue-200 hover:border-blue-600">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>
