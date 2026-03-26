<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maalem Dashboard - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Hello Maalem, {{ Auth::user()->name }}!</h1>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-400">
                <p class="text-gray-500 text-sm mb-1">Pending Applications</p>
                <p class="text-4xl font-bold text-yellow-500">{{ $pendingApplications }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
                <p class="text-gray-500 text-sm mb-1">Active Jobs</p>
                <p class="text-4xl font-bold text-green-600">{{ $activeJobs }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
                <p class="text-gray-500 text-sm mb-1">Average Rating</p>
                <p class="text-4xl font-bold text-blue-600">{{ $averageRating ? number_format($averageRating, 1) : 'N/A' }}</p>
            </div>
        </div>
    </main>

</body>
</html>
