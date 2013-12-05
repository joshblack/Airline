@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="/client/<?php echo Auth::user()->id; ?>/flights">My Flights</a></li>
        <li><a href="logout">Logout</a></li>
      @elseif (Auth::user()->role == 'agent')
        <li class="active"><a href="/agents/flights">Flight Info</a></li>
        <li><a href="/agents/reservations">Reservations</a></li>
        <li><a href="/logout">Logout</a></li>
      @endif
    @else
      <li><a href="login">Login</a></li>
    @endif 
  </ul>
  <h3 class="text-muted">JJ Airlines</h3>
</div>

@if ($message = Session::get('success'))
  <h4>Success</h4>
  {{ $message }}  
@endif

@if ($message = Session::get('error'))
  <h4>Error</h4>
  {{ $message }}  
@endif
<a href="/flights/new"><h4>Create a New Trip</h4></a>
<hr></hr>

<form class="form-signin" action="/agents/flights/<?php echo $trip[0]->tripNum; ?>/edit" method="POST">
    <h3 class="form-signin-heading">Edit The Trip Information</h3>
    <input type="text" class="form-control" name="airline" value="<?php echo $trip[0]->airline; ?>"placeholder="Airline Name">
    <input type="text" class="form-control" name="price" value="<?php echo $trip[0]->price; ?>" placeholder="Price" required>
    <input type="text" class="form-control" name="departure" value="<?php echo $trip[0]->departure; ?>" placeholder="Departure City" readonly>
    <input type="text" class="form-control" name="destination" value="<?php echo $trip[0]->destination; ?>" placeholder="Destination City" readonly>
    <input type="text" class="form-control" name="numOfLegs" value="<?php echo $trip[0]->numOfLegs; ?>" placeholder="Number of Legs" readonly>
    <input type="hidden" name="tripNum" value="<?php echo $trip[0]->tripNum; ?>">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Trip</button>
</form>

<form class="form-signin" action="/agents/flights/<?php echo $trip[0]->tripNum; ?>/delete" method="POST">
	<button class="btn btn-lg btn-danger btn-block" type="submit">Delete Trip</button>
</form>
@stop