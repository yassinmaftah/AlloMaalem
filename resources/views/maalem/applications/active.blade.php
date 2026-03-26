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

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Active Missions</h1>

        @if($applications->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                You have no active missions right now.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($applications as $application)
                    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">{{ $application->job->title }}</h2>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-semibold">Client:</span> {{ $application->job->user->name }}</p>
                            <p><span class="font-semibold">Phone:</span> {{ $application->job->user->phone }}</p>
                            <p><span class="font-semibold">Agreed Price:</span> {{ number_format($application->proposed_price, 2) }} DH</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>
