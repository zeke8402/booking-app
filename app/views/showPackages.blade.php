@extends('layout')
@section('content')

  <h3>Select Package</h3>
  <div class="large-12 columns text-center">
  @foreach($packages as $package)
   
    <p><b>Package:</b><a href="bookAppointment/{{ $package->id }}">{{ $package->package_name }}</a><br>
    <b>Price:</b>{{ $package->package_price }}<br>
    <b>Description:</b>{{ $package->package_description }}</p>
    <br><br>
  @endforeach
</div>
 
@stop
