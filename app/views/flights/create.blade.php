@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/">Home</a></li>
    <li><a href="/flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="#">My Flights</a></li>
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

@if ($message = Session::get('error'))
  <h4>Error</h4>
  {{ $message }}  
@endif

<form class="form-signin" action="/agents/flights/new" method="POST">
    <h3 class="form-signin-heading">Enter The Trip Information</h3>
    <input type="text" class="form-control" name="airline" placeholder="Airline Name" required>
    <input type="text" class="form-control" name="price" placeholder="Price" required>
    <input type="text" class="form-control" name="departure" placeholder="Departure City" required>
    <input type="text" class="form-control" name="destination" placeholder="Destination City" required>
    <input type="text" class="form-control" name="numOfLegs" placeholder="Number of Legs" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Create Trip</button>
</form>

@stop