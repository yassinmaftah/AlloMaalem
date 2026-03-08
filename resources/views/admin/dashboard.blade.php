<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    @include('navbars.adminnav')

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-red-600">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Admin Control Panel
            </h1>
            <p class="text-gray-600 text-lg mb-6">
                Welcome back, Boss. From here you can manage all users and monitor the platform's activity.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-gray-50 p-4 rounded border border-gray-200 text-center">
                    <span class="block text-2xl font-bold text-gray-800">142</span>
                    <span class="text-sm text-gray-500">Total Users</span>
                </div>
                <div class="bg-gray-50 p-4 rounded border border-gray-200 text-center">
                    <span class="block text-2xl font-bold text-gray-800">56</span>
                    <span class="text-sm text-gray-500">Active Jobs</span>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
