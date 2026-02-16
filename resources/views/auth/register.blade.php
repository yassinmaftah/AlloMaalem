<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center items-center bg-yellow-600 text-white p-10">
            <h2 class="text-3xl font-bold mb-4">Join Us Today</h2>
            <p class="text-center text-lg italic opacity-90">
                "Whether you are a Client looking for help or a Maalem looking for work, we have a place for you."
            </p>
        </div>

        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Create Account</h1>
                <p class="text-gray-500">It takes less than a minute</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 gap-4 mb-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="client" class="peer sr-only" {{ old('role', 'client') == 'client' ? 'checked' : '' }}>
                        <div class="p-3 border-2 rounded-lg text-center peer-checked:border-blue-800 peer-checked:bg-blue-50 text-gray-500 peer-checked:text-blue-800 hover:bg-gray-50">
                            <i class="fa-solid fa-user text-xl mb-1"></i>
                            <div class="font-bold text-sm">I'm a Client</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="maalem" class="peer sr-only" {{ old('role') == 'maalem' ? 'checked' : '' }}>
                        <div class="p-3 border-2 rounded-lg text-center peer-checked:border-yellow-600 peer-checked:bg-yellow-50 text-gray-500 peer-checked:text-yellow-600 hover:bg-gray-50">
                            <i class="fa-solid fa-helmet-safety text-xl mb-1"></i>
                            <div class="font-bold text-sm">I'm a Maalem</div>
                        </div>
                    </label>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Full Name</label>
                    <input type="text" name="name" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="Ahmed Benali" value="{{ old('name') }}">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                    <input type="email" name="email" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="email@example.com" value="{{ old('email') }}">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input type="password" name="password" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="••••••••">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600" placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">
                    Register Now
                </button>
            </form>

            <p class="text-center mt-6 text-gray-600">
                Already have an account? <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">Login</a>
            </p>
        </div>

    </div>

</body>
</html>
