@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li class="active"><a href="/">Home</a></li>
    <li><a href="flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="#">My Flights</a></li>
        <li><a href="logout">Logout</a></li>
      @elseif (Auth::user()->role == 'agent')
        <li><a href="#">My Flights</a></li>
        <li><a href="#">Edit Flight Info</a></li>
        <li><a href="logout">Logout</a></li>
      @endif
    @else
      <li><a href="login">Login</a></li>
    @endif 
  </ul>
  <h3 class="text-muted">JJ Airlines</h3>
</div>

<form role="form" action="flights" method="post">
  <div class="form-group">
    <label for="date">Date</label>
    <input type="datetime-local" name="flight-date" class="form-control" id="date" placeholder="Select a Date" required>
  </div>
  <div class="form-group">
    <label for="Departure">Departure</label>
    <input type="text" class="form-control" name="departure" id="Departure" placeholder="Atlanta" required>
  </div>
  <div class="form-group">
    <label for="Destination">Destination</label>
    <input type="text" class="form-control" name="destination" id="Destination" placeholder="Gainesville" required>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="flexible-date" value="true">
      Select for flexible dates
    </label>
  </div>
  <button type="submit" class="btn btn-success">Look for flights</button>
</form>

@stop