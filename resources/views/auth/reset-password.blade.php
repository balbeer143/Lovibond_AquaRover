<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | Lovibond AquaRover</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#002C51] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-[#002C51] text-center mb-6">Forgot Password</h1>

        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('reset.password.send.otp') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <input type="hidden" name="formName" value="reset">
                <label for="email" class="block text-gray-700 font-medium mb-1">Enter Your Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]"
                    required>
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#F07815] text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition-colors">
                Send OTP
            </button>
        </form>

        <p class="mt-4 text-gray-500 text-center">
            Remembered your password?
            <a href="{{ route('login') }}" class="text-[#F07815] font-semibold hover:underline">Login</a>
        </p>
    </div>

</body>
</html>
