@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li class="active"><a href="/flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="/client/<?php echo Auth::user()->id; ?>/flights">My Flights</a></li>
        <li><a href="/logout">Logout</a></li>
      @elseif (Auth::user()->role == 'agent')
        <li><a href="/agents/flights">Flight Info</a></li>
        <li><a href="/agents/reservations">Reservations</a></li>
        <li><a href="/logout">Logout</a></li>
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
    <input type="datetime-local" name="flight-date" class="form-control" id="date" placeholder="Input a Date (ex. 1/1/1111 1:30PM)" required>
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