@extends('master')

@section('content')

<div class="header">
  <ul class="nav nav-pills pull-right">
    <li><a href="/">Home</a></li>
    <li><a href="flights">Book a Flight</a></li>
    @if ( Auth::check() )
      @if ( Auth::user()->role == 'client')
        <li><a href="#">My Flights</a></li>
        <li><a href="logout">Logout</a></li>
      @elseif (Auth::user()->role == 'agent')
        <li><a href="#">My Flights</a></li>
        <li class="active"><a href="#">Edit Flight Info</a></li>
        <li><a href="logout">Logout</a></li>
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
		    <input type="text" class="form-control" name="departure<?php echo $flightLegNum; ?>" value="{{ $trip['departure'] }}" readonly>
		    <input type="text" class="form-control" name="destination<?php echo $flightLegNum; ?>" placeholder="Destination City" required>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		<?php } elseif ($numOfLegs == 0) {?>
			<h3 class="form-signin-heading">Enter Flight Leg Number {{ $flightLegNum }} Information</h3>
		    <input type="text" class="form-control" name="departure<?php echo $flightLegNum; ?>" value="" required>
		    <input type="text" class="form-control" name="price" placeholder="Price" required>
		    <input type="text" class="form-control" name="departure" placeholder="Departure City" required>
		    <input type="text" class="form-control" name="destination" placeholder="Destination City" required>
		    <input type="text" class="form-control" name="numLegs" placeholder="Number of Legs" required>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		<?php } else { ?>
			<h3 class="form-signin-heading">Enter Flight Leg Number {{ $flightLegNum }} Information</h3>
		    <input type="text" class="form-control" name="airline" placeholder="Airline Name" required>
		    <input type="text" class="form-control" name="price" placeholder="Price" required>
		    <input type="text" class="form-control" name="departure" placeholder="Departure City" required>
		    <input type="text" class="form-control" name="destination" placeholder="Destination City" required>
		    <input type="text" class="form-control" name="numLegs" placeholder="Number of Legs" required>
		    <input type="hidden" class="form-control" name="flightLeg<?php echo $flightLegNum; ?>" value="<?php echo $flightLegNum; ?>">
		<?php } ?>
	<?php $numOfLegs--; $flightLegNum++; }?>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Create Flight Legs</button>
</form>


@stop