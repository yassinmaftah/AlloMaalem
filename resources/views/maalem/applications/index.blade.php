<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Apps - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Apps</h1>

        <div class="flex border-b border-gray-200 mb-8 gap-6 overflow-x-auto">
            <a href="{{ route('maalem.applications.index', ['tab' => 'pending']) }}" class="pb-3 font-semibold {{ $tab === 'pending' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500' }}">Pending</a>
            <a href="{{ route('maalem.applications.index', ['tab' => 'accepted']) }}" class="pb-3 font-semibold {{ $tab === 'accepted' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500' }}">Accepted (Active)</a>
            <a href="{{ route('maalem.applications.index', ['tab' => 'rejected']) }}" class="pb-3 font-semibold {{ $tab === 'rejected' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500' }}">Rejected</a>
            <a href="{{ route('maalem.applications.index', ['tab' => 'completed']) }}" class="pb-3 font-semibold {{ $tab === 'completed' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500' }}">Completed</a>
        </div>

        @if($apps->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                Nothing here right now.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($apps as $app)
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $app->job->title }}</h3>

                        @if($tab === 'pending')
                            <p class="text-sm text-gray-500 mb-4">My price: <span class="font-semibold">{{ $app->proposed_price }} MAD</span></p>
                            <div class="mt-auto flex gap-2">
                                <a href="{{ route('maalem.applications.edit', $app->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-2 px-4 rounded transition">Edit</a>
                                <button type="button" onclick="openPopup('{{ route('maalem.applications.destroy', $app->id) }}')" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">Delete</button>
                            </div>

                        @elseif($tab === 'accepted')
                            <div class="bg-green-50 p-3 rounded mb-4">
                                <p class="text-sm">Client: <span class="font-bold">{{ $app->job->user->name }}</span></p>
                                <p class="text-sm">Phone: <a href="tel:{{ $app->job->user->phone }}" class="font-bold underline">{{ $app->job->user->phone }}</a></p>
                            </div>
                            <div class="flex justify-between text-sm mb-4">
                                <span>📍 {{ $app->job->city->name }}</span>
                                <span class="font-bold">{{ $app->proposed_price }} MAD</span>
                            </div>
                            <span class="text-green-600 font-bold uppercase text-sm mt-auto">In Progress</span>

                        @elseif($tab === 'rejected')
                            <p class="text-sm text-red-500 font-bold mb-4">Application Rejected</p>
                            @if($app->job->status === 'open')
                                <form method="POST" action="{{ route('maalem.applications.reapply', $app->id) }}" class="mt-auto flex gap-2">
                                    @csrf
                                    <input type="number" name="price" value="{{ $app->proposed_price }}" class="border border-gray-300 rounded px-3 py-2 w-full">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Reapply</button>
                                </form>
                            @else
                                <p class="text-xs text-gray-400 mt-auto">Job is closed</p>
                            @endif

                        @elseif($tab === 'completed')
                            <p class="text-sm text-gray-500 mb-4">Final price: <span class="font-bold">{{ $app->proposed_price }} MAD</span></p>
                            @if($app->job->review)
                                <div class="bg-gray-50 p-3 rounded mt-auto">
                                    <p class="text-yellow-500 mb-1">
                                        @for($i=1; $i<=5; $i++)
                                            {{ $i <= $app->job->review->rating ? '⭐' : '☆' }}
                                        @endfor
                                    </p>
                                    <p class="text-sm text-gray-600">"{{ $app->job->review->comment }}"</p>
                                </div>
                            @else
                                <p class="text-xs text-gray-400 mt-auto">No review from client yet.</p>
                            @endif
                        @endif

                    </div>
                @endforeach
            </div>
        @endif

        <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
                <h2 class="text-xl font-bold mb-4">Delete Application</h2>
                <p class="text-gray-600 mb-6">Are you sure you want to delete this application?</p>

                <div class="flex justify-center gap-4">
                    <button onclick="closePopup()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded transition">Cancel</button>

                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition">Yes, Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        function openPopup(url) {
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('deleteModal').classList.add('hidden');
        }
    </script>
</body>
</html>
