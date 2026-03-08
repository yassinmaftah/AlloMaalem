<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-blue-600">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Welcome to your Dashboard, {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-600 text-lg mb-6">
                This is where you will post your jobs and find the best artisans in your city.
            </p>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition">
                + Post your first Job
            </button>
        </div>
    </main>

</body>
</html>
