@extends('layout')
@section('content')
<div class="row jumbotron text-center">
  <h1>Confirm Appointment</h1>
</div>

<div class="row col-md-6 well center-block">
  <h3 id="momentDate"></h3>
  <legend>Patient Details</legend>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Contact Number</th>
        <th>E-Mail</th>
        <th>Newsletter</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{ $appointmentInfo['fname'] }} </td>
        <td>{{ $appointmentInfo['lname'] }} </td>
        <td>{{ $appointmentInfo['number'] }} </td>
        <td>{{ $appointmentInfo['email'] }} </td>
        <td>{{ $appointmentInfo['updates'] }} </td>
      </tr>
    </tbody>
  </table>
  
  <div class="text-center">
  <a href="confirmed" class="btn btn-primary">Confirm Appointment</a>
  </div>
  
</div>
<br><br><br><br><br>

<script>
  $(document).ready(function() {
    mDate = moment({{ "'".Session::get('selection')."'" }});
    $('#momentDate').text("On " + mDate.format("MMMM Do, YYYY"));
  })
</script>
@stop
