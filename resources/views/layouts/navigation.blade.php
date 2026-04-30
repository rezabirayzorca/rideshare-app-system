<div class="bg-white shadow p-4 flex justify-between items-center">

    <h1 class="font-bold text-blue-600">
        RideShare
    </h1>

    <div class="space-x-4 text-sm">

        <a href="/home" class="text-gray-700 hover:text-blue-600">
            Home
        </a>

        <a href="/rides" class="text-gray-700 hover:text-blue-600">
            Available Rides
        </a>

        <a href="/my-bookings" class="text-gray-700 hover:text-blue-600">
            My Bookings
        </a>

        @if(auth()->user()->role === 'driver')
            <a href="/driver/dashboard" class="text-purple-600 font-semibold">
                Driver Dashboard
            </a>
        @endif

        <a href="/profile" class="text-gray-700 hover:text-blue-600">
            Profile
        </a>

    </div>

</div>