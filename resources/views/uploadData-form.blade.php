@extends('layout.master-layout')

@section('title', 'AquaRover Form')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 mb-6">Upload Data</h1>

    <form action="{{ 'importExcelData' }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
<input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <!-- XD7500 -->
            <div id="xd7500_field" class=" border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">XD7500 Instrument</h2>
                <input type="file" name="xd7500_files" accept=".xlsx,.xls,.csv" class="w-full border rounded px-3 py-2">
            </div>

            <!-- SD335 -->
            <div id="sd335_field" class=" border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">SD335 Instrument</h2>
                <input type="file" name="sd335_files" accept=".xlsx,.xls,.csv" class="w-full border rounded px-3 py-2">
            </div>

            <!-- MD610 -->
            <div id="md610_field" class=" border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">MD610 Instrument</h2>
                <input type="file" name="md610_files" accept=".xlsx,.xls,.csv" class="w-full border rounded px-3 py-2">
            </div>

            <!-- TB350 -->
            <div id="tb350_field" class=" border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">TB350 Instrument</h2>
                <input type="file" name="tb350_files" accept=".xlsx,.xls,.csv" class="w-full border rounded px-3 py-2">
            </div>

            <!-- SD400 Oxi L -->
            <div id="sd400_field" class=" border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">SD400 Oxi L Instrument</h2>
                <input type="file" name="sd400_oxi_l_field" accept=".xlsx,.xls,.csv" class="w-full border rounded px-3 py-2">
            </div>

        <!-- Submit -->
        <div class="text-right mt-6">
            <button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded hover:bg-blue-800">
                Submit
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // Instrument fields toggle
    const checkboxes = document.querySelectorAll('.instrument-check');

    checkboxes.forEach(cb => {
        cb.addEventListener('change', () => {
            document.getElementById('xd7500_field').classList.toggle('hidden', !document.querySelector('input[value="XD7500"]').checked);
            document.getElementById('sd335_field').classList.toggle('hidden', !document.querySelector('input[value="SD335"]').checked);
            document.getElementById('md610_field').classList.toggle('hidden', !document.querySelector('input[value="MD610"]').checked);
            document.getElementById('tb350_field').classList.toggle('hidden', !document.querySelector('input[value="TB350"]').checked);
            document.getElementById('sd400_field').classList.toggle('hidden', !document.querySelector('input[value="SD400 Oxi L"]').checked);
            document.getElementById('sd40_field').classList.toggle('hidden', !document.querySelector('input[value="SD40"]').checked);
        });
    });

    // Geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            },
            function(error) {
                alert("Unable to fetch your location. Please enable browser location.");
                console.error(error);
            }
        );
    } else {
        alert("Geolocation is not supported by your browser.");
    }

});
</script>

@endsection