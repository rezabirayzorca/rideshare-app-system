<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ride;
use App\Models\User;

class Booking extends Model
{
    protected $fillable = [
        'ride_id',
        'passenger_id',
        'seats',
        'total_fare',
        'status'
    ];

    // 🔹 Relationship: Booking belongs to Ride
    public function ride()
    {
        return $this->belongsTo(Ride::class);
    }

    // 🔹 Relationship: Booking belongs to Passenger (User)
    public function passenger()
    {
        return $this->belongsTo(User::class, 'passenger_id');
    }
}