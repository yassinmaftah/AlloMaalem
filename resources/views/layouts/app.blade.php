<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allo Maalem - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-slate-900 font-sans">

    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <i class="fa-solid fa-helmet-safety text-yellow-500 text-2xl"></i>
                <span class="text-xl font-bold text-slate-800">Allo<span class="text-blue-700">Maalem</span></span>
            </a>

            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-600">
                    {{ Auth::user()->name ?? 'Guest' }}
                    <span class="text-xs bg-gray-100 px-2 py-1 rounded text-gray-500 uppercase ml-1">
                        {{ Auth::user()->role ?? '' }}
                    </span>
                </span>
            </div>
        </div>
    </nav>

    <main class="py-10 max-w-7xl mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>
