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

@if ($message = Session::get('success'))
  <h4>Success</h4>
  {{ $message }}  
@endif

<div class="jumbotron">
  <h1>Welcome!</h1>
  <p class="lead">Looking for a flight to the hottest destination? Maybe a getaway from all the noise?
    Book now for the highest deals along with the lowest rates!</p>
  <p><a class="btn btn-lg btn-success" href="signup" role="button">Sign up today</a></p>
</div>

<div class="row marketing">
  <div class="col-lg-6">
    <h4>Catch a Flight</h4>
    <p>Search for flights when YOU want them.</p>

    <h4>Find the closest date</h4>
    <p>Look for a flight that matches what you want and grab the cheapest one.</p>

    <h4>Review your trips</h4>
    <p>Not sure when your departure time is? Don't worry, we've got your back.</p>
  </div>

  <div class="col-lg-6">
    <h4>Power to the Flight Agents!</h4>
    <p>Easily create, edit and delete flight scheduling information.</p>

    <h4>Make a Payment</h4>
    <p>Easily pay any ticket cost through our payment system.</p>

    <h4>Sales Sales Sales</h4>
    <p>Flight agents have the ability to see what's hot and what's not in the clear blue skies.</p>
  </div>
</div>

@stop