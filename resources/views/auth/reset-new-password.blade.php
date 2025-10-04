<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | Lovibond AquaRover</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
</head>

<body class="bg-[#002C51] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-[#002C51] text-center mb-6">Set New Password</h1>

        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('update.new.password') }}" method="POST" class="space-y-5">
            @csrf

            <div class="relative">
                <label for="password" class="block text-gray-700 font-medium mb-1">New Password</label>
                <input type="password" name="password" id="password" placeholder="New Password"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]" required>
                    <span class="password-toggle absolute right-3 top-9 cursor-pointer text-gray-500">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="relative">
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]" required>
                    <span class="password-toggle absolute right-3 top-9 cursor-pointer text-gray-500">
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>

            <button type="submit"
                class="w-full bg-[#F07815] text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition-colors">
                Reset Password
            </button>
        </form>

        <p class="mt-4 text-gray-500 text-center">
            Remembered your password?
            <a href="{{ route('login') }}" class="text-[#F07815] font-semibold hover:underline">Login</a>
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.password-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = this.previousElementSibling; // nearest password input
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                });
            });
        });
    </script>

</body>
</html>
