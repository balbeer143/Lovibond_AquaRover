@extends('layout.master-layout')

@section('title', 'AquaRover Form')

@section('content')
<div class="bg-white p-8 rounded-lg shadow">
    <h1 class="text-2xl font-bold text-blue-900 mb-6">Upload Data</h1>

    <form action="{{ 'importExcelData' }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold">Name*</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2">
                @error('name')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <div>
                <label class="block text-sm font-semibold">Tested By*</label>
                <input type="text" name="tested_by" class="block w-full border rounded px-3 py-2">
                @error('tested_by')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold">Mobile No*</label>
                <input type="tel" id="mobile" name="mobile" class="w-full border rounded px-3 py-2"
                    value="{{ old('mobile') }}">
                @error('mobile')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold">Email*</label>
                <input type="email" name="email" class="w-full border rounded px-3 py-2">
                @error('email')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold">Address*</label>
            <textarea name="address" class="w-full border rounded px-3 py-2"></textarea>
            @error('address')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- State & Town -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold">State*</label>
                <select name="state" class="w-full border rounded px-3 py-2">
                    <option value="">Select State</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="West Bengal">West Bengal</option>
                    <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                    <option value="Chandigarh">Chandigarh</option>
                    <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                    <option value="Delhi">Delhi</option>
                    <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                    <option value="Ladakh">Ladakh</option>
                    <option value="Lakshadweep">Lakshadweep</option>
                    <option value="Puducherry">Puducherry</option>
                </select>
                @error('state')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <!-- City Input -->
            <div>
                <label class="block text-sm font-semibold">City*</label>
                <input type="text" id="city" name="city" placeholder="Enter City"
                    class="w-full border rounded px-3 py-2">
                @error('city')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Town/Village Input -->
            <div>
                <label class="block text-sm font-semibold">Town / Village*</label>
                <input type="text" id="village" name="village" placeholder="Enter Town / Village"
                    class="w-full border rounded px-3 py-2">
                @error('village')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Map & Coordinates with Geolocation -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold">
                    Latitude* (Please enable browser location)
                </label>
                <input type="text" id="latitude" name="latitude" class="w-full border rounded px-3 py-2" readonly>
                @error('latitude')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold">
                    Longitude* (Please enable browser location)
                </label>
                <input type="text" id="longitude" name="longitude" class="w-full border rounded px-3 py-2" readonly>
                @error('longitude')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Map -->
        <div id="map" style="height: 400px; margin-top: 15px; border-radius:8px;"></div>

        <!-- Sample Type -->
        <div>
            <label class="block text-sm font-semibold">Sample Type*</label>
            <select name="sample_type" class="w-full border rounded px-3 py-2">
                <option value="Domestic">Domestic</option>
                <option value="Commercial">Commercial</option>
                <option value="Industrial">Industrial</option>
                <option value="Institutional">Institutional</option>
                <option value="Govt">Govt</option>
            </select>
            @error('sample_type')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Source of Water -->
        <div>
            <label class="block text-sm font-semibold">Source of Water*</label>
            <select name="source_category" class="w-full border rounded px-3 py-2">
                <option value="Anganwadi">Anganwadi</option>
                <option value="School">School</option>
                <option value="House">House</option>
                <option value="Public Tap">Public Tap</option>
                <option value="Govt Buildings">Govt Buildings</option>
                <option value="Tube Well">Tube Well</option>
                <option value="Hand Pump">Hand Pump</option>
                <option value="Pond">Pond</option>
                <option value="Spring">Spring</option>
                <option value="Other">Other</option>
            </select>
            @error('source_category')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Date & Time -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold">Date*</label>
                <input type="date" name="date" class="w-full border rounded px-3 py-2">
                @error('date')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold">Time*</label>
                <input type="time" name="time" class="w-full border rounded px-3 py-2">
                @error('time')
                <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Instruments -->
        <div>
            <label class="block text-sm font-semibold">Tested on Instruments*</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach(['XD7500','SD335','MD610','TB350','SD400 Oxi L','SD40'] as $inst)
                <label>
                    <input type="checkbox" name="instruments[]" value="{{ $inst }}" class="instrument-check"> {{ $inst }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- Dynamic Instrument Fields -->
        <div id="extra_fields" class="space-y-4 mt-6">

            <!-- XD7500 -->
            <div id="xd7500_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">XD7500 Instrument</h2>
                <div class="drop-zone">
                    <p class="text-gray-600">Drag & Drop file here or <span class="text-blue-600 font-semibold">Browse</span></p>
                    <input type="file" name="xd7500_files" accept=".xlsx,.xls,.csv" class="hidden">
                </div>
            </div>

            <!-- SD335 -->
            <div id="sd335_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">SD335 Instrument</h2>
                <div class="drop-zone">
                    <p class="text-gray-600">Drag & Drop file here or <span class="text-blue-600 font-semibold">Browse</span></p>
                    <input type="file" name="sd335_files" accept=".xlsx,.xls,.csv" class="hidden">
                </div>
            </div>

            <!-- MD610 -->
            <div id="md610_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">MD610 Instrument</h2>
                <div class="drop-zone">
                    <p class="text-gray-600">Drag & Drop file here or <span class="text-blue-600 font-semibold">Browse</span></p>
                    <input type="file" name="md610_files" accept=".xlsx,.xls,.csv" class="hidden">
                </div>
            </div>

            <!-- TB350 -->
            <div id="tb350_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">TB350 Instrument</h2>
                <div class="drop-zone">
                    <p class="text-gray-600">Drag & Drop file here or <span class="text-blue-600 font-semibold">Browse</span></p>
                    <input type="file" name="tb350_files" accept=".xlsx,.xls,.csv" class="hidden">
                </div>
            </div>

            <!-- SD400 Oxi L -->
            <div id="sd400_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-2">SD400 Oxi L Instrument</h2>
                <div class="drop-zone">
                    <p class="text-gray-600">Drag & Drop file here or <span class="text-blue-600 font-semibold">Browse</span></p>
                    <input type="file" name="sd400_oxi_l_field" accept=".xlsx,.xls,.csv" class="hidden">
                </div>
            </div>

            <!-- SD40 -->
            <div id="sd40_field" class="hidden border p-4 rounded bg-gray-50">
                <h2 class="font-bold text-blue-800 mb-3">SD40 Instrument</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- pH -->
                    <div>
                        <label class="block text-sm font-semibold">pH:</label>
                        <div class="flex">
                            <input type="text" name="ph" class="border rounded-l px-2 py-1 w-full">
                            <select name="ph_unit" class="border rounded-r px-2 py-1 bg-gray-50">
                                <option value="pH">pH</option>
                                <option value="mV">mV</option>
                            </select>
                        </div>
                    </div>

                    <!-- Temperature -->
                    <div>
                        <label class="block text-sm font-semibold">Temperature:</label>
                        <div class="flex">
                            <input type="text" name="temperature" class="border rounded-l px-2 py-1 w-full">
                            <select name="temperature_unit" class="border rounded-r px-2 py-1 bg-gray-50">
                                <option value="°C">°C</option>
                                <option value="°F">°F</option>
                            </select>
                        </div>
                    </div>

                    <!-- Conductivity -->
                    <div>
                        <label class="block text-sm font-semibold">Conductivity:</label>
                        <div class="flex">
                            <input type="text" name="conductivity" class="border rounded-l px-2 py-1 w-full">
                            <select name="conductivity_unit" class="border rounded-r px-2 py-1 bg-gray-50">
                                <option value="μS/cm">μS/cm</option>
                                <option value="mS/cm">mS/cm</option>
                            </select>
                        </div>
                    </div>

                    <!-- TDS -->
                    <div>
                        <label class="block text-sm font-semibold">TDS:</label>
                        <div class="flex">
                            <input type="text" name="tds" class="border rounded-l px-2 py-1 w-full">
                            <select name="tds_unit" class="border rounded-r px-2 py-1 bg-gray-50">
                                <option value="PPM">PPM</option>
                                <option value="PPT">PPT</option>
                            </select>
                        </div>
                    </div>

                    <!-- Salinity -->
                    <div>
                        <label class="block text-sm font-semibold">Salinity:</label>
                        <div class="flex">
                            <input type="text" name="salinity" class="border rounded-l px-2 py-1 w-full">
                            <select name="salinity_unit" class="border rounded-r px-2 py-1 bg-gray-50">
                                <option value="PPT">PPT</option>
                                <option value="PSU">PSU</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="mt-4">
                    <label class="block text-sm font-semibold">Upload SD40 Image</label>
                    <input type="file" name="sd40_files" accept="image/*" class="w-full border rounded px-3 py-2">
                </div>
            </div>
        </div>

        <!-- Remarks -->
        <div>
            <label class="block text-sm font-semibold">Remarks*</label>
            <textarea name="remarks" class="w-full border rounded px-3 py-2"></textarea>
            @error('remarks')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Captcha -->
        <div>
            <label class="block text-sm font-semibold">Captcha*</label>
            <input type="text" name="captcha" placeholder="Enter Captcha" class="w-full border rounded px-3 py-2">
            @error('captcha')
            <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
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
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const input = document.querySelector("#mobile");

        const iti = window.intlTelInput(input, {
            initialCountry: "in", // Default India
            separateDialCode: true, // Show +91 separately
            preferredCountries: ["in", "us", "gb"],
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Initialize map (center at 0,0 but zoomed out, marker will not update until location allowed)
        var map = L.map('map').setView([0, 0], 2);

        // OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Draggable marker (temporary, hidden initially)
        var marker = L.marker([0, 0], {
            draggable: true
        }).addTo(map).setOpacity(0);

        // Update coordinates on marker drag
        marker.on('dragend', function(e) {
            var latlng = e.target.getLatLng();
            document.getElementById('latitude').value = latlng.lat;
            document.getElementById('longitude').value = latlng.lng;
        });

        // Search control
        L.Control.geocoder({
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                var center = e.geocode.center;
                marker.setLatLng(center).setOpacity(1);
                map.setView(center, 15);
                document.getElementById('latitude').value = center.lat;
                document.getElementById('longitude').value = center.lng;
            })
            .addTo(map);

        // Browser geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    // Success: show marker and set coordinates
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    marker.setLatLng([lat, lng]).setOpacity(1);
                    map.setView([lat, lng], 15);
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                },
                function(error) {
                    // Error: alert but do not set any value
                    alert("Unable to fetch your location. Please enable browser location.");
                    console.error(error);
                }
            );
        } else {
            alert("Geolocation is not supported by your browser.");
        }

    });
</script>


<!-- Common JS for All Drop Zones -->
<script>
    document.querySelectorAll(".drop-zone").forEach((dropZone) => {
        const fileInput = dropZone.querySelector("input[type=file]");
        const text = dropZone.querySelector("p");

        // Click to open file dialog
        dropZone.addEventListener("click", () => fileInput.click());

        // Highlight on drag over
        dropZone.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropZone.classList.add("bg-blue-50", "border-blue-400");
        });

        // Remove highlight
        dropZone.addEventListener("dragleave", () => {
            dropZone.classList.remove("bg-blue-50", "border-blue-400");
        });

        // Handle file drop
        dropZone.addEventListener("drop", (e) => {
            e.preventDefault();
            dropZone.classList.remove("bg-blue-50", "border-blue-400");

            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                text.textContent = e.dataTransfer.files[0].name;
            }
        });

        // Handle file selection (via browse)
        fileInput.addEventListener("change", () => {
            if (fileInput.files.length) {
                text.textContent = fileInput.files[0].name;
            }
        });
    });
</script>




@endsection