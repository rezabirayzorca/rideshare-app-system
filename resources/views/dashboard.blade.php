@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">
    Welcome, {{ auth()->user()->name }}
</h1>

<p class="text-gray-600 mb-6">
    Book rides, manage trips, and travel smarter.
</p>

<!-- QUICK ACTIONS -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <!-- FIND RIDE -->
    <a href="/rides"
       class="bg-blue-600 text-white p-6 rounded shadow text-center hover:bg-blue-700">
        🚗
        <h2 class="font-bold mt-2">Find a Ride</h2>
    </a>

    <!-- MY BOOKINGS -->
    <a href="/my-bookings"
       class="bg-green-600 text-white p-6 rounded shadow text-center hover:bg-green-700">
        📋
        <h2 class="font-bold mt-2">My Bookings</h2>
    </a>

    <!-- DRIVER DASHBOARD -->
    <a href="/driver/dashboard"
       class="bg-purple-600 text-white p-6 rounded shadow text-center hover:bg-purple-700">
        🚘
        <h2 class="font-bold mt-2">Driver Dashboard</h2>
    </a>

</div>

@endsection