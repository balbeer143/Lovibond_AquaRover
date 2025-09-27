<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Lovibond AquaRover</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#002C51] flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <h1 class="text-2xl font-bold text-[#002C51] text-center mb-6">Create Your Account</h1>

        <form action="{{ route('register.save') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1" for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="John Doe"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]">
                @error('name')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]">
                @error('email')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="********"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]">
                @error('password')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1" for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-[#F07815]">
                @error('password_confirmation')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-[#F07815] text-white font-semibold py-2 rounded-lg hover:bg-orange-600 transition-colors">
                Register
            </button>
        </form>

        <p class="mt-4 text-gray-500 text-center">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#F07815] font-semibold hover:underline">Login</a>
        </p>
    </div>

</body>

</html>