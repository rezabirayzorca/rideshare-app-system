@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-4">Create Ride</h1>

<form method="POST" action="/driver/store" class="space-y-3">
@csrf

<input name="origin" placeholder="From" class="border p-2 w-full">
<input name="destination" placeholder="To" class="border p-2 w-full">
<input type="date" name="date" class="border p-2 w-full">
<input type="time" name="time" class="border p-2 w-full">
<input type="number" name="seats" placeholder="Seats" class="border p-2 w-full">
<input type="number" name="price" placeholder="Price" class="border p-2 w-full">

<button class="bg-blue-600 text-white px-4 py-2 rounded">
    Create Ride
</button>

</form>

@endsection