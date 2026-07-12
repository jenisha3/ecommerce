<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 min-h-screen flex items-center justify-center py-10">

<div class="w-full max-w-lg">

    <!-- Logo -->
    <div class="text-center mb-8">

        <h1 class="text-4xl font-bold text-white">

            Gadget Store

        </h1>

        <p class="text-gray-300 mt-2">

            Create your account

        </p>

    </div>

    <!-- Register Card -->

    <div class="bg-white rounded-2xl shadow-2xl p-8">

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">

            Register

        </h2>

        @if($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4 mb-6">

                <ul class="list-disc ml-5">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <!-- Name -->

            <div class="mb-5">

                <label class="block font-semibold text-gray-700 mb-2">

                    Full Name

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter your full name"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Email -->

            <div class="mb-5">

                <label class="block font-semibold text-gray-700 mb-2">

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

            <div class="mb-5">

                <label class="block font-semibold text-gray-700 mb-2">

                    Password

                </label>

                <input
                    type="password"
                    name="password"
                    placeholder="Enter password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Confirm Password -->

            <div class="mb-8">

                <label class="block font-semibold text-gray-700 mb-2">

                    Confirm Password

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <!-- Register Button -->

            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition">

                Register

            </button>

        </form>

        <!-- Divider -->

        <div class="my-6 border-t"></div>

        <!-- Login Link -->

        <p class="text-center text-gray-600">

            Already have an account?

            <a href="{{ route('login') }}"
               class="text-blue-600 hover:text-blue-700 font-semibold">

                Login

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