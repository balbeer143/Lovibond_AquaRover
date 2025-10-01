@extends('layout.master-layout')

@section('title', 'All Upload Data')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    
    <!-- Table Scroll Wrapper -->
    <div class="overflow-x-auto">
        <table class="dataTable overflow-x-auto border border-gray-200 rounded text-sm">
            <thead class="bg-[#052c65] text-white">
                <tr>
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Tested By</th>
                    <th class="px-4 py-2">Mobile</th>
                    <th class="px-4 py-2">Email</th>
                    <th class="px-4 py-2">Address</th>
                    <th class="px-4 py-2">State</th>
                    <th class="px-4 py-2">City</th>
                    <th class="px-4 py-2">Village</th>
                    <th class="px-4 py-2">Latitude</th>
                    <th class="px-4 py-2">Longitude</th>
                    <th class="px-4 py-2">Sample Type</th>
                    <th class="px-4 py-2">Source Category</th>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Time</th>
                    <th class="px-4 py-2">Instruments</th>
                    <th class="px-4 py-2">SD40 pH</th>
                    <th class="px-4 py-2">Temperature</th>
                    <th class="px-4 py-2">Conductivity</th>
                    <th class="px-4 py-2">TDS</th>
                    <th class="px-4 py-2">Salinity</th>
                    <th class="px-4 py-2">SD40 Image</th>
                    <th class="px-4 py-2">Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($allUploadData as $index => $formData)
                <tr class="border-b">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $formData->name ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->tested_by ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->mobile ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->email ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->address ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->state ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->city ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->village ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->latitude ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->longitude ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->sample_type ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->source_category ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->date ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->time ?? '-' }}</td>

                    <!-- Instruments -->
                    <td class="px-4 py-2">
                        @if($formData->instruments)
                        {{ implode(', ', json_decode($formData->instruments, true)) }}
                        @else
                        -
                        @endif
                    </td>

                    <!-- SD40 Values -->
                    <td class="px-4 py-2">{{ $formData->ph ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->temperature ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->conductivity ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->tds ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $formData->salinity ?? '-' }}</td>

                    <!-- SD40 Image Preview -->
                    <td class="px-4 py-2">
                        @if($formData->sd40_files)
                        <a href="{{ asset('storage/'.$formData->sd40_files) }}" target="_blank">
                            <img src="{{ asset('storage/'.$formData->sd40_files) }}"
                                alt="sd40 image"
                                class="w-16 h-16 object-cover rounded shadow">
                        </a>
                        @else
                        -
                        @endif
                    </td>

                    <td class="px-4 py-2">{{ $formData->remarks ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection