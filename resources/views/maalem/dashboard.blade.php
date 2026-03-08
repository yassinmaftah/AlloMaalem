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
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-green-600">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">
                Hello Maalem {{ Auth::user()->name }}!
            </h1>
            <p class="text-gray-600 text-lg mb-6">
                Ready to work? Here you will see a list of available jobs from clients in your city.
            </p>
            <div class="bg-green-50 text-green-700 p-4 rounded-md border border-green-200">
                Soon, job posts will appear right here!
            </div>
        </div>
    </main>

</body>
</html>
