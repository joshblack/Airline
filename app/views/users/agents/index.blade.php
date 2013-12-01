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

<a href="flights/new"><h4>Create a New Trip</h4></a>
<table class="table table-striped span8 table-bordered" >
  <tr>
    <th>Trip Number</th>
    <th>Departure</th>
    <th>Destination</th>
    <th>Price</th>
    <th>Number of Legs</th>
    <th>Edit</th>
  </tr>
  <?php foreach ($trips as $tripInfo): ?>
    <tr>
      <td>{{ $tripInfo->tripNum }}</td>
      <td>{{ $tripInfo->departure }}</td>
      <td>{{ $tripInfo->destination }}</td>
      <td>${{ $tripInfo->price }}</td>
      <td>{{ $tripInfo->numOfLegs }}</td>
      <td><a href="#">Edit Flight</a></td>
  <?php endforeach; ?>

</table>



@stop