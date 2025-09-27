<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification | Lovibond AquaRover</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#002C51] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-[#002C51] text-center mb-6">Verify Your Email</h1>

        @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('verify.otp.post') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="hidden" name="formName" value="{{ $formName }}">

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="otp">Enter OTP</label>
                <input type="text" name="otp" id="otp" maxlength="6" placeholder="6-digit OTP"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]"
                    required>
                @error('otp')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#F07815] text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition-colors">
                Verify OTP
            </button>
        </form>

        <p class="mt-4 text-gray-500 text-center">
            Didn’t receive the code? 
            <a href="{{ route('resend.otp', ['email' => $email]) }}" class="text-[#F07815] font-semibold hover:underline">
                Resend OTP
            </a>
        </p>
    </div>

</body>

</html>
