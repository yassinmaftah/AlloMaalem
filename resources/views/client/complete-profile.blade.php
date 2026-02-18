@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Complete Your Client Profile</h2>

        <form method="POST" action="{{ route('profile.complete.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" placeholder="06XXXXXXXX" value="{{ old('phone') }}" >
                @error('phone')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">City</label>
                <select name="city" class="w-full border p-2 rounded" >
                    <option value="" disabled selected>Select your city</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Marrakech">Marrakech</option>
                    <option value="Tangier">Tangier</option>
                    <option value="Agadir">Agadir</option>
                </select>
                @error('city')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Profile Picture</label>
                <input type="file" name="avatar" class="w-full border p-2 rounded">
                @error('avatar')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save & Continue
            </button>
        </form>

    </div>
</div>
@endsection
