@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto">

    <!-- TITLE -->
    <h1 class="text-2xl font-bold mb-6">Book a Ride</h1>

    <!-- SEARCH FORM -->
    <div class="bg-white p-4 rounded shadow mb-6">

        <form action="/rides/result" method="GET"
              class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">

            <input type="text"
                   name="origin"
                   value="{{ request('origin') }}"
                   placeholder="From"
                   class="border p-2 rounded w-full">

            <input type="text"
                   name="destination"
                   value="{{ request('destination') }}"
                   placeholder="To"
                   class="border p-2 rounded w-full">

            <input type="date"
                   name="date"
                   value="{{ request('date') }}"
                   class="border p-2 rounded w-full">

            <input type="number"
                   name="seats"
                   min="1"
                   value="{{ request('seats', 1) }}"
                   class="border p-2 rounded w-full">

            <button type="submit"
                    class="bg-blue-600 text-white rounded px-4 py-2 w-full hover:bg-blue-700">
                Find a Ride
            </button>

        </form>

    </div>

    <!-- INITIAL STATE -->
    @if(!request()->has('origin') && !request()->has('destination') && !request()->has('date') && !request()->has('seats'))

        <p class="text-gray-400 text-center">
            Enter details above to find available rides.
        </p>

    @else

        <!-- NO RESULTS -->
        @if($rides->count() == 0)

            <p class="text-gray-500 text-center">
                No rides found.
            </p>

        @else

            <!-- RESULTS -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                @foreach($rides as $ride)

                <div class="bg-white p-4 rounded shadow hover:shadow-lg transition">

                    <!-- ROUTE -->
                    <h2 class="font-bold text-lg">
                        {{ $ride->origin }} → {{ $ride->destination }}
                    </h2>

                    <!-- DRIVER INFO -->
                    <p class="text-sm text-gray-600 mt-1">
                        Driver: {{ $ride->driver->name ?? 'N/A' }}
                    </p>

                    <!-- RATING -->
                    <p class="text-yellow-500 text-sm">
                        ⭐ {{ number_format($ride->driver->reviews->avg('rating') ?? 0, 1) }} / 5
                    </p>

                    <!-- DETAILS -->
                    <p class="text-sm text-gray-600 mt-1">
                        Date: {{ $ride->date }} | Time: {{ $ride->time }}
                    </p>

                    <p class="mt-1">
                        Seats: {{ $ride->available_seats }}
                    </p>

                    <p class="text-blue-600 font-bold">
                        ₱{{ $ride->price_per_seat }} / seat
                    </p>

                    <!-- BOOK FORM -->
                    <form method="POST"
                          action="/book/{{ $ride->id }}"
                          class="mt-3 flex gap-2">

                        @csrf

                        <input type="number"
                               name="seats"
                               value="1"
                               min="1"
                               class="border p-2 rounded w-20">

                        <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                            Book
                        </button>

                    </form>

                </div>

                @endforeach

            </div>

        @endif

    @endif

</div>

@endsection