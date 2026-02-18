@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">

        <h2 class="text-2xl font-bold mb-6 text-gray-800">Complete Your Maalem Profile</h2>

        <form method="POST" action="{{ route('profile.complete.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">My Speciality</label>
                <input type="text" name="speciality" class="w-full border p-2 rounded" placeholder="Plumber, Electrician..." >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">About Me (Bio)</label>
                <textarea name="bio" rows="3" class="w-full border p-2 rounded" placeholder="Tell clients about your experience..."></textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                <input type="text" name="phone" class="w-full border p-2 rounded" placeholder="06XXXXXXXX" >
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">City</label>
                <select name="city" class="w-full border p-2 rounded" >
                    <option value="" disabled selected>Select your city</option>
                    <option value="Casablanca">Casablanca</option>
                    <option value="Rabat">Rabat</option>
                    <option value="Marrakech">Marrakech</option>
                </select>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Profile Picture</label>
                <input type="file" name="avatar" class="w-full border p-2 rounded">
            </div>

            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Finish Setup
            </button>
        </form>

    </div>
</div>
@endsection
