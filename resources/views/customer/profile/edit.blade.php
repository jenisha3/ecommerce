@extends('layouts.shop')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow rounded-lg p-8 mt-10">

    <h2 class="text-3xl font-bold mb-6">
        Edit Profile
    </h2>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 p-3 rounded mb-5">

            {{ session('success') }}

        </div>

    @endif

    <form method="POST" action="{{ route('profile.update') }}">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Name

            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                class="w-full border rounded p-3">

            @error('name')

                <p class="text-red-600 mt-1">{{ $message }}</p>

            @enderror

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Email

            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                class="w-full border rounded p-3">

            @error('email')

                <p class="text-red-600 mt-1">{{ $message }}</p>

            @enderror

        </div>

        <div class="mb-4">

            <label class="block font-semibold mb-2">

                Phone

            </label>

            <input
                type="text"
                name="phone"
                value="{{ old('phone', $user->phone) }}"
                class="w-full border rounded p-3">

        </div>

        <div class="mb-6">

            <label class="block font-semibold mb-2">

                Address

            </label>

            <textarea
                name="address"
                rows="4"
                class="w-full border rounded p-3">{{ old('address', $user->address) }}</textarea>

        </div>

        <div class="mb-4">
    <label class="block text-sm font-semibold mb-2">
        Current Password
    </label>

    <input
        type="password"
        name="current_password"
        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500">

    @error('current_password')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-sm font-semibold mb-2">
        New Password
    </label>

    <input
        type="password"
        name="password"
        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500">

    @error('password')
        <p class="text-red-500 text-sm mt-1">
            {{ $message }}
        </p>
    @enderror
</div>

<div class="mb-6">
    <label class="block text-sm font-semibold mb-2">
        Confirm New Password
    </label>

    <input
        type="password"
        name="password_confirmation"
        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-purple-500">
</div>

<button
    type="submit"
    class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-6 py-3 rounded-lg transition">
    Update Profile
</button>

@endsection