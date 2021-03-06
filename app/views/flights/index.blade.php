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

<h3>Results:</h3>
<table class="table table-striped span8 table-bordered" >
	<tr>
		<th>Date</th>
		<th>Departure</th>
		<th>Destination</th>
		<th>Price</th>
		<th>Book Now</th>
	</tr>
  <?php if ($tripType == 1): ?>
  	<?php foreach ($tripInfo as $trip): ?>
  	<tr>
  		<td><?php echo $flightDate->format("g:i A M j, Y "); ?></td>
  		<td>{{ $trip->departure }}</td>
  		<td>{{ $trip->destination }}</td>
  		<td>${{ $trip->price }}</td>
  		<td><a href="<?php echo 'reservation/' . $trip->departure . '/' . $trip->destination . '/' . $flightDate->format("g:i A M j, Y ") . ''?>">Book Now</a></td>
  	</tr>
  	<?php endforeach; ?>
  <?php elseif ($tripInfo == NULL || $tripInfo == 1): ?>
    <tr>
      <td>No flights found</td>
      <td>No flights found</td>
      <td>No flights found</td>
      <td>No flights found</td>
      <td>No flights found</td>
    </tr>
  <?php else: ?>
    <?php foreach ($tripInfo as $trip): ?>
      <tr>
        <td><?php $i = 0; $formatFlight = new Datetime($tripInfo[$i]['flightTime']); echo $formatFlight->format("g:i A M j, Y "); $i++;?></td>
        <td><?php echo $trip[0]->departure; ?></td>
        <td>{{ $trip[0]->destination }}</td>
        <td>${{ $trip[0]->price }}</td>
        <td><a href="<?php echo 'reservation/' . $trip[0]->departure . '/' . $trip[0]->destination . '/' . $formatFlight->format("g:i A M j, Y ") . ''?>">Book Now</a></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

@stop