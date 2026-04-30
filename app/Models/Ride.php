<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Booking;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'origin',
        'destination',
        'date',
        'time',
        'available_seats',
        'price_per_seat',
        'status',
    ];

    // 🔹 Ride belongs to Driver (User)
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    // 🔹 Ride has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}