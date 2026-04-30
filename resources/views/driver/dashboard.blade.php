@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Driver Dashboard</h1>

<div class="flex justify-between items-center mb-6">

    <a href="/driver/create"
       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        + Create Ride
    </a>

</div>

@foreach($rides as $ride)

@php
    $totalSeats = 0;
    $totalEarnings = 0;
@endphp

<div class="bg-white p-4 rounded shadow mb-4">

    <!-- RIDE INFO -->
    <h2 class="font-bold text-lg">
        {{ $ride->origin }} → {{ $ride->destination }}
    </h2>

    <p class="text-sm text-gray-600">
        {{ $ride->date }} | {{ $ride->time }}
    </p>

    <!-- BOOKINGS -->
    <h3 class="mt-3 font-semibold">Bookings:</h3>

    @forelse($ride->bookings as $booking)

        @php
            $fare = $booking->seats * $ride->price_per_seat;
            $totalSeats += $booking->seats;
            $totalEarnings += $fare;
        @endphp

        <div class="border p-3 mt-2 rounded">

            <p>Passenger: {{ $booking->passenger->name }}</p>

            <p>Seats Booked: 
                <span class="font-bold">{{ $booking->seats }}</span>
            </p>

            <p>Total Fare: 
                <span class="text-green-600 font-bold">
                    ₱{{ $fare }}
                </span>
            </p>

            <p>Status: 
                <span class="font-bold text-blue-600">
                    {{ $booking->status }}
                </span>
            </p>

            <!-- ACTION BUTTONS -->
            @if($booking->status == 'pending')

            <div class="mt-2 flex gap-2">

                <form method="POST" action="/booking/{{ $booking->id }}/accept">
                    @csrf
                    <button class="bg-green-600 text-white px-3 py-1 rounded">
                        Accept
                    </button>
                </form>

                <form method="POST" action="/booking/{{ $booking->id }}/reject">
                    @csrf
                    <button class="bg-red-600 text-white px-3 py-1 rounded">
                        Reject
                    </button>
                </form>

            </div>

            @endif

        </div>

    @empty
        <p class="text-gray-500 mt-2">No bookings yet.</p>
    @endforelse

    <!-- SUMMARY -->
    <div class="mt-4 bg-gray-100 p-3 rounded">

        <p class="text-sm">
            Total Seats Booked:
            <span class="font-bold">{{ $totalSeats }}</span>
        </p>

         <p class="text-blue-600">
        Fare per seat: ₱{{ $booking->ride->price_per_seat }}
    </p>
    
        <p class="text-sm text-green-700">
            Total Earnings:
            <span class="font-bold">₱{{ $totalEarnings }}</span>
        </p>

    </div>

</div>

@endforeach

@endsection