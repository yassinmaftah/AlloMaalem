@extends('layouts.app')
{{-- Note: Later we will create a layouts.dashboard --}}

@section('content')
<div class="p-10 text-center">
    <h1 class="text-3xl font-bold text-blue-800">Client Dashboard</h1>
    <p class="mt-4">{{ Auth::user()->name }}!</p>

    <form action="{{ route('logout') }}" method="POST" class="mt-10">
        @csrf
        <button class="text-red-500 underline">Logout</button>
    </form>
</div>
@endsection
