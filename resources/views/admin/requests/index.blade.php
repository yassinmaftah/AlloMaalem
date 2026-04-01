<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Requests - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Premium Account Requests</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-6 font-bold">
                {{ session('success') }}
            </div>
        @endif

        @if($users->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500 font-semibold">
                There are no pending requests right now.
            </div>
        @else
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Name</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Email</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm">Role</th>
                            <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4 font-bold text-gray-800">{{ $user->name }}</td>
                                <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-2 py-1 rounded uppercase">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex justify-center gap-2">
                                    <form method="POST" action="{{ route('admin.users.approve', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded transition">Approve</button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.users.reject', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded transition">Reject</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </main>
</body>
</html>
