@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="#">My Flights</a></li>
        <li><a href="logout">Logout</a></li>
      @elseif (Auth::user()->role == 'agent')
        <li><a href="/agents/flights">Edit Flight Info</a></li>
        <li  class="active"><a href="/agents/reservations">Edit Reservations</a></li>
        <li><a href="/logout">Logout</a></li>
      @endif
    @else
      <li><a href="login">Login</a></li>
    @endif 
  </ul>
  <h3 class="text-muted">JJ Airlines</h3>
</div>

<form class="form-signin" action="/agents/reservations/<?php echo $reservation[0]->reservationNum; ?>/edit" method="POST">
    <h3 class="form-signin-heading">Edit The Reservation Information</h3>
    <input type="text" class="form-control" name="reservationNum" value="<?php echo $reservation[0]->reservationNum; ?>" placeholder="<?php echo $reservation[0]->reservationNum; ?>" readonly>
    <input type="text" class="form-control" name="email" value="<?php echo $reservation[0]->email ?>" required>
    <input type="text" class="form-control" name="name" value="<?php echo $reservation[0]->name ?>" required>
    <input type="text" class="form-control" name="address" value="<?php echo $reservation[0]->address ?>" required>
    <input type="text" class="form-control" name="phone" value="<?php echo $reservation[0]->phone ?>" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Edit Reservation</button>
</form>

<form class="form-signin" action="/agents/reservations/<?php echo $reservation[0]->reservationNum; ?>/delete" method="POST">
	<button class="btn btn-lg btn-danger btn-block" type="submit">Delete Reservation</button>
</form>


@stop