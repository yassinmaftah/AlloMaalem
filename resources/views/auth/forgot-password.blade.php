<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 md:p-12">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Forgot Password?</h1>
            <p class="text-gray-500 mt-1">Enter your email and we'll send you a 6-digit code.</p>
        </div>

        <form action="{{ route('password.send.code') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('email') border-red-500 @enderror"
                       placeholder="name@example.com">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">
                Send Code
            </button>
        </form>

        <p class="text-center mt-6 text-gray-600">
            Remember your password? <a href="{{ route('login') }}" class="text-blue-700 font-bold hover:underline">Login</a>
        </p>
    </div>

</body>
</html>
