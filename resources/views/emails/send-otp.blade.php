<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-[#002C51] to-[#004080] flex items-center justify-center min-h-screen p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full text-center p-10 border-t-8 border-[#F07815]">
        <!-- Header -->
        <h3 class="text-3xl font-extrabold text-[#002C51] mb-6">AquaRover OTP Verification</h3>
        <p class="text-gray-700 mb-3">Hello!</p>

        <!-- Dynamic OTP message -->
        @if($isResend)
            <p class="text-gray-700 mb-5 text-lg">You requested a new OTP. Here it is:</p>
        @else
            <p class="text-gray-700 mb-5 text-lg">Your OTP for login is:</p>
        @endif

        <!-- OTP Number -->
        <h2 class="text-5xl font-bold text-[#F07815] mb-6 tracking-widest">{{ $otp }}</h2>

        <!-- OTP validity -->
        <p class="text-gray-500 text-sm mb-3">This OTP is valid for 10 minutes.</p>

        <!-- Footer note -->
        <p class="text-gray-400 text-xs">If you did not request this, please ignore this email.</p>

        <!-- Optional Button -->
        <div class="mt-6">
            <a href="#" class="inline-block bg-[#F07815] text-white px-6 py-2 rounded-full font-semibold shadow hover:bg-[#d96611] transition duration-300">Go to AquaRover</a>
        </div>
    </div>
</body>
</html>
