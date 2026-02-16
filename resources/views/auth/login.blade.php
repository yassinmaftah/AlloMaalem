<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-4xl rounded-2xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        <div class="hidden md:flex flex-col justify-center items-center bg-blue-900 text-white p-10">
            <h2 class="text-3xl font-bold mb-4">Welcome Back!</h2>
            <p class="text-center text-lg italic opacity-90">
                "Finding a trusted Maalem has never been easier. Build your home with confidence."
            </p>
        </div>

        <div class="p-8 md:p-12 flex flex-col justify-center">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Sign In</h1>
                <p class="text-gray-500">Access your dashboard</p>
            </div>

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                    <input name="email"
                           value="{{ old('email') }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                           placeholder="name@example.com" >
                    @error('email')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Password</label>
                    <input name="password" type="password"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                           placeholder="••••••••" >
                    @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">
                    Login
                </button>
            </form>

            <p class="text-center mt-6 text-gray-600">
                New here? <a href="{{ route('register') }}" class="text-blue-700 font-bold hover:underline">Create Account</a>
            </p>
        </div>

    </div>

</body>
</html>
