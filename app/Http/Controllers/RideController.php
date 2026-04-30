<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ride;

class RideController extends Controller
{
    public function index(Request $request)
    {
        $rides = Ride::query();

        if ($request->origin || $request->destination || $request->date || $request->seats) {

            if ($request->origin) {
                $rides->where('origin', 'like', '%' . $request->origin . '%');
            }

            if ($request->destination) {
                $rides->where('destination', 'like', '%' . $request->destination . '%');
            }

            if ($request->date) {
                $rides->whereDate('date', $request->date);
            }

            if ($request->seats) {
                $rides->where('available_seats', '>=', $request->seats);
            }

            $rides = $rides->latest()->get();

        } else {
            $rides = collect();
        }

        return view('rides.index', compact('rides'));
    }

    public function driverDashboard()
    {
        $rides = Ride::with('bookings.passenger')
            ->where('driver_id', auth()->id())
            ->latest()
            ->get();

        return view('driver.dashboard', compact('rides'));
    }

    // 🔹 SHOW CREATE FORM
    public function create()
    {
        return view('driver.create');
    }

    // 🔹 STORE NEW RIDE
    public function store(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'seats' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Ride::create([
            'origin' => $request->origin,
            'destination' => $request->destination,
            'date' => $request->date,
            'time' => $request->time,
            'available_seats' => $request->seats,
            'price_per_seat' => $request->price,
            'driver_id' => auth()->id(),
            'status' => 'pending'
        ]);

        return redirect('/driver/dashboard')->with('success', 'Ride created!');
    }

    // 🔹 SEARCH RESULTS (optional separate page)
    public function results(Request $request)
    {
        $rides = Ride::with('driver')
            ->where('origin', 'like', '%' . $request->origin . '%')
            ->where('destination', 'like', '%' . $request->destination . '%')
            ->whereDate('date', $request->date)
            ->where('available_seats', '>=', $request->seats ?? 1)
            ->latest()
            ->get();

        return view('rides.results', compact('rides'));
    }
}