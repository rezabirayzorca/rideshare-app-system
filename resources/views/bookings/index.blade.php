<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4">My Bookings</h1>

@if($bookings->isEmpty())
    <p>No bookings yet.</p>
@else

<div class="space-y-4">

@foreach($bookings as $booking)
<div class="bg-white p-4 rounded shadow">

    <h2 class="font-bold text-lg">
        {{ $booking->ride->origin }} → {{ $booking->ride->destination }}
    </h2>

    <p>Date: {{ $booking->ride->date }} | Time: {{ $booking->ride->time }}</p>

    <p>Seats: {{ $booking->seats }}</p>
    
    <!-- FARE PER SEAT (ADDED) -->
    <p class="text-blue-600">
        Fare per seat: ₱{{ $booking->ride->price_per_seat }}
    </p>

    <p>Total Fare: ₱{{ $booking->total_fare }}</p>

    <p>Status:
        <span class="text-blue-600">
            {{ ucfirst($booking->status) }}
        </span>
    </p>

</div>
@endforeach

</div>

@endif

</body>
</html>