@extends('layout.master-layout')

@section('title', 'AquaRover Data Export')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 mb-6">AquaRover Data Export</h1>

    <p class="mb-4 text-blue-800">
        Select a date range to download data, or leave empty to download today's data:
    </p>

    <form action="{{ route('export.daterange') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
    @csrf
    <div>
        <label class="block text-sm font-semibold text-blue-800">From Date</label>
        <input type="date" name="from_date" value="{{ date('Y-m-d') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-semibold text-blue-800">To Date</label>
        <input type="date" name="to_date" value="{{ date('Y-m-d') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div>
        <label class="block text-sm font-semibold text-blue-800">Format</label>
        <select name="format" class="w-full border rounded px-3 py-2">
            <option value="xlsx">Excel (.xlsx)</option>
            <option value="csv">CSV (.csv)</option>
        </select>
    </div>
    <div>
        <button type="submit" class="bg-blue-700 text-white px-6 py-3 rounded hover:bg-blue-800 w-full">
            Export Data
        </button>
    </div>
</form>
</div>
@endsection
