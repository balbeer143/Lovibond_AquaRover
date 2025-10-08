@extends('layout.master-layout')

@section('title', 'All Users')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4 text-[#052c65]">All Users</h2>

    <div class="overflow-x-auto">
        <table class="datatable w-full border border-gray-200 rounded">
            <thead class="bg-[#052c65] text-white">
                <tr>
                    <th class="px-4 py-2">User ID</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Mobile Number</th>
                    <th class="px-4 py-2">Department</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $index + 1 }}</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        <td class="px-4 py-2">{{ $user->contact_number }}</td>
                        <td class="px-4 py-2">{{ $user->department }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
