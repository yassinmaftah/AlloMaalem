@extends('layouts.app')

@section('content')
<div class="p-10 text-center">
    <h1 class="text-3xl font-bold text-yellow-600">👷 Maalem Dashboard</h1>
    <p class="mt-4">Welcome, {{ Auth::user()->name }}!</p>
    <div class="mt-6">
        <a href="#" class="bg-yellow-500 text-white px-6 py-3 rounded-lg">Find Work</a>
    </div>

    <form action="{{ route('logout') }}" method="POST" class="mt-10">
        @csrf
        <button class="text-red-500 underline">Logout</button>
    </form>
</div>
@endsection
