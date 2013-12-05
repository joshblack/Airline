@extend('master')

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

<table class="table table-striped span8 table-bordered" >
	<tr>
		<th>Trip Number</th>
		<th>Departure</th>
		<th>Destination</th>
		<th>Price</th>
		<th># Seats Available</th>
	</tr>
  	<tr>
  		<td>{{ $trip[0]->tripNum }}</td>
  		<td>{{ $trip[0]->departure }}</td>
  		<td>{{ $trip[0]->destination }}</td>
  		<td>${{ $trip[0]->price }}</td>
  		<td>{{ $numSeats }}</td>
  	</tr>
</table>

@stop