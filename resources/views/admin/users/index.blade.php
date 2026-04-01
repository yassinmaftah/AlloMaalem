<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Manage All Users</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-8 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <form method="GET" action="{{ route('admin.users.index') }}" class="flex gap-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users by name..." class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Search
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-6 rounded-lg transition text-center flex items-center">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        @if($users->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500 font-semibold">
                No users found.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($users as $user)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col relative overflow-hidden">

                        <div class="absolute top-4 right-4">
                            @if($user->is_baned == 1)
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">BANNED</span>
                            @else
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">ACTIVE</span>
                            @endif
                        </div>

                        <div class="text-center mb-4 mt-2">
                            <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=374151&color=fff' }}"
                                 class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-4 border-gray-100 shadow-sm" alt="avatar">

                            <h2 class="text-lg font-bold text-gray-900">{{ $user->name }}</h2>
                            <span class="bg-gray-100 text-gray-600 text-xs font-bold px-2 py-1 rounded uppercase mt-1 inline-block">
                                {{ $user->role }}
                            </span>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-3 mb-6 text-sm flex-1">
                            @if($user->role === 'maalem')
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-500">Rating:</span>
                                    <span class="font-bold text-yellow-500">⭐
                                        {{-- Simple fallback if no rating system is fully calculated yet --}}
                                        4.5
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Completed Apps:</span>
                                    <span class="font-bold text-gray-800">
                                        {{ $user->applications ? $user->applications->where('status', 'completed')->count() : 0 }}
                                    </span>
                                </div>

                            @elseif($user->role === 'client')
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-500">Jobs Posted:</span>
                                    <span class="font-bold text-gray-800">
                                        {{ $user->jobs ? $user->jobs->count() : 0 }}
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Completed Jobs:</span>
                                    <span class="font-bold text-green-600">
                                        {{ $user->jobs ? $user->jobs->where('status', 'completed')->count() : 0 }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="mt-auto">
                            @if($user->is_baned == 0)
                                <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full bg-red-100 hover:bg-red-200 text-red-700 font-bold py-2 px-4 rounded transition border border-red-200">
                                        Ban User
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition">
                                        Unban User
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
