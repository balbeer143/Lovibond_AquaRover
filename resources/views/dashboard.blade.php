@extends('layout.master-layout')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-[#002C51] mb-2">Your Uploads</h2>
            <p class="text-gray-700 text-2xl">12</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold text-[#002C51] mb-2">Master Sheets Available</h2>
            <p class="text-gray-700 text-2xl">5</p>
        </div>
    </div>
@endsection
