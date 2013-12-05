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
        <li><a href="/agents/flights">Flight Info</a></li>
        <li  class="active"><a href="/agents/reservations">Reservations</a></li>
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

<table class="table table-striped span8 table-bordered" >
	<tr>
		<th>Reservation Number</th>
		<th>Email</th>
		<th>Name</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Reservation Date</th>
		<th>Edit Reservation</th>
	</tr>
  	<?php foreach ($reservations as $reservation): ?>
	  	<tr>
	  		<td>{{ $reservation->reservationNum }}</td>
	  		<td>{{ $reservation->email }}</td>
	  		<td>{{ $reservation->name }}</td>
	  		<td>{{ $reservation->address }}</td>
	  		<td>{{ $reservation->phone }}</td>
	  		<td><?php $reservationDate = new Datetime($reservation->reservationDate);
			echo $reservationDate->format("g:i A M j, Y "); ?></td>
	  		<td><a href="/agents/reservations/{{ $reservation->reservationNum }}/edit">Edit</a></td>
	  	</tr>
  	<?php endforeach; ?>

</table>

@stop