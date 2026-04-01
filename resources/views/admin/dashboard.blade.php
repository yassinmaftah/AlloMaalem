<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-500">Welcome back! Here is what is happening on Allo Maalem today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Clients</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalClients }}</h2>
                </div>
                <div class="text-blue-500 text-4xl">👤</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Total Maalems</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $totalMaalems }}</h2>
                </div>
                <div class="text-orange-500 text-4xl">🛠️</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Premium Users</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $premiumUsers }}</h2>
                </div>
                <div class="text-yellow-500 text-4xl">⭐</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Open Jobs</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $openJobs }}</h2>
                </div>
                <div class="text-green-500 text-4xl">📢</div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500 flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-1">Completed Jobs</p>
                    <h2 class="text-3xl font-bold text-gray-800">{{ $completedJobs }}</h2>
                </div>
                <div class="text-purple-500 text-4xl">✅</div>
            </div>

        </div>
    </main>
</body>
</html>
