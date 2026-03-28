<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Jobs - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">My Jobs</h1>
                <p class="text-gray-500 mt-1">You have <span class="font-semibold text-blue-600">{{ $counts['open'] }}</span> active job postings</p>
            </div>
            <a href="{{ route('client.jobs.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-lg shadow transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Post a New Job
            </a>
        </div>

        <div class="flex gap-2 mb-8 border-b border-gray-200 overflow-x-auto">
            @php
                $tabs = [
                    'all'         => 'All Jobs',
                    'open'        => 'Open',
                    'in_progress' => 'In Progress',
                    'completed'   => 'Completed',
                ];
            @endphp
            @foreach($tabs as $key => $label)
                <a href="{{ route('client.jobs.index', ['tab' => $key]) }}"
                   class="whitespace-nowrap pb-3 px-4 text-sm font-semibold border-b-2 transition
                          {{ $tab === $key ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                    {{ $label }}
                    <span class="ml-1 {{ $tab === $key ? 'bg-blue-100 text-blue-600' : 'bg-gray-100 text-gray-500' }} text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $counts[$key] }}
                    </span>
                </a>
            @endforeach
        </div>

        @if($jobs->isEmpty())
            <div class="text-center text-gray-500 py-20">
                <p class="text-xl mb-4">No jobs found in this category.</p>
                <a href="{{ route('client.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">Post a Job</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($jobs as $job)
                    @php
                        $categoryImages = [
                            1  => 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?w=400&h=200&fit=crop',
                            2  => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=400&h=200&fit=crop',
                            3  => 'https://images.unsplash.com/photo-1562259949-e8e7689d7828?w=400&h=200&fit=crop',
                            4  => 'https://images.unsplash.com/photo-1504148455328-c376907d081c?w=400&h=200&fit=crop',
                            5  => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=400&h=200&fit=crop',
                            6  => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400&h=200&fit=crop',
                            7  => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=400&h=200&fit=crop',
                            8  => 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=400&h=200&fit=crop',
                            9  => 'https://images.unsplash.com/photo-1631545806609-3b8e0b0b0b0b?w=400&h=200&fit=crop',
                            10 => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=400&h=200&fit=crop',
                        ];
                        $headerImage = $job->image
                            ? Storage::url($job->image)
                            : ($categoryImages[$job->category_id] ?? 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?w=400&h=200&fit=crop');

                        $badgeClass = match($job->status) {
                            'open'        => 'bg-green-500 text-white',
                            'in_progress' => 'bg-blue-500 text-white',
                            'completed'   => 'bg-gray-400 text-white',
                            default       => 'bg-gray-400 text-white',
                        };
                        $badgeLabel = match($job->status) {
                            'open'        => 'Open',
                            'in_progress' => 'In Progress',
                            'completed'   => 'Completed',
                            default       => $job->status,
                        };
                    @endphp

                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col hover:shadow-md transition">

                        <div class="relative h-40">
                            <img src="{{ $headerImage }}" alt="{{ $job->title }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                            <span class="absolute top-3 left-3 {{ $badgeClass }} text-xs font-bold px-3 py-1 rounded-full shadow">
                                {{ $badgeLabel }}
                            </span>
                            @if($job->is_urgent)
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                    🔥 Urgent
                                </span>
                            @endif
                        </div>

                        <div class="p-5 flex flex-col flex-1">
                            <h2 class="text-lg font-bold text-gray-900 mb-1 line-clamp-1">{{ $job->title }}</h2>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $job->description }}</p>

                            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                                <span>📍 {{ $job->city->name }}</span>
                                <span>🧰 {{ $job->category->name }}</span>
                            </div>

                            <div class="flex items-center justify-between text-xs text-gray-400 mb-4">
                                <span>💰 {{ number_format($job->budget, 2) }} MAD</span>
                                <span>{{ $job->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="mt-auto flex items-center gap-2">
                                @if($job->status === 'open' || $job->status === 'in_progress')
                                    <a href="{{ route('client.jobs.show', $job->id) }}"
                                       class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2 px-3 rounded-lg transition">
                                        See Applications ({{ $job->applications->count() }})
                                    </a>
                                    @if($job->status === 'open')
                                        <a href="{{ route('client.jobs.edit', $job->id) }}"
                                           class="p-2 border border-gray-200 hover:bg-gray-100 rounded-lg transition text-gray-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M9 13l6.586-6.586a2 2 0 112.828 2.828L11.828 15.828a2 2 0 01-1.414.586H9v-2a2 2 0 01.586-1.414z"/>
                                            </svg>
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('client.jobs.show', $job->id) }}"
                                       class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm font-semibold py-2 px-3 rounded-lg transition">
                                        View Job History
                                    </a>
                                    <button class="p-2 border border-gray-200 hover:bg-gray-100 rounded-lg transition text-gray-500">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                            <circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/>
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $jobs->links() }}
            </div>
        @endif

    </main>

</body>
</html>
