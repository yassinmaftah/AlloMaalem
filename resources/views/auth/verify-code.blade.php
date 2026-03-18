<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Code - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 md:p-12">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Enter the Code</h1>
            <p class="text-gray-500 mt-1">We sent a 6-digit code to <span class="font-semibold text-gray-700">{{ $email }}</span></p>
        </div>

        <form action="{{ route('password.verify.code') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label class="block text-gray-700 font-medium mb-1">6-Digit Code</label>
                <input type="text" name="code" value="{{ old('code') }}" maxlength="6"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 text-center text-2xl tracking-widest @error('code') border-red-500 @enderror"
                       placeholder="______">
                @error('code')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">
                Verify Code
            </button>
        </form>

        <p class="text-center mt-6 text-gray-600">
            <a href="{{ route('password.email.form') }}" class="text-blue-700 font-bold hover:underline">← Try another email</a>
        </p>
    </div>

</body>
</html>
