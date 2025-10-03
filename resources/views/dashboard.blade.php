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

    <!-- Icon -->
    <div class="w-16 h-16 flex items-center justify-center rounded-full bg-gradient-to-tr from-blue-500 to-blue-700 text-white shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12v6m0 0l-3-3m3 3l3-3" />
        </svg>
    </div>
</div>


@endsection