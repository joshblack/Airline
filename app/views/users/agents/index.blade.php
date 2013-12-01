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
        <li><a href="#">My Flights</a></li>
        <li class="active"><a href="/agents/flights">Edit Flight Info</a></li>
        <li><a href="/agents/reservations">Edit Reservations</a></li>
        <li><a href="logout">Logout</a></li>
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

@if ($message = Session::get('error'))
  <h4>Error</h4>
  {{ $message }}  
@endif

<a href="flights/new"><h4>Create a New Trip</h4></a>
<table class="table table-striped span8 table-bordered" >
  <tr>
    <th>Trip Number</th>
    <th>Airline</th>
    <th>Departure</th>
    <th>Destination</th>
    <th>Price</th>
    <th>Number of Legs</th>
    <th>Edit</th>
  </tr>
  <?php foreach ($trips as $tripInfo): ?>
    <tr>
      <td>{{ $tripInfo->tripNum }}</td>
      <td>{{ $tripInfo->airline }}</td>
      <td>{{ $tripInfo->departure }}</td>
      <td>{{ $tripInfo->destination }}</td>
      <td>${{ $tripInfo->price }}</td>
      <td>{{ $tripInfo->numOfLegs }}</td>
      <td><a href="flights/<?php echo $tripInfo->tripNum; ?>/edit">Edit Flight</a></td>
  <?php endforeach; ?>

</table>



@stop