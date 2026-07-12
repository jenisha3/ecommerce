<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md">

    <!-- Logo -->
    <div class="text-center mb-8">

        <h1 class="text-4xl font-bold text-white">
            Gadget Store
        </h1>

        <p class="text-gray-300 mt-2">
            Login to your account
        </p>

    </div>

    <!-- Card -->
    <div class="bg-white rounded-2xl shadow-2xl p-8">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">

            Login

        </h2>

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">

                {{ session('success') }}

            </div>

        @endif

        @if($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('login.store') }}" method="POST">

            @csrf

            <!-- Email -->

            <div class="mb-5">

                <label class="block text-gray-700 font-semibold mb-2">

                    Email Address

                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Password -->

            <div class="mb-6">

                <label class="block text-gray-700 font-semibold mb-2">

                    Password

                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Login Button -->

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition">

                Login

            </button>

        </form>

        <!-- Divider -->

        <div class="my-6 border-t"></div>

        <!-- Register -->

        <p class="text-center text-gray-600">

            Don't have an account?

            <a href="{{ route('register') }}"
               class="text-blue-600 hover:text-blue-700 font-semibold">

                Register Here

            </a>

        </p>

        <!-- Back to Shop -->

        <div class="mt-6 text-center">

            <a href="{{ route('shop') }}"
               class="text-gray-500 hover:text-blue-600">

                ← Back to Shop

            </a>

        </div>

    </div>

</div>

</body>
</html>