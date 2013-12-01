@extends('master')

@section('content')

<form class="form-signin" action="payment" method="POST">
    <h3 class="form-signin-heading">Enter The Trip Information</h3>
    <input type="text" class="form-control" name="airline" placeholder="Airline Name" required>
    <input type="text" class="form-control" name="price" placeholder="Price" required>
    <input type="text" class="form-control" name="departure" placeholder="Departure City" required>
    <input type="text" class="form-control" name="destination" placeholder="Destination City" required>
    <input type="text" class="form-control" name="numLegs" placeholder="Number of Legs" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Create Trip</button>
</form>


@stop