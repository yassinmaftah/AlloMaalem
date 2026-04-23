<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center p-4">

    <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-8 md:p-12">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Set New Password</h1>
            <p class="text-gray-500 mt-1">Almost done! Enter your new password.</p>
        </div>

        <form action="{{ route('password.reset') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="code" value="{{ $code }}">

            <x-alert />

            <div>
                <label class="block text-gray-700 font-medium mb-1">New Password</label>
                <input type="password" name="password"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('password') border-red-500 @enderror"
                       placeholder="••••••••">

            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
                       placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-blue-900 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">
                Update Password
            </button>
        </form>
    </div>

</body>
</html>
