<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AquaRover')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <!-- intl-tel-input CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/css/intlTelInput.css" />
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Control Geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- intl-tel-input JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <style>
        .iti {
            display: block !important;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-[#F7F7F7] min-h-screen flex flex-col" x-data="{ openProfileModal: false }">

    <!-- Backdrop (for sidebar) -->
    <div id="backdrop" class="fixed inset-0 bg-black bg-opacity-50 hidden z-40"
        onclick="closeSidebar()"></div>

    <div class="flex flex-1">

        <!-- Sidebar -->
        <div id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-[#002C51] text-white flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300 z-50">
            <!-- Header with Close -->
            <div class="flex items-center justify-between p-6 text-2xl font-bold border-b border-[#F07815]">
                AquaRover
                <button onclick="closeSidebar()" class="md:hidden">
                    <!-- Close X -->
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Nav -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 py-2 px-3 rounded transition-colors {{ request()->routeIs('dashboard') ? 'bg-[#ea580c] text-white' : 'hover:bg-[#F07815]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12h18M3 6h18M3 18h18"></path>
                    </svg>
                    Dashboard
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('all.user') }}" class="flex items-center gap-2 py-2 px-3 rounded transition-colors {{ request()->routeIs('allUsers') ? 'bg-[#ea580c] text-white' : 'hover:bg-[#F07815]' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" />
                    </svg>
                    All Users
                </a>
                @endif
                <a href="{{ route('uploadData') }}" class="flex items-center gap-2 py-2 px-3 rounded transition-colors {{ request()->routeIs('uploadData') ? 'bg-[#ea580c] text-white' : 'hover:bg-[#F07815]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 9l5-5 5 5M12 4v12"></path>
                    </svg>
                    Upload Data
                </a>
                <a href="{{ route('show.form.data') }}" class="flex items-center gap-2 py-2 px-3 rounded transition-colors {{ request()->routeIs('') ? 'bg-[#ea580c] text-white' : 'hover:bg-[#F07815]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 9l5-5 5 5M12 4v12"></path>
                    </svg>
                    My Uploads
                </a>
                <a href="{{ route('view.daterange') }}" class="flex items-center gap-2 py-2 px-3 rounded whitespace-nowrap transition-colors {{ request()->routeIs('') ? 'bg-[#ea580c] text-white' : 'hover:bg-[#F07815]' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2M7 9l5 5 5-5M12 4v10"></path>
                    </svg>
                    Download Master Sheet
                </a>
            </nav>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="p-4">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-[#F07815] text-white py-2 rounded hover:bg-orange-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <!-- Content Area -->
        <div class="flex-1 flex flex-col md:ml-64 overflow-hidden">

            <!-- Global Header -->
            <header class="flex items-center justify-between bg-white shadow p-4">
                <!-- Mobile toggle -->
                <button onclick="toggleSidebar()" class="md:hidden text-[#002C51]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <h1 class="text-xl font-bold text-[#002C51]">@yield('title', 'AquaRover')</h1>

                <!-- User Button -->
                <div class="relative">
                    <button onclick="toggleUserMenu()" class="flex items-center gap-2 bg-[#002C51] text-white px-3 py-2 rounded">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5z"></path>
                            <path d="M4 20c0-4 4-7 8-7s8 3 8 7"></path>
                        </svg>
                    </button>
                    <!-- Dropdown -->
                    <div id="userMenu" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl z-50 border border-gray-200 overflow-hidden">

                        <!-- Avatar + Name + Email -->
                        <div class="bg-gray-50 p-5 flex flex-col items-center gap-2 border-b border-gray-200">
                            <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center text-gray-500 text-xl font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1) . substr(strstr(Auth::user()->name, ' '), 1, 1)) }}
                            </div>
                            <p class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                        </div>

                        <!-- Contact Info Section -->
                        <div class="p-5 border-b border-gray-200 space-y-3">
                            <div>
                                <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Contact Number</p>
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 5a2 2 0 012-2h1.5a.5.5 0 010 1H4a1 1 0 00-1 1v10a1 1 0 001 1h1.5a.5.5 0 010 1H4a2 2 0 01-2-2V5z" />
                                        <path d="M14.854 7.146a.5.5 0 00-.708.708l1.646 1.647H7.5a.5.5 0 000 1h8.292l-1.646 1.646a.5.5 0 00.708.708l2.5-2.5a.5.5 0 000-.708l-2.5-2.5z" />
                                    </svg>
                                    <p class="text-gray-700 text-sm">{{ Auth::user()->contact_number ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs text-gray-400 uppercase font-semibold mb-1">Designation</p>
                                <div class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2a5 5 0 00-5 5v1a5 5 0 0010 0V7a5 5 0 00-5-5zM4 12a4 4 0 018 0v1H4v-1zM2 16a2 2 0 012-2h12a2 2 0 012 2v1H2v-1z" />
                                    </svg>
                                    <p class="text-gray-700 text-sm">{{ Auth::user()->designation ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Update Profile Button Section -->
                        <div class="p-5 border-b border-gray-200">
                            <a href="javascript:void(0)" @click="openProfileModal = true"
                                class="w-full text-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow hover:bg-blue-700 hover:shadow-md transition duration-200">
                                Update Profile
                            </a>
                        </div>

                        <!-- Logout Button Section -->
                        <div class="p-5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-center px-4 py-2 border border-red-600 text-red-600 font-semibold rounded-lg hover:bg-red-50 transition duration-200">
                                    Logout
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>

            <!-- Global Footer -->
            <footer class="bg-white shadow p-4 text-center text-gray-600">
                &copy; {{ date('Y') }} AquaRover. All Rights Reserved.
            </footer>
        </div>
    </div>

    <!-- Pop up form -->

    <!-- Wrapper with Alpine -->
    <div>
        <!-- Profile Update Modal -->
        <div x-show="openProfileModal" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">

            <div @click.away="openProfileModal = false"
                class="bg-white rounded-xl shadow-xl w-full max-w-md p-6 space-y-4">

                <!-- Modal Header -->
                <div class="flex justify-between items-center border-b pb-2">
                    <h2 class="text-lg font-semibold text-gray-800">Update Profile</h2>
                    <button @click="openProfileModal = false"
                        class="text-gray-500 hover:text-gray-700 text-xl leading-none">
                        ✕
                    </button>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('update.profile') }}" class="space-y-4">
                    @csrf

                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                        <input type="text" name="contact_number" value="{{ Auth::user()->contact_number }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                    </div>

                    <!-- Designation -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                        <input type="text" name="designation" value="{{ Auth::user()->designation }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 focus:outline-none">
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="openProfileModal = false"
                            class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Date picker
        const datePicker = flatpickr("#date", {
            dateFormat: "Y-m-d",
            allowInput: true,
        });

        // Time picker
        const timePicker = flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            allowInput: true,
        });
    </script>

    <!-- Toastr + Scripts -->
    <script>
        // Toastr
        @if(session('success')) toastr.success("{{ session('success') }}");
        @endif
        @if(session('error')) toastr.error("{{ session('error') }}");
        @endif

        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: "5000"
        };

        // Sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('backdrop').classList.toggle('hidden');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('backdrop').classList.add('hidden');
        }

        // User Menu
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }

        // Close user menu on outside click
        window.addEventListener('click', function(e) {
            const menu = document.getElementById('userMenu');
            const button = e.target.closest('button');
            if (!menu.contains(e.target) && !button) {
                menu.classList.add('hidden');
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.dataTable').DataTable({
                'scrollX': true,
                "pageLength": 10, // default rows per page
                "ordering": false, // enable sorting
                "searching": true, // enable search box
                "lengthChange": true, // allow change rows per page
                "language": {
                    "search": "Search User:"
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "pageLength": 10, // default rows per page
                "ordering": false, // enable sorting
                "searching": true, // enable search box
                "lengthChange": true, // allow change rows per page
                "language": {
                    "search": "Search User:"
                }
            });
        });
    </script>

</body>

</html>