<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Reviews - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    @include('navbars.maalemnav')

    <main class="max-w-7xl mx-auto px-4 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">My Reviews</h1>

        @if($reviews->isEmpty())
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                You have no reviews yet.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($reviews as $review)
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-gray-900">{{ $review->reviewer->name }}</h3>
                                <p class="text-xs text-gray-500">{{ $review->job->title }}</p>
                            </div>
                            <div class="text-yellow-500">
                                @for($i=1; $i<=5; $i++)
                                    {{ $i <= $review->rating ? '⭐' : '☆' }}
                                @endfor
                            </div>
                        </div>
                        <p class="text-gray-700 text-sm">"{{ $review->comment }}"</p>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>
