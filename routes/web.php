<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RideController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//booking
Route::post('/book/{ride}', [BookingController::class, 'store'])
    ->middleware('auth');
Route::get('/my-bookings', [BookingController::class, 'myBookings'])
    ->middleware('auth');
Route::post('/booking/{id}/accept', [BookingController::class, 'accept']);
Route::post('/booking/{id}/reject', [BookingController::class, 'reject']);

//rides
Route::get('/rides', [RideController::class, 'index'])
    ->middleware('auth');
    Route::get('/rides/result', [RideController::class, 'results'])->middleware('auth');


//
Route::get('/driver/dashboard', [RideController::class, 'driverDashboard'])
    ->middleware('auth');
Route::get('/driver/create', [RideController::class, 'create'])->middleware('auth');
Route::post('/driver/store', [RideController::class, 'store'])->middleware('auth');
Route::get('/driver/dashboard', [RideController::class, 'driverDashboard'])->middleware('auth');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');

require __DIR__ . '/auth.php';
