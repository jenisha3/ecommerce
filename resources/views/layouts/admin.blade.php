<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white">

        <div class="p-6 text-2xl font-bold border-b border-slate-700">
            Admin Panel
        </div>

        <nav class="mt-4">

            <a href="{{ route('admin.dashboard') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Dashboard
            </a>

            <a href="{{ route('admin.categories.index') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Categories
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Products
            </a>

            <a href="{{ route('admin.orders.index') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Orders
            </a>

            <a href="{{ route('admin.inventory.index') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Inventory
            </a>

            {{-- We will add Sales Reports after creating the module --}}
            {{--
            <a href="{{ route('admin.reports.index') }}"
               class="block px-6 py-3 hover:bg-slate-800">
                Sales Reports
            </a>
            --}}

        </nav>

    </aside>

    <!-- Main Content -->
    <div class="flex-1">

        <!-- Top Navbar -->
        <header class="bg-white shadow px-8 py-4 flex justify-between items-center">

            <h1 class="text-2xl font-bold text-gray-700">
                @yield('title')
            </h1>

            <div class="flex items-center gap-4">

                <span class="font-semibold text-gray-700">
                    {{ auth()->user()->name }}
                </span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Logout
                    </button>

                </form>

            </div>

        </header>

        <!-- Page Content -->
        <main class="p-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>

</div>

</body>
</html>