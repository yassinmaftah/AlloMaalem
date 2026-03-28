<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Missions - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Active Missions</h1>

        @if($applications->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                You have no active missions right now.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($applications as $app)
                    <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500 flex flex-col">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $app->job->title }}</h2>

                        <div class="bg-green-50 p-4 rounded-lg mb-6 flex-1">
                            <p class="text-sm text-green-900 mb-2"><strong>Client:</strong> {{ $app->job->user->name }}</p>
                            <p class="text-sm text-green-900"><strong>Phone:</strong> <a href="tel:{{ $app->job->user->phone }}" class="underline font-bold">{{ $app->job->user->phone }}</a></p>
                        </div>

                        <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                            <span class="text-lg font-bold text-gray-900">{{ number_format($app->proposed_price, 2) }} MAD</span>
                            <span class="text-xs text-gray-500 uppercase font-bold tracking-wider">In Progress</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
