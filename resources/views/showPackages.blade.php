@extends('layout')
@section('content')

  
  <div class="row text-center">
  <h1>Select Package</h1>
  @foreach($packages as $package)
   
    <div class="col-md-4 center-block" style="float:none;">
    <div class="panel panel-default">
      <div class="panel-heading">
    <p><b>Package: </b><a href="booking/calendar/{{ $package->id }}">{{ $package->package_name }}</a><br>
      </div>
      <div class="panel-body">
    <b>Time: </b>{{ $package->package_time }} hours<br>
    <b>Price: </b>{{ $package->package_price }}<br>
    <b>Description: </b>{{ $package->package_description }}</p>
    </div>
</div>
</div>
  @endforeach
</div>
 
@stop
