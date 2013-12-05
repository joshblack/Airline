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

<form class="form-signin" action="/agents/flights/flightlegs/new" method="POST">
	<?php $flightLegNum = 1; while ($numOfLegs > 0) { ?>
		<?php if ($numOfLegs == $trip['numOfLegs']) { ?>
		    <h3 class="form-signin-heading">Enter Flight Leg Number {{ $flightLegNum }} Information</h3>
			<div class="form-group">
				<label for="date">Departure Date</label>
				<input type="datetime-local" name="departure<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Departure Date" required>
			</div>
			<div class="form-group">
				<label for="date">Destination Date</label>
				<input type="datetime-local" name="destination<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Destination Date" required>
			</div>
		    <input type="text" class="form-control" name="departure<?php echo $flightLegNum; ?>" value="{{ $trip['departure'] }}" readonly>
		    <input type="text" class="form-control" name="destination<?php echo $flightLegNum; ?>" placeholder="Destination City" required>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		    <input type="text" class="form-contorl" name="airplane<?php echo $flightLegNum; ?>" placeholder="Airplane ID" required>
		<?php } elseif ($numOfLegs == 1) {?>
			<h3 class="form-signin-heading">Enter Flight Leg Number {{ $flightLegNum }} Information</h3>
			<div class="form-group">
				<label for="date">Departure Date</label>
				<input type="datetime-local" name="departure<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Departure Date" required>
			</div>
			<div class="form-group">
				<label for="date">Destination Date</label>
				<input type="datetime-local" name="destination<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Destination Date" required>
			</div>
		    <input type="text" class="form-control" name="departure<?php echo $flightLegNum; ?>" placeholder="Departure City (Destination of Previous Leg)" required>
		    <input type="text" class="form-control" name="destination<?php echo $flightLegNum; ?>" value="{{ $trip['destination'] }}" placeholder="{{ $trip['destination'] }}" readonly>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		    <input type="text" class="form-contorl" name="airplane<?php echo $flightLegNum; ?>" placeholder="Airplane ID" required>
		<?php } else { ?>
			<h3 class="form-signin-heading">Enter Flight Leg Number {{ $flightLegNum }} Information</h3>
			<div class="form-group">
				<label for="date">Departure Date</label>
				<input type="datetime-local" name="departure<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Departure Date" required>
			</div>
			<div class="form-group">
				<label for="date">Destination Date</label>
				<input type="datetime-local" name="destination<?php echo $flightLegNum; ?>-date" class="form-control" id="date" placeholder="Destination Date" required>
			</div>
		    <input type="text" class="form-control" name="departure<?php echo $flightLegNum; ?>" placeholder="Departure City (Destination of Previous Leg)" required>
		    <input type="text" class="form-control" name="destination<?php echo $flightLegNum; ?>" placeholder="Destination" required>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		    <input type="text" class="form-contorl" name="airplane<?php echo $flightLegNum; ?>" placeholder="Airplane ID" required>
		<?php } ?>
	<?php $numOfLegs--; $flightLegNum++; }?>
	<input type="hidden" name="tripNum" value="{{ $trip['tripNum'] }}">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Create Flight Legs</button>
</form>


@stop