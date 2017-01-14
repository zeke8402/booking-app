@extends('layout')
@section('content')
<br><br><br>
<?php $link = Request::root(); ?>
<center>
  <div class="panel">
    <h1>Select a Day</h1>
    <p>You have choosen <b> {{ $packageName }} </b></p>
    <h3 id="currentDate">  </h3>
  </div>
</center>

<div class="col-md-11 text-center">
  <div class="col-md-offset-4 col-lg-offset-1 col-md-2 col-lg-6">
    <div id="calendar"></div>
  </div>
  <div class="col-md-offset-2 col-lg-offset-1 col-md-2 col-lg-2">
    <div class="panel panel-primary">
      <div class="panel-heading" id="daySelect">
        Select a Day
      </div>
      <div class="panel-body">
        <p id="dayTimes"></p>
      </div>
    </div>
  </div>
</div>

<!-- Calendar Functionality -->
<script src="{{ asset('/js/calendar.js') }}"></script>
@endsection

