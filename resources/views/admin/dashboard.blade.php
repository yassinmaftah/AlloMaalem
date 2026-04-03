<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Data Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white min-h-screen text-gray-900 font-sans">
    @include('navbars.adminnav')

    <main class="w-full px-4 py-6">

        <div class="flex gap-4 mb-6 text-sm font-mono border-b border-gray-300 pb-4">
            <div class="pr-4 border-r border-gray-300"><strong>Admin:</strong> {{ $stats['total_admins'] }}</div>
            <div class="pr-4 border-r border-gray-300"><strong>Clients:</strong> {{ $stats['total_clients'] }}</div>
            <div class="pr-4 border-r border-gray-300"><strong>Maalems:</strong> {{ $stats['total_maalems'] }}</div>
            <div class="pr-4 border-r border-gray-300"><strong>Premium:</strong> {{ $stats['premium_users'] }}</div>
            <div><strong>Open Jobs:</strong> {{ $stats['open_jobs'] }}</div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <div>
                <h2 class="text-sm font-bold uppercase tracking-widest mb-2 text-gray-600">Sheet: Recent_Users</h2>
                <div class="overflow-x-auto border border-gray-400">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-400">
                                <th class="p-2 border-r border-gray-400 font-bold w-12 text-center">ID</th>
                                <th class="p-2 border-r border-gray-400 font-bold">NAME</th>
                                <th class="p-2 border-r border-gray-400 font-bold">ROLE</th>
                                <th class="p-2 border-r border-gray-400 font-bold">STATUS</th>
                                <th class="p-2 font-bold">JOINED</th>
                            </tr>
                        </thead>
                        <tbody class="font-mono text-xs">
                            @foreach($recentUsers as $user)
                                <tr class="border-b border-gray-300 hover:bg-yellow-50">
                                    <td class="p-2 border-r border-gray-300 text-center text-gray-500">{{ $user->id }}</td>
                                    <td class="p-2 border-r border-gray-300">{{ $user->name }}</td>
                                    <td class="p-2 border-r border-gray-300">{{ strtoupper($user->role) }}</td>
                                    <td class="p-2 border-r border-gray-300">
                                        @if($user->is_baned)
                                            BANNED
                                        @elseif($user->verification_status == 'verified')
                                            PREMIUM
                                        @else
                                            NORMAL
                                        @endif
                                    </td>
                                    <td class="p-2 text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h2 class="text-sm font-bold uppercase tracking-widest mb-2 text-gray-600">Sheet: Platform_Jobs</h2>
                <div class="overflow-x-auto border border-gray-400">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b border-gray-400">
                                <th class="p-2 border-r border-gray-400 font-bold w-12 text-center">ID</th>
                                <th class="p-2 border-r border-gray-400 font-bold">CLIENT</th>
                                <th class="p-2 border-r border-gray-400 font-bold">TITLE</th>
                                <th class="p-2 border-r border-gray-400 font-bold">BUDGET</th>
                                <th class="p-2 font-bold">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="font-mono text-xs">
                            @foreach($recentJobs as $job)
                                <tr class="border-b border-gray-300 hover:bg-yellow-50">
                                    <td class="p-2 border-r border-gray-300 text-center text-gray-500">{{ $job->id }}</td>
                                    <td class="p-2 border-r border-gray-300 truncate max-w-[100px]">{{ $job->user->name }}</td>
                                    <td class="p-2 border-r border-gray-300 truncate max-w-[150px]">{{ $job->title }}</td>
                                    <td class="p-2 border-r border-gray-300">{{ $job->budget }} MAD</td>
                                    <td class="p-2">{{ strtoupper($job->status) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
