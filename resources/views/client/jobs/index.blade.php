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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-900">Fix my Kitchen Pipe</h2>
                        <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded">Open</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        Water is leaking under the sink. I need a plumber to come fix it as soon as possible.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">📍 Casablanca</span>
                        <span>🧰 Plumber</span>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <a href="{{ route('client.jobs.show', 1) }}" class="block w-full text-center bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white font-semibold py-2 px-4 rounded transition border border-blue-200 hover:border-blue-600">
                        See Applications (3)
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-900">Paint the Bedroom</h2>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-2.5 py-0.5 rounded">In Progress</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        Need an experienced painter to paint a 4x4m bedroom in white. I already bought the paint.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">📍 Rabat</span>
                        <span>🎨 Painter</span>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <a href="{{ route('client.jobs.show', 2) }}" class="block w-full text-center bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold py-2 px-4 rounded transition">
                        View Details
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden opacity-75">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <h2 class="text-xl font-bold text-gray-900">Install Ceiling Fan</h2>
                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-2.5 py-0.5 rounded">Completed</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        Need an electrician to install a new ceiling fan in the living room.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-4">
                        <span class="mr-4">📍 Marrakech</span>
                        <span>⚡ Electrician</span>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-100">
                    <a href="{{ route('client.jobs.show', 3) }}" class="block w-full text-center bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold py-2 px-4 rounded transition">
                        View Details
                    </a>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
