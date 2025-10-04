@extends('layout.master-layout')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>

<!-- Your Uploads -->
<div class="bg-white p-6 rounded-2xl shadow-md flex items-center justify-between transition-shadow duration-300">
    <div>
        <h2 class="text-lg font-semibold text-[#002C51] mb-1 tracking-wide uppercase">
            {{ $uploadsLabel }}
        </h2>
        <p class="text-4xl font-extrabold text-gray-800">
            {{ $uploadsCount }}
        </p>
        <p class="text-sm text-gray-500 mt-2">
            {{ $user->role === 'admin' ? 'Total number of forms submitted by all users' : 'Number of forms you have submitted' }}
        </p>
    </div>
</div>


@endsection