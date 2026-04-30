<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ride;

class BookingController extends Controller
{
    // 🔹 BOOK RIDE
    public function store(Request $request, $rideId)
    {
        $ride = Ride::findOrFail($rideId);

        $seats = $request->seats;

        if ($ride->available_seats < $seats) {
            return back()->with('error', 'Not enough seats available');
        }

        $total = $ride->price_per_seat * $seats;

        Booking::create([
            'ride_id' => $ride->id,
            'passenger_id' => auth()->id(),
            'seats' => $seats,
            'total_fare' => $total,
            'status' => 'pending'
        ]);

        $ride->decrement('available_seats', $seats);

        return redirect('/rides')->with('success', 'Ride booked successfully!');
    }

    // 🔹 MY BOOKINGS
    public function myBookings()
    {
        $bookings = Booking::with('ride')
            ->where('passenger_id', auth()->id())
            ->latest()
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    // 🔹 ACCEPT BOOKING
    public function accept($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        return back();
    }

    // 🔹 REJECT BOOKING
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return back();
    }
}