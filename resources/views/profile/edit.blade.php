<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Allo Maalem</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

    @if(auth()->user()->role === 'client')
        @include('navbars.clientnav')
    @elseif(auth()->user()->role === 'maalem')
        @include('navbars.maalemnav')
    @else
        @include('navbars.adminnav')
    @endif

    <main class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(auth()->user()->role !== "admin")
        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-yellow-500 mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Premium Account</h2>


                @if(auth()->user()->verification_status === 'verified')
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg flex items-center gap-3">
                        <span class="text-2xl">⭐</span>
                        <div>
                            <p class="font-bold">You are a Premium Verified User!</p>
                            <p class="text-sm">You have no limits on jobs or applications.</p>
                        </div>
                    </div>
                @elseif(auth()->user()->verification_status === 'pending')
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                        <p class="font-bold">⏳ Your request is pending</p>
                        <p class="text-sm">The admin is reviewing your account.</p>
                    </div>
                @else
                    <div class="bg-gray-100 text-gray-800 p-4 rounded-lg mb-4">
                        <p class="font-bold">You have a Normal Account.</p>
                        <p class="text-sm">Normal accounts have limits. Upgrade to Premium to remove limits.</p>
                    </div>
                    <form method="POST" action="{{ route('profile.verify') }}">
                        @csrf
                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-6 rounded-lg transition">
                            Request Premium Account
                        </button>
                    </form>
                @endif
            @endif
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-blue-600">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profile</h2>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="flex items-center gap-6 mb-6">
                    <img src="{{ $user->avatar ? Storage::url($user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=2563eb&color=fff' }}"
                         class="w-20 h-20 rounded-full object-cover border-2 border-blue-500" alt="Avatar">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Change Avatar</label>
                        <input type="file" name="avatar" accept="image/*"
                               class="text-sm text-gray-500 file:mr-3 file:py-1 file:px-3 file:rounded file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('avatar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 @enderror">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                @if(auth()->user()->role !== "admin")
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea name="bio" rows="3"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bio') border-red-500 @enderror">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                @endif

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition">
                    Save Changes
                </button>
            </form>
        </div>

        <div class="bg-white shadow-lg rounded-lg p-8 border-t-4 border-red-500">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Change Password</h2>

            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                    <input type="password" name="current_password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400 @error('current_password') border-red-500 @enderror">
                    @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                    <input type="password" name="password"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400 @error('password') border-red-500 @enderror">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-400">
                </div>

                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg transition">
                    Update Password
                </button>
            </form>
        </div>

    </main>

</body>
</html>
