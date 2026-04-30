<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RideShare</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 flex">

<!-- SIDEBAR -->
<div class="w-64 bg-white shadow h-screen p-4">

    <h1 class="text-xl font-bold text-blue-600 mb-6">
        RideShare
    </h1>

    <nav class="space-y-3 text-sm">

        <a href="/home" class="block p-2 hover:bg-gray-100 rounded">
            🏠 Home
        </a>

        <a href="/rides" class="block p-2 hover:bg-gray-100 rounded">
            🚗 Available Rides
        </a>

        <a href="/my-bookings" class="block p-2 hover:bg-gray-100 rounded">
            📋 My Bookings
        </a>

        @if(auth()->user()->role === 'driver')
        <a href="/driver/dashboard" class="block p-2 hover:bg-gray-100 rounded text-purple-600 font-semibold">
            🚘 Driver Dashboard
        </a>
        @endif

        <a href="/profile" class="block p-2 hover:bg-gray-100 rounded">
            👤 Profile
        </a>

    </nav>

</div>

<!-- MAIN CONTENT -->
<div class="flex-1 p-6">

    <!-- TOP BAR -->
    <div class="flex justify-end mb-4">

        <!-- NOTIFICATION ICON -->
        <a href="/notifications" class="relative text-xl">
            🔔
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs px-1 rounded-full">
                3
            </span>
        </a>

    </div>

    @yield('content')

</div>

</body>
</html>