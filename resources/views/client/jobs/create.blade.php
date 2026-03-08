<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post a New Job - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @include('navbars.clientnav')

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="mb-6">
            <a href="{{ route('client.jobs.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                &larr; Back to My Jobs
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-blue-600">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Post a New Job</h1>
            <p class="text-gray-600 mb-8">Describe what you need help with so the right Maalem can find you.</p>

            <form method="POST" action="#">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Job Title</label>
                    <input type="text" name="title" class="w-full border border-gray-300 p-3 rounded focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Fix leaking pipe under kitchen sink">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Speciality Needed</label>
                        <select name="speciality" class="w-full border border-gray-300 p-3 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select a profession...</option>
                            <option value="Plumber">Plumber (Plombier)</option>
                            <option value="Electrician">Electrician (Électricien)</option>
                            <option value="Painter">Painter (Peintre)</option>
                            <option value="Carpenter">Carpenter (Menuisier)</option>
                            <option value="Mason">Mason (Maçon)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">City</label>
                        <select name="city" class="w-full border border-gray-300 p-3 rounded focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Where is the job?</option>
                            <option value="Casablanca">Casablanca</option>
                            <option value="Rabat">Rabat</option>
                            <option value="Marrakech">Marrakech</option>
                            <option value="Tangier">Tangier</option>
                            <option value="Agadir">Agadir</option>
                        </select>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Description</label>
                    <textarea name="description" rows="5" class="w-full border border-gray-300 p-3 rounded focus:ring-blue-500 focus:border-blue-500" placeholder="Give more details about the problem, the materials needed, etc..."></textarea>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded shadow-lg transition text-lg">
                    Publish Job Post
                </button>
            </form>
        </div>
    </main>

</body>
</html>
